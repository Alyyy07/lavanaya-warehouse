<x-app-layout>
    @section('header_title')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Pengguna</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Kelola akses dan akun
                administrator</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn-app-primary whitespace-nowrap">
            <i data-lucide="user-plus" class="h-4 w-4 mr-2"></i>
            Tambah User
        </a>
    </div>

    <div class="card-app p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 w-16 text-center">
                            ID</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Nama</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Email</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Dibuat Pada
                        </th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center w-32">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-border">
                    @forelse($users as $index => $user)
                    <tr class="hover:bg-slate-50 group">
                        <td class="px-6 py-4 text-[10px] font-black text-slate-400 text-center">
                            {{ $users->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs font-black text-secondary tracking-tight">{{
                                $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-[10px] font-bold text-slate-500 italic">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-4">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="p-2.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                    <i data-lucide="edit-3" class="h-4 w-4"></i>
                                </a>

                                @if($user->id !== Auth::id())
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}"
                                    method="POST" data-confirm-delete="true">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $user->id }}')"
                                        class="text-[9px] font-black text-red-500 hover:underline tracking-tighter flex items-center gap-1">
                                        <i data-lucide="user-x" class="w-3 h-3"></i>
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Tidak ada data administrator
                                tersedia</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="p-4 border-t-2 border-border bg-slate-50/50">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</x-app-layout>