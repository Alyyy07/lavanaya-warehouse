<x-app-layout>
    @section('header_title')

    <div class="card-app mx-auto p-0 overflow-hidden max-w-4xl">
        <div class="bg-primary px-8 py-4 flex justify-between items-center text-white">
            <h2 class="text-xs font-black tracking-[0.2em]">Registrasi Barang Masuk</h2>
        </div>

        <form action="{{ route('transactions.in.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Tanggal
                            Penerimaan <span class="text-red-600">*</span></label>
                        <input type="date" name="transaction_date" class="input-app w-full text-xs font-bold"
                            value="{{ old('transaction_date', date('Y-m-d')) }}" required />
                        @error('transaction_date')
                        <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Supplier Pengirim
                            <span class="text-red-600">*</span></label>
                        <select name="supplier_id" class="input-app w-full text-xs font-black" required>
                            <option value="" disabled selected>Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id')==$supplier->id ? 'selected' : ''
                                }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                        <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Produk<span
                                class="text-red-600">*</span></label>
                        <select name="product_id" class="input-app w-full text-xs font-black" required>
                            <option value="" disabled selected>Pilih Produk</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id')==$product->id ? 'selected' : '' }}>
                                {{ $product->code }} - {{ $product->name }} (STOCK: {{ $product->current_stock }} {{
                                $product->unit }})
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Volume Penerimaan
                            <span class="text-red-600">*</span></label>
                        <div class="relative">
                            <input type="number" name="quantity"
                                class="input-app w-full text-xs font-black [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                value="{{ old('quantity') }}" required min="1" placeholder="0" />
                            <span
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[9px] font-black text-slate-400">UNITS</span>
                        </div>
                        @error('quantity')
                        <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Catatan Distribusi</label>
                <textarea name="notes" class="input-app w-full min-h-25 text-xs font-bold py-3"
                    placeholder="Dokumentasi tambahan / referensi pengiriman...">{{ old('notes') }}</textarea>
                @error('notes')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-12 pt-8 border-t-2 border-border flex justify-end gap-4">
                <a href="{{ route('transactions.in.index') }}"
                    class="px-8 py-3 text-xs font-black text-slate-400 hover:text-red-600 tracking-widest transition-colors">
                    Batalkan
                </a>
                <button type="submit" class="btn-app-primary px-12 py-3 text-xs font-black tracking-[0.2em]">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>