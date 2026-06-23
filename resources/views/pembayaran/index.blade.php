@extends('layouts.template')

@section('title', 'Monitor Pembayaran')

@section('content')
<div class="space-y-6 animate-fade-in">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Monitor Pembayaran</h1>
            <p class="text-xs text-slate-400 mt-1">Pantau dan sinkronkan transaksi Midtrans secara real-time.</p>
        </div>
        {{-- Sync All Button --}}
        <form method="POST" action="{{ route('admin.pembayaran.syncAll') }}"
              onsubmit="return confirmSyncAll(this)">
            @csrf
            <button type="submit" id="sync-all-btn"
                class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-br from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-bold rounded-xl shadow-md shadow-emerald-500/20 transition-all duration-200 active:scale-95 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                Sinkron Semua Pending
            </button>
        </form>
    </div>

    {{-- ===== STATS CARDS ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">

        {{-- Total Transaksi --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4 col-span-1">
            <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Total</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $stats['total'] }}</p>
            </div>
        </div>

        {{-- Pending --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4 col-span-1">
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

        {{-- Settlement --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4 col-span-1">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Berhasil</p>
                <p class="text-2xl font-extrabold text-emerald-600">{{ $stats['settlement'] }}</p>
            </div>
        </div>

        {{-- Gagal --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-4 col-span-1">
            <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Gagal/Batal</p>
                <p class="text-2xl font-extrabold text-rose-500">{{ $stats['gagal'] }}</p>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-md shadow-emerald-500/20 p-5 flex items-center gap-4 col-span-2 lg:col-span-1">
            <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-emerald-100 font-semibold uppercase tracking-wide">Total Revenue</p>
                <p class="text-lg font-extrabold text-white leading-tight">Rp{{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
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
            <span class="font-medium">{!! session('error') !!}</span>
        </div>
    @endif
    @if(session('info'))
        <div class="p-4 bg-blue-50 border border-blue-100 text-blue-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
            <svg class="w-5 h-5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            <span class="font-medium">{{ session('info') }}</span>
        </div>
    @endif

    {{-- ===== TABLE CARD ===== --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Card Header + Filters --}}
        <div class="p-6 border-b border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl flex items-center justify-center border border-emerald-100">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Riwayat Transaksi Midtrans</h2>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $pembayarans->total() }} transaksi ditemukan</p>
                    </div>
                </div>

                {{-- Search & Filter --}}
                <form method="GET" action="{{ route('admin.pembayaran.index') }}" class="flex flex-col sm:flex-row gap-2.5">
                    <div class="relative">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                            placeholder="Cari order ID atau nama..."
                            class="pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 focus:ring-3 focus:ring-emerald-500/10 outline-none text-sm text-slate-800 transition-all w-full sm:w-56">
                    </div>
                    <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-emerald-500 focus:ring-3 focus:ring-emerald-500/10 outline-none text-sm text-slate-800 transition-all cursor-pointer">
                        <option value="semua" {{ request('status', 'semua') === 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending"    {{ request('status') === 'pending'    ? 'selected' : '' }}>Pending</option>
                        <option value="settlement" {{ request('status') === 'settlement' ? 'selected' : '' }}>Settlement</option>
                        <option value="capture"    {{ request('status') === 'capture'    ? 'selected' : '' }}>Capture</option>
                        <option value="deny"       {{ request('status') === 'deny'       ? 'selected' : '' }}>Ditolak</option>
                        <option value="cancel"     {{ request('status') === 'cancel'     ? 'selected' : '' }}>Dibatalkan</option>
                        <option value="expire"     {{ request('status') === 'expire'     ? 'selected' : '' }}>Kedaluwarsa</option>
                    </select>
                    @if(request('search') || (request('status') && request('status') !== 'semua'))
                        <a href="{{ route('admin.pembayaran.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-xl text-sm font-medium transition-colors flex items-center gap-1.5">
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
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Nominal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($pembayarans as $bayar)
                        @php
                            $txStatus = strtolower($bayar->transaction_status ?? 'unknown');
                            $statusConfig = match(true) {
                                in_array($txStatus, ['settlement', 'capture']) =>
                                    ['label' => 'Settlement', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500'],
                                in_array($txStatus, ['pending', 'authorize']) =>
                                    ['label' => 'Pending',    'bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-100',   'dot' => 'bg-amber-500'],
                                in_array($txStatus, ['deny']) =>
                                    ['label' => 'Ditolak',   'bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-100',    'dot' => 'bg-rose-500'],
                                in_array($txStatus, ['cancel']) =>
                                    ['label' => 'Dibatalkan','bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-100',    'dot' => 'bg-rose-500'],
                                in_array($txStatus, ['expire']) =>
                                    ['label' => 'Kedaluwarsa','bg' => 'bg-slate-100', 'text' => 'text-slate-600',   'border' => 'border-slate-200',   'dot' => 'bg-slate-400'],
                                in_array($txStatus, ['failure']) =>
                                    ['label' => 'Gagal',     'bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-100',    'dot' => 'bg-rose-500'],
                                default =>
                                    ['label' => ucfirst($txStatus), 'bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'dot' => 'bg-slate-400'],
                            };
                            $paymentTypeLabel = match(strtolower($bayar->payment_type ?? '')) {
                                'credit_card'  => 'Kartu Kredit',
                                'bank_transfer' => 'Transfer Bank',
                                'echannel'     => 'Mandiri Bill',
                                'gopay'        => 'GoPay',
                                'shopeepay'    => 'ShopeePay',
                                'qris'         => 'QRIS',
                                'cstore'       => 'Minimarket',
                                'bca_klikpay'  => 'BCA KlikPay',
                                'danamon_online' => 'Danamon',
                                'akulaku'      => 'Akulaku',
                                ''             => '—',
                                default        => strtoupper($bayar->payment_type ?? 'SNAP'),
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/40 transition duration-150 group">

                            {{-- Waktu --}}
                            <td class="px-6 py-4">
                                @if($bayar->transaction_time)
                                    <div class="text-sm font-semibold text-slate-700">{{ $bayar->transaction_time->format('d M Y') }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">{{ $bayar->transaction_time->format('H:i') }}</div>
                                @elseif($bayar->created_at)
                                    <div class="text-sm font-semibold text-slate-700">{{ $bayar->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">{{ $bayar->created_at->format('H:i') }}</div>
                                @else
                                    <span class="text-slate-400 text-sm">—</span>
                                @endif
                            </td>

                            {{-- Order ID --}}
                            <td class="px-6 py-4">
                                <button onclick="openDetailModal('modal-detail-{{ $bayar->id_pembayaran }}')"
                                    class="text-sm font-mono font-bold text-emerald-600 hover:text-emerald-700 hover:underline underline-offset-2 transition cursor-pointer text-left">
                                    {{ $bayar->order_id }}
                                </button>
                                @if($bayar->booking)
                                    <div class="text-[10px] text-slate-400 mt-1 font-medium">
                                        Booking <span class="font-mono">{{ $bayar->booking->kode_booking }}</span>
                                    </div>
                                @endif
                            </td>

                            {{-- Customer --}}
                            <td class="px-6 py-4">
                                @if($bayar->booking && $bayar->booking->user)
                                    <div class="flex items-center gap-2.5">
                                        @php $u = $bayar->booking->user; @endphp
                                        @if($u->profile_image && $u->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . $u->profile_image)))
                                            <img src="{{ asset('img/' . $u->profile_image) }}" alt="" class="w-8 h-8 rounded-full object-cover border border-slate-100 shrink-0">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-700 font-bold uppercase text-xs shrink-0">
                                                {{ substr($u->nama_lengkap, 0, 2) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-semibold text-slate-800">{{ $u->nama_lengkap }}</div>
                                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $u->email }}</div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-slate-400 text-sm">—</span>
                                @endif
                            </td>

                            {{-- Nominal --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800 text-sm">Rp{{ number_format($bayar->gross_amount, 0, ',', '.') }}</span>
                                @if($bayar->booking)
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $bayar->booking->jumlah_orang }} orang</div>
                                @endif
                            </td>

                            {{-- Payment Type --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-bold bg-slate-100 text-slate-600 uppercase tracking-wide">
                                    {{ $paymentTypeLabel }}
                                </span>
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
                                <form method="POST" action="{{ route('admin.pembayaran.sync', $bayar->id_pembayaran) }}"
                                      onsubmit="return confirmSync('{{ $bayar->order_id }}', this)">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold border transition-all duration-200 cursor-pointer
                                            {{ in_array($txStatus, ['settlement', 'capture']) 
                                                ? 'bg-slate-50 border-slate-200 text-slate-400 hover:bg-slate-100 hover:text-slate-600' 
                                                : 'bg-gradient-to-br from-blue-50 to-indigo-50 border-blue-200 text-blue-700 hover:from-blue-100 hover:to-indigo-100 hover:border-blue-300 shadow-sm' 
                                            }}"
                                        title="Sinkronkan status dengan Midtrans">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                        Sinkron
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-slate-100 to-slate-50 rounded-3xl flex items-center justify-center border border-slate-100">
                                    <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-500">Tidak ada data pembayaran</p>
                                <p class="text-xs text-slate-400 mt-1">
                                    @if(request('search') || request('status'))
                                        Coba ubah filter pencarian.
                                    @else
                                        Belum ada transaksi yang masuk dari Midtrans.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($pembayarans->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $pembayarans->links() }}
            </div>
        @endif
    </div>

    {{-- ===== INFO MIDTRANS ===== --}}
    <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 rounded-2xl border border-slate-200/60 p-5">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-slate-700">Cara Kerja Sinkronisasi Midtrans</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Klik <strong class="text-slate-700">Sinkron</strong> pada baris tertentu untuk memeriksa status pembayaran terbaru langsung dari Midtrans API. 
                    Gunakan <strong class="text-slate-700">Sinkron Semua Pending</strong> untuk memperbarui semua transaksi berstatus <em>pending</em> sekaligus.
                    Status booking juga akan diperbarui secara otomatis mengikuti hasil sinkronisasi.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ===== DETAIL MODALS ===== --}}
@foreach($pembayarans as $bayar)
<div id="modal-detail-{{ $bayar->id_pembayaran }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeDetailModal('modal-detail-{{ $bayar->id_pembayaran }}')"></div>
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full overflow-hidden z-10 transition-all duration-300 transform scale-95 opacity-0"
             id="modal-card-{{ $bayar->id_pembayaran }}">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Detail Transaksi</h3>
                    <p class="text-xs text-slate-400 mt-0.5 font-mono">{{ $bayar->order_id }}</p>
                </div>
                <button onclick="closeDetailModal('modal-detail-{{ $bayar->id_pembayaran }}')"
                    class="p-1.5 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Detail Body --}}
            <div class="p-6 space-y-4">

                {{-- Status Banner --}}
                @php
                    $txS = strtolower($bayar->transaction_status ?? 'unknown');
                    $bannerConfig = match(true) {
                        in_array($txS, ['settlement','capture']) => ['bg'=>'bg-emerald-50','text'=>'text-emerald-700','border'=>'border-emerald-100','label'=>'Settlement / Berhasil'],
                        in_array($txS, ['pending','authorize'])  => ['bg'=>'bg-amber-50',  'text'=>'text-amber-700',  'border'=>'border-amber-100',  'label'=>'Pending'],
                        in_array($txS, ['deny'])                 => ['bg'=>'bg-rose-50',   'text'=>'text-rose-700',   'border'=>'border-rose-100',   'label'=>'Ditolak'],
                        in_array($txS, ['cancel'])               => ['bg'=>'bg-rose-50',   'text'=>'text-rose-700',   'border'=>'border-rose-100',   'label'=>'Dibatalkan'],
                        in_array($txS, ['expire'])               => ['bg'=>'bg-slate-100', 'text'=>'text-slate-600',  'border'=>'border-slate-200',  'label'=>'Kedaluwarsa'],
                        default                                  => ['bg'=>'bg-slate-100', 'text'=>'text-slate-600',  'border'=>'border-slate-200',  'label'=>ucfirst($txS)],
                    };
                @endphp
                <div class="px-4 py-3 rounded-xl border {{ $bannerConfig['bg'] }} {{ $bannerConfig['border'] }} flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider {{ $bannerConfig['text'] }}">{{ $bannerConfig['label'] }}</span>
                    <span class="text-xs font-mono text-slate-500">{{ $bayar->transaction_id ?? '-' }}</span>
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-slate-400 font-semibold uppercase tracking-wider">Nominal</p>
                        <p class="font-extrabold text-slate-800 text-base mt-0.5">Rp{{ number_format($bayar->gross_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-slate-400 font-semibold uppercase tracking-wider">Metode</p>
                        <p class="font-bold text-slate-800 mt-0.5 uppercase">{{ $bayar->payment_type ?? '—' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-slate-400 font-semibold uppercase tracking-wider">Waktu Transaksi</p>
                        <p class="font-bold text-slate-800 mt-0.5">{{ $bayar->transaction_time ? $bayar->transaction_time->format('d M Y H:i') : '—' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-slate-400 font-semibold uppercase tracking-wider">Snap Token</p>
                        <p class="font-mono text-slate-600 mt-0.5 text-[10px] break-all">{{ $bayar->snap_token ? substr($bayar->snap_token, 0, 20) . '...' : '—' }}</p>
                    </div>
                </div>

                @if($bayar->booking && $bayar->booking->user)
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-2">Info Booking</p>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-700 font-bold uppercase text-sm shrink-0">
                            {{ substr($bayar->booking->user->nama_lengkap, 0, 2) }}
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $bayar->booking->user->nama_lengkap }}</p>
                            <p class="text-[10px] text-slate-400 truncate">{{ $bayar->booking->user->email }}</p>
                        </div>
                        <span class="text-[10px] font-mono font-bold bg-slate-200 text-slate-600 px-2 py-1 rounded-lg shrink-0">{{ $bayar->booking->kode_booking }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-3 text-xs">
                        <div>
                            <span class="text-slate-400">Tgl Kunjungan:</span>
                            <span class="font-semibold text-slate-700 ml-1">{{ $bayar->booking->tanggal_kunjungan->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400">Peserta:</span>
                            <span class="font-semibold text-slate-700 ml-1">{{ $bayar->booking->jumlah_orang }} orang</span>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Sync action from modal --}}
                <form method="POST" action="{{ route('admin.pembayaran.sync', $bayar->id_pembayaran) }}"
                      onsubmit="return confirmSync('{{ $bayar->order_id }}', this)">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-bold bg-gradient-to-br from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white shadow-md shadow-blue-500/20 transition-all duration-200 active:scale-95 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Sinkronkan ke Midtrans
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
    // ===== MODAL HELPERS =====
    function openDetailModal(id) {
        const modal = document.getElementById(id);
        const cardId = id.replace('modal-detail-', 'modal-card-');
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
        const cardId = id.replace('modal-detail-', 'modal-card-');
        const card = document.getElementById(cardId);
        if (modal && card) {
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 250);
        }
    }

    // ===== CONFIRM SYNC =====
    function confirmSync(orderId, form) {
        const btn = form.querySelector('button[type="submit"]');
        if (confirm(`Sinkronkan status transaksi "${orderId}" dari Midtrans?\n\nStatus booking juga akan diperbarui otomatis.`)) {
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `
                    <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Menyinkronkan...`;
            }
            return true;
        }
        return false;
    }

    function confirmSyncAll(form) {
        const btn = document.getElementById('sync-all-btn');
        if (confirm('Sinkronkan SEMUA transaksi berstatus Pending dari Midtrans?\n\nProses ini bisa memakan beberapa saat.')) {
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `
                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Menyinkronkan...`;
            }
            return true;
        }
        return false;
    }

    // ===== AUTO SEARCH =====
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            if (searchInput.value) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }

            let debounceTimer;
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => this.form.submit(), 500);
            });
        }
    });
</script>
@endpush
