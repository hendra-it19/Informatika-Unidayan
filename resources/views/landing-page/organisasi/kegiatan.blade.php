@extends('layouts.landing-page')

@section('pages')
    <main class="min-h-[100vh]">
        @inject('carbon', 'Carbon\carbon')

        <x-hero-section judul="Kegiatan" foto="{{ asset('assets/image/hero/kegiatan.webp') }}" link="/kegiatan" />


        <section class="my-10">
            <div class="custom-container mx-auto flex flex-col lg:flex-row justify-between">
                <div class="w-full lg:w-[76%]">
                    <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80 mb-6">
                        <div data-aos="fade-right" data-aos-offset="80" data-aos-delay="0" data-aos-duration="500"
                            data-aos-easing="ease-in" data-aos-mirror="false" data-aos-once="false"
                            class="flex gap-5 items-center justify-between w-full">
                            <h1 class="text-nowrap font-semibold text-lg md:text-xl text-primary-700">
                                Rilis Kegiatan Terbaru @if (!empty($param))
                                    {{ $organisasi_param->nama_organisasi }}
                                @endif
                            </h1>
                            <hr class="inline-block h-1 w-[70%] bg-yellow-300 rounded-sm lg:w-0" />
                        </div>
                    </div>
                    <div class="py-2 flex flex-col gap-3 lg:gap-4 xl:gap-5 lg:flex-row flex-wrap">
                        @forelse ($kegiatan as $r)
                            <div onclick="window.location.href='{{ url('/kegiatan-organisasi/' . $r->slug) }}'"
                                class="flex flex-row lg:flex-col gap-2.5 bg-white rounded shadow overflow-hidden p-2 w-full lg:w-48 items-center justify-start cursor-pointer group"
                                data-aos="fade-up">
                                <div class="aspect-video w-48 md:w-52 lg:w-full overflow-hidden rounded-md">
                                    <img src="{{ asset($r->foto) }}" alt="{{ $r->judul }}"
                                        class="object-cover w-full h-full hover:scale-110 group-hover:scale-110 duration-300">
                                </div>
                                <div
                                    class="pt-0 px-0.5 w-full flex flex-col gap-2 justify-between lg:justify-start lg:w-full">
                                    <a href="{{ url('/kegiatan-organisasi/' . $r->slug) }}"
                                        class="line-clamp-2 hover:underline hover:text-gray-800 capitalize text-sm lg:text-base font-semibold text-gray-700">
                                        {{ $r->judul }}
                                    </a>
                                    <div class="flex flex-col gap-1 justify-between text-gray-500 text-xs">
                                        <div class="capitalize">{{ strtolower($r->organisasi->nama_organisasi) }}</div>
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
                                data-aos-duration="500" data-aos-easing="ease-in" data-aos-mirror="false"
                                data-aos-once="false">
                                <p>Tidak ada data yang dapat ditampilkan!</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="w-full mt-4 px-2 lg:px-4 py-1.5" id="pagination">
                        <div class="w-full lg:w-fit m-auto">
                            {!! $kegiatan->withQueryString()->links() !!}
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-[28%] overflow-x-hidden lg:mt-0 mt-8">
                    <div class="rounded p-0 lg:p-4 lg:pt-0 bg-white" id="sidebar">
                        <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80 mb-3">
                            <div class="flex gap-5 items-center justify-between w-full" data-aos="fade-right"
                                data-aos-offset="80" data-aos-delay="0" data-aos-duration="500" data-aos-easing="ease-in"
                                data-aos-mirror="false" data-aos-once="false">
                                <h1 class="text-nowrap font-semibold text-lg md:text-xl text-primary-700">
                                    Daftar Organisasi
                                </h1>
                                <hr class="inline-block h-1 w-full bg-yellow-300 rounded-sm" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <a href="{{ url('/kegiatan-organisasi') }}"
                                class="flex gap-2 items-center group hover:underline hover:text-primary-500 text-gray-700"
                                data-aos="fade-left" data-aos-once="true">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Semua</span>
                            </a>
                            @forelse ($organisasi as $r)
                                <a href="{{ url('/kegiatan-organisasi?organisasi=' . $r->slug) }}"
                                    class="flex gap-2 items-center group hover:underline hover:text-primary-500 text-gray-700"
                                    data-aos="fade-left" data-aos-once="true">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $r->nama_organisasi }}</span>
                                </a>
                            @empty
                                <a class="text-gray-500 text-sm">Belum organisasi terdaftar</a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="p-5 block"></div>
    </main>
@endsection

@push('css')
    <style>
        #pagination nav div.flex {
            font-size: 12px !important;
            font-weight: 100 !important;
        }

        #pagination nav div div p {
            font-size: 10pt !important;
            margin-right: 10px !important;
        }

        #pagination nav div div span,
        #pagination nav div div a {
            border-radius: 4px !important;
            margin-left: 1px !important;
        }

        #pagination nav div a,
        #pagination nav div span {
            font-size: 12px !important;
            border-radius: 4px !important;
        }
    </style>
@endpush
