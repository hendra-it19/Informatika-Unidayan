@extends('layouts.landing-page')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <main>

        <x-hero-section judul="Organisasi" foto="{{ asset('assets/image/hero/organisasi.webp') }}" link="/kegiatan" />


        <section class="mb-10 mt-5 lg:mt-10 relative">
            <div class="custom-container mx-auto flex flex-col lg:flex-row justify-between">
                <div class="w-full min-h-[100px] lg:w-[70%] lg:border-r-2 lg:pr-6">
                    <div>
                        <div class="mb-2">
                            <img src="{{ asset($data->logo) }}" alt="logo {{ $data->nama_organisasi }} png"
                                class="w-[50px] lg:w-[70px] m-auto">
                            <h1 class="text-center text-xl lg:text-2xl text-gray-800">{{ $data->nama_organisasi }}</h1>
                        </div>
                        <div class="konten mb-5">
                            {!! $data->keterangan_tambahan !!}
                        </div>
                        <img src="{{ asset($data->foto) }}" alt="foto {{ $data->nama_organisasi }} png"
                            class="rounded-sm w-full aspect-video object-cover bg-cover mb-8">

                        <div class="mb-5">
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <caption
                                        class="text-lg mb-2 font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                        Riwayat Struktural
                                        <p class="mt-1 text-sm font-normal text-gray-500">
                                            Berikut daftar atau riwayat struktur kepengurusan organisasi
                                            {{ $data->nama_organisasi }}
                                            dari masa kemasa disertai dengan Surat Keterangan (SK)
                                        </p>
                                    </caption>
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">
                                                Ketua
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Wakil Ketua
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Sekretaris
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Bendahara
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Periode
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-right">
                                                SK
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($struktural as $row)
                                            <tr class="bg-white border-b text-xs">
                                                <th scope="row"
                                                    class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $row->ketua }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $row->wakil }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $row->sekretaris }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $row->bendahara }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $row->awal_jabatan }} sampai {{ $row->akhir_jabatan }}
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <a href="{{ asset($row->sk) }}" download
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b text-xs">
                                                <td class="px-6 py-4 text-center text-gray-600" colspan="6">
                                                    Tidak ada data yang dapat ditampilkan!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- side --}}
                <div class="w-full overflow-x-hidden lg:w-[30%] lg:mt-0 mt-8 relative">
                    <div class="rounded p-0 lg:p-4 lg:pt-0 bg-white" id="sidebar">
                        <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80">
                            <div class="flex gap-5 items-center justify-between w-full" data-aos="fade-left"
                                data-aos-offset="80" data-aos-delay="0" data-aos-duration="500" data-aos-easing="ease-in"
                                data-aos-mirror="false" data-aos-once="false">
                                <h1 class="text-nowrap font-semibold text-lg md:text-xl text-primary-700">
                                    Kegiatan Organisasi
                                </h1>
                                <hr class="inline-block h-1 w-full bg-yellow-300 rounded-sm" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 lg:gap-0.5 pb-4 py-2">
                            @forelse ($kegiatanTerbaru as $r)
                                <div onclick="window.location.href='{{ url('/kegiatan-organisasi/' . $r->slug) }}'"
                                    class="flex flex-row gap-2.5 bg-white rounded shadow lg:shadow-sm overflow-hidden p-0.5 w-full justify-start cursor-pointer group items-center"
                                    data-aos="fade-left">
                                    <div class="aspect-video w-40 md:w-52 overflow-hidden rounded">
                                        <img src="{{ asset($r->foto) }}" alt="{{ $r->judul }}"
                                            class="object-cover w-full h-full hover:scale-110 group-hover:scale-110 duration-300">
                                    </div>
                                    <div
                                        class="pt-0 px-0.5 flex flex-col gap-2 lg:gap-0.5 justify-center items-start w-full">
                                        <a href="{{ url('/kegiatan-organisasi/' . $r->slug) }}"
                                            class="line-clamp-2 hover:underline hover:text-gray-800 capitalize text-sm lg:text-xs font-semibold text-gray-700">
                                            {{ $r->judul }}
                                        </a>
                                        <div class="flex flex-col gap-1 justify-between text-gray-500 text-[10px]">
                                            <div>{{ $r->organisasi->nama_organisasi }}</div>
                                            <div class="flex gap-1 items-center">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
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

        <div class="p-10 block"></div>
    </main>
@endsection
@push('css')
    <style>
        .konten ul li {
            list-style-type: disc;
            list-style-position: inside;
        }

        .konten ol li {
            list-style-type: decimal;
            list-style-position: inside;
        }
    </style>
@endpush
