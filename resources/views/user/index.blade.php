@extends('layouts.template')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-6 animate-fade-in">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Manajemen Pengguna</h1>
            <p class="text-xs text-slate-400 mt-1">Daftar, tambah, edit, dan hapus pengguna terdaftar di sistem.</p>
        </div>
        <button onclick="openModal('add-user-modal')" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition duration-200 shadow-md shadow-emerald-500/10 flex items-center gap-2 cursor-pointer">
            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Pengguna
        </button>
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

    <!-- Users Table Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/65 border-b border-slate-100">
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Pengguna</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Nomor HP</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Peran</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/30 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($user->profile_image && $user->profile_image !== 'default_profile.svg' && file_exists(public_path('img/' . $user->profile_image)))
                                        <img src="{{ asset('img/' . $user->profile_image) }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover shadow-inner border border-slate-150/40">
                                    @else
                                        <div class="w-9 h-9 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-700 font-bold uppercase text-xs">
                                            {{ substr($user->nama_lengkap, 0, 2) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">{{ $user->nama_lengkap }}</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Terdaftar: {{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-650 font-medium">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm font-mono text-slate-600">{{ $user->no_hp }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase bg-slate-100 text-slate-600">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2.5">
                                    <!-- Edit Button -->
                                    <button 
                                        data-id="{{ $user->id_user }}"
                                        data-nama="{{ $user->nama_lengkap }}"
                                        data-email="{{ $user->email }}"
                                        data-no_hp="{{ $user->no_hp }}"
                                        data-role="{{ $user->role }}"
                                        onclick="initEditUser(this)"
                                        class="p-1.5 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50/50 rounded-lg transition-colors cursor-pointer"
                                        title="Edit Pengguna"
                                    >
                                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    @if($user->id_user !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50/50 rounded-lg transition-colors cursor-pointer" title="Hapus Pengguna">
                                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Self safeguard info -->
                                        <span class="p-1.5 text-slate-300 cursor-not-allowed" title="Anda tidak dapat menghapus akun sendiri">
                                            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">
                                Tidak ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= ADD USER MODAL ================= -->
<div id="add-user-modal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('add-user-modal')"></div>
    
    <!-- Modal Content wrapper -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-8 overflow-hidden z-10 transition-transform duration-300 transform scale-95 opacity-0" id="add-user-modal-card">
            <!-- Header -->
            <div class="flex items-center justify-between pb-5 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Tambah Pengguna Baru</h3>
                <button onclick="closeModal('add-user-modal')" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition duration-150 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.users.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" required placeholder="nama@email.com"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nomor HP</label>
                    <input type="text" name="no_hp" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kata Sandi (Password)</label>
                    <input type="password" name="password" required placeholder="Minimal 8 karakter"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Peran (Role)</label>
                    <select name="role" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm cursor-pointer">
                        <option value="user">User biasa (Pengunjung)</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                    <button type="button" onclick="closeModal('add-user-modal')" class="px-5 py-2.5 bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-slate-700 font-semibold rounded-2xl transition duration-150 text-xs cursor-pointer">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-2xl transition duration-150 text-xs shadow-md shadow-emerald-500/10 cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= EDIT USER MODAL ================= -->
<div id="edit-user-modal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('edit-user-modal')"></div>
    
    <!-- Modal Content wrapper -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-md w-full p-8 overflow-hidden z-10 transition-transform duration-300 transform scale-95 opacity-0" id="edit-user-modal-card">
            <!-- Header -->
            <div class="flex items-center justify-between pb-5 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Edit Data Pengguna</h3>
                <button onclick="closeModal('edit-user-modal')" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition duration-150 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="edit-user-form" action="" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="edit_nama" required placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" id="edit_email" required placeholder="nama@email.com"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nomor HP</label>
                    <input type="text" name="no_hp" id="edit_no_hp" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Peran (Role)</label>
                    <select name="role" id="edit_role" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm cursor-pointer">
                        <option value="user">User biasa (Pengunjung)</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Kata Sandi Baru</label>
                        <span class="text-[10px] text-slate-400 font-medium">*Kosongkan jika tidak ingin mengubah</span>
                    </div>
                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-700 outline-none text-slate-800 transition-all text-sm">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                    <button type="button" onclick="closeModal('edit-user-modal')" class="px-5 py-2.5 bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-slate-700 font-semibold rounded-2xl transition duration-150 text-xs cursor-pointer">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-2xl transition duration-150 text-xs shadow-md shadow-emerald-500/10 cursor-pointer">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        const card = document.getElementById(id + '-card');
        if (modal && card) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 50);
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        const card = document.getElementById(id + '-card');
        if (modal && card) {
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }

    function initEditUser(btn) {
        const id = btn.getAttribute('data-id');
        const nama = btn.getAttribute('data-nama');
        const email = btn.getAttribute('data-email');
        const no_hp = btn.getAttribute('data-no_hp');
        const role = btn.getAttribute('data-role');

        document.getElementById('edit-user-form').action = `{{ url('/admin/users') }}/${id}`;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_hp').value = no_hp;
        document.getElementById('edit_role').value = role;

        openModal('edit-user-modal');
    }
</script>
@endpush
