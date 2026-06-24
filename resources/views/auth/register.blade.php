<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('components.navbar')

    <main class="flex items-center justify-center min-h-[80vh] px-4 py-10">
        <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

            <h1 class="text-2xl font-bold text-slate-900 text-center">Buat Akun Baru</h1>
            <p class="text-slate-500 text-center mt-2 mb-6">Daftar untuk mulai memesan kamar kos</p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4 mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required autofocus
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Nomor WhatsApp</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Kampus</label>
                    <input type="text" name="kampus" value="{{ old('kampus') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-indigo-600 py-3 text-white font-semibold hover:bg-indigo-700 transition">
                    Daftar
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk di sini</a>
            </p>

        </div>
    </main>

    @include('components.footer')
</body>
</html>