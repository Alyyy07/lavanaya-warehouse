<x-app-layout>
    @section('header_title')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-xl font-black text-secondary tracking-tighter">Logistik Masuk</h1>
            <p class="text-[10px] font-bold text-slate-400 tracking-widest mt-1">Registrasi Kedatangan Barang
                & Verifikasi Stok</p>
        </div>
        <a href="{{ route('transactions.in.create') }}" class="btn-app-primary whitespace-nowrap">
            <i data-lucide="plus-circle" class="h-4 w-4 mr-2"></i>
            Tambah Barang Masuk
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
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Waktu &
                            Kode Transaksi</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Unit
                            Barang</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Vendor
                            Asal</th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">
                            Volume</th>
                        <th class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400">Petugas
                        </th>
                        <th
                            class="px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center w-24">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-border">
                    @forelse($transactions as $index => $transaction)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-[10px] font-black text-slate-400 text-center">
                            {{ $transactions->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-black text-secondary">{{
                                \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</div>
                            <div class="text-[9px] font-bold text-slate-400 tracking-widest mt-0.5">{{
                                $transaction->transaction_code }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs font-black text-secondary tracking-tight">{{
                                $transaction->product->name }}</div>
                            <div class="text-[9px] font-bold text-slate-400 tracking-widest">{{
                                $transaction->product->code }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-bold text-slate-500">{{ $transaction->supplier ?
                                $transaction->supplier->name : 'Tanpa Vendor' }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex flex-col items-center">
                                <span class="text-xs font-black text-emerald-600">+{{ $transaction->quantity }}</span>
                                <span class="text-[8px] font-black text-slate-400 tracking-tighter">{{
                                    $transaction->product->unit }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[10px] font-black text-slate-500 italic">
                            {{ $transaction->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <form id="delete-form-{{ $transaction->id }}"
                                    action="{{ route('transactions.destroy', $transaction) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDelete(event, 'delete-form-{{ $transaction->id }}')"
                                        class="p-2.5 rounded-lg cursor-pointer text-red-600 hover:text-red-600 hover:bg-red-50 transition-all">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="text-xs font-black text-slate-400 italic">Belum ada data transaksi
                                masuk</div>
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