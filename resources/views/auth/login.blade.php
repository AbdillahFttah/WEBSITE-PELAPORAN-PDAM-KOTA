<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SIPEMAS AVO Kota Palu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 flex items-center justify-center px-4">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center bg-gradient-to-br from-blue-800 to-cyan-600 text-white p-12">
            <div class="w-20 h-20 rounded-3xl bg-white flex items-center justify-center shadow-xl overflow-hidden mb-6">
                <img src="{{ asset('images/logo-avo.png') }}" alt="Logo Perumdam AVO" class="w-full h-full object-contain p-2">
            </div>

            <h1 class="text-4xl font-extrabold leading-tight mb-4">
                SIPEMAS AVO
            </h1>

            <p class="text-xl font-semibold mb-2">
                Sistem Informasi Pengaduan Masyarakat
            </p>

            <p class="text-blue-100 leading-relaxed mb-8">
                Halaman login admin untuk mengelola laporan pengaduan masyarakat Perumdam Air Minum AVO Kota Palu secara cepat, rapi, dan terorganisir.
            </p>

            <div class="space-y-3 text-sm text-blue-100">
                <p>• Kelola data pengaduan pelanggan</p>
                <p>• Ubah status laporan</p>
                <p>• Lihat grafik pengaduan</p>
                <p>• Export laporan ke Excel</p>
            </div>
        </div>

        <div class="p-8 md:p-12">
            <div class="mb-8 text-center md:text-left">
                <h2 class="text-3xl font-extrabold text-blue-700">Login Admin</h2>
                <p class="text-slate-500 mt-2">
                    Masuk untuk mengakses dashboard SIPEMAS AVO Kota Palu.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-2xl bg-green-100 text-green-700 px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan email admin">
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-600">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Ingat saya
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 font-medium"
                           href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold text-lg shadow-lg hover:scale-[1.01] transition">
                    Login
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('welcome') }}" class="text-sm text-slate-500 hover:text-blue-700">
                    ← Kembali ke halaman utama
                </a>
            </div>
        </div>
    </div>

</body>
</html>