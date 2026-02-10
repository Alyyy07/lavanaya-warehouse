<x-app-layout>
    @section('header_title', 'Dashboard Utama')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <!-- Statistics Cards -->
        <div class="card-app flex flex-col justify-between">
            <div class="flex items-center justify-between mb-6">
                <div class="bg-emerald-50 p-4 rounded-2xl">
                    <i data-lucide="package" class="w-6 h-6 text-emerald-600"></i>
                </div>
                <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Total Produk</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-slate-900 leading-none mb-1">{{ $productCount }}</div>
                <div class="text-xs font-semibold text-slate-500">Produk Aktif</div>
            </div>
        </div>

        <div class="card-app flex flex-col justify-between">
            <div class="flex items-center justify-between mb-6">
                <div class="bg-blue-50 p-4 rounded-2xl">
                    <i data-lucide="banknote" class="w-6 h-6 text-blue-600"></i>
                </div>
                <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Valuasi Stok</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-slate-900 leading-none mb-1">
                    <span class="text-lg font-bold text-slate-400">Rp</span>{{ $formattedStockValue }}<span
                        class="text-lg font-bold text-slate-400 lowercase">{{ $stockValueSuffix }}</span>
                </div>
                <div class="text-xs font-semibold text-slate-500">Nilai Stok</div>
            </div>
        </div>

        <div class="card-app flex flex-col justify-between">
            <div class="flex items-center justify-between mb-6">
                <div class="bg-amber-50 p-4 rounded-2xl">
                    <i data-lucide="repeat" class="w-6 h-6 text-amber-600"></i>
                </div>
                <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Transaksi</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-slate-900 leading-none mb-1">{{ $transactionsToday }}</div>
                <div class="text-xs font-semibold text-slate-500">Transaksi Hari Ini</div>
            </div>
        </div>

        <div
            class="card-app flex flex-col justify-between {{ ($outOfStockProducts->count() + $lowStockProducts->count()) > 0 ? 'ring-2 ring-red-100 bg-red-50/20' : '' }}">
            <div class="flex items-center justify-between mb-6">
                <div class="bg-red-50 p-4 rounded-2xl">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                </div>
                <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Peringatan</div>
            </div>
            <div>
                <div
                    class="text-4xl font-extrabold {{ ($outOfStockProducts->count() + $lowStockProducts->count()) > 0 ? 'text-red-600' : 'text-slate-900' }} leading-none mb-1">
                    {{ $outOfStockProducts->count() + $lowStockProducts->count() }}
                </div>
                <div class="text-xs font-semibold text-slate-500">Stok Barang Kritis</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Transactions -->
        <div class="card-app p-0 overflow-hidden flex flex-col">
            <div class="px-8 py-6 flex justify-between items-center border-b border-slate-50">
                <h2 class="text-sm font-bold text-slate-900">Aktivitas Terkini</h2>
                <div class="flex items-center gap-2">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Log Aktivitas</span>
                </div>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Tanggal
                            </th>
                            <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Produk
                            </th>
                            <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Jenis
                            </th>
                            <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 text-xs font-semibold text-slate-500">
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('H:i • d/m/Y') }}
                            </td>
                            <td class="px-8 py-4">
                                <div class="text-xs font-bold text-slate-800">{{ $transaction->product->name }}</div>
                            </td>
                            <td class="px-8 py-4">
                                @if($transaction->type == 'IN')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">Stok
                                    Masuk</span>
                                @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700">Stok
                                    Keluar</span>
                                @endif
                            </td>
                            <td class="px-8 py-4">
                                <span class="text-xs font-bold text-slate-900">{{ $transaction->quantity }}</span>
                                <span class="text-[10px] text-slate-400 font-medium ml-1">{{ $transaction->product->unit
                                    }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-xs font-semibold text-slate-400 italic">
                                Log transaksi masih kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-slate-50 text-center">
                <a href="{{ route('reports.transactions') }}"
                    class="text-[11px] font-bold text-primary hover:underline tracking-widest uppercase">
                    Lihat Semua Transaksi →
                </a>
            </div>
        </div>

        <!-- Critical Stock Alert -->
        <div
            class="card-app p-0 overflow-hidden flex flex-col {{ ($outOfStockProducts->count() + $lowStockProducts->count()) > 0 ? 'border-red-100 ring-2 ring-red-50' : '' }}">
            <div
                class="px-8 py-6 flex justify-between items-center border-b border-slate-50 {{ ($outOfStockProducts->count() + $lowStockProducts->count()) > 0 ? 'bg-red-50/30' : '' }}">
                <h2 class="text-sm font-bold text-slate-900 italic">Perlu Perhatian</h2>
                <div class="h-2 w-2 rounded-full bg-red-500 animate-ping"></div>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Info
                                Produk</th>
                            <th
                                class="px-8 py-4 text-center text-[11px] font-bold uppercase tracking-widest text-slate-400">
                                Stok</th>
                            <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($outOfStockProducts->take(3) as $product)
                        <tr class="bg-red-50/40 hover:bg-red-50/60 transition-colors">
                            <td class="px-8 py-4">
                                <div class="text-xs font-bold text-slate-900">{{ $product->name }}</div>
                                <div class="text-[10px] font-medium text-red-500 tracking-wider">{{ $product->code }}
                                </div>
                            </td>
                            <td class="px-8 py-4 text-center">
                                <span class="text-xl font-black text-red-600">{{ $product->current_stock }}</span>
                            </td>
                            <td class="px-8 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-red-600 text-white">Stok
                                    Habis</span>
                            </td>
                        </tr>
                        @endforeach

                        @foreach($lowStockProducts->take(5 - $outOfStockProducts->count()) as $product)
                        <tr class="hover:bg-amber-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="text-xs font-bold text-slate-800">{{ $product->name }}</div>
                                <div class="text-[10px] font-medium text-slate-400 tracking-wider">{{ $product->code }}
                                </div>
                            </td>
                            <td class="px-8 py-4 text-center">
                                <span class="text-xl font-black text-amber-600">{{ $product->current_stock }}</span>
                            </td>
                            <td class="px-8 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700">Stok
                                    Menipis</span>
                            </td>
                        </tr>
                        @endforeach

                        @if($outOfStockProducts->count() == 0 && $lowStockProducts->count() == 0)
                        <tr>
                            <td colspan="3" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="h-12 w-12 bg-emerald-100 rounded-full flex items-center justify-center mb-3">
                                        <i data-lucide="check" class="h-6 w-6 text-emerald-600"></i>
                                    </div>
                                    <div class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Status:
                                        Optimal</div>
                                    <div class="text-[10px] font-medium text-slate-400 mt-1">Semua level inventaris aman
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-slate-50 text-center">
                <a href="{{ route('reports.stock') }}"
                    class="text-[11px] font-bold text-amber-600 hover:underline tracking-widest uppercase">
                    Lihat Stok →
                </a>
            </div>
        </div>
    </div>
</x-app-layout>