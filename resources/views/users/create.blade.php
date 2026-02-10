<x-app-layout>
    @section('header_title')

    <div class="card-app mx-auto p-0 overflow-hidden max-w-2xl">
        <div class="bg-primary px-8 py-4 flex justify-between items-center text-white">
            <h2 class="text-xs font-black tracking-[0.2em]">Registrasi Admin</h2>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-8 space-y-8">
            @csrf

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Nama Lengkap<span
                        class="text-red-600">*</span></label>
                <input type="text" name="name" class="input-app w-full text-xs font-black"
                    placeholder="Contoh: Ahmad Logistikar" value="{{ old('name') }}" required />
                @error('name')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Email<span
                        class="text-red-600">*</span></label>
                <input type="email" name="email" class="input-app w-full text-xs font-bold"
                    placeholder="alamat@email.com" value="{{ old('email') }}" required />
                @error('email')
                <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Password
                        <span class="text-red-600">*</span></label>
                    <input type="password" name="password" class="input-app w-full text-xs" placeholder="Password"
                        required />
                    @error('password')
                    <p class="mt-2 text-xs font-black text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black tracking-widest text-slate-500 mb-2">Konfirmasi
                        Password <span class="text-red-600">*</span></label>
                    <input type="password" name="password_confirmation" class="input-app w-full text-xs"
                        placeholder="Konfirmasi Password" required />
                </div>
            </div>

            <div class="mt-12 pt-8 border-t-2 border-border flex justify-end gap-4">
                <a href="{{ route('users.index') }}"
                    class="px-8 py-3 text-xs font-black text-slate-400 hover:text-red-600 tracking-widest transition-colors">
                    Batal
                </a>
                <button type="submit" class="btn-app-primary px-12 py-3 text-xs font-black tracking-[0.2em]">
                    Daftarkan Admin
                </button>
            </div>
        </form>
    </div>
</x-app-layout>