@extends('layouts.dashboard')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <section class="min-h-screen">
        <nav class="mt-4 mb-6 xl:mb-10 flex px-5 py-2 text-gray-700 rounded bg-white shadow-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse text-xs xl:text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ url('/dashboard') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="w-2.5 h-2.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <a href="{{ route('review-kerja-praktek.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium">
                            Kerja Praktek
                        </span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium text-gray-500 md:ms-2 capitalize">
                            {{ $data->mitra }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 pb-6 overflow-hidden pt-4 shadow bg-white rounded relative">

            @php
                $tgl_mulai = $carbon::parse($data->tanggal_mulai);
                $tgl_selesai = $carbon::parse($data->tanggal_selesai);
                $tgl_sekarang = $carbon::now();
                $laporan_akhir = false;
                $laporanRutin = false;
            @endphp

            <div class="absolute top-0 left-0 right-0 w-full flex items-center justify-center">
                @if ($tgl_sekarang >= $tgl_mulai)
                    @if ($tgl_sekarang >= $tgl_selesai)
                        @if ($data->laporan_akhir)
                            <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-green-500">
                                Kegiatan Sudah Selesai</div>
                        @else
                            <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-yellow-500">
                                Laporan Akhir
                                Belum Terisi</div>
                        @endif
                    @else
                        <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-primary-500">Kegiatan
                            Masih Berlangsung</div>
                    @endif
                @else
                    <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-gray-500">Kegiatan Belum
                        Dimulai</div>
                    @php
                        $laporanRutin = false;
                    @endphp
                @endif
            </div>

            <a href="{{ route('review-kerja-praktek.index') }}"
                class="btn-secondary mb-4 flex item-center gap-1 w-fit text-sm">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m15 19-7-7 7-7" />
                </svg>
                Kembali
            </a>

            <div
                class="grid grid-cols-1 gap-2 mb-5 md:grid-cols-2 items-start place-items-start text-xs md:text-sm text-nowrap">
                <div class="flex gap-3">
                    <div>Waktu Kegiatan</div>
                    <div> : {{ $carbon::parse($data->tanggal_mulai)->format('d-m-Y') }} Sampai
                        {{ $carbon::parse($data->tanggal_selesai)->format('d-m-Y') }}</div>
                </div>
                <div class="flex gap-3">
                    <div>Laporan Akhir</div>
                    <div> :
                        @if (empty($data->laporan_akhir))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($data->laporan_akhir) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Surat Pengantar</div>
                    <div> :
                        @if (empty($data->surat_pengantar))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($data->surat_pengantar) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Balasan Surat Pengantar</div>
                    <div> :
                        @if (empty($data->balasan_surat_pengantar))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($data->balasan_surat_pengantar) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Surat Penarikan</div>
                    <div> :
                        @if (empty($data->surat_penarikan))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($data->surat_penarikan) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Balasan Surat Penarikan</div>
                    <div> :
                        @if (empty($data->balasan_surat_penarikan))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($data->balasan_surat_penarikan) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
            </div>

            <h2 class="mb-3 font-semibold text-base text-gray-800">Daftar mahasiswa</h2>

            <div class="relative overflow-x-auto shadow-sm rounded">
                <table style="table-layout: responsive" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-100 bg-primary-500">
                        <tr>
                            <th scope="col" class="p-2 lg:p-3">
                                Nama
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                NIM
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                SKS Tempuh
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Waktu Daftar
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Status
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftaran as $r)
                            <tr class="bg-white border-b hover:bg-primary-50 text-xs">
                                <th scope="row" class="p-2 lg:p-3 uppercase font-normal">
                                    <p class="line-clamp-2 hover:line-clamp-none"> {{ $r->mahasiswa->user->nama }}
                                    </p>
                                </th>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->mahasiswa->user->identitas }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->sks_ditempuh }} SKS
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $carbon::parse($r->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    @if ($r->status == 'diterima')
                                        <span class="py-0.5 px-2 bg-green-500 text-white rounded shadow">
                                            {{ $r->status }}</span>
                                    @elseif($r->status == 'ditolak')
                                        <span class="py-0.5 px-2 bg-red-500 text-white rounded shadow">
                                            {{ $r->status }}</span>
                                    @else
                                        <span class="py-0.5 px-2 bg-gray-500 text-white rounded shadow">
                                            {{ $r->status }}</span>
                                    @endif
                                </td>
                                <td class="p-2 lg:p-3 relative">
                                    <div class="flex flex-col gap-1 w-fit h-fit">
                                        @if ($r->status == 'diterima')
                                            <a class="flex gap-1 item-center justify-center rounded py-1 px-3 bg-primary-500 text-white hover:shadow hover:bg-primary-600 focus:bg-primary-700 focus:ring-2 focus:ring-primary-200"
                                                href="{{ route('review-kerja-praktek.laporan', [
                                                    'kp' => $data->id,
                                                    'mahasiswa' => $r->mahasiswa_id,
                                                ]) }}">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                        clip-rule="evenodd" />
                                                    <path fill-rule="evenodd"
                                                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Kelola</span>
                                            </a>
                                        @else
                                            <a
                                                class="flex gap-1 item-center justify-center rounded py-1 px-3 bg-gray-400 text-gray-50 cursor-not-allowed">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Laporan
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-center" colspan="6">
                                    Tidak ada data yang dapat ditampilkan!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

    </section>
@endsection
