@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-900 to-slate-800 p-8 rounded-3xl text-white shadow-lg relative overflow-hidden border border-slate-700/50">
        <div class="absolute inset-0 bg-cover bg-center opacity-10 mix-blend-overlay" style="background-image: url('{{ asset('img/tebing_linggasana_auth.png') }}')"></div>
        <div class="relative z-10">
            <span class="px-3 py-1 bg-emerald-500/20 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider border border-emerald-500/30 text-emerald-400">Ikhtisar Panel</span>
            <h1 class="text-3xl font-extrabold tracking-tight mt-2">Selamat Datang, {{ Auth::user()->nama_lengkap }}!</h1>
            <p class="text-slate-300 text-sm mt-1">Berikut adalah ringkasan performa dan aktivitas Tebing Linggasana saat ini.</p>
        </div>
        <div class="relative z-10 flex gap-3">
            <a href="{{ url('/admin/kuota') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition duration-200 shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75" />
                </svg>
                Atur Kuota
            </a>
            <a href="{{ url('/admin/booking') }}" class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-xs font-bold transition duration-200 border border-slate-600 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18" />
                </svg>
                Daftar Booking
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Bookings -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Reservasi</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $totalBookings }}</h3>
                <p class="text-xs text-slate-500">Semua riwayat booking</p>
            </div>
            <div class="p-4 bg-indigo-50 text-indigo-600 rounded-2xl border border-indigo-100 shadow-inner">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
            </div>
        </div>

        <!-- Card 2: Total Earnings -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                <h3 class="text-3xl font-extrabold text-slate-800">Rp{{ number_format($totalEarnings, 0, ',', '.') }}</h3>
                <p class="text-xs text-emerald-600 font-medium">Pembayaran sukses</p>
            </div>
            <div class="p-4 bg-emerald-50 text-emerald-650 rounded-2xl border border-emerald-100 shadow-inner">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879-.659c1.546-1.16 3.018-1.502 4.475-.752m0 0l.88.66a4.5 4.5 0 01-1.28 7.377m0-7.377v-.008m0 0H9.75M12 6h.008v.008H12V6z" />
                </svg>
            </div>
        </div>

        <!-- Card 3: Total Users -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pengguna</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $totalUsers }}</h3>
                <p class="text-xs text-slate-500">Terdaftar di sistem</p>
            </div>
            <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl border border-blue-100 shadow-inner">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07" />
                </svg>
            </div>
        </div>

        <!-- Card 4: Sisa Kuota Hari Ini -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Sisa Kuota Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-slate-800">{{ $remainingQuota }}</h3>
                    <p class="text-xs text-slate-500">Maks: {{ $maxQuota }} orang</p>
                </div>
                <div class="p-4 bg-amber-50 text-amber-600 rounded-2xl border border-amber-100 shadow-inner">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <!-- Progress Bar -->
            <div class="w-full bg-slate-100 rounded-full h-2 mt-4 overflow-hidden">
                @php
                    $percentage = $maxQuota > 0 ? min(100, ($maxQuota - $remainingQuota) / $maxQuota * 100) : 0;
                    $barColor = 'bg-emerald-500';
                    if ($percentage > 85) $barColor = 'bg-rose-500';
                    elseif ($percentage > 60) $barColor = 'bg-amber-500';
                @endphp
                <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
            </div>
        </div>
    </div>

    <!-- Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <!-- Left: Recent Bookings -->
        <div class="lg:col-span-3 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Booking Terbaru</h2>
                        <p class="text-xs text-slate-400 mt-0.5">5 transaksi reservasi paling akhir</p>
                    </div>
                    <a href="{{ url('/admin/booking') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Lihat Semua &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Pengunjung</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Peserta</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Kunjungan</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentBookings as $booking)
                                <tr class="hover:bg-slate-50/50 transition duration-150">
                                    <td class="px-6 py-4 font-mono text-xs font-bold text-slate-700">{{ $booking->kode_booking }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-slate-800">{{ $booking->nama_lengkap }}</div>
                                        <div class="text-xs text-slate-400 mt-0.5">{{ $booking->no_hp }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-sm text-slate-700">{{ $booking->jumlah_orang }} org</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                                        {{ date('d M Y', strtotime($booking->tanggal_kunjungan)) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $status = strtolower($booking->status_booking);
                                            $badgeClass = 'bg-slate-100 text-slate-500';
                                            if (in_array($status, ['lunas', 'success', 'settlement', 'dibayar'])) {
                                                $badgeClass = 'bg-emerald-50 text-emerald-705 border border-emerald-100/80';
                                            } elseif (in_array($status, ['pending', 'menunggu'])) {
                                                $badgeClass = 'bg-amber-50 text-amber-705 border border-amber-100/80';
                                            } elseif (in_array($status, ['batal', 'cancel', 'failed'])) {
                                                $badgeClass = 'bg-rose-50 text-rose-705 border border-rose-100/80';
                                            }
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $badgeClass }}">
                                            {{ $booking->status_booking }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">
                                        Belum ada riwayat booking saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Weekly Quota -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Kuota Mingguan</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Status keterisian slot per tanggal</p>
                    </div>
                    <a href="{{ url('/admin/kuota') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Kelola &rarr;</a>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($weeklyQuota as $quota)
                        @php
                            $dateStr = date('d M Y', strtotime($quota->tanggal));
                            $dayName = date('D', strtotime($quota->tanggal));
                            $daysIndo = ['Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu'];
                            $dayNameIndo = $daysIndo[$dayName] ?? $dayName;
                            
                            $filled = $quota->kuota_terisi;
                            $max = $quota->kuota_maks ?? 50;
                            $percent = $max > 0 ? min(100, ($filled / $max) * 100) : 0;
                            
                            $badgeColor = 'bg-emerald-50 text-emerald-705 border border-emerald-100/80';
                            if ($percent >= 100) {
                                $badgeColor = 'bg-rose-50 text-rose-705 border border-rose-100/80';
                            } elseif ($percent > 70) {
                                $badgeColor = 'bg-amber-50 text-amber-705 border border-amber-100/80';
                            }
                        @endphp
                        <div class="flex flex-col space-y-1.5 p-3 rounded-2xl bg-slate-50/50 hover:bg-slate-50 border border-slate-100/50 transition duration-150">
                            <div class="flex items-center justify-between text-xs">
                                <div>
                                    <span class="font-bold text-slate-800">{{ $dayNameIndo }}</span>, 
                                    <span class="text-slate-500">{{ $dateStr }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold uppercase {{ $badgeColor }}">
                                    @if($percent >= 100)
                                        Penuh
                                    @else
                                        {{ $filled }} / {{ $max }} Org
                                    @endif
                                </span>
                            </div>
                            <!-- Mini Progress Bar -->
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-sm text-slate-400">
                            Belum ada data kuota kunjungan untuk minggu ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
