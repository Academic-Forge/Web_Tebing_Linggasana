@extends('layouts.template')

@section('no-sidebar', true)

@section('title', 'Masuk Akun')

@section('content')
<div class="min-h-screen w-full grid grid-cols-1 lg:grid-cols-12 overflow-hidden bg-slate-50">
    <!-- Left Panel: Visual Aspect (Hidden on Mobile) -->
    <div class="hidden lg:flex lg:col-span-5 relative items-center justify-center p-12 bg-slate-950 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center transform scale-105 transition-transform duration-10000" style="background-image: url('{{ asset('img/tebing-1.jpeg') }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/40 to-slate-950/20"></div>
        
        <!-- Animated Background Orbs -->
        <div class="absolute top-1/4 -left-12 w-64 h-64 bg-white/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-12 w-80 h-80 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        <!-- Content on top of background -->
        <div class="relative z-10 w-full max-w-md flex flex-col justify-between h-full min-h-[500px]">
            <!-- Logo / Brand -->
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">Tebing Linggasana</span>
            </div>

            <!-- Hero Message -->
            <div class="my-auto py-8">
                <span class="px-3 py-1 bg-white/15 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider text-white/95 border border-white/20">Wisata Alam Bali</span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-white mt-4 leading-tight">Jelajahi Petualangan & Keindahan Alam</h2>
                <p class="text-slate-200/90 mt-4 leading-relaxed font-light">Lakukan reservasi camping, pendakian, dan wall climbing dengan mudah dan cepat melalui sistem booking terintegrasi kami.</p>
            </div>

            <!-- Testimonial / Features -->
            <div class="p-5 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-2">
                        <span class="w-8 h-8 rounded-full bg-slate-400 border-2 border-slate-950 flex items-center justify-center text-xs font-bold text-slate-950">A</span>
                        <span class="w-8 h-8 rounded-full bg-slate-500 border-2 border-slate-950 flex items-center justify-center text-xs font-bold text-slate-950">B</span>
                        <span class="w-8 h-8 rounded-full bg-slate-600 border-2 border-slate-950 flex items-center justify-center text-xs font-bold text-slate-950">C</span>
                    </div>
                    <div class="text-xs text-white">
                        <div class="flex items-center text-amber-400 gap-0.5">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="font-bold ml-1">4.9/5.0</span>
                        </div>
                        <p class="text-slate-300/80 mt-0.5">Dari 1,200+ ulasan petualang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel: Login Form -->
    <div class="col-span-12 lg:col-span-7 flex flex-col justify-center px-6 sm:px-12 lg:px-20 xl:px-24 py-12 bg-white relative">
        <!-- Back to Catalog Button -->
        <a href="{{ route('katalog.index') }}" class="absolute top-6 right-6 lg:top-8 lg:right-8 flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-800 bg-slate-100 hover:bg-slate-200/80 rounded-xl transition duration-150 shadow-sm border border-slate-200/50">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Kembali ke Katalog
        </a>

        <div class="w-full max-w-md mx-auto">
            <!-- Alert Session Success -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-150/40 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
                    <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Alert Session Error -->
            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 border border-rose-150/40 text-rose-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
                    <svg class="w-5 h-5 shrink-0 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Form Header -->
            <div class="text-left mb-10">
                <div class="lg:hidden flex items-center gap-2.5 mb-6 text-emerald-800">
                    <div class="p-2 bg-emerald-50 rounded-xl">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold">Tebing Linggasana</span>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-800">Selamat Datang</h1>
                <p class="text-slate-500 mt-2 text-sm">Silakan masuk menggunakan akun terdaftar Anda.</p>
            </div>

            <!-- Login Form -->
            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            placeholder="nama@email.com"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm @error('email') border-rose-400 bg-rose-50/10 @enderror">
                    </div>
                    @error('email')
                        <span class="text-rose-600 text-xs font-medium flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 bg-rose-600 rounded-full"></span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kata Sandi (Password)</label>
                        <a href="#" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800 hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-3.75 3h15a2.25 2.25 0 012.25 2.25v4.05a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V15.75a2.25 2.25 0 012.25-2.25z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                            placeholder="Masukkan password Anda"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all placeholder:text-slate-400/80 text-sm @error('password') border-rose-400 bg-rose-50/10 @enderror">
                    </div>
                    @error('password')
                        <span class="text-rose-600 text-xs font-medium flex items-center gap-1.5 mt-1">
                            <span class="w-1 h-1 bg-rose-600 rounded-full"></span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500 accent-emerald-700 cursor-pointer">
                    <label for="remember" class="ml-2.5 text-sm font-medium text-slate-600 select-none cursor-pointer">Ingat saya di perangkat ini</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold rounded-2xl shadow-lg hover:shadow-emerald-900/15 hover:shadow-xl hover:-translate-y-0.5 transition duration-200 flex items-center justify-center gap-2 cursor-pointer text-sm font-semibold">
                    <span>Masuk Ke Akun</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            <!-- Google OAuth Divider and Button -->
            <div class="relative flex py-4 items-center">
                <div class="flex-grow border-t border-slate-200"></div>
                <span class="flex-shrink mx-4 text-slate-400 text-xs font-semibold uppercase tracking-wider">Atau Masuk Dengan</span>
                <div class="flex-grow border-t border-slate-200"></div>
            </div>

            <a href="{{ route('auth.google', ['action' => 'login']) }}" class="w-full py-3.5 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-2xl shadow-sm hover:shadow transition duration-200 flex items-center justify-center gap-3 cursor-pointer text-sm font-semibold">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24">
                    <path fill="#ea4335" d="M12 5.04c1.62 0 3.08.56 4.22 1.64l3.15-3.15C17.45 1.68 14.93 1 12 1 7.37 1 3.4 3.63 1.45 7.45l3.77 2.92C6.12 7.15 8.83 5.04 12 5.04z" />
                    <path fill="#4285f4" d="M23.49 12.27c0-.81-.07-1.59-.2-2.36H12v4.51h6.46c-.29 1.48-1.14 2.73-2.4 3.58l3.74 2.9C21.99 18.99 23.49 15.93 23.49 12.27z" />
                    <path fill="#fbbc05" d="M5.22 10.37c-.24-.72-.37-1.48-.37-2.27s.13-1.55.37-2.27L1.45 2.91C.52 4.77 0 6.83 0 9s.52 4.23 1.45 6.09l3.77-2.92c-.24-.72-.37-1.48-.37-2.27z" />
                    <path fill="#34a853" d="M12 23c3.24 0 5.97-1.07 7.96-2.91l-3.74-2.9c-1.12.75-2.54 1.19-4.22 1.19-3.17 0-5.88-2.11-6.78-5.33L1.45 16.09C3.4 19.91 7.37 23 12 23z" />
                </svg>
                <span>Masuk dengan Google</span>
            </a>

            <!-- Register Link -->
            <div class="mt-8 text-center text-sm text-slate-500">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline">Daftar Akun Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection
