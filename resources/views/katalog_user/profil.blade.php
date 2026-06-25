<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - Tebing Linggasana</title>
    <meta name="description" content="Kelola informasi profil dan keamanan akun Anda di Wisata Tebing Linggasana.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', 'Inter', sans-serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.4s ease both; }

        /* Photo upload preview */
        .photo-upload-zone { transition: all 0.2s ease; }
        .photo-upload-zone:hover { border-color: #10b981; background: #f0fdf4; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">

    {{-- ===== NAVBAR ===== --}}
    @include('katalog_user.partials.navbar')

    {{-- ===== HERO MINI ===== --}}
    <section class="pt-24 pb-10 px-6 bg-gradient-to-b from-slate-900 to-slate-800">
        <div class="max-w-4xl mx-auto flex items-center gap-6">
            {{-- Avatar --}}
            <div class="relative shrink-0">
                @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                    <img src="{{ asset('img/' . Auth::user()->profile_image) }}"
                         alt="{{ Auth::user()->nama_lengkap }}"
                         class="w-20 h-20 rounded-2xl object-cover border-2 border-emerald-500/50 shadow-lg shadow-emerald-500/20">
                @else
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center font-black text-2xl uppercase shadow-lg shadow-emerald-500/30">
                        {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                    </div>
                @endif
                <div class="absolute -bottom-1.5 -right-1.5 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center border-2 border-slate-900">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
            </div>

            {{-- Info --}}
            <div class="text-white">
                <p class="text-xs font-semibold text-emerald-400 uppercase tracking-widest mb-1">Pengaturan Akun</p>
                <h1 class="text-2xl font-black tracking-tight">{{ Auth::user()->nama_lengkap }}</h1>
                <p class="text-slate-400 text-sm mt-0.5">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="max-w-4xl mx-auto px-6 py-10 animate-fade-in">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 text-sm text-emerald-800 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl flex items-center gap-3 text-sm text-rose-800 shadow-sm">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374" />
                </svg>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ===== LEFT: FOTO PROFIL ===== --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Foto Profil Card --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-slate-50">
                        <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316A2.192 2.192 0 0014.502 4h-5c-.75 0-1.437.383-1.837 1.014l-.838 1.161z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Foto Profil
                        </h2>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('user.profil.photo') }}" method="POST" enctype="multipart/form-data" id="form-photo">
                            @csrf

                            {{-- Preview --}}
                            <div class="flex justify-center mb-4">
                                @if(Auth::user()->profile_image && Auth::user()->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . Auth::user()->profile_image)))
                                    <img id="photo-preview" src="{{ asset('img/' . Auth::user()->profile_image) }}"
                                         alt="Foto Profil"
                                         class="w-28 h-28 rounded-2xl object-cover shadow-md border-2 border-emerald-100">
                                @else
                                    <div id="photo-preview-placeholder" class="w-28 h-28 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center font-black text-3xl uppercase shadow-md">
                                        {{ substr(Auth::user()->nama_lengkap, 0, 2) }}
                                    </div>
                                    <img id="photo-preview" src="" alt="Preview" class="w-28 h-28 rounded-2xl object-cover shadow-md border-2 border-emerald-100 hidden">
                                @endif
                            </div>

                            {{-- Upload Zone --}}
                            <label for="profile_image" class="photo-upload-zone flex flex-col items-center justify-center gap-2 w-full py-5 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer text-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500">Klik untuk unggah foto baru</span>
                                <span class="text-[10px] text-slate-400">JPG, PNG, WEBP · Maks. 2MB</span>
                            </label>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden" onchange="previewPhoto(this)">

                            @error('profile_image')
                                <p class="text-xs text-rose-600 mt-2">{{ $message }}</p>
                            @enderror

                            <button type="submit" id="btn-photo" disabled
                                class="mt-4 w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed text-white font-bold rounded-xl transition-all text-sm cursor-pointer">
                                Simpan Foto
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Akun Summary --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-5">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Info Akun</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Nama</p>
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->nama_lengkap }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Email</p>
                                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">No. HP</p>
                                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->no_hp }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== RIGHT: FORM SETTINGS ===== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ===== EDIT PROFIL ===== --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50">
                        <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <div class="w-7 h-7 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </div>
                            Edit Informasi Profil
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5 ml-9">Perbarui nama dan nomor telepon Anda</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('user.profil.update') }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="nama_lengkap" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', Auth::user()->nama_lengkap) }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all @error('nama_lengkap') border-rose-400 bg-rose-50 @enderror"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('nama_lengkap')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email (readonly) --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email</label>
                                <div class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-2xl text-slate-500 text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    <span>{{ Auth::user()->email }}</span>
                                    <span class="ml-auto text-[10px] bg-slate-200 text-slate-500 px-2 py-0.5 rounded-full font-bold">Tidak dapat diubah</span>
                                </div>
                            </div>

                            {{-- No HP --}}
                            <div>
                                <label for="no_hp" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nomor HP / WhatsApp</label>
                                <input type="tel" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all @error('no_hp') border-rose-400 bg-rose-50 @enderror"
                                    placeholder="08xxxxxxxxxx" required>
                                @error('no_hp')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-2xl transition-all text-sm shadow-lg shadow-emerald-500/20 hover:-translate-y-0.5 cursor-pointer flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- ===== GANTI PASSWORD ===== --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50">
                        <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <div class="w-7 h-7 bg-amber-100 rounded-xl flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            Ganti Password
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5 ml-9">Pastikan password baru Anda kuat dan unik</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('user.profil.password') }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            {{-- Password Saat Ini --}}
                            <div>
                                <label for="current_password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Saat Ini</label>
                                <div class="relative">
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all pr-11 @error('current_password') border-rose-400 bg-rose-50 @enderror"
                                        placeholder="Masukkan password saat ini">
                                    <button type="button" onclick="togglePwd('current_password', 'eye-current')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer">
                                        <svg id="eye-current" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div>
                                <label for="new_password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="new_password" name="new_password"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all pr-11 @error('new_password') border-rose-400 bg-rose-50 @enderror"
                                        placeholder="Minimal 8 karakter">
                                    <button type="button" onclick="togglePwd('new_password', 'eye-new')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer">
                                        <svg id="eye-new" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div>
                                <label for="new_password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none text-slate-800 text-sm transition-all"
                                    placeholder="Ulangi password baru">
                            </div>

                            {{-- Password Strength Indicator --}}
                            <div id="pwd-strength-wrap" class="hidden">
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="flex gap-1">
                                        <div id="s1" class="w-6 h-1.5 rounded-full bg-slate-200 transition-colors duration-300"></div>
                                        <div id="s2" class="w-6 h-1.5 rounded-full bg-slate-200 transition-colors duration-300"></div>
                                        <div id="s3" class="w-6 h-1.5 rounded-full bg-slate-200 transition-colors duration-300"></div>
                                        <div id="s4" class="w-6 h-1.5 rounded-full bg-slate-200 transition-colors duration-300"></div>
                                    </div>
                                    <span id="pwd-strength-text" class="text-[10px] font-bold text-slate-400"></span>
                                </div>
                            </div>

                            <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-400 text-white font-bold rounded-2xl transition-all text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-0.5 cursor-pointer flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                Perbarui Password
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Danger Zone --}}
                <div class="bg-white rounded-3xl border border-rose-100 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-sm font-bold text-rose-700 flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                            Keluar Akun
                        </h3>
                        <p class="text-xs text-slate-400 mb-4">Anda akan keluar dari sesi aktif saat ini di perangkat ini.</p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-5 py-2.5 bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 font-bold rounded-xl transition-all text-sm cursor-pointer flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                Keluar Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    function togglePwd(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        field.type = field.type === 'password' ? 'text' : 'password';
    }

    function previewPhoto(input) {
        const btn = document.getElementById('btn-photo');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photo-preview');
                const placeholder = document.getElementById('photo-preview-placeholder');
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                if (placeholder) placeholder.classList.add('hidden');
                btn.disabled = false;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Password strength
    document.getElementById('new_password').addEventListener('input', function() {
        const val = this.value;
        const wrap = document.getElementById('pwd-strength-wrap');
        const s = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
        const text = document.getElementById('pwd-strength-text');
        if (!val) { wrap.classList.add('hidden'); return; }
        wrap.classList.remove('hidden');
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        const colors = ['bg-rose-500', 'bg-amber-500', 'bg-yellow-400', 'bg-emerald-500'];
        const labels = ['', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
        s.forEach((el, i) => {
            el.className = 'w-6 h-1.5 rounded-full transition-colors duration-300 ' + (i < score ? colors[score - 1] : 'bg-slate-200');
        });
        text.textContent = labels[score] || '';
        text.style.color = score <= 1 ? '#ef4444' : score === 2 ? '#f59e0b' : '#10b981';
    });
    </script>
</body>
</html>
