<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kenangan - Tebing Linggasana</title>
    <meta name="description" content="Kumpulan momen indah dan kenangan petualangan di Wisata Tebing Linggasana, Kuningan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', 'Inter', sans-serif; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease both; }

        /* Masonry grid */
        .photo-grid {
            columns: 1;
            column-gap: 1rem;
        }
        @media (min-width: 640px) { .photo-grid { columns: 2; } }
        @media (min-width: 1024px) { .photo-grid { columns: 3; } }

        .photo-card {
            break-inside: avoid;
            margin-bottom: 1rem;
        }

        /* Lightbox */
        #lightbox {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(2, 6, 23, 0.96);
            backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
        }
        #lightbox.active { display: flex; }
        #lightbox img {
            max-width: 90vw;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 1rem;
            box-shadow: 0 0 80px rgba(0,0,0,0.5);
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 antialiased">

    {{-- ===== NAVBAR ===== --}}
    @include('katalog_user.partials.navbar')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative overflow-hidden pt-24 pb-12 px-6 bg-gradient-to-br from-emerald-800 via-teal-900 to-slate-900">
        <div class="absolute inset-0 bg-[url('/img/tebing-2.jpeg')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
        <div class="absolute -top-24 -right-20 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 -left-20 w-80 h-80 bg-teal-500/10 rounded-full blur-2xl"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center text-white animate-fade-in">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest mb-5 backdrop-blur-sm">
                <svg class="w-4 h-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316A2.192 2.192 0 0014.502 4h-5c-.75 0-1.437.383-1.837 1.014l-.838 1.161z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Arsip Visual
            </div>
            <h1 class="text-4xl md:text-5xl font-black tracking-tight">
                📸 Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-300">Kenangan</span>
            </h1>
            <p class="text-slate-300 text-sm md:text-base mt-4 max-w-lg mx-auto leading-relaxed">
                Kumpulan momen indah petualangan di Tebing Linggasana.<br>Setiap foto menyimpan cerita dan keberanian yang tak terlupakan.
            </p>

            {{-- Stats --}}
            <div class="mt-8 flex items-center justify-center gap-6">
                <div class="text-center">
                    <div class="text-3xl font-black text-emerald-300">{{ $photos->total() }}</div>
                    <div class="text-xs text-slate-400 mt-0.5">Total Foto</div>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div class="text-center">
                    <div class="text-3xl font-black text-teal-300">{{ $photos->lastPage() }}</div>
                    <div class="text-xs text-slate-400 mt-0.5">Halaman</div>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div class="text-center">
                    <div class="text-3xl font-black text-amber-300">∞</div>
                    <div class="text-xs text-slate-400 mt-0.5">Kenangan</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== GALLERY GRID ===== --}}
    <main class="max-w-6xl mx-auto px-6 py-12 animate-fade-in">

        @if($photos->isEmpty())
            <div class="py-24 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-white rounded-3xl flex items-center justify-center shadow-sm">
                    <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-600">Galeri masih kosong</h3>
                <p class="text-sm text-slate-400 mt-2">Belum ada foto yang diunggah oleh pengelola wisata.</p>
                <a href="{{ route('katalog.index') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-500 transition-colors shadow-lg shadow-emerald-600/20">
                    ← Kembali ke Beranda
                </a>
            </div>
        @else
            <div class="photo-grid">
                @foreach($photos as $photo)
                    <div class="photo-card">
                        <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:border-slate-200 transition-all duration-300">
                            <div class="overflow-hidden cursor-pointer"
                                 onclick="openLightbox('{{ asset('img/dokumentasi/' . $photo->file_foto) }}', '{{ addslashes($photo->keterangan ?? '') }}', '{{ $photo->file_foto }}')">
                                <img src="{{ asset('img/dokumentasi/' . $photo->file_foto) }}"
                                     alt="{{ $photo->keterangan ?? 'Foto Dokumentasi' }}"
                                     class="w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     loading="lazy">
                            </div>
                            {{-- Overlay on hover --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            </div>
                            {{-- Action bar at bottom --}}
                            <div class="absolute bottom-0 left-0 right-0 p-3 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 flex items-end justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    @if($photo->keterangan)
                                        <p class="text-white text-xs font-semibold leading-snug line-clamp-1">{{ $photo->keterangan }}</p>
                                    @endif
                                    <p class="text-slate-400 text-[10px] mt-0.5">{{ \Carbon\Carbon::parse($photo->tanggal_upload)->translatedFormat('d M Y') }}</p>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    {{-- Preview --}}
                                    <button
                                        onclick="openLightbox('{{ asset('img/dokumentasi/' . $photo->file_foto) }}', '{{ addslashes($photo->keterangan ?? '') }}', '{{ $photo->file_foto }}')"
                                        class="w-8 h-8 bg-white/15 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center transition-colors"
                                        title="Lihat Foto">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                        </svg>
                                    </button>
                                    {{-- Download --}}
                                    <button
                                        onclick="downloadPhoto('{{ asset('img/dokumentasi/' . $photo->file_foto) }}', '{{ $photo->file_foto }}')"
                                        class="w-8 h-8 bg-emerald-500/80 hover:bg-emerald-500 backdrop-blur-sm rounded-full flex items-center justify-center transition-colors"
                                        title="Download Foto">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($photos->hasPages())
                <div class="mt-10 flex justify-center">
                    <div class="inline-flex items-center gap-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-2">
                        @if($photos->onFirstPage())
                            <span class="px-4 py-2 text-slate-300 text-sm font-semibold">← Prev</span>
                        @else
                            <a href="{{ $photos->previousPageUrl() }}" class="px-4 py-2 text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl text-sm font-semibold transition-colors">← Prev</a>
                        @endif

                        @foreach($photos->getUrlRange(1, $photos->lastPage()) as $page => $url)
                            @if($page == $photos->currentPage())
                                <span class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-bold">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl text-sm font-semibold transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($photos->hasMorePages())
                            <a href="{{ $photos->nextPageUrl() }}" class="px-4 py-2 text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl text-sm font-semibold transition-colors">Next →</a>
                        @else
                            <span class="px-4 py-2 text-slate-300 text-sm font-semibold">Next →</span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </main>

    {{-- ===== LIGHTBOX ===== --}}
    <div id="lightbox" role="dialog" aria-modal="true" aria-label="Preview foto">
        {{-- Close button --}}
        <button onclick="closeLightbox()" class="absolute top-5 right-5 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10" title="Tutup">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        {{-- Download button in lightbox --}}
        <button id="lightbox-download-btn" onclick="downloadPhoto(currentLightboxSrc, currentLightboxFilename)"
            class="absolute top-5 left-5 flex items-center gap-2 px-4 py-2 bg-emerald-600/80 hover:bg-emerald-600 backdrop-blur-sm rounded-full text-white text-xs font-bold transition-all z-10"
            title="Download Foto">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            Download Foto
        </button>
        <div class="flex flex-col items-center gap-4 max-w-5xl mx-auto px-4">
            <img id="lightbox-img" src="" alt="Preview">
            <p id="lightbox-caption" class="text-slate-300 text-sm text-center max-w-xl"></p>
        </div>
    </div>

    <script>
    let currentLightboxSrc = '';
    let currentLightboxFilename = '';

    function openLightbox(src, caption, filename) {
        currentLightboxSrc = src;
        currentLightboxFilename = filename || 'foto-linggasana.jpg';
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').textContent = caption || '';
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
        currentLightboxSrc = '';
        currentLightboxFilename = '';
    }

    function downloadPhoto(src, filename) {
        if (!src) return;
        const btn = event ? event.currentTarget : null;
        if (btn) {
            const originalContent = btn.innerHTML;
            btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Mengunduh...`;
            fetch(src)
                .then(res => res.blob())
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename || 'foto-linggasana.jpg';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                    btn.innerHTML = originalContent;
                })
                .catch(() => {
                    // fallback: open in new tab
                    window.open(src, '_blank');
                    btn.innerHTML = originalContent;
                });
        } else {
            fetch(src)
                .then(res => res.blob())
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename || 'foto-linggasana.jpg';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                })
                .catch(() => window.open(src, '_blank'));
        }
    }

    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
    </script>
</body>
</html>
