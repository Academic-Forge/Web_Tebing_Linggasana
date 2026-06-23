@extends('layouts.template')

@section('no-sidebar', true)

@section('title', 'Beranda')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm animate-fade-in">
            <svg class="w-6 h-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 transition-all duration-300 hover:shadow-2xl">
        <!-- Banner -->
        <div class="relative h-64 bg-emerald-900 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay" style="background-image: url('{{ asset('img/tebing_linggasana_auth.png') }}')"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/80 to-transparent"></div>
            <div class="absolute bottom-6 left-8 right-8 text-white">
                <span class="px-3 py-1 bg-emerald-500/30 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-400/30">Portal Wisata</span>
                <h1 class="text-3xl font-bold mt-2">Tebing Linggasana</h1>
                <p class="text-emerald-100 text-sm mt-1">Sistem Reservasi & Manajemen Pengunjung Berbasis Framework</p>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            @auth
                <div class="flex flex-col md:flex-row items-center gap-8 pb-8 border-b border-slate-100">
                    <!-- Avatar -->
                    <div class="w-24 h-24 rounded-full bg-emerald-50 border-4 border-emerald-100 flex items-center justify-center text-emerald-800 text-3xl font-bold uppercase shadow-sm">
                        {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                    </div>
                    
                    <div class="flex-grow text-center md:text-left">
                        <h2 class="text-2xl font-bold text-slate-800">{{ Auth::user()->nama_lengkap }}</h2>
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-2">
                            <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-medium uppercase tracking-wider">{{ Auth::user()->role }}</span>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-8 text-sm">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 text-emerald-700 rounded-xl">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wider font-semibold">Nomor Handphone</p>
                            <p class="text-slate-800 font-medium mt-0.5">{{ Auth::user()->no_hp }}</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 text-emerald-700 rounded-xl">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wider font-semibold">Status Sesi</p>
                            <p class="text-emerald-600 font-semibold mt-0.5 flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span> Terautentikasi
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2.5 bg-rose-50 text-rose-600 font-semibold rounded-xl border border-rose-100 hover:bg-rose-100 hover:text-rose-700 transition duration-200 cursor-pointer text-sm">
                            Keluar Akun (Logout)
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-12">
                    <h3 class="text-xl font-bold text-slate-800">Selamat Datang di Portal Linggasana</h3>
                    <p class="text-slate-500 mt-2 max-w-md mx-auto">Silakan masuk ke akun Anda atau mendaftar untuk dapat mengakses sistem booking online dan mengelola perjalanan camping/panjat tebing Anda.</p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 bg-emerald-700 text-white font-semibold rounded-2xl hover:bg-emerald-800 hover:-translate-y-0.5 transition duration-200 shadow-md hover:shadow-lg text-center">
                            Masuk Ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-white text-emerald-700 font-semibold rounded-2xl border border-emerald-200 hover:bg-emerald-50 hover:-translate-y-0.5 transition duration-200 text-center">
                            Daftar Akun Baru
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
