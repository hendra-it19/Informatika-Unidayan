@extends('layouts.dashboard')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    @php
        $carbon::setLocale('id');
    @endphp
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
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium text-gray-500 md:ms-2">
                            Kerja Praktek
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 py-6 shadow bg-white rounded">
            @if ($cekPendaftaran)
                <a href="{{ route('kerja-praktek.daftar') }}" class="btn-primary">Daftar KP </a>
            @else
                <a class="btn-secondary cursor-not-allowed">Sudah ada KP terdaftar</a>
            @endif
            <div class="relative overflow-x-auto rounded mt-4">
                <table style="table-layout: responsive"
                    class="w-full text-sm text-left rtl:text-right text-gray-500 border p-0.5">
                    <thead class="text-xs text-gray-100 bg-primary-500">
                        <tr>
                            <th scope="col" class="p-2 lg:p-3 px-6">
                                Tahun
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Periode Semester
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Mitra
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Pendaftar Kelompok
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Pendaftar
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tanggal Mulai
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tanggal Selesai
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
                        @forelse ($data as $r)
                            <tr class="bg-white border-b hover:bg-primary-50 text-xs">
                                <th scope="row" class="p-2 lg:p-3 px-6 text-gray-900 whitespace-nowrap uppercase">
                                    {{ $r->kerjaPraktek->tahun }}
                                </th>
                                <th scope="row" class="p-2 lg:p-3 uppercase font-normal">
                                    {{ $r->kerjaPraktek->semester }}
                                </th>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->kerjaPraktek->mitra }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->kerjaPraktek->diusulkan_oleh }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    <button data-modal-target="modal-list-pendaftar"
                                        data-modal-toggle="modal-list-pendaftar"
                                        class="py-1 px-2 bg-primary-500 text-white rounded hover:shadow-md hover:bg-primary-600 focus:bg-primary-700 focus:ring-2 focus:ring-primary-200">
                                        {{ count($r->kerjaPraktek->pendaftaran) }} Orang</button>
                                    @include('dashboard.kerja-praktek-mahasiswa.modal-list-pendaftar')
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $carbon::parse($r->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $carbon::parse($r->tanggal_selesai)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    @switch($r->status)
                                        @case('menunggu')
                                            <span class="py-1 px-2 rounded shadow text-white bg-yellow-500">Menunggu</span>
                                        @break

                                        @case('diterima')
                                            <span class="py-1 px-2 rounded shadow text-white bg-green-500">Diterima</span>
                                        @break

                                        @case('ditolak')
                                            <span class="py-1 px-2 rounded shadow text-white bg-red-500">Ditolak</span>
                                        @break
                                    @endswitch
                                </td>
                                <td class="p-2 lg:p-3 relative">
                                    <div class="flex flex-col gap-1">
                                        @switch($r->status)
                                            @case('menunggu')
                                                <form action="{{ route('kerja-praktek.batal-daftar', $r->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button onclick="return confirm('Yakin ingin menghapus pendaftaran?')"
                                                        class="btn-danger text-sm py-0.5 px-2 flex items-center justify-center h-fit gap-1">
                                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Batal
                                                    </button>
                                                </form>
                                            @break

                                            @case('diterima')
                                                <a href="{{ route('kerja-praktek.laporan', $r->kerjaPraktek->id) }}"
                                                    class="btn-primary text-sm py-0.5 px-2 flex items-center justify-center h-fit gap-1">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Lihat
                                                </a>
                                            @break

                                            @case('ditolak')
                                                @if ($cekPendaftaran)
                                                    <a href="{{ route('kerja-praktek.daftar') }}"
                                                        class="btn-primary text-nowrap text-sm py-0.5 px-2 flex items-center justify-center h-fit gap-1">
                                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                                clip-rule="evenodd" />
                                                            <path fill-rule="evenodd"
                                                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Daftar
                                                    </a>
                                                @else
                                                    <a
                                                        class="btn-secondary text-nowrap hover:cursor-not-allowed hover:shadow-none hover:bg-gray-500 text-sm py-0.5 px-2 flex items-center justify-center h-fit gap-1">
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
                                                        Daftar
                                                    </a>
                                                @endif
                                            @break
                                        @endswitch
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center" colspan="8">
                                        Tidak ada data yang dapat ditampilkan!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endsection
