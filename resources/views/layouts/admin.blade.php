@php
    use App\Support\AdminNavigation;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-stone-100 text-stone-900">
    <div class="min-h-screen lg:flex">
        <aside class="w-full border-b border-stone-200 bg-white lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r" x-data="{ open: false }">
            <div class="flex items-center justify-between px-6 py-5">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Admin Panel</p>
                    <h1 class="mt-1 text-xl font-black text-stone-900">The Sunnah Store</h1>
                </div>
                <button class="rounded-lg border border-stone-200 p-2 lg:hidden" @click="open = !open"><i data-lucide="menu" class="h-5 w-5"></i></button>
            </div>
            <nav class="space-y-1 px-3 pb-6 lg:block" :class="{ 'hidden': !open }">
                @foreach(AdminNavigation::items(auth()->user()) as $item)
                    @php($isActive = request()->routeIs(str_contains($item['route'], '.index') ? str_replace('.index', '.*', $item['route']) : $item['route']))
                    <a href="{{ route($item['route']) }}" class="{{ $isActive ? 'bg-stone-900 text-white' : 'text-stone-700 hover:bg-stone-100' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold">
                        <i data-lucide="{{ $item['icon'] }}" class="h-4 w-4"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="flex-1">
            <header class="border-b border-stone-200 bg-white px-6 py-4">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-stone-500">@yield('eyebrow', 'Content management')</p>
                        <h2 class="text-2xl font-black tracking-tight text-stone-900">@yield('heading', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-stone-100 px-4 py-2 text-sm">
                            <span class="font-semibold">{{ auth()->user()->name }}</span>
                            <span class="text-stone-500">({{ auth()->user()->role->label() }})</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-stone-300 px-4 py-2 text-sm font-semibold text-stone-700 hover:bg-stone-100">
                                <i data-lucide="log-out" class="h-4 w-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            document.querySelectorAll('form[data-confirm]').forEach((form) => {
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    const result = await Swal.fire({
                        title: form.dataset.confirmTitle || 'Delete this item?',
                        text: form.dataset.confirm || 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        confirmButtonColor: '#b91c1c',
                    });

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            @if(session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 2600,
                    timerProgressBar: true,
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Please review the form',
                    text: @json($errors->first()),
                    confirmButtonColor: '#111827',
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
