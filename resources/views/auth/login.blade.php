<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('components.navbar')

    <main class="flex items-center justify-center min-h-[80vh] px-4">
        <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

            <h1 class="text-2xl font-bold text-slate-900 text-center">Masuk ke Akun</h1>
            <p class="text-slate-500 text-center mt-2 mb-6">Silakan login untuk memesan kamar</p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4 mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded">
                        Ingat saya
                    </label>
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-indigo-600 py-3 text-white font-semibold hover:bg-indigo-700 transition">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Daftar di sini</a>
            </p>

        </div>
    </main>

    @include('components.footer')
</body>
</html>