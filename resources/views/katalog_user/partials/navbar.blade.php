{{-- Shared Navbar for User Pages (katalog_user) --}}
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3.5 px-6 md:px-10 flex items-center justify-between bg-slate-900/95 backdrop-blur-md border-b border-white/5 shadow-sm">
    {{-- Logo --}}
    <a href="{{ route('katalog.index') }}" class="flex items-center gap-2.5 group">
        <div class="p-2 bg-emerald-500/15 rounded-xl text-emerald-400 border border-emerald-500/20 shadow-inner group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
            </svg>
        </div>
        <span class="font-black tracking-wider text-sm uppercase text-white transition-colors duration-300">Linggasana</span>
    </a>

    {{-- Middle Nav Links --}}
    <div class="hidden md:flex items-center gap-1">
        <a href="{{ route('katalog.index') }}"
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ request()->routeIs('katalog.index') ? 'bg-emerald-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            Beranda
        </a>
        <a href="{{ route('user.booking') }}"
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ request()->routeIs('user.booking') ? 'bg-emerald-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            Booking
        </a>
        <a href="{{ route('user.galeri') }}"
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ request()->routeIs('user.galeri') ? 'bg-emerald-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            Galeri
        </a>
    </div>

    {{-- Right: User Dropdown --}}
    <div class="flex items-center gap-3">
        @auth
            <div class="relative" id="profile-dropdown-container">
                <button id="profile-dropdown-btn"
                    class="flex items-center gap-2.5 focus:outline-none cursor-pointer group bg-white/8 hover:bg-white/15 px-3 py-2 rounded-full border border-white/10 hover:border-white/20 transition-all">
                    @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                        <img src="{{ asset('img/' . Auth::user()->profile_image) }}" alt="Avatar"
                             class="w-7 h-7 rounded-full object-cover border border-white/20">
                    @else
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center font-bold uppercase text-xs">
                            {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                        </div>
                    @endif
                    <span class="text-xs font-bold text-white hidden sm:block max-w-[120px] truncate">{{ Auth::user()->nama_lengkap }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" id="dropdown-chevron" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div id="profile-dropdown-menu"
                     class="absolute right-0 mt-3 w-60 bg-white text-slate-800 rounded-2xl border border-slate-100 shadow-2xl py-2 hidden z-50 transition-all duration-200 transform scale-95 opacity-0 origin-top-right">

                    {{-- Header --}}
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

                    {{-- Menu Section --}}
                    <div class="p-2">
                        <p class="px-2 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Menu</p>

                        <a href="{{ route('user.booking') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-colors {{ request()->routeIs('user.booking') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50 hover:text-emerald-700' }}">
                            <div class="w-7 h-7 rounded-lg {{ request()->routeIs('user.booking') ? 'bg-emerald-100' : 'bg-slate-100' }} flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5 {{ request()->routeIs('user.booking') ? 'text-emerald-600' : 'text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                </svg>
                            </div>
                            Booking Saya
                        </a>

                        <a href="{{ route('user.galeri') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-colors {{ request()->routeIs('user.galeri') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50 hover:text-emerald-700' }}">
                            <div class="w-7 h-7 rounded-lg {{ request()->routeIs('user.galeri') ? 'bg-emerald-100' : 'bg-slate-100' }} flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5 {{ request()->routeIs('user.galeri') ? 'text-emerald-600' : 'text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                            Galeri Kenangan
                        </a>
                    </div>

                    {{-- Akun Section --}}
                    <div class="p-2 border-t border-slate-50">
                        <p class="px-2 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akun</p>

                        <a href="{{ route('user.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-colors {{ request()->routeIs('user.profil') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50 hover:text-emerald-700' }}">
                            <div class="w-7 h-7 rounded-lg {{ request()->routeIs('user.profil') ? 'bg-emerald-100' : 'bg-slate-100' }} flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5 {{ request()->routeIs('user.profil') ? 'text-emerald-600' : 'text-slate-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
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

                    {{-- Logout --}}
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
            <a href="{{ route('login') }}" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full text-xs font-bold transition-all shadow-md shadow-emerald-500/20">
                Masuk / Daftar
            </a>
        @endauth
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const profileBtn = document.getElementById('profile-dropdown-btn');
    const profileMenu = document.getElementById('profile-dropdown-menu');
    const chevron = document.getElementById('dropdown-chevron');

    if (profileBtn && profileMenu) {
        let open = false;

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            open = !open;
            if (open) {
                profileMenu.classList.remove('hidden');
                setTimeout(() => {
                    profileMenu.classList.remove('scale-95', 'opacity-0');
                    profileMenu.classList.add('scale-100', 'opacity-100');
                }, 10);
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            } else {
                closeMenu();
            }
        });

        function closeMenu() {
            open = false;
            profileMenu.classList.remove('scale-100', 'opacity-100');
            profileMenu.classList.add('scale-95', 'opacity-0');
            if (chevron) chevron.style.transform = '';
            setTimeout(() => profileMenu.classList.add('hidden'), 200);
        }

        document.addEventListener('click', function(e) {
            if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                if (open) closeMenu();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && open) closeMenu();
        });
    }
});
</script>
