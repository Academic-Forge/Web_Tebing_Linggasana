<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Tebing Linggasana</title>
    <meta name="description" content="Dashboard Manajemen Wisata Alam Tebing Linggasana">
    
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', 'Inter', sans-serif;
        }
        /* Desktop sidebar transition styles */
        .sidebar-desktop {
            transition: transform 0.3s ease-in-out;
        }
        .content-area {
            transition: padding-left 0.3s ease-in-out;
        }
        /* When sidebar is collapsed/hidden on desktop */
        @media (min-width: 1024px) {
            .sidebar-collapsed .sidebar-desktop {
                transform: translateX(-100%);
            }
            .sidebar-collapsed .content-area {
                padding-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen antialiased">

@hasSection('no-sidebar')
    <!-- Clean Fullscreen Layout (For Auth Pages) -->
    <main class="min-h-screen flex items-center justify-center">
        @yield('content')
    </main>
@else
    <!-- Dashboard Layout with Sidebar -->
    <div class="min-h-screen flex" id="app-wrapper">
        <!-- Sidebar (Desktop View) -->
        <aside class="sidebar-desktop hidden lg:flex lg:w-64 bg-slate-900 text-white min-h-screen flex-col justify-between fixed top-0 left-0 border-r border-slate-800 z-30 shadow-xl">
            <div class="flex flex-col">
                <!-- Branding Header -->
                <div class="h-20 flex items-center gap-3 px-6 border-b border-slate-800/60">
                    <div class="p-2 bg-emerald-500/15 rounded-xl text-emerald-400 border border-emerald-500/20 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <span class="font-extrabold tracking-tight text-white text-md">Linggasana Portal</span>
                </div>

                <!-- Navigation List -->
                <div class="py-6">
                    @include('layouts.menu.admin')
                </div>
            </div>

            <!-- Footer User Card in Sidebar -->
            @auth
            <a href="{{ url('/admin/setting') }}" class="p-4 border-t border-slate-800 bg-slate-950/40 flex items-center gap-3 hover:bg-slate-950/70 transition duration-150">
                @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                    <img src="{{ asset('img/' . Auth::user()->profile_image) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover shadow-inner border border-slate-800">
                @else
                    <div class="w-10 h-10 rounded-full bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 font-bold uppercase text-sm">
                        {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                    </div>
                @endif
                <div class="flex-grow min-w-0">
                    <p class="text-xs font-bold text-slate-200 truncate">{{ Auth::user()->nama_lengkap }}</p>
                    <p class="text-[10px] text-slate-500 truncate uppercase font-semibold tracking-wider">{{ Auth::user()->role }}</p>
                </div>
            </a>
            @endauth
        </aside>

        <!-- Mobile Sidebar Drawer (Overlay) -->
        <div id="mobile-sidebar" class="fixed inset-0 z-40 lg:hidden hidden transition-all duration-300">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" id="sidebar-backdrop"></div>
            <!-- Drawer Content -->
            <aside class="absolute top-0 left-0 bottom-0 w-64 bg-slate-900 text-white flex flex-col justify-between shadow-2xl transition-transform duration-300 transform -translate-x-full" id="sidebar-drawer">
                <div class="flex flex-col">
                    <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/60">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-emerald-500/15 rounded-xl text-emerald-400 border border-emerald-500/20">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12" />
                                </svg>
                            </div>
                            <span class="font-extrabold tracking-tight text-white text-md">Linggasana</span>
                        </div>
                        <button id="close-sidebar-btn" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="py-6">
                        @include('layouts.menu.admin')
                    </div>
                </div>
                
                @auth
                <a href="{{ url('/admin/setting') }}" class="p-4 border-t border-slate-800 bg-slate-950/40 flex items-center gap-3 hover:bg-slate-950/70 transition duration-150">
                    @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                        <img src="{{ asset('img/' . Auth::user()->profile_image) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover shadow-inner border border-slate-800">
                    @else
                        <div class="w-10 h-10 rounded-full bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 font-bold uppercase text-sm">
                            {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                        </div>
                    @endif
                    <div class="flex-grow min-w-0">
                        <p class="text-xs font-bold text-slate-200 truncate">{{ Auth::user()->nama_lengkap }}</p>
                        <p class="text-[10px] text-slate-500 truncate uppercase font-semibold">{{ Auth::user()->role }}</p>
                    </div>
                </a>
                @endauth
            </aside>
        </div>

        <!-- Content Page Area Wrapper -->
        <div class="content-area flex-grow lg:pl-64 flex flex-col min-h-screen">
            <!-- Top Navbar Header -->
            <header class="h-20 bg-white border-b border-slate-100 flex items-center justify-between px-6 sm:px-8 sticky top-0 z-20 shadow-sm/5">
                <!-- Left Greeting / Mobile & Desktop Toggle -->
                <div class="flex items-center gap-4">
                    <button id="toggle-sidebar-btn" class="p-2 -ml-2 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-50 focus:outline-none cursor-pointer">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div class="hidden sm:block">
                        <h2 class="text-lg font-bold text-slate-800">Panel Kelola Admin</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pantau dan kelola aktivitas Tebing Linggasana</p>
                    </div>
                </div>

                <!-- Right Menu Header -->
                <div class="flex items-center gap-4">
                    <!-- Profile Dropdown Container -->
                    @auth
                    <div class="relative pl-4 border-l border-slate-100" id="profile-dropdown-container">
                        <button id="profile-dropdown-btn" class="flex items-center gap-3 focus:outline-none cursor-pointer group">
                            <div class="hidden md:block text-right">
                                <p class="text-xs font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">{{ Auth::user()->nama_lengkap }}</p>
                                <p class="text-[10px] text-emerald-600 font-semibold tracking-wider uppercase mt-0.5">{{ Auth::user()->role }}</p>
                            </div>
                            @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                                <img src="{{ asset('img/' . Auth::user()->profile_image) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover shadow-inner border border-slate-200 group-hover:border-emerald-400 transition-colors">
                            @else
                                <div class="w-10 h-10 rounded-full bg-emerald-50 border border-emerald-250/20 flex items-center justify-center text-emerald-700 font-bold uppercase text-sm shadow-inner group-hover:border-emerald-400 transition-colors">
                                    {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                                </div>
                            @endif
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown-menu" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl border border-slate-100 shadow-xl py-2 hidden z-30 transition-all duration-200 transform scale-95 opacity-0 origin-top-right">
                            <!-- Header -->
                            <div class="px-4 py-2 border-b border-slate-50">
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold">Masuk sebagai</p>
                                <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->nama_lengkap }}</p>
                                <p class="text-xs text-emerald-600 font-semibold truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Links -->
                            <div class="p-1.5 space-y-0.5">
                                <a href="{{ url('/admin/setting') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="{{ url('/admin/setting#change-password') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    Ganti Password
                                </a>
                            </div>

                            <div class="border-t border-slate-50 p-1.5 mt-1">
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-3 py-2 rounded-xl text-sm text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-colors text-left font-medium cursor-pointer">
                                        <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                        </svg>
                                        Keluar Akun
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </header>

            <!-- Main Yield Content -->
            <main class="p-6 sm:p-8 flex-grow">
                @yield('content')
            </main>

            <!-- Footer Area -->
            <footer class="bg-white border-t border-slate-100 py-5 text-center text-xs text-slate-400 font-medium">
                &copy; {{ date('Y') }} Tebing Linggasana Bali. Seluruh hak cipta dilindungi.
            </footer>
        </div>
    </div>
@endif

    <!-- Drawer Mobile & Desktop JS Toggle & Profile Dropdown scripts -->
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-sidebar-btn');
            const closeBtn = document.getElementById('close-sidebar-btn');
            const backdrop = document.getElementById('sidebar-backdrop');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const drawer = document.getElementById('sidebar-drawer');
            const appWrapper = document.getElementById('app-wrapper');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    if (window.innerWidth >= 1024) {
                        // Desktop collapse toggle
                        if (appWrapper) {
                            appWrapper.classList.toggle('sidebar-collapsed');
                        }
                    } else {
                        // Mobile drawer toggle
                        if (mobileSidebar && drawer) {
                            mobileSidebar.classList.remove('hidden');
                            setTimeout(() => {
                                drawer.classList.remove('-translate-x-full');
                            }, 50);
                        }
                    }
                });
            }

            if (closeBtn && mobileSidebar && drawer) {
                const closeSidebar = () => {
                    drawer.classList.add('-translate-x-full');
                    setTimeout(() => {
                        mobileSidebar.classList.add('hidden');
                    }, 300);
                };

                closeBtn.addEventListener('click', closeSidebar);
                if (backdrop) {
                    backdrop.addEventListener('click', closeSidebar);
                }
            }

            // Profile Dropdown Toggle
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
