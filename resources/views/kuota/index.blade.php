@extends('layouts.template')

@section('title', 'Kelola Kuota')

@section('content')
<div class="space-y-6">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Kelola Kuota</h1>
            <p class="text-xs text-slate-400 mt-1">Atur batas kunjungan harian untuk hari Sabtu &amp; Minggu.</p>
        </div>
        <button type="button" onclick="bukaModalTambah()"
            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition duration-200 shadow-md shadow-emerald-500/10 flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Atur Kuota Baru
        </button>
    </div>

    {{-- ===== ALERTS ===== --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl flex items-center gap-3 text-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{!! session('success') !!}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 bg-rose-50 border border-rose-100 text-rose-800 rounded-2xl flex items-center gap-3 text-sm">
            <svg class="w-5 h-5 shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Total Jadwal</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $kuotas->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Total Kapasitas</p>
                <p class="text-2xl font-extrabold text-emerald-600">{{ $kuotas->sum('kuota_maks') }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Total Terisi</p>
                <p class="text-2xl font-extrabold text-blue-600">{{ $kuotas->sum('actual_terisi') }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Total Sisa</p>
                <p class="text-2xl font-extrabold text-amber-600">{{ $kuotas->sum('sisa') }}</p>
            </div>
        </div>
    </div>

    {{-- ===== TABLE CARD ===== --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Data Kuota Terdaftar</h2>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $kuotas->count() }} jadwal terdaftar</p>
                </div>
            </div>
            <div class="text-xs text-slate-400 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Hanya tersedia Sabtu &amp; Minggu
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100">
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Maksimal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Terisi</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Sisa</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Kapasitas</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($kuotas as $k)
                        @php
                            $sisa     = $k->sisa;
                            $terisi   = $k->actual_terisi;
                            $maks     = $k->kuota_maks;
                            $pct      = $maks > 0 ? round(($terisi / $maks) * 100) : 0;
                            $hariMap  = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'];
                            $hari     = $hariMap[$k->tanggal->format('l')] ?? '';
                            $isWeekend = in_array($k->tanggal->format('l'), ['Saturday','Sunday']);
                            $tanggalStr = $k->tanggal->format('Y-m-d');
                        @endphp
                        <tr class="hover:bg-slate-50/40 transition duration-150">
                            {{-- Tanggal --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-2xl bg-slate-900 flex flex-col items-center justify-center text-white shrink-0">
                                        <span class="text-sm font-extrabold leading-none">{{ $k->tanggal->format('d') }}</span>
                                        <span class="text-[9px] font-bold uppercase tracking-wide text-slate-400 mt-0.5">{{ $k->tanggal->format('M') }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $k->tanggal->format('d M Y') }}</p>
                                        <div class="flex items-center gap-1.5 mt-0.5">
                                            <span class="text-[10px] font-semibold {{ $isWeekend ? 'text-emerald-600' : 'text-slate-400' }}">{{ $hari }}</span>
                                            @if($isWeekend)
                                                <span class="px-1.5 py-0.5 bg-emerald-50 text-emerald-600 text-[9px] font-bold rounded-full border border-emerald-100">Weekend</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Maksimal --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-3 py-1.5 bg-slate-100 text-slate-700 text-sm font-extrabold rounded-xl min-w-[40px]">{{ $maks }}</span>
                                <div class="text-[10px] text-slate-400 mt-1">orang</div>
                            </td>

                            {{-- Terisi --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-3 py-1.5 text-sm font-extrabold rounded-xl min-w-[40px]
                                    {{ $terisi === 0 ? 'bg-slate-100 text-slate-400' : ($terisi >= $maks ? 'bg-rose-100 text-rose-700' : 'bg-blue-100 text-blue-700') }}">
                                    {{ $terisi }}
                                </span>
                                <div class="text-[10px] text-slate-400 mt-1">orang</div>
                            </td>

                            {{-- Sisa --}}
                            <td class="px-6 py-4 text-center">
                                <span class="text-lg font-extrabold {{ $sisa <= 0 ? 'text-rose-500' : ($sisa <= 5 ? 'text-amber-500' : 'text-emerald-600') }}">{{ $sisa }}</span>
                                @if($sisa <= 0)
                                    <div class="text-[10px] text-rose-400 font-bold mt-0.5">PENUH</div>
                                @elseif($sisa <= 5)
                                    <div class="text-[10px] text-amber-500 font-bold mt-0.5">HAMPIR PENUH</div>
                                @else
                                    <div class="text-[10px] text-slate-400 mt-0.5">tersisa</div>
                                @endif
                            </td>

                            {{-- Progress --}}
                            <td class="px-6 py-4">
                                <div class="min-w-[100px]">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-[10px] text-slate-400 font-medium">{{ $pct }}%</span>
                                        <span class="text-[10px] text-slate-400">{{ $terisi }}/{{ $maks }}</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-2 rounded-full transition-all duration-500
                                            {{ $pct >= 100 ? 'bg-rose-500' : ($pct >= 75 ? 'bg-amber-500' : 'bg-emerald-500') }}"
                                            style="width: {{ min($pct, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Sync --}}
                                    <form action="{{ route('admin.kuota.sync', $tanggalStr) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-1.5 px-3 py-2 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-500 text-xs font-bold rounded-xl transition-colors cursor-pointer border border-slate-200 hover:border-emerald-200 group">
                                            <svg class="w-3.5 h-3.5 group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                            </svg>
                                            Sync
                                        </button>
                                    </form>

                                    {{-- Edit --}}
                                    <button type="button"
                                        onclick="bukaModalEdit('{{ $tanggalStr }}', {{ $maks }})"
                                        class="flex items-center gap-1.5 px-3 py-2 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-500 text-xs font-bold rounded-xl transition-colors cursor-pointer border border-slate-200 hover:border-blue-200">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                        </svg>
                                        Edit
                                    </button>

                                    {{-- Hapus --}}
                                    <button type="button"
                                        onclick="bukaModalHapus('{{ $tanggalStr }}', '{{ $k->tanggal->format('d M Y') }}')"
                                        class="p-2 bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-400 rounded-xl transition-colors cursor-pointer border border-slate-200 hover:border-rose-200">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-3xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-500">Belum ada data kuota</p>
                                <p class="text-xs text-slate-400 mt-1">Klik "Atur Kuota Baru" untuk menambahkan jadwal.</p>
                                <button type="button" onclick="bukaModalTambah()"
                                    class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl transition-colors cursor-pointer">
                                    + Atur Kuota Sekarang
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL: TAMBAH KUOTA --}}
{{-- ============================================================ --}}
<div id="modal-tambah" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="tutupModal('modal-tambah')"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-md z-10
                transition-all duration-200 transform scale-95 opacity-0" id="modal-tambah-card">

        {{-- Header --}}
        <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Tambah Kuota Baru</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Atur jadwal dan batas kuota kunjungan</p>
                </div>
            </div>
            <button type="button" onclick="tutupModal('modal-tambah')"
                class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.kuota.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            {{-- Tanggal --}}
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Tanggal Kunjungan <span class="text-rose-500">*</span>
                </label>
                <input type="date" name="tanggal" id="tambah-tanggal"
                    value="{{ old('tanggal') }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl
                           focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500
                           outline-none text-slate-800 text-sm transition-all cursor-pointer" required>
                <div id="tambah-hari-info" class="mt-2 text-xs hidden"></div>
            </div>

            {{-- Kuota Maks --}}
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Batas Kuota Maksimal <span class="text-rose-500">*</span>
                </label>
                <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl p-1
                            focus-within:ring-4 focus-within:ring-emerald-500/10 focus-within:border-emerald-500 transition-all">
                    <button type="button" onclick="ubahKuota('tambah-kuota', -1)"
                        class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-white shadow-sm
                               text-slate-600 hover:text-rose-600 hover:bg-rose-50 border border-slate-100 text-lg font-bold transition-colors cursor-pointer">
                        −
                    </button>
                    <input type="number" name="kuota_maks" id="tambah-kuota"
                        value="{{ old('kuota_maks', 20) }}" min="1" max="100"
                        class="flex-1 text-center bg-transparent font-extrabold text-xl text-slate-800 outline-none py-2">
                    <button type="button" onclick="ubahKuota('tambah-kuota', 1)"
                        class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-white shadow-sm
                               text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 border border-slate-100 text-lg font-bold transition-colors cursor-pointer">
                        +
                    </button>
                </div>
                <p class="text-xs text-slate-400 mt-1.5">Rekomendasi default: 20 orang per hari</p>
            </div>

            {{-- Preset --}}
            <div>
                <p class="text-xs text-slate-400 font-semibold mb-2">Preset cepat:</p>
                <div class="flex gap-2 flex-wrap">
                    @foreach([10, 15, 20, 25, 30, 50] as $n)
                        <button type="button" onclick="isiKuota('tambah-kuota', {{ $n }})"
                            class="px-3 py-1.5 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-100
                                   text-slate-600 text-xs font-bold rounded-xl border border-slate-200 transition-colors cursor-pointer">
                            {{ $n }} org
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="tutupModal('modal-tambah')"
                    class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl text-sm transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-2xl text-sm
                           transition-colors shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Simpan Kuota
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL: EDIT KUOTA --}}
{{-- ============================================================ --}}
<div id="modal-edit" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="tutupModal('modal-edit')"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-md z-10
                transition-all duration-200 transform scale-95 opacity-0" id="modal-edit-card">

        {{-- Header --}}
        <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Edit Kuota</h3>
                    <p class="text-xs text-slate-400 mt-0.5" id="edit-subtitle">Perbarui batas kuota</p>
                </div>
            </div>
            <button type="button" onclick="tutupModal('modal-edit')"
                class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.kuota.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            <input type="hidden" name="tanggal" id="edit-tanggal-input">

            {{-- Tanggal (readonly) --}}
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal</label>
                <div class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-2xl
                            text-slate-600 text-sm font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5" />
                    </svg>
                    <span id="edit-tanggal-display">—</span>
                    <span class="ml-auto text-[10px] text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Tidak dapat diubah</span>
                </div>
            </div>

            {{-- Kuota Maks --}}
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Batas Kuota Maksimal <span class="text-rose-500">*</span>
                </label>
                <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl p-1
                            focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-500 transition-all">
                    <button type="button" onclick="ubahKuota('edit-kuota', -1)"
                        class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-white shadow-sm
                               text-slate-600 hover:text-rose-600 hover:bg-rose-50 border border-slate-100 text-lg font-bold transition-colors cursor-pointer">
                        −
                    </button>
                    <input type="number" name="kuota_maks" id="edit-kuota"
                        value="20" min="1" max="100"
                        class="flex-1 text-center bg-transparent font-extrabold text-xl text-slate-800 outline-none py-2">
                    <button type="button" onclick="ubahKuota('edit-kuota', 1)"
                        class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-white shadow-sm
                               text-slate-600 hover:text-blue-600 hover:bg-blue-50 border border-slate-100 text-lg font-bold transition-colors cursor-pointer">
                        +
                    </button>
                </div>
            </div>

            {{-- Preset --}}
            <div class="flex gap-2 flex-wrap">
                @foreach([10, 15, 20, 25, 30, 50] as $n)
                    <button type="button" onclick="isiKuota('edit-kuota', {{ $n }})"
                        class="px-3 py-1.5 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-100
                               text-slate-600 text-xs font-bold rounded-xl border border-slate-200 transition-colors cursor-pointer">
                        {{ $n }} org
                    </button>
                @endforeach
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="tutupModal('modal-edit')"
                    class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl text-sm transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl text-sm
                           transition-colors shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL: KONFIRMASI HAPUS --}}
{{-- ============================================================ --}}
<div id="modal-hapus" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="tutupModal('modal-hapus')"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-sm z-10
                transition-all duration-200 transform scale-95 opacity-0" id="modal-hapus-card">

        <div class="p-6 text-center">
            {{-- Icon --}}
            <div class="w-16 h-16 mx-auto mb-4 bg-rose-100 rounded-3xl flex items-center justify-center">
                <svg class="w-8 h-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus Data Kuota?</h3>
            <p class="text-sm text-slate-500 mb-1">Anda akan menghapus kuota untuk tanggal:</p>
            <p class="text-sm font-bold text-rose-600 mb-4" id="hapus-tanggal-display">—</p>
            <p class="text-xs text-slate-400 bg-rose-50 border border-rose-100 rounded-xl p-3 mb-6">
                ⚠ Tindakan ini <strong>tidak dapat dibatalkan</strong>. Data kuota akan dihapus permanen.
            </p>

            {{-- Form hapus --}}
            <form id="form-hapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="tutupModal('modal-hapus')"
                        class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl text-sm transition-colors cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded-2xl text-sm
                               transition-colors shadow-lg shadow-rose-500/20 flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9" />
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
/* ============================================================
   MODAL HELPERS — buka / tutup dengan animasi scale
   ============================================================ */
function bukaModal(idModal) {
    const overlay = document.getElementById(idModal);
    const card    = document.getElementById(idModal + '-card');
    if (!overlay || !card) return;

    overlay.classList.remove('hidden');
    // Tunggu sebentar agar hidden hilang dahulu sebelum animasi
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        });
    });
}

