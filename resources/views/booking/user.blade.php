@extends('layouts.template')

@section('title', 'Reservasi Wisata')

@section('content')
<div class="space-y-8 animate-fade-in">

    {{-- ===== HERO BANNER ===== --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 p-8 md:p-10 text-white shadow-xl border border-emerald-900/30">
        {{-- Background decorative --}}
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=60')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-emerald-400/5 rounded-full blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-xs font-bold uppercase tracking-wider mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    Eco Tourism Linggasana
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Reservasi Wisata Tebing</h1>
                <p class="text-slate-300 text-sm max-w-lg">Daftarkan diri dan grup Anda untuk menjelajahi keindahan alam Tebing Linggasana. Tersedia setiap akhir pekan dengan kuota terbatas.</p>
            </div>
            
            {{-- Info Cards --}}
            <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center backdrop-blur-sm min-w-[130px]">
                    <div class="text-3xl font-extrabold text-emerald-400">20</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Kuota / Hari</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center backdrop-blur-sm min-w-[130px]">
                    <div class="text-3xl font-extrabold text-white">Rp125K</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Per Orang</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center backdrop-blur-sm min-w-[130px]">
                    <div class="text-lg font-extrabold text-amber-400">Sab & Min</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Hari Tersedia</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== ALERTS ===== --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200/60 text-emerald-800 rounded-2xl flex items-start gap-3 shadow-sm text-sm" role="alert">
            <div class="w-8 h-8 shrink-0 bg-emerald-100 rounded-full flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-emerald-900">Booking Berhasil! 🎉</p>
                <p class="mt-0.5 text-emerald-700">{!! session('success') !!}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-2xl flex items-start gap-3 shadow-sm text-sm" role="alert">
            <div class="w-8 h-8 shrink-0 bg-rose-100 rounded-full flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-rose-900">Booking Gagal</p>
                <p class="mt-0.5 text-rose-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-2xl shadow-sm text-sm">
            <p class="font-bold mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                Terjadi kesalahan:
            </p>
            <ul class="list-disc list-inside space-y-0.5 text-rose-700 text-xs pl-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

        {{-- ===== LEFT: FORM BOOKING ===== --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden sticky top-8">
                {{-- Card Header --}}
                <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Form Reservasi</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Isi data dengan lengkap dan benar</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <form action="{{ route('booking.store') }}" method="POST" id="form-booking">
                        @csrf

                        {{-- Tanggal Kunjungan --}}
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" id="input-tanggal"
                                value="{{ old('tanggal_kunjungan') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all cursor-pointer" required>
                            {{-- Date Warning --}}
                            <div id="date-warning" class="hidden mt-2 text-xs text-rose-600 font-semibold flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z" />
                                </svg>
                                Hanya tersedia hari Sabtu &amp; Minggu!
                            </div>
                        </div>

                        {{-- Quota Info --}}
                        <div id="quota-info" class="hidden mb-5 p-3.5 bg-slate-50 border border-slate-200 rounded-2xl transition-all">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500 font-medium text-xs">Sisa kuota tanggal ini</span>
                                <span id="quota-badge" class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-700"></span>
                            </div>
                            <div class="mt-2.5 w-full bg-slate-200 rounded-full h-1.5 overflow-hidden">
                                <div id="quota-bar" class="h-1.5 rounded-full bg-emerald-500 transition-all duration-500" style="width:0%"></div>
                            </div>
                            <p id="quota-text" class="text-xs text-slate-400 mt-1.5"></p>
                        </div>

                        {{-- Jumlah Peserta --}}
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jumlah Peserta</label>
                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl p-1 focus-within:border-emerald-500 focus-within:ring-4 focus-within:ring-emerald-500/10 transition-all">
                                <button type="button" id="btn-minus" class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-white shadow-sm text-slate-600 hover:text-rose-600 hover:bg-rose-50 transition-colors border border-slate-100 text-lg font-bold">−</button>
                                <input type="number" name="jumlah_orang" id="input-jumlah"
                                    value="{{ old('jumlah_orang', 1) }}"
                                    min="1" max="10" readonly
                                    class="flex-1 text-center bg-transparent font-extrabold text-lg text-slate-800 outline-none w-full">
                                <button type="button" id="btn-plus" class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-white shadow-sm text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 transition-colors border border-slate-100 text-lg font-bold">+</button>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Minimal 1, maksimal 10 orang per booking</p>
                        </div>

                        {{-- Ringkasan Biaya --}}
                        <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 rounded-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wider">Total Biaya</p>
                                    <p id="label-total" class="text-2xl font-extrabold text-slate-800 mt-0.5">Rp 125.000</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-slate-400">Rp 125.000 × <span id="label-jumlah">1</span> orang</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Belum termasuk pembayaran</p>
                                </div>
                            </div>
                        </div>

                        {{-- Container Peserta (dinamis) --}}
                        <div id="peserta-container" class="mb-5 space-y-3 max-h-80 overflow-y-auto pr-1">
                            {{-- Generated by JS --}}
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="btn-submit"
                            class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-2xl transition-all duration-200 shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 text-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none cursor-pointer">
                            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span id="btn-submit-text">Konfirmasi &amp; Pesan Sekarang</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===== RIGHT: RIWAYAT BOOKING ===== --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                {{-- Header --}}
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Riwayat Perjalanan Saya</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Semua booking yang pernah dibuat</p>
                        </div>
                    </div>
                    <span class="px-3 py-1.5 bg-slate-100 text-slate-500 text-xs font-bold rounded-full">
                        {{ $myBookings->count() }} Transaksi
                    </span>
                </div>

                @forelse($myBookings as $booking)
                    @php
                        $status = strtolower($booking->status_booking);
                        $statusColor = match(true) {
                            in_array($status, ['dibayar', 'lunas', 'success', 'settlement']) => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500'],
                            in_array($status, ['pending', 'menunggu']) => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-100', 'dot' => 'bg-amber-500'],
                            in_array($status, ['batal', 'cancel', 'failed']) => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-100', 'dot' => 'bg-rose-500'],
                            default => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'dot' => 'bg-slate-400'],
                        };
                        $isPending = in_array($status, ['pending', 'menunggu']);
                    @endphp
                    <div class="p-5 border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-start gap-4">

                            {{-- Date Box --}}
                            <div class="shrink-0 bg-slate-900 text-white rounded-2xl w-16 h-16 flex flex-col items-center justify-center shadow-sm">
                                <span class="text-2xl font-extrabold leading-none">{{ $booking->tanggal_kunjungan->format('d') }}</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mt-0.5">{{ $booking->tanggal_kunjungan->format('M Y') }}</span>
                            </div>

                            {{-- Info --}}
                            <div class="flex-grow min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="font-mono text-sm font-bold text-slate-800">{{ $booking->kode_booking }}</span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase border {{ $statusColor['bg'] }} {{ $statusColor['text'] }} {{ $statusColor['border'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusColor['dot'] }}"></span>
                                        {{ $booking->status_booking }}
                                    </span>
                                </div>

                                <div class="flex flex-wrap gap-4 text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0112.002 20" />
                                        </svg>
                                        <span class="font-semibold text-slate-700">{{ $booking->jumlah_orang }} Peserta</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5" />
                                        </svg>
                                        <span class="font-bold text-emerald-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Dipesan: {{ $booking->tanggal_booking->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>

                                {{-- Peserta List (Collapsible) --}}
                                @if($booking->details->isNotEmpty())
                                    <div class="mt-3">
                                        <button type="button"
                                            onclick="togglePeserta('peserta-{{ $booking->id_booking }}')"
                                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1.5 transition-colors cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952" />
                                            </svg>
                                            Lihat {{ $booking->details->count() }} detail peserta
                                        </button>
                                        <div id="peserta-{{ $booking->id_booking }}" class="hidden mt-2 p-3 bg-slate-50 border border-slate-100 rounded-xl space-y-1.5">
                                            @foreach($booking->details as $i => $peserta)
                                                <div class="flex items-center gap-2.5 text-xs">
                                                    <span class="w-5 h-5 shrink-0 bg-slate-200 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-600">{{ $i + 1 }}</span>
                                                    <span class="font-semibold text-slate-700">{{ $peserta->nama_peserta }}</span>
                                                    @if($peserta->no_hp)
                                                        <span class="text-slate-400">·</span>
                                                        <span class="text-slate-500 font-mono">{{ $peserta->no_hp }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Action --}}
                            @if($isPending)
                                <div class="shrink-0">
                                    <a href="#"
                                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-colors shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                        Bayar
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-20 text-center">
                        <div class="w-20 h-20 mx-auto mb-5 bg-slate-100 rounded-3xl flex items-center justify-center">
                            <svg class="w-9 h-9 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-600 text-sm">Belum ada riwayat perjalanan</h3>
                        <p class="text-xs text-slate-400 mt-1">Buat reservasi pertama Anda dan mulai petualangan!</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const HARGA = 125000;
    const MAX_KUOTA_HARIAN = 20;

    const inputTanggal = document.getElementById('input-tanggal');
    const inputJumlah  = document.getElementById('input-jumlah');
    const btnMinus     = document.getElementById('btn-minus');
    const btnPlus      = document.getElementById('btn-plus');
    const labelTotal   = document.getElementById('label-total');
    const labelJumlah  = document.getElementById('label-jumlah');
    const pesertaContainer = document.getElementById('peserta-container');
    const quotaInfo    = document.getElementById('quota-info');
    const quotaBadge   = document.getElementById('quota-badge');
    const quotaBar     = document.getElementById('quota-bar');
    const quotaText    = document.getElementById('quota-text');
    const dateWarning  = document.getElementById('date-warning');
    const btnSubmit    = document.getElementById('btn-submit');
    const btnSubmitText = document.getElementById('btn-submit-text');

    let sisaKuota = MAX_KUOTA_HARIAN;
    let isDateValid = false;

    // === FORMAT CURRENCY ===
    function formatRupiah(n) {
        return 'Rp ' + n.toLocaleString('id-ID');
    }

    // === RENDER PESERTA FORMS ===
    function renderPeserta(jumlah) {
        pesertaContainer.innerHTML = '';
        if (jumlah < 1) return;

        const header = document.createElement('div');
        header.className = 'flex items-center gap-2 mb-3';
        header.innerHTML = `<span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Detail Peserta</span>
            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full">Wajib Diisi</span>`;
        pesertaContainer.appendChild(header);

        for (let i = 1; i <= jumlah; i++) {
            const card = document.createElement('div');
            card.className = 'p-4 bg-slate-50 border border-slate-100 rounded-2xl transition-all';
            card.style.animation = `fadeSlideIn 0.25s ease ${(i - 1) * 0.05}s both`;
            card.innerHTML = `
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-6 h-6 bg-slate-900 rounded-lg flex items-center justify-center text-white text-[10px] font-bold shrink-0">${i}</span>
                    <span class="text-xs font-bold text-slate-700">Anggota Grup ${i}</span>
                    ${i === 1 ? '<span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-bold">Pemesan</span>' : ''}
                </div>
                <div class="space-y-2.5">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_peserta[]" placeholder="Nama sesuai identitas"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-3 focus:ring-emerald-500/10 outline-none text-slate-800 text-sm transition-all" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">No. HP <span class="text-slate-300 font-normal">(Opsional)</span></label>
                        <input type="tel" name="no_hp_peserta[]" placeholder="08xxxxxxxxxx"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-3 focus:ring-emerald-500/10 outline-none text-slate-800 text-sm transition-all">
                    </div>
                </div>
            `;
            pesertaContainer.appendChild(card);
        }
    }

    // === UPDATE TOTAL ===
    function updateTotal() {
        const jumlah = parseInt(inputJumlah.value) || 1;
        labelTotal.textContent = formatRupiah(jumlah * HARGA);
        labelJumlah.textContent = jumlah;
        renderPeserta(jumlah);
        validateSubmit(jumlah);
    }

    // === VALIDATE SUBMIT ===
    function validateSubmit(jumlah) {
        jumlah = jumlah || parseInt(inputJumlah.value) || 1;

        if (!isDateValid) {
            setSubmitDisabled('Pilih Tanggal yang Valid');
            return;
        }
        if (sisaKuota <= 0) {
            setSubmitDisabled('Kuota Penuh');
            return;
        }
        if (jumlah > sisaKuota) {
            setSubmitDisabled(`Kuota Tidak Cukup (Sisa: ${sisaKuota})`);
            return;
        }
        setSubmitEnabled();
    }

    function setSubmitDisabled(msg) {
        btnSubmit.disabled = true;
        btnSubmitText.textContent = msg;
    }

    function setSubmitEnabled() {
        btnSubmit.disabled = false;
        btnSubmitText.innerHTML = 'Konfirmasi &amp; Pesan Sekarang';
    }

    // === QUANTITY BUTTONS ===
    btnMinus.addEventListener('click', () => {
        const val = parseInt(inputJumlah.value) || 1;
        if (val > 1) {
            inputJumlah.value = val - 1;
            updateTotal();
        }
    });
    btnPlus.addEventListener('click', () => {
        const val = parseInt(inputJumlah.value) || 1;
        if (val < 10) {
            inputJumlah.value = val + 1;
            updateTotal();
        }
    });

    // === DATE CHANGE ===
    inputTanggal.addEventListener('change', function () {
        const dateStr = this.value;
        if (!dateStr) return;

        // JS date: getDay() — 0=Sunday,6=Saturday, tapi UTC offset bisa geser
        // Pakai string split agar tidak kena timezone issue
        const [y, m, d] = dateStr.split('-').map(Number);
        const dateObj = new Date(y, m - 1, d);
        const dow = dateObj.getDay(); // 0=Minggu, 6=Sabtu

        if (dow !== 0 && dow !== 6) {
            dateWarning.classList.remove('hidden');
            quotaInfo.classList.add('hidden');
            isDateValid = false;
            sisaKuota = 0;
            validateSubmit();
            return;
        }

        // Valid weekend
        dateWarning.classList.add('hidden');
        isDateValid = true;

        // Show loading in quota info
        quotaInfo.classList.remove('hidden');
        quotaBadge.textContent = '...';
        quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-500';
        quotaBar.style.width = '0%';
        quotaText.textContent = 'Mengecek kuota...';

        // Fetch real-time quota
        fetch(`{{ route('booking.quota') }}?date=${dateStr}`)
            .then(r => r.json())
            .then(data => {
                sisaKuota = data.remaining;
                const filled = data.filled;
                const max = data.max_quota;
                const pct = Math.round((filled / max) * 100);

                if (sisaKuota <= 0) {
                    quotaBadge.textContent = '0 — PENUH';
                    quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-700';
                    quotaBar.style.width = '100%';
                    quotaBar.className = 'h-1.5 rounded-full bg-rose-500 transition-all duration-500';
                    quotaText.textContent = `Semua ${max} slot sudah terisi.`;
                } else if (sisaKuota <= 5) {
                    quotaBadge.textContent = `${sisaKuota} orang tersisa`;
                    quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-700';
                    quotaBar.style.width = pct + '%';
                    quotaBar.className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-500';
                    quotaText.textContent = `${filled} dari ${max} slot terisi — segera pesan!`;
                } else {
                    quotaBadge.textContent = `${sisaKuota} orang tersisa`;
                    quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-700';
                    quotaBar.style.width = pct + '%';
                    quotaBar.className = 'h-1.5 rounded-full bg-emerald-500 transition-all duration-500';
                    quotaText.textContent = `${filled} dari ${max} slot terisi`;
                }
                validateSubmit();
            })
            .catch(() => {
                quotaText.textContent = 'Gagal memuat data kuota.';
            });
    });

    // === PESERTA TOGGLE ===
    window.togglePeserta = function(id) {
        const el = document.getElementById(id);
        if (el) el.classList.toggle('hidden');
    };

    // === INIT ===
    setSubmitDisabled('Pilih Tanggal Dahulu');
    renderPeserta(parseInt(inputJumlah.value) || 1);
    updateTotal();

    // CSS animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush
