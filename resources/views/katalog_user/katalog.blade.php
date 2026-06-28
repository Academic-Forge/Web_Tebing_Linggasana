<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Wisata - Tebing Linggasana</title>
    <meta name="description" content="Eksklusivitas dan Keindahan Alam Tebing Linggasana, Cilimus, Kuningan. Pesan tiket masuk dan camping online.">

    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', 'Inter', sans-serif;
        }

        /* Custom Keyframe Animations */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.5; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(0.95); opacity: 0.5; }
        }

        .animate-pulse-ring {
            animation: pulse-ring 3s infinite ease-in-out;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 4s infinite ease-in-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-emerald-600 selection:text-white">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-transparent py-4 px-6 md:px-10 text-white bg-transparent">
        <div class="max-w-5xl mx-auto flex items-center justify-between w-full">
            <a href="#beranda" class="flex items-center gap-2.5 group">
                <div class="p-2 bg-emerald-500/10 backdrop-blur-md rounded-xl text-emerald-400 border border-emerald-500/20 shadow-inner group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="font-black tracking-wider text-lg uppercase transition-colors duration-300">Linggasana</span>
            </a>

            <!-- Middle Links (Hidden on Mobile) -->
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold tracking-wide">
                <a href="#beranda" class="hover:text-emerald-400 transition-colors">Beranda</a>
                <a href="#info" class="hover:text-emerald-400 transition-colors">Informasi</a>
                <a href="#fasilitas" class="hover:text-emerald-400 transition-colors">Fasilitas</a>
                <a href="#keunggulan" class="hover:text-emerald-400 transition-colors">Keunggulan</a>
            </div>

            <!-- Right Side: User Dropdown or Login -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="relative" id="profile-dropdown-container">
                        <button id="profile-dropdown-btn" class="flex items-center gap-2.5 focus:outline-none cursor-pointer group bg-black/20 hover:bg-black/35 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10 hover:border-white/20 transition-all">
                            <div class="text-right hidden sm:block">
                                <p class="text-xs font-bold transition-colors">{{ Auth::user()->nama_lengkap }}</p>
                            </div>
                            @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                                <img src="{{ asset('img/' . Auth::user()->profile_image) }}" alt="Avatar" class="w-7 h-7 rounded-full object-cover shadow-inner border border-white/20">
                            @else
                                <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold uppercase text-xs">
                                    {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                                </div>
                            @endif
                            <svg class="w-3.5 h-3.5 opacity-60 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown-menu" class="absolute right-0 mt-3 w-60 bg-white text-slate-800 rounded-2xl border border-slate-100 shadow-2xl py-2 hidden z-50 transition-all duration-200 transform scale-95 opacity-0 origin-top-right">
                            <!-- Header -->
                            <div class="px-4 py-3 border-b border-slate-50">
                                <div class="flex items-center gap-3">
                                    @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                                        <img src="{{ asset('img/' . Auth::user()->profile_image) }}" class="w-9 h-9 rounded-xl object-cover" alt="Avatar">
                                    @else
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center font-bold uppercase text-sm">
                                            {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->nama_lengkap }}</p>
                                        <p class="text-xs text-emerald-600 font-semibold truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Section -->
                            <div class="p-2">
                                <p class="px-2 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Menu</p>

                                <a href="{{ route('user.booking') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                        </svg>
                                    </div>
                                    Booking Saya
                                </a>

                                <a href="{{ route('user.galeri') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                    Galeri Kenangan
                                </a>
                            </div>

                            <!-- Akun Section -->
                            <div class="p-2 border-t border-slate-50">
                                <p class="px-2 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akun</p>

                                <a href="{{ route('user.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                    Pengaturan Profil
                                </a>

                                @if(Auth::user()->role === 'admin')
                                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-emerald-700 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                        </svg>
                                    </div>
                                    Admin Panel
                                </a>
                                @endif
                            </div>

                            <!-- Logout -->
                            <div class="p-2 border-t border-slate-50">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-colors cursor-pointer">
                                        <div class="w-7 h-7 rounded-lg bg-rose-50 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                            </svg>
                                        </div>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 border border-emerald-500 hover:border-emerald-400 text-white rounded-full text-xs font-bold transition-all shadow-md shadow-emerald-500/10 cursor-pointer">
                        Masuk / Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative min-h-screen flex items-center justify-center bg-slate-950 overflow-hidden">
        <!-- Background Image Cliff -->
        <div class="absolute inset-0 bg-[url('/public/img/tebing-1.jpeg')] bg-cover bg-center opacity-45 transform scale-105 transition-transform duration-[8s] hover:scale-100"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-slate-950/40"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center text-white flex flex-col items-center gap-6 mt-12">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/15 border border-emerald-500/25 rounded-full text-emerald-400 text-xs font-black uppercase tracking-widest shadow-inner animate-pulse-ring">
                ⛰️ Eco Adventure Kuningan
            </span>
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight leading-none drop-shadow-md">
                Wisata Tebing <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-350">Linggasana</span>
            </h1>
            <p class="text-slate-300 text-sm md:text-lg max-w-2xl leading-relaxed drop-shadow-sm">
                Rasakan sensasi petualangan alam yang menakjubkan, aman, dan eksklusif di atas tebing dengan pemandangan lembah Gunung Ciremai yang spektakuler.
            </p>
            <div class="mt-4 flex flex-col sm:flex-row gap-4 items-center">
                <a href="{{ route('user.booking') }}" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-extrabold rounded-2xl transition duration-300 shadow-xl shadow-emerald-500/20 transform hover:-translate-y-0.5 cursor-pointer flex items-center gap-2 group">
                    <svg class="w-4.5 h-4.5 group-hover:rotate-6 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                    BOOKING SEKARANG
                </a>
                <a href="#info" class="px-8 py-4 bg-white/10 hover:bg-white/15 border border-white/10 text-white text-sm font-extrabold rounded-2xl transition duration-300 backdrop-blur-sm cursor-pointer">
                    Pelajari Selengkapnya
                </a>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute -bottom-1 left-0 right-0 h-20 bg-gradient-to-t from-slate-50 to-transparent"></div>
    </section>

    <!-- Info & Quota Section -->
    <section id="info" class="relative z-20 -mt-20 px-6 max-w-5xl mx-auto pb-16">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden p-6 md:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-stretch">
                <!-- Left: Ticket Price -->
                <div class="flex flex-col justify-between gap-6 md:pr-10 md:border-r border-slate-100">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-emerald-600 rounded-full"></span>
                            Harga Tiket Masuk
                        </h3>
                        <div class="mt-4 flex items-baseline gap-2">
                            <span class="text-4xl md:text-5xl font-black text-emerald-600 tracking-tight">Rp 125.000</span>
                            <span class="text-slate-400 font-semibold text-xs">/ Orang / Hari</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Jadwal Operasional Wisata
                        </h4>
                        <p class="text-sm font-extrabold text-slate-700 mt-2">Hanya tersedia pada hari <span class="text-emerald-600">Sabtu &amp; Minggu</span></p>
                        <p class="text-xs text-slate-400 mt-0.5">Lakukan reservasi secara online terlebih dahulu karena pembatasan kuota ketat.</p>
                    </div>
                </div>

                <!-- Right: Availability Live Quota -->
                <div class="flex flex-col justify-between gap-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-emerald-600 rounded-full"></span>
                            Ketersediaan Kuota Terdekat
                        </h3>
                        <p class="text-xs font-bold text-rose-600 flex items-center gap-1.5 mt-2 bg-rose-50 border border-rose-100 rounded-xl px-3 py-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z" />
                            </svg>
                            Maksimal 20 orang per hari (Sangat Terbatas!)
                        </p>
                    </div>

                    <div class="space-y-4">
                        @foreach($schedule as $day)
                            @php
                                $percent = $day['max'] > 0 ? min(100, round(($day['filled'] / $day['max']) * 100)) : 100;
                                $isFull = $day['filled'] >= $day['max'];
                                $sisa = max(0, $day['max'] - $day['filled']);
                                $formattedDate = \Carbon\Carbon::parse($day['date'])->translatedFormat('d M Y');
                            @endphp

                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-slate-700">{{ $day['day'] }}, {{ $formattedDate }}</span>
                                    </div>
                                    @if($isFull)
                                        <span class="px-2.5 py-0.5 bg-rose-100 text-rose-700 text-[10px] font-black uppercase rounded-full">SOLD OUT</span>
                                    @elseif($sisa <= 5)
                                        <span class="px-2.5 py-0.5 bg-amber-100 text-amber-700 text-[10px] font-black uppercase rounded-full">Sisa {{ $sisa }} Slot!</span>
                                    @else
                                        <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-full">Tersedia: {{ $sisa }}</span>
                                    @endif
                                </div>
                                <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-1000 {{ $isFull ? 'bg-rose-500' : ($sisa <= 5 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $percent }}%"></div>
                                </div>
                                <div class="flex items-center justify-between mt-1 text-[10px] text-slate-400 font-semibold">
                                    <span>Kapasitas: {{ $day['max'] }} orang</span>
                                    <span>Terisi: {{ $day['filled'] }} orang ({{ $percent }}%)</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="fasilitas" class="bg-white py-20 px-6 border-y border-slate-100">
        <div class="max-w-5xl mx-auto">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span class="text-xs font-extrabold text-emerald-600 uppercase tracking-widest">Kenyamanan &amp; Keselamatan</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight mt-2">
                    Fasilitas <span class="text-emerald-600">Lengkap</span> Kami
                </h2>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">Kami mempersiapkan segala kebutuhan Anda untuk memastikan petualangan panjat tebing berjalan aman dan menyenangkan.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Fasilitas 1 -->
                <div class="group p-6 bg-slate-50 border border-slate-100/60 rounded-3xl hover:bg-white hover:shadow-xl hover:border-slate-200 transition-all duration-300 flex flex-col justify-between items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">Safety Man</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Anda akan didampingi penuh oleh pemandu profesional bersertifikat nasional demi keselamatan.</p>
                    </div>
                </div>

                <!-- Fasilitas 2 -->
                <div class="group p-6 bg-slate-50 border border-slate-100/60 rounded-3xl hover:bg-white hover:shadow-xl hover:border-slate-200 transition-all duration-300 flex flex-col justify-between items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21m0 0l-.813-5.096M9 21h7.5M12 3v13.5M3 15h18" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">Alat Safety</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Kami meminjamkan kelengkapan body harness dan helm safety dengan standar kekuatan tinggi.</p>
                    </div>
                </div>

                <!-- Fasilitas 3 -->
                <div class="group p-6 bg-slate-50 border border-slate-100/60 rounded-3xl hover:bg-white hover:shadow-xl hover:border-slate-200 transition-all duration-300 flex flex-col justify-between items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697-.056-4.024-.166C6.845 7.91 6 6.899 6 5.727V3.75m6 4.5c1.355 0 2.697-.056 4.024-.166C17.155 7.91 18 6.899 18 5.727V3.75m-12 0c0-.621.504-1.125 1.125-1.125h9.75c.621 0 1.125.504 1.125 1.125M3 15h18M6.75 19.5h10.5a2.25 2.25 0 002.25-2.25" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">Snack &amp; Minuman</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Nikmati makanan ringan dan minuman kelapa segar/teh hangat sembari bersantai di atas tebing.</p>
                    </div>
                </div>

                <!-- Fasilitas 4 -->
                <div class="group p-6 bg-slate-50 border border-slate-100/60 rounded-3xl hover:bg-white hover:shadow-xl hover:border-slate-200 transition-all duration-300 flex flex-col justify-between items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316A2.192 2.192 0 0014.502 4h-5c-.75 0-1.437.383-1.837 1.014l-.838 1.161z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">Dokumentasi</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Abadikan momen petualangan Anda dengan dokumentasi foto eksklusif yang siap diunggah ke sosial media.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Highlights/Advantages Section -->
    <section id="keunggulan" class="bg-slate-50 py-20 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Beautiful Image Gallery Stack -->
                <div class="lg:col-span-6 space-y-4">
                    <img src="{{ asset('img/tebing-2.jpeg') }}" alt="Pemandangan Tebing Linggasana" class="w-full h-80 object-cover rounded-3xl shadow-lg transform hover:scale-[1.02] transition-transform duration-500">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ asset('img/tebing-3.jpeg') }}" alt="Aktivitas Panjat Tebing" class="w-full h-40 object-cover rounded-2xl shadow-md transform hover:scale-[1.02] transition-transform duration-500">
                        <img src="{{ asset('img/tebing-4.jpeg') }}" alt="Camp Area Tebing" class="w-full h-40 object-cover rounded-2xl shadow-md transform hover:scale-[1.02] transition-transform duration-500">
                    </div>
                </div>

                <!-- Right: Bullet Points -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="text-xs font-extrabold text-emerald-600 uppercase tracking-widest">Kenapa Memilih Kami</span>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight mt-1">Petualangan Eksklusif Berprivasi Tinggi</h2>
                        <p class="text-xs text-slate-400 mt-2 leading-relaxed">Kami membatasi jumlah kuota hanya 20 orang per hari agar Anda dapat menikmati ketenangan alam secara maksimal, bebas dari keramaian padat.</p>
                    </div>

                    <ul class="space-y-4">
                        <!-- Item 1 -->
                        <li class="flex items-start gap-3">
                            <div class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-bold text-slate-800">Aman &amp; Didampingi Profesional</h5>
                                <p class="text-xs text-slate-400 mt-0.5">Keselamatan adalah fokus utama. Pemandu ahli siap memandu di setiap pijakan tebing.</p>
                            </div>
                        </li>
                        <!-- Item 2 -->
                        <li class="flex items-start gap-3">
                            <div class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-bold text-slate-800">Peralatan Standar Internasional</h5>
                                <p class="text-xs text-slate-400 mt-0.5">Semua perlengkapan memanjat dicek secara berkala untuk menjaga fungsi keamanan.</p>
                            </div>
                        </li>
                        <!-- Item 3 -->
                        <li class="flex items-start gap-3">
                            <div class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-bold text-slate-800">Sangat Ramah Untuk Pemula</h5>
                                <p class="text-xs text-slate-400 mt-0.5">Tidak perlu keahlian memanjat tebing sebelumnya. Kami membimbing langkah demi langkah.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="bg-gradient-to-br from-emerald-800 via-teal-900 to-slate-900 py-16 px-6 text-white text-center relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-teal-500/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-xl mx-auto flex flex-col items-center gap-6">
            <h2 class="text-2xl md:text-3xl font-black tracking-tight leading-tight">Mulai Petualangan Alam Anda Sekarang!</h2>
            <p class="text-slate-250 text-xs md:text-sm leading-relaxed max-w-md">Dapatkan tiket masuk dan amankan slot kuota harian Anda sebelum kehabisan. Sisa kuota di-update secara live.</p>
            <a href="{{ route('user.booking') }}" class="px-8 py-3.5 bg-white text-emerald-800 hover:bg-slate-100 font-extrabold rounded-2xl shadow-xl transition transform hover:-translate-y-0.5 cursor-pointer text-xs uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3" />
                </svg>
                Booking Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-16 px-6 md:px-10 border-t border-slate-900">
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start text-left">
            <!-- Left Info -->
            <div class="lg:col-span-6 space-y-4">
                <div class="flex items-center gap-2">
                    <div class="p-2 bg-emerald-500/15 rounded-xl text-emerald-400 border border-emerald-500/20 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12" />
                        </svg>
                    </div>
                    <span class="font-extrabold tracking-wider text-white text-sm uppercase">Tebing Linggasana</span>
                </div>
                <p class="text-xs leading-relaxed max-w-sm">Tempat terbaik untuk melepas penat dan menikmati tantangan panjat tebing dengan pemandangan pegunungan terindah di Kuningan.</p>
                <div class="flex items-center gap-4 pt-2">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/wisatatebinglinggasana?igsh=a21wbndueWlhMmg3" target="_blank" class="p-2 bg-slate-900 hover:bg-emerald-600 rounded-xl hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@wisatatebinglingasana?_r=1&_t=ZS-963IfLXKNEt" target="_blank" class="p-2 bg-slate-900 hover:bg-emerald-600 rounded-xl hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.59 4.18.94 1.13 2.27 1.87 3.73 2.14V10c-1.69.04-3.32-.47-4.66-1.49-.03 2.94-.01 5.89-.02 8.83-.05 1.48-.48 2.96-1.26 4.22-.85 1.34-2.14 2.39-3.64 2.91-1.39.49-2.92.57-4.36.21-1.57-.38-3.02-1.29-4.04-2.58-1.07-1.35-1.59-3.08-1.52-4.8.06-1.74.68-3.44 1.83-4.73 1.17-1.31 2.8-2.13 4.54-2.34v4.06c-.84.1-1.64.49-2.22 1.12-.55.62-.83 1.43-.79 2.26.04.81.42 1.56 1.03 2.06.63.5 1.44.71 2.24.58.78-.12 1.46-.62 1.84-1.33.29-.53.4-1.13.38-1.74.02-4.04.01-8.08.02-12.12z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Location Maps -->
            <div class="lg:col-span-6 space-y-4">
                <h5 class="font-bold text-white text-sm">Lokasi &amp; Peta Koordinat</h5>
                <p class="text-xs leading-relaxed">
                    <span class="text-rose-500 font-bold">📍 Lokasi:</span> Jl. Linggasana, Linggasana, Kec. Cilimus, Kabupaten Kuningan, Jawa Barat 45556
                </p>

                <!-- Embedded interactive maps inside framework -->
                <div class="relative overflow-hidden rounded-2xl border border-slate-900 shadow-lg group">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.334190105315!2d108.4626213759312!3d-6.887830393111425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f182f7c4d7109%3A0x9fa683ee63b9daaa!2sMount%20Ciremai%20Climbing%20Post%20Linggasana%20Route!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                        width="100%" 
                        height="180" 
                        style="border:0; pointer-events: none;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <!-- Overlay map interaction link -->
                    <a href="https://www.google.com/maps/place/Mount+Ciremai+Climbing+Post+Linggasana+Route/@-6.8885372,108.4646879,18.75z" target="_blank"
                       class="absolute inset-0 bg-slate-950/40 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold shadow-md shadow-emerald-600/20">
                            Buka di Google Maps
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto border-t border-slate-900 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} Reservasi Wisata Tebing Linggasana. Hak Cipta Dilindungi.</p>
            <p class="mt-2 sm:mt-0 font-medium">Eco Tourism &amp; Rock Climbing Post Ciremai</p>
        </div>
    </footer>

    <!-- Scripts for Scroll & Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Navbar scroll class toggle ---
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function () {
                if (window.scrollY > 40) {
                    navbar.classList.remove('bg-transparent', 'text-white', 'py-4', 'border-transparent');
                    navbar.classList.add('bg-white/95', 'text-slate-800', 'py-3.5', 'border-slate-100', 'shadow-md', 'backdrop-blur-md');
                } else {
                    navbar.classList.remove('bg-white/95', 'text-slate-800', 'py-3.5', 'border-slate-100', 'shadow-md', 'backdrop-blur-md');
                    navbar.classList.add('bg-transparent', 'text-white', 'py-4', 'border-transparent');
                }
            });

            // --- Profile Dropdown Toggle ---
            const profileBtn = document.getElementById('profile-dropdown-btn');
            const profileMenu = document.getElementById('profile-dropdown-menu');

            if (profileBtn && profileMenu) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = profileMenu.classList.contains('hidden');
                    if (isHidden) {
                        profileMenu.classList.remove('hidden');
                        setTimeout(() => {
                            profileMenu.classList.remove('scale-95', 'opacity-0');
                            profileMenu.classList.add('scale-100', 'opacity-100');
                        }, 10);
                    } else {
                        closeProfileMenu();
                    }
                });

                const closeProfileMenu = () => {
                    profileMenu.classList.remove('scale-100', 'opacity-100');
                    profileMenu.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        profileMenu.classList.add('hidden');
                    }, 200);
                };

                // Close on click outside
                document.addEventListener('click', function(e) {
                    if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                        closeProfileMenu();
                    }
                });
            }
        });
    </script>
</body>
</html>
