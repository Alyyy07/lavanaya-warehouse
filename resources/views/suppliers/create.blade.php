<x-app-layout>
    @section('header_title')

    <div class="card-app mx-auto p-0 overflow-hidden max-w-2xl">
        <div class="bg-primary px-8 py-4 flex justify-between items-center text-white">
            <h2 class="text-xs font-black tracking-[0.2em]">Input Data Supplier Baru</h2>
        </div>

        <form action="{{ route('suppliers.store') }}" method="POST" class="p-8 space-y-8">
            @csrf

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Nama Entitas /
                    Perusahaan <span class="text-red-600">*</span></label>
                <input type="text" name="name" class="input-app w-full text-xs font-black"
                    placeholder="Contoh: PT. Logistik Jaya Abadi" value="{{ old('name') }}" required />
                @error('name')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">PIC</label>
                    <input type="text" name="contact_person" class="input-app w-full text-xs font-bold"
                        placeholder="Nama penanggung jawab" value="{{ old('contact_person') }}" />
                    @error('contact_person')
                    <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">No. Telepon</label>
                    <input type="text" name="phone" class="input-app w-full text-xs font-bold"
                        placeholder="Telepon / WhatsApp" value="{{ old('phone') }}" />
                    @error('phone')
                    <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Email</label>
                <input type="email" name="email" class="input-app w-full text-xs font-bold"
                    placeholder="SUPPLIER@CORP.ID" value="{{ old('email') }}" />
                @error('email')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Alamat</label>
                <textarea name="address" class="input-app w-full min-h-25 text-xs font-bold py-3"
                    placeholder="Alamat lengkap...">{{ old('address') }}</textarea>
                @error('address')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-8 border-t-2 border-border flex justify-end gap-4">
                <a href="{{ route('suppliers.index') }}"
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