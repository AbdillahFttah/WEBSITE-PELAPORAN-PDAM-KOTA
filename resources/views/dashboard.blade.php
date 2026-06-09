<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIPEMAS AVO Kota Palu</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                <a href="{{ route('welcome') }}"
                   class="block px-4 py-3 rounded-2xl hover:bg-white/10 transition">
                    Halaman Public
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

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-blue-800">Dashboard Admin</h2>
                    <p class="text-slate-500 mt-1">
                        Kelola laporan pengaduan masyarakat Perumdam AVO Kota Palu.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('complaints.export') }}"
                       class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition">
                        Export Excel Bulan Ini
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                        @csrf
                        <button type="submit"
                                class="px-5 py-3 rounded-2xl bg-red-600 text-white font-bold">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-100 hover:-translate-y-1 transition">
                    <p class="text-slate-500 text-sm font-semibold">Total Laporan</p>
                    <h3 class="text-4xl font-extrabold text-blue-700 mt-3">{{ $totalSemua }}</h3>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-yellow-100 hover:-translate-y-1 transition">
                    <p class="text-slate-500 text-sm font-semibold">Pending</p>
                    <h3 class="text-4xl font-extrabold text-yellow-500 mt-3">{{ $totalPending }}</h3>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-cyan-100 hover:-translate-y-1 transition">
                    <p class="text-slate-500 text-sm font-semibold">Proses</p>
                    <h3 class="text-4xl font-extrabold text-cyan-600 mt-3">{{ $totalProses }}</h3>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-emerald-100 hover:-translate-y-1 transition">
                    <p class="text-slate-500 text-sm font-semibold">Selesai</p>
                    <h3 class="text-4xl font-extrabold text-emerald-600 mt-3">{{ $totalDone }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-100 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                    <div>
                        <h3 class="text-xl font-extrabold text-blue-800">Grafik Pengaduan Bulanan</h3>
                        <p class="text-slate-500 text-sm">
                            Jumlah pengaduan masuk dalam 12 bulan terakhir.
                        </p>
                    </div>
                </div>

                <canvas id="complaintChart" height="100"></canvas>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-blue-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-xl font-extrabold text-blue-800">Manajemen Laporan</h3>
                    <p class="text-slate-500 text-sm mt-1">
                        Ubah status laporan atau hapus data jika diperlukan.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-blue-50 text-blue-800">
                            <tr>
                                <th class="px-5 py-4 text-left">No</th>
                                <th class="px-5 py-4 text-left">No Meter</th>
                                <th class="px-5 py-4 text-left">Nama</th>
                                <th class="px-5 py-4 text-left">No HP</th>
                                <th class="px-5 py-4 text-left">Alamat</th>
                                <th class="px-5 py-4 text-left">Tanggal</th>
                                <th class="px-5 py-4 text-left">Keluhan</th>
                                <th class="px-5 py-4 text-left">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($complaints as $index => $complaint)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4">
                                        {{ $complaints->firstItem() + $index }}
                                    </td>

                                    <td class="px-5 py-4 font-semibold">
                                        {{ $complaint->no_meter }}
                                    </td>

                                    <td class="px-5 py-4">
                                        {{ $complaint->nama_pelapor }}
                                    </td>

                                    <td class="px-5 py-4">
                                        {{ $complaint->no_hp }}
                                    </td>

                                    <td class="px-5 py-4 max-w-xs">
                                        {{ $complaint->alamat }}
                                    </td>

                                    <td class="px-5 py-4">
                                        {{ $complaint->tanggal->format('d-m-Y') }}
                                    </td>

                                    <td class="px-5 py-4 max-w-sm">
                                        {{ $complaint->keterangan }}
                                    </td>

                                    <td class="px-5 py-4">
                                        @if ($complaint->status === 'pending')
                                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-bold text-xs">
                                                Pending
                                            </span>
                                        @elseif ($complaint->status === 'proses')
                                            <span class="px-3 py-1 rounded-full bg-cyan-100 text-cyan-700 font-bold text-xs">
                                                Proses
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                <tr class="bg-slate-50">
                                    <td colspan="8" class="px-5 py-4">
                                        <div class="bg-white border border-slate-200 rounded-2xl p-4">
                                            <p class="font-bold text-blue-700 mb-3">
                                                Aksi Penyelesaian
                                            </p>

                                            <div class="grid md:grid-cols-4 gap-3">
                                                <form action="{{ route('complaints.updateStatus', $complaint) }}"
                                                    method="POST"
                                                    class="md:col-span-3 grid md:grid-cols-3 gap-3">
                                                    @csrf
                                                    @method('PATCH')

                                                    <select name="status"
                                                            class="rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                                        <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>
                                                            Pending
                                                        </option>
                                                        <option value="proses" {{ $complaint->status === 'proses' ? 'selected' : '' }}>
                                                            Proses
                                                        </option>
                                                        <option value="done" {{ $complaint->status === 'done' ? 'selected' : '' }}>
                                                            Done / Selesai
                                                        </option>
                                                    </select>

                                                    <select name="bagian"
                                                            class="rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                                        <option value="">Pilih Bagian</option>
                                                        <option value="teknisi" {{ $complaint->bagian === 'teknisi' ? 'selected' : '' }}>
                                                            Teknisi
                                                        </option>
                                                        <option value="administrasi" {{ $complaint->bagian === 'administrasi' ? 'selected' : '' }}>
                                                            Administrasi
                                                        </option>
                                                    </select>

                                                    <textarea name="penyelesaian"
                                                            rows="2"
                                                            placeholder="Keterangan penyelesaian"
                                                            class="rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ $complaint->penyelesaian }}</textarea>

                                                    <div class="md:col-span-3">
                                                        <button type="submit"
                                                                class="px-5 py-2 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>

                                                <form action="{{ route('complaints.destroy', $complaint) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus laporan ini?')"
                                                    class="flex md:justify-end items-start">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-5 py-2 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-10 text-center text-slate-500">
                                        Belum ada laporan pengaduan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6">
                    {{ $complaints->links() }}
                </div>
            </div>

        </main>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#2563eb'
            });
        </script>
    @endif

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