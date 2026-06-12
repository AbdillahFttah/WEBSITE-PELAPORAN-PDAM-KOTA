<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Laporan - SIPEMAS AVO Kota Palu</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-white text-slate-800">

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
                   class="block px-4 py-3 rounded-2xl hover:bg-white/10 transition">
                    Dashboard
                </a>

                <a href="{{ route('complaints.manage') }}"
                   class="block px-4 py-3 rounded-2xl bg-white/15 font-semibold">
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

        <main class="flex-1 p-6 md:p-10 bg-white">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-blue-800">Kelola Laporan</h2>
                    <p class="text-slate-500 mt-1">
                        Kelola data laporan pengaduan masyarakat Perumdam AVO Kota Palu.
                    </p>
                </div>

                <a href="{{ route('complaints.export', request()->query()) }}"
                    class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition">
                        Download Excel 
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-blue-100 p-6 mb-8">
                <h3 class="text-xl font-extrabold text-blue-800 mb-4">Filter Laporan</h3>

                <form action="{{ route('complaints.manage') }}" method="GET" class="grid md:grid-cols-5 gap-4">

                    <div>
                        <label class="block text-sm font-semibold mb-2">Nama Pelapor</label>
                        <input type="text"
                            name="nama_pelapor"
                            value="{{ request('nama_pelapor') }}"
                            placeholder="Cari nama pelapor"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Bulan Laporan</label>
                        <input type="month"
                            name="bulan"
                            value="{{ request('bulan') }}"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Status</label>
                        <select name="status"
                                class="w-full rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ request('status') === 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Tanggal</label>
                        <input type="date"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="w-full rounded-xl border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="w-full px-4 py-2 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">
                            Terapkan
                        </button>

                        <a href="{{ route('complaints.manage') }}"
                        class="w-full text-center px-4 py-2 rounded-xl bg-slate-200 text-slate-700 font-bold hover:bg-slate-300 transition">
                            Reset
                        </a>
                    </div>

                </form>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-blue-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-xl font-extrabold text-blue-800">Daftar Laporan</h3>
                    <p class="text-slate-500 text-sm mt-1">
                        Ubah status laporan, isi data penyelesaian, atau hapus data jika diperlukan.
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
                                <tr class="hover:bg-slate-50 align-top">
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

                @if ($complaints->hasPages())
                    <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <p class="text-sm text-slate-500">
                            Menampilkan {{ $complaints->firstItem() }} sampai {{ $complaints->lastItem() }}
                            dari {{ $complaints->total() }} laporan
                        </p>

                        <div class="flex items-center gap-2">
                            {{-- Tombol Sebelumnya --}}
                            @if ($complaints->onFirstPage())
                                <span class="px-4 py-2 rounded-xl border border-slate-200 text-slate-300 bg-white cursor-not-allowed">
                                    ‹
                                </span>
                            @else
                                <a href="{{ $complaints->previousPageUrl() }}"
                                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 bg-white hover:bg-blue-50 hover:text-blue-700 transition">
                                    ‹
                                </a>
                            @endif

                            {{-- Nomor Halaman --}}
                            @foreach ($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                                @if ($page == $complaints->currentPage())
                                    <span class="px-4 py-2 rounded-xl bg-blue-600 text-white font-bold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                    class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 bg-white hover:bg-blue-50 hover:text-blue-700 transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Tombol Berikutnya --}}
                            @if ($complaints->hasMorePages())
                                <a href="{{ $complaints->nextPageUrl() }}"
                                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 bg-white hover:bg-blue-50 hover:text-blue-700 transition">
                                    ›
                                </a>
                            @else
                                <span class="px-4 py-2 rounded-xl border border-slate-200 text-slate-300 bg-white cursor-not-allowed">
                                    ›
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
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

</body>
</html>