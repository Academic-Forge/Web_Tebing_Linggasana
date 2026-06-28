<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('katalog.index');
        }
        return view('auth.login');
    }

    /**
     * Process login authentication.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $request->session()->flash('success', "Selamat datang kembali, {$user->nama_lengkap}!");
            
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('katalog.index');
        }

        throw ValidationException::withMessages([
            'email' => ['Kredensial yang Anda masukkan tidak cocok dengan data kami.'],
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    /**
     * Process user registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'no_hp' => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid (contoh: 081234567890).',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Standardize phone number format if needed (e.g. 08xx)
        $noHp = $data['no_hp'];
        if (str_starts_with($noHp, '+62')) {
            $noHp = '0' . substr($noHp, 3);
        } elseif (str_starts_with($noHp, '62')) {
            $noHp = '0' . substr($noHp, 2);
        }

        $user = User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'no_hp' => $noHp,
            'password' => Hash::make($data['password']),
            'role' => 'user', // Default role for new register
            'profile_image' => 'default_profile.svg',
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        
        $request->session()->flash('success', "Registrasi berhasil! Selamat datang, {$user->nama_lengkap}.");

        return redirect('/');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request)
    {
        $action = $request->query('action', 'login');
        session(['google_auth_action' => $action]);

        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists by google_id or email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            $action = session('google_auth_action', 'login');

            if ($user) {
                // If user exists but google_id is not set yet, update it
                if (empty($user->google_id)) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                    ]);
                }
            } else {
                // If action is login, block them
                if ($action === 'login') {
                    return redirect()->route('login')->with('error', 'Akun Google Anda belum terdaftar di sistem. Silakan lakukan registrasi terlebih dahulu.');
                }

                // Create a new user
                $user = User::create([
                    'nama_lengkap' => $googleUser->getName(),
                    'email'        => $googleUser->getEmail(),
                    'google_id'    => $googleUser->getId(),
                    'no_hp'        => null,
                    'password'     => null, // Nullable because logged in via Google
                    'role'         => 'user',
                    'profile_image' => $googleUser->getAvatar() ?? 'default_profile.svg',
                ]);
            }

            Auth::login($user);
            $request->session()->regenerate();
            $request->session()->flash('success', "Selamat datang, {$user->nama_lengkap}!");

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('katalog.index');

        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal masuk menggunakan Google. Silakan coba lagi.');
        }
    }
}
