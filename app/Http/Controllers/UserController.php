<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Dokumentasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display the user's booking page.
     */
    public function booking()
    {
        $userId = Auth::id();
        
        // Auto-sync pending payments for the logged-in user
        $pendingPayments = \App\Models\Pembayaran::whereHas('booking', function ($q) use ($userId) {
                $q->where('id_user', $userId)
                  ->where('status_booking', 'pending');
            })
            ->whereIn('transaction_status', ['pending', 'authorize'])
            ->get();

        if ($pendingPayments->isNotEmpty()) {
            $serverKey = config('midtrans.server_key', env('MIDTRANS_SERVER_KEY', ''));
            $isProduction = config('midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
            $baseUrl = $isProduction
                ? 'https://api.midtrans.com/v2'
                : 'https://api.sandbox.midtrans.com/v2';

            foreach ($pendingPayments as $pembayaran) {
                try {
                    $response = Http::withBasicAuth($serverKey, '')
                        ->timeout(5)
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
                        }
                    }
                } catch (\Exception $e) {
                    \Log::error("Auto sync payment error: " . $e->getMessage());
                }
            }
        }

        $myBookings = Booking::with(['details', 'pembayaran'])
            ->where('id_user', $userId)
            ->orderBy('tanggal_booking', 'desc')
            ->get();

        return view('katalog_user.booking', compact('myBookings'));
    }

    /**
     * Display the public gallery (galeri kenangan).
     */
    public function galeri()
    {
        $photos = Dokumentasi::orderBy('tanggal_upload', 'desc')
            ->orderBy('id_foto', 'desc')
            ->paginate(12);

        return view('katalog_user.galeri', compact('photos'));
    }

    /**
     * Display the user's profile settings page.
     */
    public function profil()
    {
        return view('katalog_user.profil');
    }

    /**
     * Update the authenticated user's profile.
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid (contoh: 081234567890).',
        ]);

        $noHp = $data['no_hp'];
        if (str_starts_with($noHp, '+62')) {
            $noHp = '0' . substr($noHp, 3);
        } elseif (str_starts_with($noHp, '62')) {
            $noHp = '0' . substr($noHp, 2);
        }

        $userModel = User::findOrFail($user->id_user);
        $userModel->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'no_hp' => $noHp,
        ]);

        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $userModel = User::findOrFail($user->id_user);
        $userModel->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return redirect()->route('user.profil')->with('success', 'Password berhasil diubah.');
    }

    /**
     * Update the authenticated user's profile photo.
     */
    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'profile_image.required' => 'File foto profil wajib dipilih.',
            'profile_image.image' => 'File harus berupa gambar.',
            'profile_image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'profile_image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = 'profile_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img');

            if ($user->profile_image && $user->profile_image !== 'default_profile.svg') {
                $oldPath = $destinationPath . '/' . $user->profile_image;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $image->move($destinationPath, $filename);

            $userModel = User::findOrFail($user->id_user);
            $userModel->update(['profile_image' => $filename]);

            return redirect()->route('user.profil')->with('success', 'Foto profil berhasil diperbarui.');
        }

        return back()->with('error', 'Gagal memperbarui foto profil.');
    }
}
