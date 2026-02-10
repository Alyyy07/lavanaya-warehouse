<x-app-layout>
    @section('header_title', 'Riwayat Transaksi')

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
        <div>
            <h1 class="text-xl font-black text-secondary tracking-tighter">Data Transaksi Barang
            </h1>
            <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-1">Catatan riwayat keluar masuk
                barang</p>
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

    <!-- Configuration / Filter Section -->
    <div class="card-app p-6 mb-8 bg-slate-50/50">
        <form action="{{ route('reports.transactions') }}" method="GET"
            class="grid grid-cols-1 md:grid-cols-5 gap-6 items-end">
            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="input-app w-full text-xs font-black" />
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="input-app w-full text-xs font-black" />
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Jenis Transaksi</label>
                <select name="type" class="input-app w-full text-xs font-black">
                    <option value="">Semua Tipe</option>
                    <option value="IN" {{ request('type')=='IN' ? 'selected' : '' }}>Masuk (Inbound)</option>
                    <option value="OUT" {{ request('type')=='OUT' ? 'selected' : '' }}>Keluar (Outbound)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Produk</label>
                <select name="product_id" class="input-app w-full text-xs font-black">
                    <option value="">Semua Produk</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ request('product_id')==$product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="flex-1 bg-secondary text-white text-[10px] font-black tracking-widest py-3 hover:bg-black transition-colors">
                    Lihat Laporan
                </button>
                @if(request()->anyFilled(['start_date', 'end_date', 'type', 'product_id']))
                <a href="{{ route('reports.transactions') }}"
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
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">Waktu &
                            Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">No.
                            Referensi</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">Nama
                            Produk</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">Jenis</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500 text-center">
                            Jumlah</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">Asal /
                            Tujuan</th>
                        <th class="px-6 py-4 text-[10px] font-black tracking-widest text-slate-500">
                            Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-border">
                    @forelse($transactions as $index => $transaction)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-[10px] font-black text-slate-400 text-center">
                            {{ $transactions->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 text-[10px] font-bold text-slate-600">
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-[10px] font-black text-slate-400 tracking-tighter font-mono">
                            {{ $transaction->transaction_code }}
                        </td>
                        <td class="px-6 py-4 text-xs font-black text-secondary italic">
                            {{ $transaction->product->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if($transaction->type == 'IN')
                            <span
                                class="inline-flex px-2 py-0.5 bg-emerald-100 text-[9px] font-black text-emerald-600 tracking-tighter">Masuk</span>
                            @else
                            <span
                                class="inline-flex px-2 py-0.5 bg-red-100 text-[9px] font-black text-red-600 tracking-tighter">Keluar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-[10px] font-black text-secondary">{{ $transaction->quantity }}
                            </div>
                            <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">{{
                                $transaction->product->unit }}</div>
                        </td>
                        <td class="px-6 py-4 text-[10px] font-bold text-slate-500">
                            @if($transaction->type == 'IN')
                            {{ $transaction->supplier ? $transaction->supplier->name : '-' }}
                            @else
                            {{ $transaction->destination ?? '-' }}
                            @endif
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <div class="text-[10px] font-bold text-slate-400 tracking-tight truncate"
                                title="{{ $transaction->notes }}">
                                {{ $transaction->notes ?? '-' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Tidak ada data transaksi
                                dalam filter ini</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="p-4 border-t-2 border-border bg-slate-50/50">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</x-app-layout>