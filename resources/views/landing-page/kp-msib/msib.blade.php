@extends('layouts.landing-page')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <main class="min-h-[100vh]">

        <x-hero-section judul="MSIB Kampus Merdeka" foto="{{ asset('assets/image/hero/mbkm.webp') }}"
            link="{{ url('/msib') }}" />

        <section class="mb-10 mt-5 lg:mt-10 relative">
            <div class="custom-container mx-auto flex flex-col lg:flex-row justify-between">

                <div class="w-full min-h-[100px] h-fit pb-4 lg:w-[70%] lg:border-r-2 lg:pr-6 overflow-hidden">
                    <div>
                        <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80 mb-6">
                            <div data-aos="fade-right" class="flex gap-5 items-center justify-between w-full">
                                <h1 class="text-nowrap font-semibold text-lg md:text-xl text-primary-700">
                                    MSIB Kampus Merdeka
                                </h1>
                                <hr class="inline-block h-1 w-[70%] bg-yellow-300 rounded-sm lg:w-0" />
                            </div>
                        </div>
                        <div>
                            <h5 class="font-semibold" data-aos="fade-up" data-aos-once="true">
                                Halo, Mahasiswa Informatika!
                            </h5>
                            <p class="text-sm md:text-base" data-aos="fade-up" data-aos-once="true">
                                Selamat datang di halaman Magang & Studi Independen Bersertifikat (MSIB). Program ini
                                merupakan bagian dari Kampus Merdeka yang memberikan kesempatan kepada mahasiswa untuk
                                mendapatkan pengalaman nyata di dunia industri dan institusi pendidikan. Mari manfaatkan
                                program ini untuk memperluas wawasan, membangun koneksi, dan meningkatkan daya saing di
                                dunia kerja!
                            </p>
                        </div>
                        <a href="#syarat" class="btn-primary mt-4 block w-fit" data-aos="fade-up" data-aos-once="true">
                            Lihat Syarat & Ketentuan
                        </a>
                    </div>

                    {{-- Bagian MSIB --}}
                    <div class="mt-10 space-y-14">

                        {{-- Manfaat MSIB --}}
                        <div class="space-y-6">
                            <h2 data-aos="fade-up" class="text-2xl font-bold text-primary-700 flex items-center gap-2">
                                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Manfaat Mengikuti MSIB
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach (['Pengalaman kerja nyata di perusahaan atau lembaga ternama.', 'Meningkatkan kompetensi dan skill sesuai kebutuhan industri.', 'Kesempatan membangun portofolio dan relasi profesional.', 'Konversi SKS dari aktivitas pembelajaran di luar kampus.'] as $manfaat)
                                    <div data-aos="fade-up" class="flex items-start gap-3">
                                        <div class="text-green-600 mt-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-700 text-sm md:text-base">{{ $manfaat }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- timeline --}}
                        <div data-aos="fade-up" class="space-y-6">
                            <h2 class="text-2xl font-bold text-primary-700 flex items-center gap-2">
                                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                </svg>
                                Alur Kegiatan MSIB
                            </h2>
                            <div class="relative border-l border-primary-300 pl-6 space-y-6">
                                @foreach ([['Registrasi & Pendaftaran', 'Mahasiswa mendaftar dan mengisi data lengkap.'], ['Verifikasi & Penempatan', 'Dosen pembimbing menyetujui, lalu mahasiswa ditempatkan di mitra.'], ['Kegiatan Lapangan', 'Mahasiswa mulai mengikuti program sesuai jadwal.'], ['Monitoring & Laporan', 'Mengisi laporan harian dan mingguan secara berkala.'], ['Evaluasi & Penilaian', 'Dosen dan mitra memberikan evaluasi akhir.']] as $i => [$judul, $deskripsi])
                                    <div class="relative" data-aos="fade-left">
                                        <div
                                            class="absolute left-[-14px] top-1 w-4 h-4 bg-primary-600 rounded-full border-4 border-white">
                                        </div>
                                        <h4 class="font-semibold text-primary-700">{{ $judul }}</h4>
                                        <p class="text-gray-700 text-sm">{{ $deskripsi }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        {{-- Syarat dan Ketentuan --}}
                        <div class="space-y-6 scroll-mt-10 lg:scroll-mt-48" id="syarat">
                            <h2 data-aos="fade-up" class="text-2xl font-bold text-primary-700 flex items-center gap-2">
                                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 16l-4-4 4-4m8 8l4-4-4-4M12 20V4" />
                                </svg>
                                Syarat & Ketentuan MSIB
                            </h2>
                            <ul class="list-decimal pl-6 space-y-2 text-gray-700 text-sm md:text-base">
                                <li data-aos="fade-up">Mahasiswa aktif minimal semester 5.</li>
                                <li data-aos="fade-up">IPK minimal 3.0 atau sesuai ketentuan mitra.</li>
                                <li data-aos="fade-up">Mengisi data dan berkas lengkap di platform Kampus Merdeka.</li>
                                <li data-aos="fade-up">Lolos seleksi dari pihak mitra penyelenggara.</li>
                                <li data-aos="fade-up">Komitmen mengikuti program selama satu semester penuh.</li>
                            </ul>
                            <a data-aos="fade-up"
                                href="{{ asset('upload/Panduan-Pendaftaran-Magang-Studi-Independen-Bersertifikat.pdf') }}"
                                target="_blank"
                                class="inline-block mt-4 px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded shadow transition">
                                Unduh Panduan MSIB
                            </a>
                        </div>

                        {{-- Mitra --}}
                        <div data-aos="fade-up" class="space-y-6" data-aos-once="true">
                            <h2 class="text-2xl font-bold text-primary-700 flex items-center gap-2">
                                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 0l7 7-7 7" />
                                </svg>
                                Mitra Kerja Sama
                            </h2>
                            <div class="relative overflow-hidden border rounded-lg bg-white shadow-sm p-4">
                                <div class="flex w-max animate-slide group-hover:[animation-play-state:paused]">
                                    @php
                                        $logos = $mitra;
                                        $doubledLogos = array_merge($logos, $logos);
                                    @endphp
                                    @foreach ($doubledLogos as $logo)
                                        <img src="{{ asset($logo) }}" alt="Mitra"
                                            class="h-16 w-auto object-contain rounded-xl grayscale hover:grayscale-0 transition duration-300 mx-8">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Sidebar (tidak diubah) --}}
                <div class="w-full overflow-x-hidden lg:w-[30%] lg:mt-0 mt-8 relative">
                    <div class="rounded p-0 lg:p-4 lg:pt-0 bg-white" id="sidebar">
                        <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80">
                            <div class="flex gap-5 items-center justify-between w-full" data-aos="fade-left"
                                data-aos-offset="80" data-aos-delay="0" data-aos-duration="500"
                                data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="true">
                                <h1 class="text-nowrap font-semibold text-lg md:text-xl text-primary-700">
                                    Postingan Terbaru
                                </h1>
                                <hr class="inline-block h-1 w-full bg-yellow-300 rounded-sm" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 lg:gap-0.5 pb-4 py-2">
                            @forelse ($kegiatanTerbaru as $r)
                                <div onclick="window.location.href='{{ url('/kegiatan/' . $r->slug) }}'"
                                    class="flex flex-row gap-2.5 bg-white rounded shadow lg:shadow-sm overflow-hidden p-0.5 w-full justify-start cursor-pointer group items-center"
                                    data-aos="fade-left" data-aos-once="true">
                                    <div class="aspect-video w-40 md:w-52 overflow-hidden rounded">
                                        <img src="{{ asset($r->foto) }}" alt="{{ $r->judul }}"
                                            class="object-cover w-full h-full hover:scale-110 group-hover:scale-110 duration-300">
                                    </div>
                                    <div
                                        class="pt-0 px-0.5 flex flex-col gap-2 lg:gap-0.5 justify-center items-start w-full">
                                        <a href="{{ url('/kegiatan/' . $r->slug) }}"
                                            class="line-clamp-2 hover:underline hover:text-gray-800 capitalize text-sm lg:text-xs font-semibold text-gray-700">
                                            {{ $r->judul }}
                                        </a>
                                        <div class="flex flex-col gap-1 justify-between text-gray-500 text-[10px]">
                                            <div>{{ $r->kategori->nama }}</div>
                                            <div class="flex gap-1 items-center">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                                </svg>
                                                <span>{{ $carbon::parse($r->created_at)->format('d-m-Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">Belum ada postingan</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('css')
    <style>
        @keyframes slide {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-slide {
            animation: slide 30s linear infinite;
        }
    </style>
@endpush
