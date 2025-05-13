@extends('layouts.landing-page')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <main class="min-h-[100vh]">

        <x-hero-section judul="Alumni" foto="{{ asset('assets/image/hero/wisudawan.webp') }}" link="{{ url('/alumni') }}" />

        <section class="custom-container mx-auto mt-5 lg:mt-10 scroll-smooth scroll-mt-8" id="filter">
            <div class="flex flex-col md:flex-row gap-5 lg:gap-10">
                <div class="w-full md:w-[35%] md:max-w-72 overflow-hidden">
                    <div class="flex items-center justify-between gap-3">
                        <h1 class="text-nowrap text-primary-700" data-aos="fade-right">Filter & Pencarian</h1>
                        <hr class="h-1 w-full bg-yellow-300" data-aos="fade-left">
                    </div>
                    <div>
                        <h2 class="text-gray-600 text-sm mb-3"data-aos="zoom-in">Ditampilkan {{ $ditampilkan }} dari
                            {{ $total }}</h2>
                    </div>
                    <div>
                        <form action="{{ url('/alumni') }}" method="GET">
                            <div class="text-sm lg:text-base flex md:flex-col gap-3 mb-5">
                                <input type="search" name="nama" placeholder="Nama Alumni"
                                    class="py-1.5 px-2 rounded w-full text-sm" value="{{ $nama }}">
                                <select name="tahun_lulus" class="py-1.5 px-2 text-sm rounded">
                                    <option value="">Tahun Lulus</option>
                                    @foreach ($data_tahun_lulus as $r => $value)
                                        @if ($value == $tahun_lulus)
                                            <option value="{{ $value }}" selected>Tahun {{ $value }}</option>
                                        @endif
                                        <option value="{{ $value }}">Tahun {{ $value }}</option>
                                    @endforeach
                                </select>
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
                            <a href="{{ url('/alumni') }}"
                                class="mt-2 w-full block py-1 border-[1.5px] text-center border-gray-700 rounded text-gray-700 hover:bg-gray-600 hover:text-white">
                                Reset Filter
                            </a>
                        </form>
                    </div>

                </div>
                <div class="px-0 w-full md:px-4 mb-10 lg:mb-14">
                    <div
                        class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 2xl:grid-cols-7">
                        @forelse ($data as $r)
                            <div data-aos="fade-up"
                                class="rounded shadow-md bg-gray-50 h-fit flex flex-col justify-start overflow-hidden group p-4 border-t-[4px] border-t-gray-700">
                                <div>
                                    <a href="#">
                                        <h5
                                            class="mb-1.5 text-sm lg:text-base line-clamp-2 group-hover:line-clamp-none font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $r->nama }}
                                        </h5>
                                    </a>
                                    <p
                                        class="mb-2.5 font-normal text-gray-700 text-xs line-clamp-4 group-hover:line-clamp-none">
                                        Angkatan tahun {{ $r->tahun_masuk }} dengan status masuk sebagai
                                        <span
                                            class="">{{ $r->status_masuk == 'maba' ? 'Mahasiswa Baru' : 'Mahasiswa Integrasi' }}</span>
                                    </p>
                                    <a href="javascript:void(0)" data-modal-target="modal-detail-{{ $r->id }}"
                                        data-modal-toggle="modal-detail-{{ $r->id }}"
                                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-gray-700 rounded hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 text-nowrap">
                                        Lihat Detail
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </a>
                                    {{-- modal --}}
                                    @include('landing-page.alumni.modal-detail')
                                    {{-- end of modal --}}
                                </div>
                            </div>
                        @empty
                            <div class="h-full w-full flex items-center justify-center">
                                <p class="text-gray-700 text-sm lg:text-base">Tidak ada data yang dapat
                                    ditampilkan!
                                </p>
                            </div>
                        @endforelse
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
