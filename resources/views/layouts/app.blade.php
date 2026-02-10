<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Warehouse System') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Nunito+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-text min-h-screen">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">
        @auth
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden" style="display: none;"></div>
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 w-72 bg-white shrink-0 border-r border-border flex flex-col shadow-sm transition-transform duration-300 ease-in-out z-50 lg:static lg:flex">
            <div class="p-8 flex items-center justify-between">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 text-2xl font-black tracking-tighter text-secondary">
                    <div class="h-10 w-10 bg-primary rounded-xl flex items-center justify-center text-white italic">
                        W</div>
                    <span>Warehouse</span>
                </a>
                <button @click="sidebarOpen = false"
                    class="lg:hidden text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto px-4 pb-8 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <div class="px-4 py-2 mt-6 text-[11px] font-bold tracking-widest text-slate-400">Data Master
                </div>
                <a href="{{ route('categories.index') }}"
                    class="{{ request()->routeIs('categories.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('suppliers.index') }}"
                    class="{{ request()->routeIs('suppliers.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="truck" class="w-5 h-5"></i>
                    <span>Supplier</span>
                </a>
                <a href="{{ route('products.index') }}"
                    class="{{ request()->routeIs('products.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('users.index') }}"
                    class="{{ request()->routeIs('users.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>User</span>
                </a>

                <div class="px-4 py-2 mt-6 text-[11px] font-bold tracking-widest text-slate-400">Operasional
                </div>
                <a href="{{ route('transactions.in.index') }}"
                    class="{{ request()->routeIs('transactions.in.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    <span>Barang Masuk</span>
                </a>
                <a href="{{ route('transactions.out.index') }}"
                    class="{{ request()->routeIs('transactions.out.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span>Barang Keluar</span>
                </a>

                <div class="px-4 py-2 mt-6 text-[11px] font-bold tracking-widest text-slate-400">Laporan</div>
                <a href="{{ route('reports.stock') }}"
                    class="{{ request()->routeIs('reports.stock') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    <span>Stok Barang</span>
                </a>
                <a href="{{ route('reports.transactions') }}"
                    class="{{ request()->routeIs('reports.transactions') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <i data-lucide="history" class="w-5 h-5"></i>
                    <span>Riwayat Transaksi</span>
                </a>
            </nav>
        </aside>
        @endauth

        <div class="flex-1 flex flex-col min-w-0">
            @auth
            <header
                class="h-20 bg-white border-b border-border flex items-center justify-between px-10 sticky top-0 z-40 shadow-sm">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden text-secondary p-2 rounded-lg hover:bg-slate-50 transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="flex items-center gap-6" x-data="{ open: false }">
                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-bold text-secondary">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] font-medium text-slate-400 italic">System Administrator</div>
                    </div>

                    <div class="relative">
                        <button @click="open = !open"
                            class="h-10 w-10 ring-2 ring-primary-light p-0.5 rounded-xl cursor-pointer hover:ring-primary transition-all overflow-hidden bg-slate-100">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=10b981&background=d1fae5"
                                alt="Avatar" class="w-full h-full object-cover rounded-lg">
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-border py-2 z-50 overflow-hidden">
                            <div class="px-4 py-2 border-b border-border mb-1 lg:hidden">
                                <div class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-slate-400">Admin</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-xs font-bold text-red-500 hover:bg-red-50 transition-colors flex items-center gap-2">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            @endauth

            <main class="flex-1 p-8">
                {{ $slot }}
            </main>
            <footer class="p-8 border-t border-border text-center bg-white/50 backdrop-blur-sm">
                <p class="text-[10px] font-bold uppercase tracking-[0.5em] text-slate-400">
                    &copy; {{ date('Y') }} PT Lavanaya Madinah Travel &bull; Warehouse System
                </p>
            </footer>

        </div>
    </div>

    <script type="module">
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '<span class="text-sm font-bold text-slate-800">Operation Successful</span>',
                text: "{{ session('success') }}",
                background: '#ffffff',
                confirmButtonColor: '#10b981',
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-(--radius-soft) border border-slate-100 shadow-xl',
                    title: 'font-sans'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '<span class="text-sm font-bold text-slate-800">System Error</span>',
                text: "{{ session('error') }}",
                background: '#ffffff',
                confirmButtonColor: '#0f172a',
                customClass: {
                    popup: 'rounded-(--radius-soft) border border-red-50 shadow-xl'
                }
            });
        @endif
    </script>

    <script>
        document.addEventListener('submit', function(e) {
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            
            if (form.getAttribute('data-confirm-delete') === 'true') {
                e.preventDefault();
                return;
            }

            if (submitBtn) {
                if (form.checkValidity()) {
                    const originalText = submitBtn.innerText;
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    submitBtn.innerHTML = 'Memproses...';
                    
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                        submitBtn.innerText = originalText;
                    }, 10000);
                }
            }
        });

        function confirmDelete(event, formId, type = 'delete') {
            event.preventDefault();
            
            let title = 'Apakah Anda yakin?';
            let text = "Data yang dihapus tidak dapat dikembalikan!";
            let confirmButtonText = 'YA, HAPUS!';
            let confirmButtonColor = '#ef4444';

            if (type === 'archive') {
                title = 'Arsipkan Data?';
                text = "Data akan dipindahkan ke tab 'Arsip' dan tidak aktif.";
                confirmButtonText = 'YA, ARSIPKAN';
                confirmButtonColor = '#f97316';
            }

            Swal.fire({
                title: `<span class="text-sm font-bold">${title}</span>`,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'CANCEL',
                reverseButtons: true,
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-(--radius-soft) border border-slate-100 shadow-xl',
                    confirmButton: 'rounded-lg px-6 py-2.5 text-xs font-bold uppercase tracking-wider',
                    cancelButton: 'rounded-lg px-6 py-2.5 text-xs font-bold uppercase tracking-wider'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>