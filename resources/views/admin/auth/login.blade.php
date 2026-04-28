<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen bg-stone-100 text-stone-900">
    <div class="mx-auto flex min-h-screen max-w-6xl items-center px-6 py-12">
        <div class="grid w-full gap-8 rounded-[28px] bg-white p-8 shadow-xl lg:grid-cols-[1.1fr_0.9fr] lg:p-12">
            <div class="rounded-[24px] bg-stone-900 p-8 text-white">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-emerald-300">Dynamic Store Admin</p>
                <h1 class="mt-6 max-w-lg text-4xl font-black leading-tight">Control content, pages, products, posts, and settings from one panel.</h1>
                <p class="mt-6 max-w-md text-sm leading-7 text-stone-300">Seeded accounts after migration: `superadmin@sunnahstore.test`, `admin@sunnahstore.test`, and `editor@sunnahstore.test`. Default password: `password`.</p>
            </div>

            <div class="flex items-center">
                <form action="{{ route('admin.login.store') }}" method="POST" class="w-full space-y-5">
                    @csrf
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-700">Welcome back</p>
                        <h2 class="mt-2 text-3xl font-black">Admin login</h2>
                    </div>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900" required>
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold">Password</span>
                        <input type="password" name="password" class="w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900" required>
                    </label>
                    <label class="flex items-center gap-3 text-sm text-stone-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-stone-300">
                        <span>Remember me</span>
                    </label>
                    <button type="submit" class="w-full rounded-2xl bg-stone-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-stone-800">Sign in</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Login failed',
                text: @json($errors->first()),
                confirmButtonColor: '#111827',
            });
        @endif
    </script>
</body>
</html>
