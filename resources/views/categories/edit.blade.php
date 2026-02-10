<x-app-layout>
    @section('header_title')

    <div class="card-app mx-auto p-0 overflow-hidden max-w-2xl">
        <div class="bg-primary px-8 py-4 flex justify-between items-center text-white">
            <h2 class="text-xs font-black tracking-[0.2em]">Update Kategori</h2>
        </div>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Nama
                    Kategori <span class="text-red-600">*</span></label>
                <input type="text" name="name" class="input-app w-full text-xs font-black"
                    placeholder="Contoh: Elektronik / Sparepart" value="{{ old('name', $category->name) }}" required />
                @error('name')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Deskripsi</label>
                <textarea name="description" class="input-app w-full h-32 text-xs font-bold py-3"
                    placeholder="Berikan keterangan singkat mengenai parameter ini...">{{ old('description', $category->description) }}</textarea>
                @error('description')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-12 pt-8 border-t-2 border-border flex justify-end gap-4">
                <a href="{{ route('categories.index') }}"
                    class="px-8 py-3 text-xs font-black text-slate-400 hover:text-red-600 tracking-widest transition-colors">
                    Batal
                </a>
                <button type="submit" class="btn-app-primary px-12 py-3 text-xs font-black tracking-[0.2em]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>