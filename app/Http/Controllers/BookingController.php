<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Kuota;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    const HARGA_PER_ORANG = 125000;
    const KUOTA_HARIAN = 20;
    const MAX_PER_BOOKING = 10;

    /**
     * Redirect to the new user booking page.
     */
    public function index()
    {
        return redirect()->route('user.booking');
    }

    /**
     * AJAX: Get remaining quota for a specific date.
     */
    public function getQuota(Request $request)
    {
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['remaining' => self::KUOTA_HARIAN]);
        }

        $terisi = Booking::where('tanggal_kunjungan', $date)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        $remaining = max(0, self::KUOTA_HARIAN - $terisi);

        return response()->json([
            'remaining' => $remaining,
            'max_quota' => self::KUOTA_HARIAN,
            'filled' => $terisi,
        ]);
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_kunjungan' => ['required', 'date', 'after_or_equal:today'],
            'jumlah_orang'      => ['required', 'integer', 'min:1', 'max:' . self::MAX_PER_BOOKING],
            'nama_peserta'      => ['required', 'array', 'min:1'],
            'nama_peserta.*'    => ['required', 'string', 'max:255'],
            'no_hp_peserta'     => ['nullable', 'array'],
            'no_hp_peserta.*'   => ['nullable', 'string', 'max:20'],
        ], [
            'tanggal_kunjungan.required'    => 'Tanggal kunjungan wajib dipilih.',
            'tanggal_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh di masa lalu.',
            'jumlah_orang.required'         => 'Jumlah peserta wajib diisi.',
            'jumlah_orang.min'              => 'Minimal 1 peserta per booking.',
            'jumlah_orang.max'              => 'Maksimal ' . self::MAX_PER_BOOKING . ' peserta per booking.',
            'nama_peserta.required'         => 'Data peserta wajib diisi.',
            'nama_peserta.*.required'       => 'Nama peserta tidak boleh kosong.',
        ]);

        $tanggal = $request->tanggal_kunjungan;
        $jumlah  = (int) $request->jumlah_orang;

        // Validasi: hanya Sabtu & Minggu (0=Minggu, 6=Sabtu)
        $dayOfWeek = date('w', strtotime($tanggal));
        if ($dayOfWeek != 0 && $dayOfWeek != 6) {
            return back()->withInput()->with('error', 'Booking hanya tersedia pada hari Sabtu & Minggu.');
        }

        // Cek kuota harian
        $terisi = Booking::where('tanggal_kunjungan', $tanggal)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        $sisa = self::KUOTA_HARIAN - $terisi;

        if (($terisi + $jumlah) > self::KUOTA_HARIAN) {
            return back()->withInput()->with(
                'error',
                "Kuota tidak mencukupi! Sisa kuota untuk tanggal tersebut adalah {$sisa} orang."
            );
        }

        // Generate kode booking unik
        $kode = 'BK-' . strtoupper(substr(uniqid(), -6));

        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'id_user'           => Auth::id(),
                'tanggal_kunjungan' => $tanggal,
                'jumlah_orang'      => $jumlah,
                'total_harga'       => $jumlah * self::HARGA_PER_ORANG,
                'kode_booking'      => $kode,
                'status_booking'    => 'pending',
            ]);

            // Simpan detail peserta
            $namaPeserta = $request->nama_peserta;
            $noHpPeserta = $request->no_hp_peserta ?? [];

            foreach ($namaPeserta as $i => $nama) {
                if (!empty(trim($nama))) {
                    BookingDetail::create([
                        'id_booking'   => $booking->id_booking,
                        'nama_peserta' => trim($nama),
                        'no_hp'        => isset($noHpPeserta[$i]) ? trim($noHpPeserta[$i]) : null,
                    ]);
                }
            }

            DB::commit();

            $total = number_format($booking->total_harga, 0, ',', '.');
            return redirect()->route('booking.index')->with(
                'success',
                "Booking berhasil! Kode: <strong>{$kode}</strong>. Total: Rp {$total}. Segera lakukan pembayaran."
            );
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking failed: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->except(['_token'])
            ]);
            return back()->withInput()->with('error', 'Gagal melakukan booking. Silakan coba lagi.');
        }
    }

    /**
     * AJAX: Get or generate Midtrans Snap Token for a booking.
     */
    public function pay(Request $request, $id)
    {
        $booking = Booking::with(['user', 'pembayaran'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        if ($booking->status_booking !== 'pending') {
            return response()->json(['error' => 'Booking ini sudah tidak berstatus pending.'], 400);
        }

        $pembayaran = $booking->pembayaran;
        if ($pembayaran && $pembayaran->snap_token && in_array($pembayaran->transaction_status, ['pending', 'authorize'])) {
            return response()->json([
                'snap_token' => $pembayaran->snap_token,
                'order_id'   => $pembayaran->order_id,
            ]);
        }

        $orderId = $booking->kode_booking . '-' . time();
        $serverKey = config('midtrans.server_key', env('MIDTRANS_SERVER_KEY', ''));
        $isProduction = config('midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
        $snapUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $booking->total_harga,
            ],
            'customer_details' => [
                'first_name' => $booking->user->nama_lengkap,
                'email'      => $booking->user->email,
                'phone'      => $booking->user->no_hp ?? '',
            ],
            'item_details' => [
                [
                    'id'       => $booking->kode_booking,
                    'price'    => self::HARGA_PER_ORANG,
                    'quantity' => (int) $booking->jumlah_orang,
                    'name'     => 'Tiket Masuk & Camping Tebing Linggasana',
                ]
            ],
        ];

        try {
            $response = Http::withBasicAuth($serverKey, '')
                ->contentType('application/json')
                ->acceptJson()
                ->post($snapUrl, $payload);

            if ($response->failed()) {
                Log::error('Midtrans Snap request failed: ' . $response->body());
                return response()->json(['error' => 'Gagal menghubungi Midtrans Snap API.'], 500);
            }

            $data = $response->json();
            $snapToken = $data['token'] ?? null;

            if (!$snapToken) {
                Log::error('Midtrans Snap token not found in response: ' . json_encode($data));
                return response()->json(['error' => 'Gagal mendapatkan token transaksi dari Midtrans.'], 500);
            }

            if ($pembayaran) {
                $pembayaran->update([
                    'order_id'           => $orderId,
                    'gross_amount'       => (int) $booking->total_harga,
                    'snap_token'         => $snapToken,
                    'transaction_status' => 'pending',
                ]);
            } else {
                Pembayaran::create([
                    'id_booking'         => $booking->id_booking,
                    'order_id'           => $orderId,
                    'gross_amount'       => (int) $booking->total_harga,
                    'snap_token'         => $snapToken,
                    'transaction_status' => 'pending',
                ]);
            }

            return response()->json([
                'snap_token' => $snapToken,
                'order_id'   => $orderId,
            ]);

        } catch (\Exception $e) {
            Log::error('Pay exception: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the printable ticket for a paid booking.
     */
    public function ticket($id)
    {
        $booking = Booking::with(['user', 'details', 'pembayaran'])->findOrFail($id);

        // Access control: only owner or admin
        if ($booking->id_user !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke tiket ini.');
        }

        // Verify payment is successful
        $status = strtolower($booking->status_booking);
        if (!in_array($status, ['dibayar', 'lunas', 'success', 'settlement', 'terkonfirmasi', 'confirmed'])) {
            return redirect()->route('booking.index')->with('error', 'Tiket belum tersedia karena status pembayaran belum lunas.');
        }

        return view('katalog_user.ticket', compact('booking'));
    }
}
