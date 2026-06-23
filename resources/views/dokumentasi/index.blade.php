@extends('layouts.template')

@section('title', 'Manajemen Galeri Foto')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2.5">
                <div class="p-2 bg-emerald-500/10 rounded-2xl text-emerald-600 border border-emerald-500/20 shadow-inner">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                Manajemen Galeri Foto
            </h1>
            <p class="text-xs text-slate-400 mt-1">Total <span class="font-bold text-slate-700">{{ $totalPhotos }}</span> foto tersimpan di galeri.</p>
        </div>
    </div>

    <!-- Session Alerts -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-150/40 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
    
    @if(session('error'))
        <div class="p-4 bg-rose-50 border border-rose-150/40 text-rose-800 rounded-2xl flex items-center gap-3 shadow-sm text-sm">
            <svg class="w-5 h-5 shrink-0 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-150/40 text-rose-800 rounded-2xl space-y-1 shadow-sm text-sm">
            <div class="font-bold flex items-center gap-2 text-rose-850">
                <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                Terjadi kesalahan input data:
            </div>
            <ul class="list-disc list-inside text-xs text-rose-700/90 pl-1 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column: Upload Form -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100/80">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-50 pb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5h10.5a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0017.25 4.5H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    Upload Foto Galeri
                </h3>

                <form action="{{ route('admin.dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                    @csrf
                    
                    <!-- Drag & Drop Zone -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">File Foto</label>
                        <div class="relative group border-2 border-dashed border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/5 rounded-2xl p-6 transition-all cursor-pointer flex flex-col items-center justify-center text-center" 
                             onclick="document.getElementById('file_foto_input').click()">
                            <svg class="w-12 h-12 text-slate-450 group-hover:text-emerald-600 transition-colors mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M22.5 12a9.5 9.5 0 11-19 0 9.5 9.5 0 0119 0z" />
                            </svg>
                            <span class="text-sm font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">Seret & Lepas Foto di Sini</span>
                            <span class="text-xs text-slate-400 mt-1">atau klik area ini untuk memilih foto</span>
                            <span class="text-[10px] text-slate-400/80 font-medium mt-2.5 bg-slate-50 px-2.5 py-0.5 rounded-full border border-slate-100 group-hover:border-emerald-100 transition-all">JPG, PNG, WEBP — Banyak foto sekaligus</span>
                            <input type="file" name="file_foto[]" id="file_foto_input" class="hidden" accept="image/*" multiple onchange="handleFileSelect(this)">
                        </div>
                        
                        <!-- Preview Container -->
                        <div id="image-preview-container" class="grid grid-cols-4 gap-2 mt-3 hidden">
                            <!-- JS Previews will be injected here -->
                        </div>
                    </div>

                    <!-- Keterangan (Opsional) -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Keterangan (Opsional)</label>
                        <textarea name="keterangan" rows="3" placeholder="Mis: Kegiatan hiking, 3 Mei 2026..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm resize-none"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 mt-6 border-t border-slate-50">
                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-2xl transition duration-150 text-xs shadow-md shadow-emerald-500/10 cursor-pointer flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            Upload Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Gallery List -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100/80">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-50 pb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25z" />
                    </svg>
                    Semua Foto Galeri
                </h3>

                @if($photos->isEmpty())
                    <!-- Empty State -->
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <div class="p-4 bg-slate-50 rounded-full border border-slate-100 text-slate-400 mb-4">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Galeri Foto Kosong</h4>
                        <p class="text-xs text-slate-400 mt-1 max-w-sm">Belum ada foto dokumentasi yang diunggah. Silakan gunakan panel di sebelah kiri untuk mengunggah foto baru.</p>
                    </div>
                @else
                    <!-- Photo Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                        @foreach($photos as $photo)
                            <div class="group relative bg-slate-50 rounded-2xl border border-slate-100/80 overflow-hidden flex flex-col hover:shadow-md hover:border-slate-200 transition-all duration-300">
                                <!-- Photo Container -->
                                <div class="relative aspect-[4/3] overflow-hidden bg-slate-900 flex items-center justify-center">
                                    <img src="{{ asset('img/dokumentasi/' . $photo->file_foto) }}" alt="{{ $photo->keterangan ?? 'Foto Galeri' }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    
                                    <!-- Hover Delete Overlay -->
                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <button type="button" onclick="confirmDelete('{{ $photo->id_foto }}')" 
                                                class="p-2.5 bg-rose-600 hover:bg-rose-500 text-white rounded-xl shadow-lg transition-transform transform scale-90 group-hover:scale-100 cursor-pointer">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Meta & Description -->
                                <div class="p-4 flex flex-col justify-between flex-grow">
                                    <p class="text-xs text-slate-700 font-semibold line-clamp-2 min-h-[2.5rem]">
                                        {{ $photo->keterangan ?? 'Tanpa keterangan' }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-medium mt-3 flex items-center gap-1.5 border-t border-slate-100 pt-3">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75" />
                                        </svg>
                                        {{ $photo->tanggal_upload->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 border-t border-slate-100 pt-6">
                        {{ $photos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
    
    <!-- Modal Container -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-100 animate-scale-up">
            <div class="bg-white p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 sm:mx-0 border border-rose-100 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-base font-bold text-slate-800">Hapus Foto Galeri</h3>
                        <div class="mt-2">
                            <p class="text-xs text-slate-450 leading-relaxed">Apakah Anda yakin ingin menghapus foto ini? Gambar akan dihapus secara permanen dari server dan tidak dapat dikembalikan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-slate-100">
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2.5 bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold rounded-xl transition cursor-pointer shadow-md shadow-rose-500/10">Hapus Permanen</button>
                </form>
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2.5 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // File select handling and previews
    function handleFileSelect(input) {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            previewContainer.classList.remove('hidden');
            
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'relative aspect-square rounded-xl overflow-hidden bg-slate-100 border border-slate-250/20 shadow-sm';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';
                    
                    imgWrapper.appendChild(img);
                    previewContainer.appendChild(imgWrapper);
                }
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // Drag and Drop Zone styling helper
    const dropzone = document.querySelector('.border-dashed');
    if (dropzone) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropzone.classList.add('border-emerald-500', 'bg-emerald-50/5');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-emerald-500', 'bg-emerald-50/5');
            }, false);
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            const fileInput = document.getElementById('file_foto_input');
            
            if (fileInput && files.length > 0) {
                fileInput.files = files;
                handleFileSelect(fileInput);
            }
        });
    }

    // Modal delete variables and functions
    const modal = document.getElementById('delete-modal');
    const deleteForm = document.getElementById('delete-form');

    function confirmDelete(id) {
        if (modal && deleteForm) {
            deleteForm.action = `{{ url('/admin/dokumentasi') }}/${id}`;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Disable scroll background
        }
    }

    function closeDeleteModal() {
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Re-enable scroll background
        }
    }

    // Close modal on click outside content
    window.addEventListener('click', function(e) {
        if (modal && e.target === modal) {
            closeDeleteModal();
        }
    });
</script>
@endpush
