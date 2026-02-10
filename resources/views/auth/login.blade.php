<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-slate-50 min-h-screen flex items-center justify-center p-4 font-sans selection:bg-emerald-100 selection:text-emerald-900">
    <div class="w-full max-w-110">
        <div class="mb-2 text-center">
            <div class="inline-flex items-center gap-3 mb-4">
                <div
                    class="h-12 w-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white text-2xl font-black italic shadow-lg shadow-emerald-200/50">
                    W</div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter">
                    Warehouse<span class="text-emerald-500 text-lg ml-0.5">•</span>
                </h1>
            </div>
        </div>

        <div
            class="bg-white rounded-4xl shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
            <div class="h-1.5 bg-emerald-500 w-full"></div>

            <div class="p-8 pb-2">
                <div class="mb-10">
                    <h2 class="text-lg font-bold text-slate-900 leading-tight">Selamat Datang</h2>
                    <p class="text-xs font-medium text-slate-400 mt-1">Silahkan login untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label
                                class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2.5 ml-1">Email</label>
                            <input type="email" name="email" placeholder="Email address"
                                class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500/50 transition-all"
                                value="{{ old('email') }}" required autofocus />
                            @error('email')
                            <p class="mt-2 text-[10px] font-bold text-red-500 flex items-center gap-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2.5 ml-1">Password</label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500/50 transition-all"
                                required />
                            @error('password')
                            <p class="mt-2 text-[10px] font-bold text-red-500 flex items-center gap-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full bg-slate-900 hover:bg-slate-800 text-white py-4 rounded-2xl text-xs font-bold tracking-[0.2em] transition-all transform active:scale-[0.98] shadow-lg shadow-slate-200">
                                LOGIN
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-slate-50/50 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-px bg-slate-100 flex-1"></div>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.3em]">Credentials</span>
                    <div class="h-px bg-slate-100 flex-1"></div>
                </div>
                <div class="flex justify-center gap-4">
                    <div
                        class="bg-white px-3 py-1.5 rounded-lg border border-slate-100 text-[10px] font-bold text-slate-400">
                        USER: <span class="text-slate-600">admin@warehouse.com</span>
                    </div>
                    <div
                        class="bg-white px-3 py-1.5 rounded-lg border border-slate-100 text-[10px] font-bold text-slate-400">
                        PASSWORD: <span class="text-slate-600">password</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center text-[10px] font-bold text-slate-600 uppercase tracking-widest">
            &copy; {{ date('Y') }} Lavanaya Madinah Travel
        </div>
    </div>
</body>

</html>