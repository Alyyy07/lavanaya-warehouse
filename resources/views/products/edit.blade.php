<x-app-layout>
    @section('header_title')

    <div class="card-app mx-auto p-0 overflow-hidden max-w-4xl">
        <div class="bg-primary px-8 py-4 flex justify-between items-center text-white">
            <h2 class="text-xs font-bold tracking-widest">Edit Produk</h2>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Kode Produk <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="code" class="input-app w-full text-xs font-bold" placeholder="prd-xxxx"
                            value="{{ old('code', $product->code) }}" required />
                        @error('code')
                        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Nama Produk <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="name" class="input-app w-full text-xs font-bold"
                            placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required />
                        @error('name')
                        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Kategori
                                <span class="text-red-600">*</span></label>
                            <select name="category_id" class="input-app w-full text-xs font-bold" required>
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) ==
                                    $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Supplier</label>
                            <select name="supplier_id" class="input-app w-full text-xs font-bold">
                                <option value="">Tanpa Supplier</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) ==
                                    $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Satuan
                                Unit <span class="text-red-600">*</span></label>
                            <input type="text" name="unit" class="input-app w-full text-xs font-bold"
                                placeholder="PCS / KG" value="{{ old('unit', $product->unit) }}" required />
                        </div>

                        <div>
                            <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Harga
                                Per Unit <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Rp</span>
                                <input type="number" name="price" class="input-app w-full pl-8 text-xs font-bold"
                                    value="{{ old('price', $product->price) }}" required min="0" />
                            </div>
                        </div>
                    </div>

                    <div x-data="{ imageUrl: '{{ $product->image ? asset('storage/' . $product->image) : null }}' }">
                        <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Foto Produk</label>
                        <div class="relative group">
                            <input type="file" name="image"
                                @change="imageUrl = URL.createObjectURL($event.target.files[0])"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" />

                            <template x-if="!imageUrl">
                                <div
                                    class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center group-hover:border-primary transition-all bg-slate-50/50">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="space-y-1">
                                            <div class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">
                                                Klik untuk Upload</div>
                                            <div class="text-[9px] font-medium text-slate-400">Maksimal 2MB (JPG, PNG,
                                                WEBP)</div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="imageUrl">
                                <div
                                    class="relative border-2 border-dashed border-primary p-2 bg-slate-50 rounded-xl overflow-hidden group">
                                    <img :src="imageUrl" class="max-h-64 mx-auto rounded-lg shadow-sm object-contain" />
                                    <div
                                        class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <div class="text-[10px] font-bold text-white uppercase tracking-widest">Klik
                                            untuk ganti gambar</div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        @error('image')
                        <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-widest text-slate-500 mb-2">Deskripsi</label>
                        <textarea name="description" class="input-app w-full min-h-25 text-xs font-medium py-3"
                            placeholder="Spesifikasi atau catatan khusus mengenai produk ini...">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('products.index') }}" class="btn-app-ghost text-slate-400 hover:text-red-600">
                    Batal
                </a>
                <button type="submit" class="btn-app-primary px-12">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>