<x-app-layout>
    @section('header_title')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Produk</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Kelola data barang dan stok inventaris</p>
        </div>

        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <form action="{{ route('products.index') }}" method="GET" class="flex">
                @if(request('category_id'))
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                <div
                    class="flex items-center bg-white rounded-(--radius-sharp) shadow-sm border border-slate-100 overflow-hidden">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                        class="px-4 py-2.5 text-xs font-medium bg-transparent focus:outline-none w-full md:w-64" />
                    <button type="submit" class="px-4 py-2.5 text-slate-400 hover:text-primary transition-colors">
                        <i data-lucide="search" class="h-4 w-4"></i>
                    </button>
                </div>
            </form>
            <a href="{{ route('products.create') }}" class="btn-app-primary whitespace-nowrap">
                <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                Tambah Produk
            </a>
        </div>
    </div>

    <!-- Status & Category Filter -->
    <div class="mb-10 space-y-6">
        <div class="flex gap-8 border-b border-slate-100 pb-px px-2">
            <a href="{{ route('products.index') }}"
                class="pb-4 text-xs font-bold tracking-widest transition-all relative {{ !request('status') ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
                Produk Aktif
                @if(!request('status'))
                <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full"></div>
                @endif
            </a>
            <a href="{{ route('products.index', ['status' => 'archived']) }}"
                class="pb-4 text-xs font-bold tracking-widest transition-all relative {{ request('status') == 'archived' ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
                Produk Terarsip
                @if(request('status') == 'archived')
                <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full"></div>
                @endif
            </a>
        </div>

        <div class="flex flex-wrap gap-2 px-2">
            <a href="{{ route('products.index', request()->except('category_id')) }}"
                class="px-4 py-1.5 text-[10px] font-bold rounded-full transition-all border {{ !request('category_id') ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-500 border-slate-200 hover:border-slate-300' }}">
                Semua Kategori
            </a>
            @foreach($categories as $category)
            <a href="{{ route('products.index', array_merge(request()->all(), ['category_id' => $category->id])) }}"
                class="px-4 py-1.5 text-[10px] font-bold rounded-full transition-all border {{ request('category_id') == $category->id ? 'bg-primary text-white border-primary' : 'bg-white text-slate-500 border-slate-200 hover:border-slate-300' }}">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="card-app p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 w-24 text-center">
                            SKU</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Produk
                        </th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Kategori
                        </th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Supplier
                        </th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-right">
                            Harga Unit</th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">
                            Stok</th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center w-36">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($products as $index => $product)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 text-[11px] font-bold text-slate-400 text-center tracking-wider">
                            {{ $product->code }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 overflow-hidden shrink-0 flex items-center justify-center">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover" />
                                    @else
                                    <i data-lucide="image" class="h-5 w-5 text-slate-200"></i>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-800">{{ $product->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium italic">Prod. ID #{{
                                        $product->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100 uppercase">{{
                                $product->category ? $product->category->name : 'Tidak ada kategori' }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-[11px] font-semibold text-slate-500">{{ $product->supplier ?
                                $product->supplier->name : '-' }}</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <span class="text-xs font-bold text-slate-900">Rp {{ number_format($product->price, 0, ',',
                                '.') }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span
                                class="text-lg font-black {{ $product->current_stock < 10 ? 'text-red-500' : 'text-slate-900' }}">{{
                                $product->current_stock }}</span>
                            <span class="text-[10px] text-slate-400 font-bold ml-0.5">{{ $product->unit }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-center gap-3">
                                @if(request('status') == 'archived')
                                <form id="restore-form-{{ $product->id }}"
                                    action="{{ route('products.restore', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn-app-ghost text-emerald-600 hover:bg-emerald-50 px-3 py-1.5"
                                        onclick="confirmRestore(event, 'restore-form-{{ $product->id }}')">
                                        Pulihkan
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('products.edit', $product) }}"
                                    class="p-2.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                    <i data-lucide="edit-3" class="h-4 w-4"></i>
                                </a>
                                <form id="delete-form-{{ $product->id }}"
                                    action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDelete(event, 'delete-form-{{ $product->id }}', 'archive')"
                                        class="p-2.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                        <i data-lucide="archive" class="h-4 w-4"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Tidak ada data produk
                                tersedia</div>
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