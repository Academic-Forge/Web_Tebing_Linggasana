@extends('layouts.template')

@section('no-sidebar', true)

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="min-h-screen w-full grid grid-cols-1 lg:grid-cols-12 overflow-hidden bg-slate-50">
    <!-- Left Panel: Visual Aspect (Hidden on Mobile) -->
    <div class="hidden lg:flex lg:col-span-5 relative items-center justify-center p-12 bg-emerald-950 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center opacity-40 transform scale-105 transition-transform duration-10000" style="background-image: url('{{ asset('img/tebing_linggasana_auth.png') }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/95 via-emerald-900/90 to-slate-900/95"></div>
        
        <!-- Animated Background Orbs -->
        <div class="absolute top-1/4 -left-12 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-12 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        <!-- Content on top of background -->
        <div class="relative z-10 w-full max-w-md flex flex-col justify-between h-full min-h-[500px]">
            <!-- Logo / Brand -->
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-emerald-500/20 backdrop-blur-md rounded-2xl border border-emerald-400/30 text-emerald-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">Tebing Linggasana</span>
            </div>

            <!-- Hero Message -->
            <div class="my-auto py-8">
                <span class="px-3 py-1 bg-emerald-500/20 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider text-emerald-300 border border-emerald-500/30">Mulai Bersama Kami</span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-white mt-4 leading-tight">Mulai Petualangan Seru Anda</h2>
                <p class="text-emerald-100/80 mt-4 leading-relaxed font-light">Dapatkan akses penuh ke sistem reservasi camping ground, peralatan panjat tebing, dan nikmati kemudahan bertransaksi secara aman.</p>
            </div>

            <!-- Benefits Checklist -->
            <div class="p-5 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 shadow-lg text-emerald-100 text-xs space-y-2.5">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Booking Instan & Ketersediaan Kuota Real-time</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Pembayaran Aman Menggunakan QRIS & E-Wallet (Midtrans)</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Notifikasi Otomatis Status Reservasi Anda</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel: Register Form -->
    <div class="col-span-12 lg:col-span-7 flex flex-col justify-center px-6 sm:px-12 lg:px-20 xl:px-24 py-12 bg-white relative">
        <div class="w-full max-w-md mx-auto">
            <!-- Form Header -->
            <div class="text-left mb-8">
                <div class="lg:hidden flex items-center gap-2.5 mb-6 text-emerald-800">
                    <div class="p-2 bg-emerald-50 rounded-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold">Tebing Linggasana</span>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-800">Daftar Akun Baru</h1>
                <p class="text-slate-500 mt-2 text-sm">Lengkapi data di bawah ini untuk membuat akun baru.</p>
            </div>

            <!-- Register Form -->
            <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Lengkap Input -->
                <div class="space-y-1">
                    <label for="nama_lengkap" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nama Lengkap</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required autofocus
                            placeholder="Masukkan nama lengkap Anda"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm @error('nama_lengkap') border-rose-400 bg-rose-50/10 @enderror">
                    </div>
                    @error('nama_lengkap')
                        <span class="text-rose-600 text-xs font-medium flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 bg-rose-600 rounded-full"></span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="space-y-1">
                    <label for="email" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            placeholder="nama@email.com"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm @error('email') border-rose-400 bg-rose-50/10 @enderror">
                    </div>
                    @error('email')
                        <span class="text-rose-600 text-xs font-medium flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 bg-rose-600 rounded-full"></span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Nomor HP Input -->
                <div class="space-y-1">
                    <label for="no_hp" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Nomor Handphone (HP)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required
                            placeholder="Contoh: 081234567890"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm @error('no_hp') border-rose-400 bg-rose-50/10 @enderror">
                    </div>
                    @error('no_hp')
                        <span class="text-rose-600 text-xs font-medium flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 bg-rose-600 rounded-full"></span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-1">
                    <label for="password" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kata Sandi (Password)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-3.75 3h15a2.25 2.25 0 012.25 2.25v4.05a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V15.75a2.25 2.25 0 012.25-2.25z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                            placeholder="Minimal 8 karakter"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm @error('password') border-rose-400 bg-rose-50/10 @enderror">
                    </div>
                    @error('password')
                        <span class="text-rose-600 text-xs font-medium flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 bg-rose-600 rounded-full"></span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password Confirmation Input -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Konfirmasi Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-3.75 3h15a2.25 2.25 0 012.25 2.25v4.05a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V15.75a2.25 2.25 0 012.25-2.25z" />
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            placeholder="Ulangi kata sandi Anda"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full mt-2 py-3 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold rounded-2xl shadow-lg hover:shadow-emerald-900/15 hover:shadow-xl hover:-translate-y-0.5 transition duration-200 flex items-center justify-center gap-2 cursor-pointer text-sm">
                    <span>Daftarkan Akun Baru</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center text-sm text-slate-500">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline">Masuk Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
