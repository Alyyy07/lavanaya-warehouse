<x-app-layout>
    @section('header_title')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Kategori Barang</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Kelola Kategori Barang</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn-app-primary whitespace-nowrap">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Tambah Kategori
        </a>
    </div>

    <div class="flex gap-8 mb-10 border-b border-slate-100 pb-px px-2">
        <a href="{{ route('categories.index') }}"
            class="pb-4 text-xs font-bold tracking-widest transition-all relative {{ !request('status') ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
            Kategori Aktif
            @if(!request('status'))
            <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full"></div>
            @endif
        </a>
        <a href="{{ route('categories.index', ['status' => 'archived']) }}"
            class="pb-4 text-xs font-bold tracking-widest transition-all relative {{ request('status') == 'archived' ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
            Data Terarsip
            @if(request('status') == 'archived')
            <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full"></div>
            @endif
        </a>
    </div>

    <div class="card-app p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 w-24 text-center">
                            ID</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">
                            Nama Kategori</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Keterangan
                        </th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">
                            Jumlah Produk</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500 text-center w-32">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($categories as $index => $category)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 text-[11px] font-bold text-slate-400 text-center">
                            {{ $categories->firstItem() + $index }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-xs font-bold text-slate-800">{{ $category->name }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-semibold text-slate-600 italic">{{
                                $category->description ?? 'Tidak ada keterangan' }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 tracking-tighter">
                                {{ $category->products_count }} Unit Terdaftar
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-4">
                                @if(request('status') == 'archived')
                                <form id="restore-form-{{ $category->id }}"
                                    action="{{ route('categories.restore', $category->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="confirmRestore(event, 'restore-form-{{ $category->id }}')"
                                        class="btn-app-ghost text-emerald-600 hover:bg-emerald-50 px-3 py-1.5">
                                        Pulihkan
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="p-2.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                    <i data-lucide="edit-3" class="h-4 w-4"></i>
                                </a>
                                <form id="delete-form-{{ $category->id }}"
                                    action="{{ route('categories.destroy', $category) }}" method="POST"
                                    data-confirm-delete="true" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDelete(event, 'delete-form-{{ $category->id }}', 'archive')"
                                        class="p-2.5 cursor-pointer rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                        <i data-lucide="archive" class="h-4 w-4"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Tidak ada data kategori
                                tersedia</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
        <div class="p-4 border-t-2 border-border bg-slate-50/50">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</x-app-layout>