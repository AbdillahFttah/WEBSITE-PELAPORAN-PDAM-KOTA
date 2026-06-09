<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEMAS AVO - Perumdam Kota Palu</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-50 text-slate-800">

    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow border border-blue-100 overflow-hidden">
                    <img src="{{ asset('images/logo-avo.png') }}" alt="Logo Perumdam AVO" class="w-full h-full object-contain p-1">
                </div>
                <div>
                    <h1 class="font-bold text-blue-700">SIPEMAS AVO</h1>
                    <p class="text-xs text-slate-500">Sistem Informasi Pengaduan Masyarakat</p>
                </div>
            </div>

            <a href="{{ route('login') }}"
               class="px-5 py-2 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                Login Admin
            </a>
        </div>
    </nav>

    <section class="pt-32 pb-20 bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex px-4 py-2 rounded-full bg-white/15 border border-white/20 text-sm mb-5">
                    Layanan Pengaduan Digital Perumdam AVO Kota Palu
                </span>

                <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6 max-w-2xl">
                    Sampaikan Pengaduan Air Bersih dengan Mudah dan Cepat
                </h1>

                <p class="text-blue-50 text-base md:text-lg mb-8 leading-relaxed max-w-xl">
                    SIPEMAS AVO membantu masyarakat Kota Palu menyampaikan laporan kendala layanan air bersih secara online,
                    cepat, transparan, dan mudah ditindaklanjuti oleh admin Perumdam AVO.
                </p>

                <a href="#form-pengaduan"
                class="inline-block px-8 py-4 rounded-2xl bg-white text-blue-700 font-bold shadow-xl hover:scale-105 transition">
                    Buat Pengaduan Sekarang
                </a>
            </div>

            <div class="relative">
                <div class="absolute -top-8 -left-8 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                <div class="bg-white/15 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-3xl p-6 text-blue-700 shadow-xl">
                            <p class="text-sm font-semibold text-slate-500">Laporan Masuk</p>
                            <h2 class="text-4xl font-extrabold mt-3 counter" data-target="{{ $totalMasuk }}">0</h2>
                        </div>

                        <div class="bg-white rounded-3xl p-6 text-emerald-600 shadow-xl">
                            <p class="text-sm font-semibold text-slate-500">Laporan Selesai</p>
                            <h2 class="text-4xl font-extrabold mt-3 counter" data-target="{{ $totalSelesai }}">0</h2>
                        </div>
                    </div>

                    <div class="mt-6 bg-white/20 rounded-3xl p-6">
                        <p class="font-semibold">Status Layanan</p>
                        <p class="text-blue-50 text-sm mt-2">
                            Data statistik diperbarui berdasarkan laporan yang tersimpan di sistem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="form-pengaduan" class="py-20">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-blue-700">
                    Form Pengaduan Masyarakat
                </h2>
                <p class="text-slate-500 mt-3">
                    Isi data berikut dengan benar agar petugas dapat menindaklanjuti laporan Anda.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl border border-blue-100 p-8">
                <form action="{{ route('complaints.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nomor Meter</label>
                            <input type="text" name="no_meter" value="{{ old('no_meter') }}"
                                class="w-full rounded-2xl border-slate-200 border px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Contoh: 123456789" required>

                            @error('no_meter')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Pelapor</label>
                            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                                class="w-full rounded-2xl border-slate-200 border px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Nama lengkap" required>

                            @error('nama_pelapor')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                            class="w-full rounded-2xl border-slate-200 border px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Contoh: 082190001933" required>

                        @error('no_hp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Alamat</label>
                        <textarea name="alamat" rows="3"
                                class="w-full rounded-2xl border-slate-200 border px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Alamat lengkap pelanggan" required>{{ old('alamat') }}</textarea>

                        @error('alamat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Tanggal</label>
                        <input type="text" value="{{ now()->format('d-m-Y') }}"
                            class="w-full rounded-2xl border-slate-200 border px-4 py-3 bg-slate-100 text-slate-500"
                            readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Keterangan Keluhan</label>
                        <textarea name="keterangan" rows="5"
                                class="w-full rounded-2xl border-slate-200 border px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Contoh: Air tidak mengalir sejak pagi..." required>{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold shadow-lg hover:shadow-xl hover:scale-[1.01] transition">
                        Kirim Laporan
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 text-white pt-10">
        <div class="w-full px-10 pb-14">
            <div class="flex justify-between items-start gap-10">

                <div class="w-[52%]">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center overflow-hidden shadow">
                            <img src="{{ asset('images/logo-avo.png') }}"
                                alt="Logo Perumdam AVO"
                                class="w-full h-full object-contain p-1">
                        </div>

                        <div>
                            <h3 class="font-extrabold text-lg leading-tight">
                                SIPEMAS AVO - Perumdam Kota Palu
                            </h3>
                        </div>
                    </div>

                    <p class="text-blue-50 leading-relaxed max-w-xl">
                        SIPEMAS AVO adalah layanan pengaduan masyarakat berbasis
                        web untuk membantu pelanggan Perumdam AVO Kota Palu
                        menyampaikan keluhan layanan air bersih secara cepat, mudah,
                        dan terdata.
                    </p>

                    <div class="mt-8 border-t border-white/20 pt-8">
                        <h4 class="font-bold text-lg mb-5">Social Media</h4>

                        <div class="flex items-center gap-4">
                            <a href="https://www.instagram.com/perumdamavo?utm_source=ig_web_button_share_sheet&igsh=MWR3bjJld242ZjJ1aQ%3D%3D"
                            target="_blank"
                            class="w-11 h-11 rounded-full bg-sky-500 hover:bg-sky-400 flex items-center justify-center transition hover:scale-110"
                            title="Instagram Perumdam AVO">
                                <i class="fa-brands fa-instagram text-black text-xl"></i>
                            </a>

                            <a href="https://api.whatsapp.com/send/?phone=6282190001933&text&type=phone_number&app_absent=0"
                            target="_blank"
                            class="w-11 h-11 rounded-full bg-sky-500 hover:bg-sky-400 flex items-center justify-center transition hover:scale-110"
                            title="WhatsApp Perumdam AVO">
                                <i class="fa-brands fa-whatsapp text-black text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-[28%] ml-auto">
                    <h4 class="font-bold text-lg mb-6">Kontak</h4>

                    <div class="space-y-5 text-blue-50">
                        <div class="flex gap-4">
                            <i class="fa-solid fa-location-dot text-yellow-400 mt-1 w-5"></i>
                            <a href="https://www.google.com/maps/place/PDAM+KOTA+PALU/@-0.8856023,119.8790631,17z/data=!3m1!4b1!4m6!3m5!1s0x2d8bec2acabce647:0x4320d44e35621df2!8m2!3d-0.8856077!4d119.881638!16s%2Fg%2F11cp7k73n9?entry=tts&g_ep=EgoyMDI1MTIwOS4wIPu8ASoASAFQAw%3D%3D&skid=7ed4f02b-3271-4822-9d0e-64692af111dc"
                            target="_blank"
                            class="hover:text-white hover:underline underline-offset-4">
                                Jalan Tombolotutu No. 132 A<br>
                                Kota Palu, Provinsi Sulawesi Tengah
                            </a>
                        </div>

                        <div class="flex gap-4">
                            <i class="fa-solid fa-envelope text-yellow-400 mt-1 w-5"></i>
                            <a href="mailto:info@perumdamavo.id" class="hover:text-white hover:underline">
                                info@perumdamavo.id
                            </a>
                        </div>

                        <div class="flex gap-4">
                            <i class="fa-solid fa-phone text-yellow-400 mt-1 w-5"></i>
                            <a href="https://api.whatsapp.com/send/?phone=6282190001933&text&type=phone_number&app_absent=0"
                            target="_blank"
                            class="hover:text-white hover:underline">
                                (+62) 82190001933
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="border-t border-white/20 py-6 bg-blue-900/20">
            <div class="w-full px-10 flex justify-between gap-3 text-sm text-blue-100">
                <a href="https://perumdamavo.id/#"
                target="_blank"
                class="hover:text-white transition underline-offset-4 hover:underline">
                    Perumdam AVO Kota Palu
                </a>

                <p>&copy; Copyright {{ date('Y') }} SIPEMAS AVO</p>
            </div>
        </div>
    </footer>

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
        const counters = document.querySelectorAll('.counter');

        counters.forEach(counter => {
            const target = Number(counter.getAttribute('data-target'));
            let current = 0;
            const increment = Math.max(1, Math.ceil(target / 60));

            const updateCounter = () => {
                current += increment;

                if (current >= target) {
                    counter.textContent = target;
                } else {
                    counter.textContent = current;
                    requestAnimationFrame(updateCounter);
                }
            };

            updateCounter();
        });
    </script>
</body>
</html>