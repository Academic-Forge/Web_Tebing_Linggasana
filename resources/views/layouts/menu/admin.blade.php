<nav class="space-y-5 px-3">
    <!-- Dashboard Section -->
    <div class="space-y-1">
        <a href="{{ url('/admin/dashboard') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/dashboard') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-405 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6z" />
            </svg>
            <span>Dashboard</span>
        </a>
    </div>

    <!-- Manajemen Wisata Section -->
    <div class="space-y-1 pt-4 border-t border-slate-800/50">
        <span class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Manajemen Wisata</span>
        
        <!-- Data Booking -->
        <a href="{{ route('admin.booking.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/booking*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
            </svg>
            <span>Data Booking</span>
        </a>

        <!-- Pembayaran -->
        <a href="{{ route('admin.pembayaran.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/pembayaran*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5m-18 0a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 003.75 19.5h16.5a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0020.25 4.5M3.75 4.5V15M20.25 4.5V15M3.75 15h16.5" />
            </svg>
            <span>Pembayaran</span>
        </a>

        <!-- Kelola Kuota -->
        <a href="{{ route('admin.kuota.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/kuota*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15z" />
            </svg>
            <span>Kelola Kuota</span>
        </a>

        <!-- Galeri Dokumentasi -->
        <a href="{{ route('admin.dokumentasi.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/dokumentasi*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25z" />
            </svg>
            <span>Galeri Dokumentasi</span>
        </a>
    </div>

    <!-- Manajemen User Section -->
    <div class="space-y-1 pt-4 border-t border-slate-800/50">
        <span class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Manajemen User</span>
        
        <!-- Kelola Pengguna -->
        <a href="{{ url('/admin/users') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/users*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0112.002 20c-1.102 0-2.167-.156-3.175-.446v-.109m0-1.396a9.3 9.3 0 01-2.625.372 9.337 9.337 0 01-4.121-.952 4.125 4.125 0 007.533-2.493" />
            </svg>
            <span>Kelola Pengguna</span>
        </a>
    </div>

    <!-- Sistem Section -->
    <div class="space-y-1 pt-4 border-t border-slate-800/50">
        <span class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Sistem</span>

        <!-- Pengaturan Profil -->
        <a href="{{ url('/admin/setting') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/setting') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.43l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z" />
            </svg>
            <span>Pengaturan Profil</span>
        </a>
    </div>
</nav>
