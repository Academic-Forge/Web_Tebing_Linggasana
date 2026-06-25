@extends('layouts.template')

@section('title', 'Profil Saya')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Profil Saya</h1>
        <p class="text-xs text-slate-400 mt-1">Kelola data diri, ganti foto profil, dan perbarui kata sandi akun Anda.</p>
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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Left Column: Photo Card -->
        <div class="md:col-span-1 space-y-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100/80 flex flex-col items-center text-center">
                <form action="{{ route('admin.setting.photo') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col items-center">
                    @csrf
                    <!-- Circular Photo -->
                    <div class="relative group cursor-pointer" onclick="document.getElementById('profile_image_input').click()">
                        @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                            <img id="profile-preview" src="{{ asset('img/' . Auth::user()->profile_image) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover shadow-inner border-4 border-slate-100 group-hover:opacity-85 transition-opacity">
                        @else
                            <div id="profile-initials-preview" class="w-32 h-32 rounded-full bg-emerald-50 border-4 border-emerald-100 flex items-center justify-center text-emerald-700 font-extrabold uppercase text-3xl shadow-inner group-hover:opacity-85 transition-opacity">
                                {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                            </div>
                            <img id="profile-preview" src="" alt="Avatar" class="w-32 h-32 rounded-full object-cover shadow-inner border-4 border-slate-100 group-hover:opacity-85 transition-opacity hidden">
                        @endif
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-slate-900/40 rounded-full flex items-center justify-center text-white text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity">
                            Pilih Foto
                        </div>
                    </div>
                    <input type="file" name="profile_image" id="profile_image_input" class="hidden" accept="image/*" onchange="previewImage(this)">

                    <h3 class="text-base font-bold text-slate-800 mt-4 truncate max-w-full">{{ Auth::user()->nama_lengkap }}</h3>
                    <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider mt-0.5">{{ Auth::user()->role }}</p>
                    <p class="text-xs text-slate-400 mt-2 truncate max-w-full">{{ Auth::user()->email }}</p>

                    <div class="w-full mt-6 pt-6 border-t border-slate-100 flex flex-col gap-2">
                        <button type="submit" id="save-photo-btn" class="w-full py-2.5 bg-slate-850 hover:bg-slate-800 text-white bg-slate-900 rounded-xl text-xs font-bold transition duration-150 cursor-not-allowed opacity-50" disabled>
                            Simpan Foto Baru
                        </button>
                        <p class="text-[10px] text-slate-400">Klik lingkaran foto untuk memilih file gambar (PNG, JPG, WEBP maks 2MB).</p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Profile Info & Password Cards -->
        <div class="md:col-span-2 space-y-8">
            <!-- Card 1: Profile Info -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100/80">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-50 pb-4">Informasi Profil</h3>
                <form action="{{ route('admin.setting.profile') }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->nama_lengkap) }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nomor HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-50 mt-6">
                        <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-2xl transition duration-150 text-xs shadow-md shadow-emerald-500/10 cursor-pointer">
                            Perbarui Profil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Card 2: Password Card -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100/80" id="change-password">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-50 pb-4">Ganti Kata Sandi</h3>
                <form action="{{ route('admin.setting.password') }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" required placeholder="Masukkan kata sandi saat ini"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                                <input type="password" name="new_password" required placeholder="Minimal 8 karakter"
                                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="new_password_confirmation" required placeholder="Ulangi kata sandi baru"
                                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-50 mt-6">
                        <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-2xl transition duration-150 text-xs shadow-md shadow-emerald-500/10 cursor-pointer">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgPreview = document.getElementById('profile-preview');
                const initialsPreview = document.getElementById('profile-initials-preview');
                
                if (imgPreview) {
                    imgPreview.src = e.target.result;
                    imgPreview.classList.remove('hidden');
                }
                
                if (initialsPreview) {
                    initialsPreview.classList.add('hidden');
                }
                
                // Enable save button
                const saveBtn = document.getElementById('save-photo-btn');
                if (saveBtn) {
                    saveBtn.removeAttribute('disabled');
                    saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
