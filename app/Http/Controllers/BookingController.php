<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Kuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    const HARGA_PER_ORANG = 125000;
    const KUOTA_HARIAN = 20;
    const MAX_PER_BOOKING = 10;

    /**
     * Display the booking page with user's booking history.
     */
    public function index()
    {
        $myBookings = Booking::with('details')
            ->where('id_user', Auth::id())
            ->orderBy('tanggal_booking', 'desc')
            ->get();

        return view('booking.index', compact('myBookings'));
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
            return back()->withInput()->with('error', 'Gagal melakukan booking. Silakan coba lagi.');
        }
    }
}
