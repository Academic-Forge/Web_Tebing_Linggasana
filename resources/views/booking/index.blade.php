@extends('layouts.template')

@section('title', 'Manajemen Booking')

@section('content')
<div class="space-y-6 animate-fade-in">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Manajemen Booking</h1>
            <p class="text-xs text-slate-400 mt-1">Pantau dan kelola seluruh reservasi wisata Tebing Linggasana.</p>
        </div>
        {{-- Export / Print placeholder --}}
        <button onclick="window.print()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition duration-200 flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
            </svg>
            Cetak
        </button>
    </div>

    {{-- ===== STATS CARDS ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Total</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $stats['total'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Pending</p>
                <p class="text-2xl font-extrabold text-amber-600">{{ $stats['pending'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Dibayar</p>
                <p class="text-2xl font-extrabold text-emerald-600">{{ $stats['dibayar'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Dibatalkan</p>
                <p class="text-2xl font-extrabold text-rose-500">{{ $stats['batal'] }}</p>
            </div>
        </div>
    </div>

    {{-- ===== SESSION ALERTS ===== --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{!! session('success') !!}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 bg-rose-50 border border-rose-100 text-rose-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
            <svg class="w-5 h-5 shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- ===== TABLE CARD ===== --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Card Header + Filters --}}
        <div class="p-6 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Daftar Seluruh Reservasi</h2>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $bookings->total() }} data ditemukan</p>
                    </div>
                </div>

                {{-- Search & Filter --}}
                <form method="GET" action="{{ route('admin.booking.index') }}" class="flex flex-col sm:flex-row gap-2.5">
                    <div class="relative">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kode atau nama..."
                            class="pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 focus:ring-3 focus:ring-emerald-500/10 outline-none text-sm text-slate-800 transition-all w-full sm:w-52">
                    </div>
                    <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 focus:ring-3 focus:ring-emerald-500/10 outline-none text-sm text-slate-800 transition-all cursor-pointer">
                        <option value="semua" {{ request('status', 'semua') === 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                        <option value="dibayar"  {{ request('status') === 'dibayar'  ? 'selected' : '' }}>Dibayar</option>
                        <option value="selesai"  {{ request('status') === 'selesai'  ? 'selected' : '' }}>Selesai</option>
                        <option value="batal"    {{ request('status') === 'batal'    ? 'selected' : '' }}>Batal</option>
                    </select>
                    @if(request('search') || (request('status') && request('status') !== 'semua'))
                        <a href="{{ route('admin.booking.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-xl text-sm font-medium transition-colors flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto min-h-[320px]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100">
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Kode Booking</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Pemesan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tgl Kunjungan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Peserta</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($bookings as $booking)
                        @php
                            $status = strtolower($booking->status_booking);
                            $statusConfig = match(true) {
                                in_array($status, ['dibayar', 'lunas', 'success', 'settlement']) =>
                                    ['label' => 'Dibayar',  'bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500'],
                                in_array($status, ['selesai']) =>
                                    ['label' => 'Selesai',  'bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-100',    'dot' => 'bg-blue-500'],
                                in_array($status, ['pending', 'menunggu']) =>
                                    ['label' => 'Pending',  'bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-100',   'dot' => 'bg-amber-500'],
                                in_array($status, ['batal', 'cancel', 'failed']) =>
                                    ['label' => 'Batal',    'bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-100',    'dot' => 'bg-rose-500'],
                                default =>
                                    ['label' => ucfirst($status), 'bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'dot' => 'bg-slate-400'],
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/40 transition duration-150 group">

                            {{-- Kode --}}
                            <td class="px-6 py-4">
                                <span class="inline-block font-mono text-xs font-extrabold text-slate-800 bg-slate-100 px-2.5 py-1.5 rounded-lg border border-slate-200">
                                    {{ $booking->kode_booking }}
                                </span>
                                <div class="text-[10px] text-slate-400 mt-1.5 font-medium">
                                    {{ $booking->tanggal_booking->format('d M Y') }}
                                </div>
                            </td>

                            {{-- Pemesan --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    @if($booking->user && $booking->user->profile_image && $booking->user->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . $booking->user->profile_image)))
                                        <img src="{{ asset('img/' . $booking->user->profile_image) }}" alt="" class="w-8 h-8 rounded-full object-cover border border-slate-100 shrink-0">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-700 font-bold uppercase text-xs shrink-0">
                                            {{ $booking->user ? substr($booking->user->nama_lengkap, 0, 2) : '??' }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">
                                            {{ $booking->user->nama_lengkap ?? '—' }}
                                        </div>
                                        <div class="text-[10px] text-slate-400 mt-0.5">
                                            {{ $booking->user->email ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Tgl Kunjungan --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-10 h-10 bg-slate-900 rounded-xl flex flex-col items-center justify-center text-white shrink-0">
                                        <span class="text-sm font-extrabold leading-none">{{ $booking->tanggal_kunjungan->format('d') }}</span>
                                        <span class="text-[9px] font-bold uppercase tracking-wide text-slate-400">{{ $booking->tanggal_kunjungan->format('M') }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-700">{{ $booking->tanggal_kunjungan->format('Y') }}</div>
                                        <div class="text-[10px] text-slate-400">
                                            @php $hari = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu']; @endphp
                                            {{ $hari[$booking->tanggal_kunjungan->format('l')] ?? $booking->tanggal_kunjungan->format('l') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Peserta --}}
                            <td class="px-6 py-4 text-center">
                                <div class="font-bold text-slate-800 text-sm">{{ $booking->jumlah_orang }} <span class="font-normal text-slate-400 text-xs">org</span></div>
                                @if($booking->details->isNotEmpty())
                                    <button
                                        onclick="openDetailModal('modal-peserta-{{ $booking->id_booking }}')"
                                        class="mt-1.5 inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-500 text-[10px] font-bold rounded-lg transition-colors cursor-pointer">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0112.002 20c-1.102 0-2.167-.156-3.175-.446v-.109" />
                                        </svg>
                                        Detail
                                    </button>
                                @endif
                            </td>

                            {{-- Total Harga --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800 text-sm">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                <div class="text-[10px] text-slate-400 mt-0.5">Rp125K × {{ $booking->jumlah_orang }}</div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wide border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-right">
                                <div class="relative inline-block" x-data="{ open: false }">
                                    <button
                                        onclick="toggleDropdown('dd-{{ $booking->id_booking }}')"
                                        class="flex items-center gap-1.5 px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-colors cursor-pointer border border-slate-200">
                                        Kelola
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>

                                    {{-- Dropdown --}}
                                    <div id="dd-{{ $booking->id_booking }}"
                                        class="hidden absolute right-0 top-full mt-2 w-52 bg-white rounded-2xl border border-slate-100 shadow-xl py-2 z-20">

                                        <div class="px-3 py-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Ubah Status</div>

                                        @foreach([
                                            ['pending',  'Pending',  'text-amber-600 bg-amber-50'],
                                            ['dibayar',  'Dibayar',  'text-emerald-600 bg-emerald-50'],
                                            ['selesai',  'Selesai',  'text-blue-600 bg-blue-50'],
                                            ['batal',    'Batalkan', 'text-rose-600 bg-rose-50'],
                                        ] as [$val, $label, $cls])
                                            @if($booking->status_booking !== $val)
                                                <form action="{{ route('admin.booking.status', $booking->id_booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $val }}">
                                                    <button type="submit"
                                                        class="flex items-center gap-2.5 w-full px-4 py-2 text-sm {{ $cls }} hover:opacity-80 transition-opacity font-medium text-left cursor-pointer"
                                                        @if($val === 'batal') onclick="return confirm('Yakin ingin membatalkan booking ini?')" @endif>
                                                        <span class="w-2 h-2 rounded-full
                                                            @if($val==='pending') bg-amber-400
                                                            @elseif($val==='dibayar') bg-emerald-500
                                                            @elseif($val==='selesai') bg-blue-500
                                                            @else bg-rose-500 @endif">
                                                        </span>
                                                        Set {{ $label }}
                                                    </button>
                                                </form>
                                            @endif
                                        @endforeach

                                        <div class="border-t border-slate-100 mt-1 pt-1">
                                            <form action="{{ route('admin.booking.destroy', $booking->id_booking) }}" method="POST"
                                                onsubmit="return confirm('Hapus booking {{ $booking->kode_booking }} secara permanen? Tindakan ini tidak dapat dibatalkan.')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center gap-2.5 w-full px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 font-medium cursor-pointer">
                                                    <svg class="w-4 h-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    Hapus Permanen
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-3xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-500">Tidak ada data booking</p>
                                <p class="text-xs text-slate-400 mt-1">
                                    @if(request('search') || request('status'))
                                        Coba ubah filter pencarian.
                                    @else
                                        Belum ada reservasi yang masuk.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ===== PESERTA DETAIL MODALS ===== --}}
@foreach($bookings as $booking)
    @if($booking->details->isNotEmpty())
    <div id="modal-peserta-{{ $booking->id_booking }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeDetailModal('modal-peserta-{{ $booking->id_booking }}')"></div>
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-sm w-full overflow-hidden z-10 transition-all duration-300 transform scale-95 opacity-0" id="modal-card-{{ $booking->id_booking }}">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Detail Peserta</h3>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $booking->kode_booking }}</p>
                    </div>
                    <button onclick="closeDetailModal('modal-peserta-{{ $booking->id_booking }}')"
                        class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Booking Info --}}
                <div class="p-4 bg-slate-50 mx-6 mt-6 rounded-2xl border border-slate-100">
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div>
                            <p class="text-slate-400 font-semibold uppercase tracking-wider">Pemesan</p>
                            <p class="font-bold text-slate-800 mt-0.5">{{ $booking->user->nama_lengkap ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-400 font-semibold uppercase tracking-wider">Kunjungan</p>
                            <p class="font-bold text-slate-800 mt-0.5">{{ $booking->tanggal_kunjungan->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Peserta List --}}
                <div class="p-6 space-y-2.5 max-h-72 overflow-y-auto">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Daftar {{ $booking->details->count() }} Anggota</p>
                    @foreach($booking->details as $i => $peserta)
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="w-7 h-7 shrink-0 bg-slate-900 rounded-lg flex items-center justify-center text-white text-[10px] font-bold">{{ $i + 1 }}</div>
                            <div class="flex-grow min-w-0">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $peserta->nama_peserta }}</p>
                                @if($peserta->no_hp)
                                    <p class="text-[10px] text-slate-400 font-mono mt-0.5">{{ $peserta->no_hp }}</p>
                                @else
                                    <p class="text-[10px] text-slate-300 mt-0.5 italic">No. HP tidak diisi</p>
                                @endif
                            </div>
                            @if($i === 0)
                                <span class="text-[9px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full shrink-0">Pemesan</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="px-6 pb-6">
                    <button onclick="closeDetailModal('modal-peserta-{{ $booking->id_booking }}')"
                        class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl text-sm transition-colors cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
@endsection

@push('scripts')
<script>
    // ===== DROPDOWN KELOLA =====
    function toggleDropdown(id) {
        // Close all other dropdowns first
        document.querySelectorAll('[id^="dd-"]').forEach(el => {
            if (el.id !== id) el.classList.add('hidden');
        });
        const el = document.getElementById(id);
        if (el) el.classList.toggle('hidden');
    }

    // Close dropdowns on outside click
    document.addEventListener('click', function (e) {
        if (!e.target.closest('[onclick^="toggleDropdown"]') && !e.target.closest('[id^="dd-"]')) {
            document.querySelectorAll('[id^="dd-"]').forEach(el => el.classList.add('hidden'));
        }
    });

    // ===== DETAIL MODAL =====
    function openDetailModal(id) {
        const modal = document.getElementById(id);
        const cardId = id.replace('modal-peserta-', 'modal-card-');
        const card = document.getElementById(cardId);
        if (modal && card) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 50);
        }
    }

    function closeDetailModal(id) {
        const modal = document.getElementById(id);
        const cardId = id.replace('modal-peserta-', 'modal-card-');
        const card = document.getElementById(cardId);
        if (modal && card) {
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 250);
        }
    }

    // ===== AUTO SEARCH =====
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            // Refocus search input if it has value (cursor at end)
            if (searchInput.value) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }

            let debounceTimer;
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        }
    });
</script>
@endpush
