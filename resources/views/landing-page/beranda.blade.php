@extends('layouts.landing-page')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <main class="min-h-[200vh]">

        <x-slider-section :carousel="$carousel" />

        <x-sambutan-prodi-section />

        <x-menu-section />

        {{-- kegiatan --}}
        <section class="-mt-12 md:-mt-10 w-full overflow-x-hidden">
            <div class="w-full custom-container m-auto">
                <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80">
                    <div data-aos="fade-right" data-aos-offset="80" data-aos-delay="0" data-aos-duration="400"
                        data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                        class="flex gap-5 items-center justify-between w-full">
                        <h1 class="text-nowrap font-semibold text-lg md:text-xl lg:text-2xl text-primary-700">
                            Rilis Kegiatan Terbaru
                        </h1>
                        <hr class="inline-block h-1 w-full bg-yellow-300 rounded-sm" />
                    </div>
                    <a data-aos="fade-left" data-aos-offset="80" data-aos-delay="0" data-aos-duration="400"
                        data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                        href="{{ url('/kegiatan') }}"
                        class="hidden lg:flex text-primary-800 hover:text-primary-500 items-center gap-3 border-b-2 border-b-primary-800 pb-2 pt-4">
                        <span class="text-nowrap">Lihat kegiatan lainnya</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
                <div class="py-2 flex flex-col gap-3 lg:gap-4 xl:gap-5 lg:flex-row">
                    @forelse ($kegiatan as $r)
                        <div onclick="window.location.href='{{ url('/kegiatan/' . $r->slug) }}'"
                            class="flex flex-row lg:flex-col gap-2.5 bg-white rounded shadow overflow-hidden p-2 w-full lg:w-48 items-center justify-start cursor-pointer group"
                            data-aos="zoom-in" data-aos-offset="80" data-aos-delay="0" data-aos-duration="400"
                            data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false">
                            <div class="flex-shrink-0 aspect-video w-36 md:w-52 lg:w-full overflow-hidden rounded-md">
                                <img src="{{ asset($r->foto) }}" alt="{{ $r->judul }}"
                                    class="object-cover w-full h-full hover:scale-110 group-hover:scale-110 duration-300">
                            </div>
                            <div class="pt-0 px-0.5 flex flex-col gap-2 justify-between lg:justify-start lg:w-full">
                                <a href="{{ url('/kegiatan/' . $r->slug) }}"
                                    class="line-clamp-2 hover:underline hover:text-gray-800 capitalize text-sm lg:text-base font-semibold text-gray-700">
                                    {{ $r->judul }}
                                </a>
                                <div class="flex flex-col gap-1 justify-between text-gray-500 text-xs">
                                    <div class="capitalize">{{ strtolower($r->kategori->nama) }}</div>
                                    <div class="flex gap-1 items-center">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                        </svg>
                                        <span>{{ $carbon::parse($r->created_at)->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-700 text-sm" data-aos="zoom-in" data-aos-offset="80" data-aos-delay="0"
                            data-aos-duration="400" data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false">
                            <p>Tidak ada data yang dapat ditampilkan!</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ url('/kegiatan') }}" data-aos="fade-left" data-aos-offset="80" data-aos-delay="0"
                    data-aos-duration="400" data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                    class="flex lg:hidden justify-between text-primary-800 hover:text-primary-500 border-b-2 border-b-primary-800 py-1">
                    <span>Lihat kegiatan lainnya</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a>
            </div>
        </section>

        {{-- alumni --}}
        <section class="mt-10 relative">
            <img src="{{ asset('assets/image/motif/2rounded-left.png') }}" alt="motif"
                class="absolute left-0 z-[-1] -top-40 h-52 lg:h-72 opacity-25">
            <div class="w-full overflow-x-hidden">
                <div class="w-full custom-container m-auto">
                    <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80">
                        <div data-aos="fade-right" data-aos-offset="80" data-aos-delay="0" data-aos-duration="400"
                            data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                            class="flex gap-5 items-center justify-between w-full">
                            <h1 class="text-nowrap font-semibold text-lg md:text-xl lg:text-2xl text-primary-700">
                                Daftar Alumni
                            </h1>
                            <hr class="inline-block h-1 w-full bg-yellow-300 rounded-sm" />
                        </div>
                        <a data-aos="fade-left" data-aos-offset="80" data-aos-delay="0" data-aos-duration="400"
                            data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                            href="{{ url('/alumni') }}"
                            class="hidden lg:flex text-primary-800 hover:text-primary-500 items-center gap-3 border-b-2 border-b-primary-800 pb-2 pt-4">
                            <span class="text-nowrap">Lihat alumni lainnya</span>
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                    <div class="w-full">
                        <div
                            class="overflow-hidden hover:overflow-x-auto mt-3 flex gap-3 lg:gap-4 xl:gap-5 flex-nowrap snap-x snap-mandatory">
                            @forelse ($alumni as $r)
                                <div data-aos="zoom-in" data-aos-offset="80" data-aos-delay="0" data-aos-duration="400"
                                    data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                                    class="flex-shrink-0 flex flex-col w-36 gap-2 bg-white rounded shadow overflow-hidden p-1 lg:p-2 items-center justify-start group my-1">
                                    <div class="aspect-square w-full overflow-hidden rounded-md">
                                        <img src="{{ empty($r->foto) ? 'https://placehold.co/480?text=?' : asset($r->foto) }}"
                                            alt="{{ $r->nama }}"
                                            class="object-cover w-full h-full hover:scale-110 group-hover:scale-110 duration-300"
                                            loading="lazy">
                                    </div>
                                    <div class="pt-0 px-0.5 flex flex-col gap-2 justify-start w-full">
                                        <a href="javascript:void(0)"
                                            class="line-clamp-2 text-sm lg:text-base font-semibold text-gray-700">
                                            {{ $r->nama }}
                                        </a>
                                        <div class="flex flex-row justify-between text-gray-500 text-xs">
                                            <div class="flex gap-0.5 items-center">
                                                <svg class="w-3.5 h-3.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M3 15v4m6-6v6m6-4v4m6-6v6M3 11l6-5 6 5 5.5-5.5" />
                                                </svg>
                                                <span>{{ $r->ipk }} | {{ $r->tahun_lulus }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="text-gray-700 text-sm" data-aos="zoom-in" data-aos-offset="80"
                                    data-aos-delay="0" data-aos-duration="400" data-aos-easing="ease-in"
                                    data-aos-mirror="false" data-aos-once="false">
                                    <p>Tidak ada data yang dapat ditampilkan!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <a href="{{ url('/alumni') }}" data-aos="fade-left" data-aos-offset="80" data-aos-delay="0"
                        data-aos-duration="400" data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                        class="flex lg:hidden justify-between text-primary-800 hover:text-primary-500 border-b-2 border-b-primary-800 py-1">
                        <span>Lihat alumni lainnya</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- kampus --}}
        <section class="mt-16 relative">
            <img src="{{ asset('assets/image/motif/2rounded-right.png') }}" alt="motif"
                class="absolute right-0 z-[-1] -top-32 h-52 lg:h-72 opacity-30">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="w-full h-full bg-primary-900 lg:relative">
                    <div class="h-full w-full object-cover bg-cover max-h-[350px] lg:max-h-[421.5px] overflow-hidden">
                        <img src="{{ asset('assets/image/component/gedung-teknik.jpg') }}" alt="gedung teknik"
                            class="object-cover w-full h-full hover:scale-105 duration-300">
                    </div>
                    <div
                        class="bg-yellow-300 rounded-sm text-gray-900 p-5 block relative w-full lg:p-10 lg:absolute lg:bottom-0 lg:w-[60%] lg:max-w-sm lg:left-0">
                        <div class="mb-3 lg:mb-5" data-aos="zoom-in" data-aos-offset="30" data-aos-delay="0"
                            data-aos-duration="400" data-aos-easing="ease-in" data-aos-mirror="false"
                            data-aos-once="false">
                            <h3 class="font-bold text-lg lg:text-xl mb-3 lg:mb-5">Tentang Informatika Unidayan</h3>
                            <p class="lg:text-lg">Program studi dengan minat terbanyak setiap tahun dan sejalan dengan
                                peningkatan teknologi
                                informasi dan komunikasi yang ada saat ini.</p>
                        </div>
                        <div class="text-sm mb-1 text-gray-700 group hover:text-gray-800" data-aos="fade-right"
                            data-aos-offset="30" data-aos-delay="0" data-aos-duration="400" data-aos-easing="ease-in"
                            data-aos-mirror="false" data-aos-once="false">
                            <div class="flex justify-between ">
                                <a href="{{ url('/tentang-kami') }}" class="lg:font-bold">
                                    SELENGKAPNYA
                                </a>
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </div>
                            <div class="h-0.5 w-full bg-gray-700 group-hover:bg-gray-800"></div>
                        </div>
                    </div>
                </div>
                <div class="h-full w-full">
                    <div class="grid grid-cols-2">
                        <div class="overflow-hidden h-full w-full">
                            <img src="{{ asset('assets/image/component/mahasiswa.jpg') }}" alt="kegiatan informatika"
                                class="w-full h-full object-cover hover:scale-105 duration-300">
                        </div>
                        <div class="bg-primary-900 p-4 lg:p-6 w-full h-full text-gray-200 overflow-hidden">
                            <div class="w-fit h-fit m-auto pt-4 md:pt-0">
                                <div data-aos="zoom-in" data-aos-offset="30" data-aos-delay="0" data-aos-duration="400"
                                    data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false">
                                    <h3 class="mb-2 font-semibold text-lg lg:text-xl">Studi</h3>
                                    <p class="text-sm lg:text-base">Memberikan peluang kepada para mahasiswa untuk
                                        mengembangkan
                                        minat dan
                                        bakat di berbagai bidang teknologi</p>
                                </div>
                                <div class="mt-3 group text-gray-50 hover:text-gray-400" data-aos="fade-right"
                                    data-aos-offset="30" data-aos-delay="0" data-aos-duration="400"
                                    data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false">
                                    <div class="flex justify-between text-sm tracking-wider mb-1">
                                        <a href="{{ url('/organisasi') }}" class="lg:font-semibold">
                                            SELENGKAPNYA
                                        </a>
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </div>
                                    <div class="h-0.5 w-full bg-gray-50 group-hover:bg-gray-400"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="bg-primary-900 p-4 lg:p-6 w-full h-full text-gray-200 overflow-hidden">
                            <div class="w-fit h-fit m-auto">
                                <div data-aos="zoom-in" data-aos-offset="30" data-aos-delay="0" data-aos-duration="400"
                                    data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false">
                                    <h3 class="mb-2 font-semibold text-lg lg:text-xl">Alumni</h3>
                                    <p class="text-sm lg:text-base">
                                        Tracking alumni dan juga kesempatan penyebaran informasi karir bagi para lulusan
                                        baru
                                    </p>
                                </div>
                                <div class="mt-3 group text-gray-50 hover:text-gray-400" data-aos="fade-right"
                                    data-aos-offset="30" data-aos-delay="0" data-aos-duration="400"
                                    data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false">
                                    <div class="flex justify-between text-sm tracking-wider mb-1">
                                        <a href="{{ url('/alumni') }}" class="lg:font-semibold">
                                            SELENGKAPNYA
                                        </a>
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </div>
                                    <div class="h-0.5 w-full bg-gray-50 group-hover:bg-gray-400"></div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-hidden h-full w-full">
                            <img src="{{ asset('assets/image/wisudawan.webp') }}" alt="wisuda unidayan"
                                class="w-full h-full object-cover hover:scale-105 duration-300">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- mitra --}}
        <section class="w-full overflow-x-hidden overflow-y-hidden bg-white bg-opacity-50 mt-20 mb-32">
            <div class="text-center custom-container mt-6">
                <h2 class="text-primary-700 font-semibold text-xl lg:text-2xl mb-2" data-aos="fade-up">Mitra Kami</h2>
                <div data-aos="zoom-in">
                    <p>Kolaborasi dalam menciptakan SDM yang berkualitas</p>
                    <p>dan memenuhi kebutuhan industri</p>
                </div>
            </div>
            <div class="px-6 md:px-12 lg:px-16 w-full max-w-screen-lg m-auto mt-5">
                <div class="wrapper">
                    <div class="item item1">
                    </div>
                    <div class="item item2"></div>
                    <div class="item item3"></div>
                    <div class="item item4"></div>
                    <div class="item item5"></div>
                    <div class="item item6"></div>
                    <div class="item item7"></div>
                    <div class="item item8"></div>
                </div>
            </div>
        </section>


        {{-- unggulan --}}
        <section class="px-5 relative">
            <div class="w-full max-w-screen-lg bg-gray-700 m-auto p-4 lg:p-8 rounded-sm shadow -mb-10" data-aos="fade-up"
                data-aos-offset="100" data-aos-delay="0" data-aos-duration="500" data-aos-easing="ease-in"
                data-aos-mirror="false" data-aos-once="false">
                <div
                    class="grid grid-cols-2 lg:grid-cols-4 gap-5 justify-around items-start text-white text-sm lg:text-base">
                    <div class="flex flex-col gap-2 items-center justify-start text-center">
                        <img src="{{ asset('assets/image/icons/display-code.png') }}" alt="icon komputer"
                            class="w-4 lg:w-6">
                        <div>
                            2 Laboratorium penunjang dalam kegiatan prakter mahasiswa
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 items-center justify-start text-center">
                        <img src="{{ asset('assets/image/icons/features.png') }}" alt="icon fitur" class="w-4 lg:w-6">
                        <div>
                            4 Bidang fokus Keilmuan sesuai minat dan bakat para mahasiswa
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 items-center justify-start text-center">
                        <img src="{{ asset('assets/image/icons/workshop.png') }}" alt="icon pengajar"
                            class="w-4 lg:w-6">
                        <div>
                            Tenaga pengajar yang profesional
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 items-center justify-start text-center">
                        <img src="{{ asset('assets/image/icons/user-headset.png') }}" alt="icon pelayanan"
                            class="w-4 lg:w-6">
                        <div>
                            Pelayanan cepat dan menjadi sistem penunjang informasi yang utama
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@push('css')
    <style>
        .wrapper {
            width: 100%;
            margin-inline: auto;
            position: relative;
            height: 100px;
            overflow: hidden;
        }

        .wrapper:hover .item {
            animation-play-state: paused;
            cursor: pointer;
        }

        @keyframes scrollLeft {
            to {
                left: -200px;
            }
        }

        .item {
            width: 200px;
            height: 100px;
            background-color: red;
            border-radius: 6px;
            position: absolute;
            left: max(calc(200px * 8), 100%);
            animation-name: scrollLeft;
            animation-duration: 30s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        .item1 {
            animation-delay: calc(30s / 8 * (8 - 1) * -1);
        }

        .item2 {
            animation-delay: calc(30s / 8 * (8 - 2) * -1);
        }

        .item3 {
            animation-delay: calc(30s / 8 * (8 - 3) * -1);
        }

        .item4 {
            animation-delay: calc(30s / 8 * (8 - 4) * -1);
        }

        .item5 {
            animation-delay: calc(30s / 8 * (8 - 5) * -1);
        }

        .item6 {
            animation-delay: calc(30s / 8 * (8 - 6) * -1);
        }

        .item7 {
            animation-delay: calc(30s / 8 * (8 - 7) * -1);
        }

        .item8 {
            animation-delay: calc(30s / 8 * (8 - 8) * -1);
        }
    </style>
@endpush
