<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Midtrans Server Key from config/env
     */
    private function getMidtransServerKey(): string
    {
        return config('midtrans.server_key', env('MIDTRANS_SERVER_KEY', ''));
    }

    private function getMidtransBaseUrl(): string
    {
        $isProduction = config('midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
        return $isProduction
            ? 'https://api.midtrans.com/v2'
            : 'https://api.sandbox.midtrans.com/v2';
    }

    /**
     * Display payment monitor page.
     */
    public function index(Request $request)
    {
        $query = Pembayaran::with(['booking.user'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('transaction_status', $request->status);
        }

        // Search by order_id, kode_booking, or user name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                  ->orWhereHas('booking', function ($bq) use ($search) {
                      $bq->where('kode_booking', 'like', "%{$search}%")
                         ->orWhereHas('user', fn($u) => $u->where('nama_lengkap', 'like', "%{$search}%"));
                  });
            });
        }

        $pembayarans = $query->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total'      => Pembayaran::count(),
            'pending'    => Pembayaran::whereIn('transaction_status', ['pending', 'authorize'])->count(),
            'settlement' => Pembayaran::whereIn('transaction_status', ['settlement', 'capture'])->count(),
            'gagal'      => Pembayaran::whereIn('transaction_status', ['deny', 'cancel', 'expire', 'failure'])->count(),
            'total_revenue' => Pembayaran::whereIn('transaction_status', ['settlement', 'capture'])->sum('gross_amount'),
        ];

        return view('pembayaran.index', compact('pembayarans', 'stats'));
    }

    /**
     * Sync a specific payment status from Midtrans.
     */
    public function sync(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('booking')->findOrFail($id);

        try {
            $serverKey  = $this->getMidtransServerKey();
            $baseUrl    = $this->getMidtransBaseUrl();
            $orderId    = $pembayaran->order_id;

            $response = Http::withBasicAuth($serverKey, '')
                ->timeout(15)
                ->get("{$baseUrl}/{$orderId}/status");

            if ($response->failed()) {
                return back()->with('error', "Gagal menghubungi Midtrans. HTTP {$response->status()}. Cek koneksi atau Order ID.");
            }

            $data = $response->json();
            $statusCode = $data['status_code'] ?? null;

            // 404 from Midtrans: order not found
            if ($statusCode == '404') {
                return back()->with('error', "Order ID <strong>{$orderId}</strong> tidak ditemukan di Midtrans.");
            }

            $transactionStatus = $data['transaction_status'] ?? $pembayaran->transaction_status;
            $transactionId     = $data['transaction_id']     ?? $pembayaran->transaction_id;
            $paymentType       = $data['payment_type']       ?? $pembayaran->payment_type;
            $transactionTime   = $data['transaction_time']   ?? $pembayaran->transaction_time;
            $grossAmount       = isset($data['gross_amount']) ? (int) $data['gross_amount'] : $pembayaran->gross_amount;

            $pembayaran->update([
                'transaction_status' => $transactionStatus,
                'transaction_id'     => $transactionId,
                'payment_type'       => $paymentType,
                'transaction_time'   => $transactionTime,
                'gross_amount'       => $grossAmount,
            ]);

            // Sync booking status based on transaction status
            if ($pembayaran->booking) {
                $bookingStatus = match(true) {
                    in_array($transactionStatus, ['settlement', 'capture'])          => 'dibayar',
                    in_array($transactionStatus, ['pending', 'authorize'])           => 'pending',
                    in_array($transactionStatus, ['deny', 'cancel', 'expire', 'failure']) => 'batal',
                    default => $pembayaran->booking->status_booking,
                };
                $pembayaran->booking->update(['status_booking' => $bookingStatus]);
            }

            Log::info("Midtrans sync success for order {$orderId}", $data);

            $statusLabel = strtoupper($transactionStatus);
            return back()->with('success', "Sinkronisasi berhasil! Order <strong>{$orderId}</strong> → Status: <strong>{$statusLabel}</strong>.");

        } catch (\Exception $e) {
            Log::error("Midtrans sync error: " . $e->getMessage());
            return back()->with('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

    /**
     * Sync ALL pending payments from Midtrans at once.
     */
    public function syncAll(Request $request)
    {
        $pendingPayments = Pembayaran::whereIn('transaction_status', ['pending', 'authorize'])->get();

        if ($pendingPayments->isEmpty()) {
            return back()->with('info', 'Tidak ada transaksi pending yang perlu disinkronkan.');
        }

        $serverKey = $this->getMidtransServerKey();
        $baseUrl   = $this->getMidtransBaseUrl();
        $synced    = 0;
        $failed    = 0;

        foreach ($pendingPayments as $pembayaran) {
            try {
                $response = Http::withBasicAuth($serverKey, '')
                    ->timeout(10)
                    ->get("{$baseUrl}/{$pembayaran->order_id}/status");

                if ($response->successful()) {
                    $data = $response->json();
                    $statusCode = $data['status_code'] ?? null;

                    if ($statusCode != '404') {
                        $transactionStatus = $data['transaction_status'] ?? $pembayaran->transaction_status;

                        $pembayaran->update([
                            'transaction_status' => $transactionStatus,
                            'transaction_id'     => $data['transaction_id'] ?? $pembayaran->transaction_id,
                            'payment_type'       => $data['payment_type']   ?? $pembayaran->payment_type,
                            'transaction_time'   => $data['transaction_time'] ?? null,
                            'gross_amount'       => isset($data['gross_amount']) ? (int)$data['gross_amount'] : $pembayaran->gross_amount,
                        ]);

                        if ($pembayaran->booking) {
                            $bookingStatus = match(true) {
                                in_array($transactionStatus, ['settlement', 'capture']) => 'dibayar',
                                in_array($transactionStatus, ['pending', 'authorize'])  => 'pending',
                                in_array($transactionStatus, ['deny', 'cancel', 'expire', 'failure']) => 'batal',
                                default => $pembayaran->booking->status_booking,
                            };
                            $pembayaran->booking->update(['status_booking' => $bookingStatus]);
                        }
                        $synced++;
                    }
                } else {
                    $failed++;
                }
            } catch (\Exception $e) {
                Log::error("Midtrans sync-all error for {$pembayaran->order_id}: " . $e->getMessage());
                $failed++;
            }
        }

        $msg = "Sinkronisasi selesai: <strong>{$synced}</strong> berhasil";
        if ($failed > 0) $msg .= ", <strong>{$failed}</strong> gagal";
        $msg .= ".";

        return back()->with('success', $msg);
    }
}
