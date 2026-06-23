<nav class="space-y-1 px-3">
    <!-- Dashboard -->
    <a href="{{ url('/admin/dashboard') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/dashboard') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
        </svg>
        <span>Dashboard</span>
    </a>

    <!-- Transaksi Booking -->
    <a href="{{ route('admin.booking.index') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/booking*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
        </svg>
        <span>Transaksi Booking</span>
    </a>

    <!-- Kelola Kuota -->
    <a href="{{ route('admin.kuota.index') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/kuota*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
        </svg>
        <span>Kelola Kuota</span>
    </a>

    <!-- Pembayaran (coming soon) -->
    <a href="#" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold text-slate-400 hover:bg-slate-800/40 hover:text-slate-200 transition-all duration-200 opacity-60 cursor-not-allowed">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5m-18 0a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 003.75 19.5h16.5a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0020.25 4.5M3.75 4.5V15M20.25 4.5V15M3.75 15h16.5M7.5 12h3m-3 0V9m0 3v3m3-3H12m0 0v-3m0 3v3" />
        </svg>
        <span>Pembayaran</span>
        <span class="ml-auto text-[9px] bg-slate-700 text-slate-400 px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wide">Soon</span>
    </a>

    <!-- Galeri Dokumentasi (coming soon) -->
    <a href="#" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold text-slate-400 hover:bg-slate-800/40 hover:text-slate-200 transition-all duration-200 opacity-60 cursor-not-allowed">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
        <span>Galeri Dokumentasi</span>
        <span class="ml-auto text-[9px] bg-slate-700 text-slate-400 px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wide">Soon</span>
    </a>

    <!-- Profil Saya -->
    <a href="{{ url('/admin/setting') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/setting') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>Profil Saya</span>
    </a>

    <!-- Manajemen Pengguna -->
    <a href="{{ url('/admin/users') }}" 
       class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/users*') ? 'bg-emerald-500/10 text-emerald-400 border-l-4 border-emerald-500 pl-3' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0112.002 20c-1.102 0-2.167-.156-3.175-.446v-.109m0-1.396a9.3 9.3 0 01-2.625.372 9.337 9.337 0 01-4.121-.952 4.125 4.125 0 007.533-2.493M9.002 19.128v-.003a9.31 9.31 0 00.786-3.07M9.002 19.128v.109A11.386 11.386 0 016.002 20c-1.102 0-2.167-.156-3.175-.446v-.109m0-1.396C4.12 13.565 5.922 12 8 12s3.88 1.565 5.175 4.156m-5.175-4.156A3.75 3.75 0 108 4.5a3.75 3.75 0 000 7.5zm9 0A3.75 3.75 0 1017.5 4.5a3.75 3.75 0 000 7.5z" />
        </svg>
        <span>Manajemen Pengguna</span>
    </a>
</nav>
