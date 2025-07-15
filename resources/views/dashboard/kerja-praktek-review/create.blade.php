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
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium text-gray-500 md:ms-2">
                            Kegiatan Prodi
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 py-6 shadow bg-white rounded">
            <div class="w-full flex justify-between items-end">
                <form action="{{ route('admin-kp.index') }}" method="GET">
                    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row w-fit p-2">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-3 h-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="table-search-users"
                                class="block px-2 py-1 ps-10 text-sm text-gray-900 rounded w-72 bg-gray-50 focus:ring-primary-500 focus:border-primary-500 outline-none border-gray-300"
                                placeholder="Kata kunci" name="keyword" value="{{ $keyword }}">
                        </div>
                    </div>
                    <button type="submit" class="hidden">Submit</button>
                </form>
                <a href="{{ route('admin-kp.create') }}">
                    <x-input.button-add text="Tambah">
                        <svg class="me-2 h-3.5 aspect-square" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                                clip-rule="evenodd" />
                        </svg>
                    </x-input.button-add>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-sm rounded mt-4">
                <table style="table-layout: responsive" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-100 bg-primary-500">
                        <tr>
                            <th scope="col" class="p-2 lg:p-3 px-6">
                                No
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Mitra
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tahun
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Semester
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tanggal Mulai
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tanggal Selesai
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Registrasi Oleh
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Pending
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Diterima
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
                                    {{ ++$i }}
                                </th>
                                <th scope="row" class="p-2 lg:p-3 uppercase font-normal">
                                    <p class="line-clamp-2 hover:line-clamp-none"> {{ $r->mitra }}</p>
                                </th>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->tahun }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->semester }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $carbon::parse($r->tanggal_mulai)->format('d-m-Y') }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $carbon::parse($r->tanggal_selesai)->format('d-m-Y') }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $r->diusulkan_oleh }}
                                </td>
                                <td class="p-2 lg:p-3 w-5">
                                    <span
                                        class="font-semibold py-0.5 px-2 bg-yellow-500 text-white rounded-lg shadow-md">{{ count($r->pendaftaran) }}</span>
                                </td>
                                <td class="p-2 lg:p-3">
                                    <span
                                        class="font-semibold py-0.5 px-2 bg-green-500 text-white rounded-lg shadow-md">{{ count($r->kelompok) }}</span>
                                </td>
                                <td class="p-2 lg:p-3 relative">
                                    <a href="{{ route('admin-kp.detail', $r->id) }}"
                                        class="btn-primary py-0.5 px-2 flex items-center text-sm justify-center h-fit w-fit">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>Kelola</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-center" colspan="10">
                                    Tidak ada data yang dapat ditampilkan!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div id="pagination">
                <div class="w-full lg:w-fit m-auto">
                    {!! $data->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </section>
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
