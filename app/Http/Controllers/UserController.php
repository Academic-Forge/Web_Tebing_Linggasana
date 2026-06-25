<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Dokumentasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display the user's booking page.
     */
    public function booking()
    {
        $myBookings = Booking::with('details')
            ->where('id_user', Auth::id())
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
