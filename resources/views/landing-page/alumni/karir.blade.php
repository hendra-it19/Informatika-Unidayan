@extends('layouts.landing-page')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <main class="min-h-[100vh]">

        <x-hero-section judul="Karir" foto="{{ asset('assets/image/hero/karir.webp') }}" link="{{ url('/karir') }}" />

        <section class="custom-container mx-auto mt-5 lg:mt-10 scroll-smooth scroll-mt-8" id="filter">
            <div class="flex flex-col md:flex-row gap-5 lg:gap-10">
                <div class="w-full md:w-[35%] md:max-w-72 overflow-hidden">
                    <div class="flex items-center justify-between gap-3">
                        <h1 class="text-nowrap text-primary-700" data-aos="fade-right">Filter & Pencarian</h1>
                        <hr class="h-1 w-full bg-yellow-300" data-aos="fade-left">
                    </div>
                    <div>
                        <h2 class="text-gray-600 text-sm mb-3" data-aos="zoom-in">Ditampilkan {{ $ditampilkan }} dari
                            {{ $total }}</h2>
                    </div>
                    <div>
                        <form action="{{ url('/karir') }}" method="GET">
                            <div class="text-sm lg:text-base flex md:flex-col gap-3 mb-5">
                                <input type="search" name="keyword" placeholder="Kata Kunci"
                                    class="py-1.5 px-2 rounded w-full text-sm" value="{{ $keyword }}">
                            </div>
                            <button type="submit"
                                class="text-center py-1 w-full bg-gray-700 hover:bg-gray-800 duration-300 text-gray-50 rounded flex items-center justify-center gap-2">
                                <span>Cari</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>
                            </button>
                            <a href="{{ url('/karir') }}"
                                class="mt-2 w-full block py-1 border-[1.5px] text-center border-gray-700 rounded text-gray-700 hover:bg-gray-600 hover:text-white">
                                Reset Filter
                            </a>
                        </form>
                    </div>
                </div>
                <div class="px-0 md:px-4 mb-10 lg:mb-14">
                    <div class="flex flex-wrap gap-3 justify-evenly">
                        @foreach ($data as $r)
                            <div
                                class="rounded-lg shadow bg-white h-fit flex flex-col items-center justify-start w-40 md:w-36 overflow-hidden p-2">
                                <div class="rounded overflow-hidden w-full aspect-square">
                                    <img src="{{ $r->foto ?? 'https://placehold.co/480x484?text=?' }}"
                                        alt="{{ $r->pekerjaan }}"
                                        class="hover:scale-110 duration-300 transition-all cursor-pointer w-full h-full object-cover">
                                </div>
                                <div class="text-sm text-gray-700 text-center mt-1 w-full">
                                    <p class="text-wrap mt-1 font-semibold">{{ $r->pekerjaan }}</p>
                                    <div class="text-xs mt-1">
                                        <p class="text-gray-600">IPK {{ $r->mitra }}</p>
                                        <p class="text-gray-500">{{ $r->nim }}</p>
                                        <div class="w-full mt-1">
                                            <button data-modal-target="static-modal-{{ $r->id }}"
                                                data-modal-toggle="static-modal-{{ $r->id }}"
                                                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-1 text-center mt-2 w-full"
                                                type="button">
                                                Lihat Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main modal -->
                            <div id="static-modal-{{ $r->id }}" data-modal-backdrop="static" tabindex="-1"
                                aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Detail Pekerjaan
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="static-modal-{{ $r->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <div>
                                                <h1 class="text-xl font-semibold relative w-fit h-fit">
                                                    <span class="inline-block text-wrap">{{ $r->pekerjaan }}</span>
                                                </h1>
                                                <p class="text-gray-500 -mt-1 block">di {{ $r->mitra }}</p>


                                                <p class="mt-2 text-sm">Postingan pekerjaan di upload oleh
                                                    {{ $r->alumni->nama }}
                                                </p>
                                                <p class="text-sm inline">Batas lamaran hingga
                                                    {{ $carbon->parse($r->batas_penerimaan)->format('d-m-Y') }}
                                                </p>
                                                <div class="text-xs text-white -mt-1 inline-block h-fit w-fit">
                                                    @if ($carbon::now() <= $carbon::parse($r->batas_penerimaan))
                                                        <p class="block py-0.5 px-1 h-fit bg-green-400 rounded w-fit">
                                                            Buka</p>
                                                    @else
                                                        <p class="block py-1 px-1 h-fit bg-red-400 rounded w-fit">Tutup
                                                        </p>
                                                    @endif
                                                </div>

                                            </div>
                                            <p class="mt-3 text-sm">Deskrisi : </p>
                                            <p class="text-sm">
                                                {!! $r->deskripsi !!}
                                            </p>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center pb-5 rounded-b dark:border-gray-600">
                                            <button data-modal-hide="static-modal-{{ $r->id }}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-50 focus:outline-none bg-gray-600 rounded border border-gray-200 hover:bg-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                Tutup Modal Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        @if ($p)
                            <div class="w-full bg-white rounded shadow-sm mt-4 px-2 lg:px-4 py-1.5" id="pagination">
                                <div class="w-full lg:w-fit m-auto">
                                    {!! $data->withQueryString()->links() !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
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
