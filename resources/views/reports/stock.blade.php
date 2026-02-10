<x-app-layout>
    @section('header_title', 'Laporan Stok Barang')

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
        <div>
            <h1 class="text-xl font-black text-secondary tracking-tighter">Daftar Inventaris</h1>
            <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-1">Cek stok dan status
                ketersediaan barang</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ request()->fullUrlWithQuery(['export' => 'excel']) }}" class="btn-app-success">
                <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i>
                Excel
            </a>
            <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" class="btn-app-danger">
                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                PDF
            </a>
        </div>
    </div>

    <!-- Filter System -->
    <div class="card-app p-6 mb-8 bg-slate-50/50">
        <form action="{{ route('reports.stock') }}" method="GET"
            class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Pencarian
                    Barang</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Kode / Nama Produk..."
                    class="input-app w-full text-xs font-black" />
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Kategori</label>
                <select name="category_id" class="input-app w-full text-xs font-black">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Status Stok</label>
                <select name="stock_status" class="input-app w-full text-xs font-black">
                    <option value="">Semua Status</option>
                    <option value="low" {{ request('stock_status')=='low' ? 'selected' : '' }}>Stok Kritis (<
                            10)</option>
                    <option value="available" {{ request('stock_status')=='available' ? 'selected' : '' }}>Optimal /
                        Tersedia</option>
                    <option value="empty" {{ request('stock_status')=='empty' ? 'selected' : '' }}>Kosong / Habis
                    </option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="flex-1 bg-secondary text-white text-[10px] font-black tracking-widest py-3 hover:bg-black transition-colors">
                    Terapkan Filter
                </button>
                @if(request()->anyFilled(['search', 'category_id', 'stock_status']))
                <a href="{{ route('reports.stock') }}"
                    class="px-4 py-3 border-2 border-slate-200 text-[10px] font-black text-slate-400 hover:text-red-500 hover:border-red-500 transition-all">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <div class="card-app p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b-2 border-border">
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500 w-16 text-center">
                            ID</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">
                            Nama Barang</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">Kategori
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">Supplier
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500 text-right">
                            Harga Unit</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500 text-center">
                            Stok Saat Ini</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500 text-center w-32">
                            Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-border">
                    @forelse($products as $index => $product)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-[10px] font-black text-slate-400 text-center">
                            {{ $products->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-black text-slate-400 tracking-tighter font-mono">{{
                                $product->code }}</div>
                            <div class="text-xs font-black text-secondary tracking-tight">{{
                                $product->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[10px] font-black text-slate-500 tracking-widest">{{
                                $product->category->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-[10px] font-bold text-slate-400">
                            {{ $product->supplier ? $product->supplier->name : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="text-[10px] font-black text-secondary">Rp {{
                                number_format($product->price, 0, ',', '.') }}</div>
                            <div class="text-[8px] font-bold text-slate-400 tracking-tighter">per unit</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-xs font-black text-secondary">{{ $product->current_stock }}</div>
                            <div class="text-xs font-bold text-slate-400 uppercase italic">{{ $product->unit }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($product->current_stock == 0)
                            <span
                                class="inline-flex px-3 py-1 bg-red-100 text-xs font-black text-red-600 tracking-tighter">Kritis:
                                Habis</span>
                            @elseif($product->current_stock < 10) <span
                                class="inline-flex px-3 py-1 bg-amber-100 text-xs font-black text-amber-600 tracking-tighter">
                                Peringatan: Menipis</span>
                                @else
                                <span
                                    class="inline-flex px-3 py-1 bg-emerald-100 text-xs font-black text-emerald-600 tracking-tighter">Aman:
                                    Optimal</span>
                                @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Tidak ada data produk dalam
                                filter ini</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="p-4 border-t-2 border-border bg-slate-50/50">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</x-app-layout>