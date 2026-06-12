<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIPEMAS AVO Kota Palu</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-gradient-to-b from-blue-700 to-blue-900 text-white p-6 hidden md:block">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center overflow-hidden shadow">
                    <img src="{{ asset('images/logo-avo.png') }}" alt="Logo Perumdam AVO" class="w-full h-full object-contain p-1">
                </div>
                <div>
                    <h1 class="font-extrabold text-xl">SIPEMAS AVO</h1>
                    <p class="text-blue-200 text-sm">Sistem Informasi Pengaduan Masyarakat</p>
                </div>
            </div>

            <nav class="space-y-3">
                <a href="{{ route('dashboard') }}"
                   class="block px-4 py-3 rounded-2xl bg-white/15 font-semibold">
                    Dashboard
                </a>

                <a href="{{ route('complaints.manage') }}"
                   class="block px-4 py-3 rounded-2xl hover:bg-white/10 transition">
                    Kelola Laporan
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-2xl hover:bg-white/10 transition">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-6 md:p-10">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-blue-800">Dashboard Admin</h2>
                <p class="text-slate-500 mt-1">
                    Ringkasan laporan pengaduan masyarakat Perumdam AVO Kota Palu.
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-100">
                    <p class="text-slate-500 text-sm font-semibold">Total Laporan</p>
                    <h3 class="text-4xl font-extrabold text-blue-700 mt-3">{{ $totalSemua }}</h3>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-yellow-100">
                    <p class="text-slate-500 text-sm font-semibold">Pending</p>
                    <h3 class="text-4xl font-extrabold text-yellow-500 mt-3">{{ $totalPending }}</h3>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-cyan-100">
                    <p class="text-slate-500 text-sm font-semibold">Proses</p>
                    <h3 class="text-4xl font-extrabold text-cyan-600 mt-3">{{ $totalProses }}</h3>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-emerald-100">
                    <p class="text-slate-500 text-sm font-semibold">Selesai</p>
                    <h3 class="text-4xl font-extrabold text-emerald-600 mt-3">{{ $totalDone }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-100">
                <div class="mb-6">
                    <h3 class="text-xl font-extrabold text-blue-800">Grafik Pengaduan Bulanan</h3>
                    <p class="text-slate-500 text-sm">
                        Jumlah pengaduan masuk dalam 12 bulan terakhir.
                    </p>
                </div>

                <canvas id="complaintChart" height="100"></canvas>
            </div>

        </main>
    </div>

    <script>
        const ctx = document.getElementById('complaintChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: @json($monthlyData),
                    borderWidth: 2,
                    borderRadius: 12,
                    backgroundColor: 'rgba(37, 99, 235, 0.75)',
                    borderColor: 'rgba(37, 99, 235, 1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>