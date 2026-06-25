<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Saya - Tebing Linggasana</title>
    <meta name="description" content="Kelola reservasi wisata Tebing Linggasana Anda. Buat booking baru dan lihat riwayat perjalanan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', 'Inter', sans-serif; }
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeSlideIn 0.4s ease both; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">

    {{-- ===== NAVBAR ===== --}}
    @include('katalog_user.partials.navbar')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 pt-24 pb-16 px-6">
        <div class="absolute inset-0 bg-[url('/img/tebing-1.jpeg')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-teal-400/5 rounded-full blur-2xl"></div>

        <div class="relative z-10 max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 text-white">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-xs font-bold uppercase tracking-wider mb-4">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                        Eco Tourism Linggasana
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black tracking-tight">Reservasi <span class="text-emerald-400">Eksklusif</span></h1>
                    <p class="text-slate-300 text-sm mt-2 max-w-lg">Satu pendaftaran praktis untuk seluruh anggota petualangan Anda.</p>
                </div>
                <div class="flex gap-3 shrink-0">
                    <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center backdrop-blur-sm min-w-[110px]">
                        <div class="text-3xl font-black text-emerald-400">20</div>
                        <div class="text-[10px] text-slate-400 mt-1 font-semibold uppercase tracking-wider">Kuota / Hari</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center backdrop-blur-sm min-w-[110px]">
                        <div class="text-2xl font-black text-white">Rp125K</div>
                        <div class="text-[10px] text-slate-400 mt-1 font-semibold uppercase tracking-wider">Per Orang</div>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center backdrop-blur-sm min-w-[110px]">
                        <div class="text-base font-black text-amber-400">Sab & Min</div>
                        <div class="text-[10px] text-slate-400 mt-1 font-semibold uppercase tracking-wider">Hari Tersedia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="max-w-5xl mx-auto px-6 py-10 animate-fade-in">

        {{-- ===== ALERTS ===== --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200/60 text-emerald-800 rounded-2xl flex items-start gap-3 shadow-sm text-sm">
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
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-2xl flex items-start gap-3 shadow-sm text-sm">
                <div class="w-8 h-8 shrink-0 bg-rose-100 rounded-full flex items-center justify-center mt-0.5">
                    <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-rose-900">Gagal</p>
                    <p class="mt-0.5 text-rose-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200/60 text-rose-800 rounded-2xl shadow-sm text-sm">
                <p class="font-bold mb-2">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside space-y-0.5 text-rose-700 text-xs pl-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

            {{-- ===== FORM BOOKING ===== --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
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

                            {{-- Tanggal --}}
                            <div class="mb-5">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" id="input-tanggal"
                                    value="{{ old('tanggal_kunjungan') }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all cursor-pointer" required>
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

                            {{-- Total --}}
                            <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 rounded-2xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs text-emerald-600 font-semibold uppercase tracking-wider">Total Biaya</p>
                                        <p id="label-total" class="text-2xl font-extrabold text-slate-800 mt-0.5">Rp 125.000</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-slate-400">Rp 125.000 × <span id="label-jumlah">1</span> orang</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Peserta Container --}}
                            <div id="peserta-container" class="mb-5 space-y-3 max-h-80 overflow-y-auto pr-1"></div>

                            {{-- Submit --}}
                            <button type="submit" id="btn-submit"
                                class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-2xl transition-all duration-200 shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 text-sm disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span id="btn-submit-text">Konfirmasi &amp; Pesan Sekarang</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ===== RIWAYAT BOOKING ===== --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-slate-800">Riwayat Perjalanan Saya</h2>
                                <p class="text-xs text-slate-400 mt-0.5">Semua booking yang pernah dibuat</p>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                            {{ $myBookings->count() }} Transaksi
                        </span>
                    </div>

                    @forelse($myBookings as $booking)
                        @php
                            $status = strtolower($booking->status_booking);
                            $statusColor = match(true) {
                                in_array($status, ['dibayar', 'lunas', 'success', 'settlement']) => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500', 'label' => 'Lunas'],
                                in_array($status, ['pending', 'menunggu']) => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-100', 'dot' => 'bg-amber-500', 'label' => 'Menunggu'],
                                in_array($status, ['terkonfirmasi', 'confirmed']) => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-100', 'dot' => 'bg-blue-500', 'label' => 'Terkonfirmasi'],
                                in_array($status, ['batal', 'cancel', 'failed']) => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-100', 'dot' => 'bg-rose-500', 'label' => 'Dibatalkan'],
                                default => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'dot' => 'bg-slate-400', 'label' => ucfirst($booking->status_booking)],
                            };
                            $isPending = in_array($status, ['pending', 'menunggu']);
                        @endphp
                        <div class="p-5 border-b border-slate-50 last:border-0 hover:bg-slate-50/60 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4">

                                {{-- Date Box --}}
                                <div class="shrink-0 bg-gradient-to-b from-slate-800 to-slate-900 text-white rounded-2xl w-16 h-16 flex flex-col items-center justify-center shadow-sm">
                                    <span class="text-2xl font-black leading-none">{{ $booking->tanggal_kunjungan->format('d') }}</span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mt-0.5">{{ $booking->tanggal_kunjungan->format('M Y') }}</span>
                                </div>

                                {{-- Info --}}
                                <div class="flex-grow min-w-0">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="font-mono text-sm font-bold text-slate-800">{{ $booking->kode_booking }}</span>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase border {{ $statusColor['bg'] }} {{ $statusColor['text'] }} {{ $statusColor['border'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $statusColor['dot'] }}"></span>
                                            {{ $statusColor['label'] }}
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
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-bold text-emerald-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $booking->tanggal_booking->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>

                                    {{-- Peserta Collapsible --}}
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

                                {{-- Action Buttons --}}
                                @if($isPending)
                                    <div class="shrink-0">
                                        <a href="#" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl transition-colors shadow-sm shadow-emerald-600/20">
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
                            <h3 class="font-bold text-slate-500 text-sm">Belum ada riwayat perjalanan</h3>
                            <p class="text-xs text-slate-400 mt-1">Buat reservasi pertama Anda dan mulai petualangan!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const HARGA = 125000;
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
        let sisaKuota = 20;
        let isDateValid = false;

        function formatRupiah(n) { return 'Rp ' + n.toLocaleString('id-ID'); }

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
                card.className = 'p-4 bg-slate-50 border border-slate-100 rounded-2xl';
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
                                class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 outline-none text-slate-800 text-sm transition-all" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">No. HP <span class="text-slate-300 font-normal">(Opsional)</span></label>
                            <input type="tel" name="no_hp_peserta[]" placeholder="08xxxxxxxxxx"
                                class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 outline-none text-slate-800 text-sm transition-all">
                        </div>
                    </div>`;
                pesertaContainer.appendChild(card);
            }
        }

        function updateTotal() {
            const jumlah = parseInt(inputJumlah.value) || 1;
            labelTotal.textContent = formatRupiah(jumlah * HARGA);
            labelJumlah.textContent = jumlah;
            renderPeserta(jumlah);
            validateSubmit(jumlah);
        }

        function validateSubmit(jumlah) {
            jumlah = jumlah || parseInt(inputJumlah.value) || 1;
            if (!isDateValid) { setSubmitDisabled('Pilih Tanggal yang Valid'); return; }
            if (sisaKuota <= 0) { setSubmitDisabled('Kuota Penuh'); return; }
            if (jumlah > sisaKuota) { setSubmitDisabled(`Kuota Tidak Cukup (Sisa: ${sisaKuota})`); return; }
            setSubmitEnabled();
        }

        function setSubmitDisabled(msg) { btnSubmit.disabled = true; btnSubmitText.textContent = msg; }
        function setSubmitEnabled() { btnSubmit.disabled = false; btnSubmitText.innerHTML = 'Konfirmasi &amp; Pesan Sekarang'; }

        btnMinus.addEventListener('click', () => {
            const val = parseInt(inputJumlah.value) || 1;
            if (val > 1) { inputJumlah.value = val - 1; updateTotal(); }
        });
        btnPlus.addEventListener('click', () => {
            const val = parseInt(inputJumlah.value) || 1;
            if (val < 10) { inputJumlah.value = val + 1; updateTotal(); }
        });

        inputTanggal.addEventListener('change', function () {
            const dateStr = this.value;
            if (!dateStr) return;
            const [y, m, d] = dateStr.split('-').map(Number);
            const dow = new Date(y, m - 1, d).getDay();
            if (dow !== 0 && dow !== 6) {
                dateWarning.classList.remove('hidden');
                quotaInfo.classList.add('hidden');
                isDateValid = false; sisaKuota = 0; validateSubmit(); return;
            }
            dateWarning.classList.add('hidden');
            isDateValid = true;
            quotaInfo.classList.remove('hidden');
            quotaBadge.textContent = '...';
            fetch(`{{ route('booking.quota') }}?date=${dateStr}`)
                .then(r => r.json())
                .then(data => {
                    sisaKuota = data.remaining;
                    const pct = Math.round((data.filled / data.max_quota) * 100);
                    if (sisaKuota <= 0) {
                        quotaBadge.textContent = 'PENUH'; quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-700';
                        quotaBar.style.width = '100%'; quotaBar.className = 'h-1.5 rounded-full bg-rose-500 transition-all duration-500';
                        quotaText.textContent = `Semua ${data.max_quota} slot sudah terisi.`;
                    } else if (sisaKuota <= 5) {
                        quotaBadge.textContent = `${sisaKuota} tersisa`; quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-700';
                        quotaBar.style.width = pct + '%'; quotaBar.className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-500';
                        quotaText.textContent = `${data.filled} dari ${data.max_quota} slot — segera pesan!`;
                    } else {
                        quotaBadge.textContent = `${sisaKuota} tersisa`; quotaBadge.className = 'px-2.5 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-700';
                        quotaBar.style.width = pct + '%'; quotaBar.className = 'h-1.5 rounded-full bg-emerald-500 transition-all duration-500';
                        quotaText.textContent = `${data.filled} dari ${data.max_quota} slot terisi`;
                    }
                    validateSubmit();
                });
        });

        window.togglePeserta = function(id) {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('hidden');
        };

        setSubmitDisabled('Pilih Tanggal Dahulu');
        renderPeserta(parseInt(inputJumlah.value) || 1);
        updateTotal();
    });
    </script>
</body>
</html>