function tutupModal(idModal) {
    const overlay = document.getElementById(idModal);
    const card    = document.getElementById(idModal + '-card');
    if (!overlay || !card) return;

    card.classList.remove('scale-100', 'opacity-100');
    card.classList.add('scale-95', 'opacity-0');
    setTimeout(() => overlay.classList.add('hidden'), 200);
}

/* ============================================================
   MODAL TAMBAH
   ============================================================ */
function bukaModalTambah() {
    // Reset field
    document.getElementById('tambah-tanggal').value = '';
    document.getElementById('tambah-kuota').value   = 20;
    document.getElementById('tambah-hari-info').classList.add('hidden');
    bukaModal('modal-tambah');
}

// Feedback hari saat pilih tanggal di modal tambah
document.getElementById('tambah-tanggal')?.addEventListener('change', function () {
    const val = this.value;
    if (!val) return;

    const [y, m, d] = val.split('-').map(Number);
    const dt  = new Date(y, m - 1, d);
    const dow = dt.getDay();
    const hariMap  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulanMap = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const info = document.getElementById('tambah-hari-info');

    info.textContent = `📅 ${hariMap[dow]}, ${String(d).padStart(2,'0')} ${bulanMap[m-1]} ${y}`;
    info.classList.remove('hidden');

    if (dow === 0 || dow === 6) {
        info.className = 'mt-2 text-xs font-semibold text-emerald-600';
    } else {
        info.className = 'mt-2 text-xs font-semibold text-amber-600';
        info.textContent += ' — ⚠ Bukan hari weekend!';
    }
});

/* ============================================================
   MODAL EDIT
   ============================================================ */
function bukaModalEdit(tanggal, maks) {
    // Isi form
    document.getElementById('edit-tanggal-input').value = tanggal;
    document.getElementById('edit-kuota').value         = maks;

    // Format tanggal untuk ditampilkan
    const [y, m, d] = tanggal.split('-').map(Number);
    const dt  = new Date(y, m - 1, d);
    const hariMap  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulanMap = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const label = `${hariMap[dt.getDay()]}, ${String(d).padStart(2,'0')} ${bulanMap[m-1]} ${y}`;

    document.getElementById('edit-tanggal-display').textContent = label;
    document.getElementById('edit-subtitle').textContent        = `Tanggal: ${label}`;

    bukaModal('modal-edit');
}

/* ============================================================
   MODAL HAPUS
   ============================================================ */
function bukaModalHapus(tanggal, labelTanggal) {
    document.getElementById('hapus-tanggal-display').textContent = labelTanggal;

    // Set action form
    const actionUrl = `{{ url('/admin/kuota') }}/${tanggal}`;
    document.getElementById('form-hapus').action = actionUrl;

    bukaModal('modal-hapus');
}

/* ============================================================
   QUANTITY HELPERS
   ============================================================ */
function ubahKuota(inputId, delta) {
    const el  = document.getElementById(inputId);
    const val = Math.min(100, Math.max(1, (parseInt(el.value) || 20) + delta));
    el.value  = val;
}

function isiKuota(inputId, nilai) {
    document.getElementById(inputId).value = nilai;
}

/* ============================================================
   AUTO-OPEN modal jika ada error validasi
   ============================================================ */
@if($errors->any())
    document.addEventListener('DOMContentLoaded', () => bukaModal('modal-tambah'));
@endif
</script>
@endpush
