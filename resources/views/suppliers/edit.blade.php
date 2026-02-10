<x-app-layout>
    @section('header_title')

    <div class="card-app mx-auto p-0 overflow-hidden max-w-2xl">
        <div class="bg-primary px-8 py-4 flex justify-between items-center text-white">
            <h2 class="text-xs font-black tracking-[0.2em]">Edit Supplier</h2>
        </div>

        <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Nama Entitas /
                    Perusahaan <span class="text-red-600">*</span></label>
                <input type="text" name="name" class="input-app w-full text-xs font-black"
                    placeholder="Contoh: PT. Logistik Jaya" value="{{ old('name', $supplier->name) }}" required />
                @error('name')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">PIC</label>
                    <input type="text" name="contact_person" class="input-app w-full text-xs font-black"
                        placeholder="Nama PIC" value="{{ old('contact_person', $supplier->contact_person) }}" />
                </div>

                <div>
                    <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">No. Telepon</label>
                    <input type="text" name="phone" class="input-app w-full text-xs font-bold"
                        placeholder="08XXXXXXXXXX" value="{{ old('phone', $supplier->phone) }}" />
                </div>
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Email</label>
                <input type="email" name="email" class="input-app w-full text-xs font-bold"
                    placeholder="ALAMAT@EMAIL.COM" value="{{ old('email', $supplier->email) }}" />
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Alamat</label>
                <textarea name="address" class="input-app w-full h-32 text-xs font-bold py-3"
                    placeholder="Alamat Lengkap Kantor/Gudang...">{{ old('address', $supplier->address) }}</textarea>
            </div>

            <div class="mt-12 pt-8 border-t-2 border-border flex justify-end gap-3">
                <a href="{{ route('suppliers.index') }}"
                    class="px-8 py-3 text-xs font-black text-slate-400 hover:text-red-600 tracking-widest transition-colors">
                    Batal
                </a>
                <button type="submit" class="btn-app-primary px-12 py-3 text-xs font-black tracking-[0.1em]">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>