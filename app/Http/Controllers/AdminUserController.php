<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::orderBy('nama_lengkap', 'asc')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,user'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid (contoh: 081234567890).',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'role.required' => 'Peran (role) wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        // Standardize phone number format
        $noHp = $data['no_hp'];
        if (str_starts_with($noHp, '+62')) {
            $noHp = '0' . substr($noHp, 3);
        } elseif (str_starts_with($noHp, '62')) {
            $noHp = '0' . substr($noHp, 2);
        }

        User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $noHp,
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'profile_image' => 'default_profile.svg',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id_user, 'id_user')],
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid.',
            'role.required' => 'Peran (role) wajib dipilih.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
        ]);

        // Standardize phone number format
        $noHp = $data['no_hp'];
        if (str_starts_with($noHp, '+62')) {
            $noHp = '0' . substr($noHp, 3);
        } elseif (str_starts_with($noHp, '62')) {
            $noHp = '0' . substr($noHp, 2);
        }

        $updateData = [
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $noHp,
            'role' => $data['role'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($data['password']);
        }

        // Prevent self-role-downgrading from admin to user
        if ($user->id_user == Auth::id() && $data['role'] !== 'admin') {
            return back()->with('error', 'Anda tidak dapat menurunkan peran (role) Anda sendiri.');
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Safeguard: Cannot delete yourself
        if ($user->id_user == Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
