<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;

class SettingController extends Controller
{
    /**
     * Display the settings/profile page.
     */
    public function index()
    {
        return view('setting.index');
    }

    /**
     * Update the authenticated user's profile details.
     */
    public function updateProfile(Request $request)
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

        // Standardize phone number format
        $noHp = $data['no_hp'];
        if (str_starts_with($noHp, '+62')) {
            $noHp = '0' . substr($noHp, 3);
        } elseif (str_starts_with($noHp, '62')) {
            $noHp = '0' . substr($noHp, 2);
        }

        // We convert Authenticatable back to User model
        $userModel = User::findOrFail($user->id_user);
        $userModel->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'no_hp' => $noHp,
        ]);

        return redirect()->route('admin.setting.index')->with('success', 'Profil Anda berhasil diperbarui.');
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
            'new_password.min' => 'Password baru minimal terdiri dari 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $userModel = User::findOrFail($user->id_user);
        $userModel->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return redirect()->route('admin.setting.index')->with('success', 'Password Anda berhasil diubah.');
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
            
            // Set public path for image
            $destinationPath = public_path('img');
            
            // Delete old photo if it exists and is not default
            if ($user->profile_image && $user->profile_image !== 'default_profile.svg') {
                $oldPath = $destinationPath . '/' . $user->profile_image;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Move file to destination folder
            $image->move($destinationPath, $filename);

            $userModel = User::findOrFail($user->id_user);
            $userModel->update([
                'profile_image' => $filename,
            ]);

            return redirect()->route('admin.setting.index')->with('success', 'Foto profil berhasil diperbarui.');
        }

        return back()->with('error', 'Gagal memperbarui foto profil.');
    }
}
