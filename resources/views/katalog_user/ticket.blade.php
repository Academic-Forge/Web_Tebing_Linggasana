<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket {{ $booking->kode_booking }} - Tebing Linggasana</title>
    
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Outfit', 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        /* Ticket styling */
        .ticket-card {
            background-image: radial-gradient(circle at 0% 50%, transparent 12px, #ffffff 12px), 
                              radial-gradient(circle at 100% 50%, transparent 12px, #ffffff 12px);
            background-position: left, right;
            background-size: 50% 100%;
            background-repeat: no-repeat;
        }
        
        .ticket-divider {
            border-style: dashed;
            border-width: 1px 0 0 0;
            border-color: #e2e8f0;
            height: 0;
            width: 100%;
        }

        @media print {
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .print-shadow-none {
                box-shadow: none !important;
                border: 1px solid #e2e8f0 !important;
            }
            .ticket-card {
                background: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
            }
        }
    </style>
</head>
<body class="p-6 md:p-12 text-slate-800">

    <!-- Action Bar -->
    <div class="max-w-3xl mx-auto mb-8 flex justify-between items-center no-print">
        <a href="{{ route('booking.index') }}" class="flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-slate-900 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Kembali ke Riwayat Booking
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-emerald-500/10 cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.821l.105-.074.007-.005-.01.012-.102.067zm.924-3.15l-.01.012.007-.004-.105-.074.108.066zm-.008 3.16l-.01-.012.007.004-.105.074.108-.066zm.008-3.16l-.103-.067-.008.005.01-.012.101.074zm0 0L12 21l4.22-3.15m-8.44 0A9 9 0 013 12m18 0a9 9 0 01-5.78 8.41m0 0L12 21M12 3v18" />
            </svg>
            Cetak Tiket / Simpan PDF
        </button>
    </div>

    <!-- Ticket Wrapper Container -->
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-md border border-slate-100 overflow-hidden print-shadow-none">
        
        <!-- Header Brand Banner -->
        <div class="p-6 md:p-8 bg-gradient-to-r from-emerald-950 to-slate-900 text-white flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-emerald-500/20 rounded-xl text-emerald-400 border border-emerald-500/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-black tracking-wider uppercase">Tebing Linggasana</h1>
                    <p class="text-[10px] text-emerald-400 font-bold uppercase tracking-widest mt-0.5">E-Tiket Reservasi Resmi</p>
                </div>
            </div>
            <div class="text-center sm:text-right">
                <span class="px-3.5 py-1.5 bg-emerald-500 text-emerald-950 text-xs font-black rounded-full uppercase tracking-wider">
                    Lunas / Paid
                </span>
            </div>
        </div>

        <!-- Main Ticket Details (Boarding Pass Layout) -->
        <div class="ticket-card p-6 md:p-8 grid grid-cols-1 md:grid-cols-12 gap-8 items-center border-b border-slate-100">
            <!-- Left Info Details -->
            <div class="md:col-span-8 space-y-4 text-sm">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Pemesan</span>
                        <span class="font-bold text-slate-800 text-base">{{ $booking->user->nama_lengkap }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kontak HP</span>
                        <span class="font-bold text-slate-800 font-mono">{{ $booking->user->no_hp ?? '—' }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Kunjungan</span>
                        <span class="font-bold text-slate-800">{{ $booking->tanggal_kunjungan->translatedFormat('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Peserta</span>
                        <span class="font-bold text-slate-800">{{ $booking->jumlah_orang }} Orang</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pembayaran</span>
                        <span class="font-black text-emerald-700 text-base">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Booking</span>
                        <span class="text-slate-600">{{ $booking->tanggal_booking->translatedFormat('d M Y, H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            <!-- Right QR Code & Barcode Code Area -->
            <div class="md:col-span-4 flex flex-col items-center justify-center p-4 bg-slate-50 rounded-2xl border border-slate-100 text-center">
                <!-- Real scanned QR Code -->
                <div class="w-32 h-32 bg-white p-2 rounded-xl border border-slate-200 flex items-center justify-center shadow-inner">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $booking->kode_booking }}" alt="QR Code {{ $booking->kode_booking }}" class="w-full h-full object-contain">
                </div>
                <div class="mt-3">
                    <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest">Kode Booking</span>
                    <span class="font-extrabold text-slate-800 tracking-wider text-md font-mono">{{ $booking->kode_booking }}</span>
                </div>
            </div>
        </div>

        <!-- Ticket Dashed Divider -->
        <div class="ticket-divider"></div>

        <!-- Registered Participants Section -->
        <div class="p-6 md:p-8">
            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0112.002 20M15 19.128v.109a11.386 11.386 0 01-3 0m3 0a11.386 11.386 0 00-3-3m0 3.75V16.5m0 3v-.003c0-1.113-.285-2.16-.786-3.07m-.786 3.07A11.386 11.386 0 0012 21" />
                </svg>
                Daftar Peserta Wisata
            </h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-100">
                            <th class="py-3 px-4 font-bold uppercase tracking-wider w-16">No</th>
                            <th class="py-3 px-4 font-bold uppercase tracking-wider">Nama Peserta</th>
                            <th class="py-3 px-4 font-bold uppercase tracking-wider">No. HP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($booking->details as $index => $detail)
                            <tr>
                                <td class="py-3.5 px-4 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-3.5 px-4 font-semibold text-slate-800">{{ $detail->nama_peserta }}</td>
                                <td class="py-3.5 px-4 font-mono text-slate-600">{{ $detail->no_hp ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ticket Policy Notes Footer Section -->
        <div class="p-6 md:p-8 bg-slate-50 border-t border-slate-100 text-[11px] text-slate-500 leading-relaxed space-y-2">
            <h4 class="font-bold text-slate-700 uppercase tracking-wider text-[10px]">Ketentuan &amp; Tata Tertib Kunjungan:</h4>
            <ul class="list-disc list-inside space-y-1 pl-1">
                <li>Harap tunjukkan E-Tiket ini kepada petugas loket Tebing Linggasana saat kedatangan.</li>
                <li>E-Tiket ini berlaku sebagai tiket masuk resmi dan camping ground sesuai tanggal kunjungan.</li>
                <li>Pembeli wajib menunjukkan kartu identitas (KTP/SIM/Paspor) yang berlaku bila diminta oleh petugas.</li>
                <li>Jaga kebersihan lingkungan wisata, buang sampah pada tempatnya, dan patuhi aturan keselamatan panjat tebing.</li>
            </ul>
        </div>
    </div>
    
    <!-- Automatic Print Script -->
    <script>
        window.onload = function() {
            // Delay slightly to ensure fonts and layouts are fully loaded
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
