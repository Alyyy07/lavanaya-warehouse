<x-app-layout>
    @section('header_title')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Supplier</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Kelola data rekanan dan pemasok barang</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn-app-primary whitespace-nowrap">
            <i data-lucide="user-plus" class="h-4 w-4 mr-2"></i>
            Tambah Supplier
        </a>
    </div>

    <div class="flex gap-8 mb-10 border-b border-slate-100 pb-px px-2">
        <a href="{{ route('suppliers.index') }}"
            class="pb-4 text-xs font-bold tracking-widest transition-all relative {{ !request('status') ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
            Supplier Aktif
            @if(!request('status'))
            <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full"></div>
            @endif
        </a>
        <a href="{{ route('suppliers.index', ['status' => 'archived']) }}"
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
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 w-16 text-center">
                            ID</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Nama &
                            Alamat</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Kontak
                            Person</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">
                            Email / Telp</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Total
                            Produk
                        </th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center w-36">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($suppliers as $index => $supplier)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 text-[11px] font-bold text-slate-400 text-center">
                            {{ $suppliers->firstItem() + $index }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-xs font-bold text-slate-800">{{ $supplier->name }}</div>
                            <div class="text-[10px] font-medium text-slate-400 italic mt-0.5 truncate max-w-xs">
                                {{ $supplier->address ?? 'Lokasi tidak ditentukan' }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-semibold text-slate-600 italic">{{ $supplier->contact_person ??
                                'N/A' }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-xs font-bold text-slate-700">{{ $supplier->email ?? '-' }}</div>
                            <div class="text-[10px] font-medium text-slate-400 mt-0.5 tracking-wider">{{
                                $supplier->phone ?? '-' }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 tracking-tighter">
                                {{ $supplier->products_count }} Unit Terdaftar
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-center gap-3">
                                @if(request('status') == 'archived')
                                <form id="restore-form-{{ $supplier->id }}"
                                    action="{{ route('suppliers.restore', $supplier->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="confirmRestore(event, 'restore-form-{{ $supplier->id }}')"
                                        class="btn-app-ghost text-emerald-600 hover:bg-emerald-50 px-3 py-1.5">
                                        Pulihkan
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('suppliers.edit', $supplier) }}"
                                    class="p-2.5 rounded-lg text-blue-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                    <i data-lucide="edit-3" class="h-4 w-4"></i>
                                </a>
                                <form id="delete-form-{{ $supplier->id }}"
                                    action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                    data-confirm-delete="true" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDelete(event, 'delete-form-{{ $supplier->id }}', 'archive')"
                                        class="p-2.5 rounded-lg cursor-pointer text-red-600 hover:text-red-600 hover:bg-red-50 transition-all">
                                        <i data-lucide="archive" class="h-4 w-4"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Belum ada data supplier
                                terdaftar</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($suppliers->hasPages())
        <div class="p-4 border-t-2 border-border bg-slate-50/50">
            {{ $suppliers->links() }}
        </div>
        @endif
    </div>
</x-app-layout>