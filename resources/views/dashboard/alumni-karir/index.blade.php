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
                            Lowongan
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div>
            <div class="w-full flex justify-between items-end">
                <form action="{{ route('alumni-karir.index') }}" method="GET">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row bg-white rounded shadow w-fit p-2">
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
                                placeholder="Kata kunci" name="keyword" value="{{ $q }}">
                        </div>
                    </div>
                    <button type="submit" class="hidden">Submit</button>
                </form>
            </div>
            <div class="relative overflow-x-auto shadow-sm rounded mt-4">
                <table style="table-layout: responsive" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-100 bg-primary-400">
                        <tr>
                            <th scope="col" class="p-3 pl-5">
                                Mitra
                            </th>
                            <th scope="col" class="p-4">
                                Pekerjaan
                            </th>
                            <th scope="col" class="p-3">
                                Batas Penerimaan
                            </th>
                            <th scope="col" class="p-3">
                                Sampul
                            </th>
                            <th scope="col" class="p-3">
                                Uploader
                            </th>
                            <th scope="col" class="p-3">
                                Tanggal Upload
                            </th>
                            <th scope="col" class="p-3">
                                Status
                            </th>
                            <th scope="col" class="p-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $r)
                            <tr class="bg-white border-b hover:bg-primary-50 text-xs">
                                <td class="p-2 pl-5">
                                    {{ $r->mitra }}
                                </td>
                                <td class="p-2">
                                    <a href="{{ route('alumni-karir.show', $r->id) }}" class="text-blue-500 underline">
                                        {{ $r->pekerjaan }}</a>
                                </td>
                                <td class="p-2">
                                    {{ $carbon::parse($r->batas_penerimaan)->format('d-m-Y') }}
                                </td>
                                <td class="p-2">
                                    <img src="@if (empty($r->foto)) https://placehold.co/100?text=? @else {{ asset($r->foto) }} @endif"
                                        alt="{{ $r->nim }}"
                                        class="w-[70px] aspect-square object-cover bg-cover rounded-sm">
                                </td>
                                <td class="p-2">
                                    {{ $r->alumni->nama }}
                                </td>
                                <td class="p-2">
                                    {{ $carbon::parse($r->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="p-2 uppercase">
                                    @if ($r->status == 'pengajuan')
                                        <span class="p-0.5 rounded bg-yellow-500 text-white">Pengajuan</span>
                                    @elseif($r->status == 'konfirmasi')
                                        <span class="p-0.5 rounded bg-primary-500 text-white">Konfirmasi</span>
                                    @elseif ($r->status == 'tolak')
                                        <span class="p-0.5 rounded bg-red-500 text-white">Tolak</span>
                                    @endif
                                </td>
                                <td class="p-2 relative">
                                    <button
                                        class="peer text-gray-800 hover:text-primary-500 focus:border-primary-200 focus:border-2 rounded">
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="M6 12h.01m6 0h.01m5.99 0h.01" />
                                        </svg>
                                    </button>
                                    <div
                                        class="absolute peer-focus:flex top-0 right-0 bg-white shadow-lg rounded p-2 hover:flex gap-1.5 hidden items-center justify-center">
                                        <form action="{{ route('alumni-karir.destroy', $r->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')"
                                                class="inline-block w-[20px] text-red-500 hover:text-red-700">
                                                <svg class="aspect-square w-full" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        @if ($r->status == 'konfirmasi' || $r->status == 'tolak')
                                            <a href="javascript:void(0)"
                                                class="inline-block w-[20px] text-green-300 cursor-not-allowed">
                                                <svg class="aspect-square w-full" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="inline-block w-[20px] text-red-300 cursor-not-allowed">
                                                <svg class="aspect-square w-full" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @else
                                            <form action="{{ route('alumni-karir.konfirmasi', $r->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('put')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin konfirmasi pengajuan?')"
                                                    class="inline-block w-[20px] text-green-500 hover:text-green-700">
                                                    <svg class="aspect-square w-full" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button data-modal-target="modal-tolak" data-modal-toggle="modal-tolak"
                                                class="inline-block w-[20px] text-red-500 hover:text-red-700">
                                                <svg class="aspect-square w-full" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <div id="modal-tolak" data-modal-backdrop="static" tabindex="-1"
                                                aria-hidden="true"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded shadow">
                                                        <div
                                                            class="flex items-center justify-between p-2 md:p-3 border-b rounded-t">
                                                            <h3 class="text-base font-semibold text-gray-900">
                                                                Konfirmasi Penolakan Publikasi Lowongan
                                                            </h3>
                                                            <button type="button"
                                                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="modal-tolak">
                                                                <svg class="w-3 h-3" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <div class="p-4 md:p-5">
                                                            <form class="space-y-4"
                                                                action="{{ route('alumni-karir.tolak', $r->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div>
                                                                    <label for="pesan"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                        Masukkan Keterangan Penolakan
                                                                    </label>
                                                                    <input type="pesan" name="pesan" id="pesan"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                                        required />
                                                                </div>
                                                                <button type="submit"
                                                                    class="w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                                    Konfirmasi
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
            @if ($p)
                <div class="w-full bg-white rounded shadow-sm mt-4 px-2 lg:px-4 py-1.5" id="pagination">
                    <div class="w-full lg:w-fit m-auto">
                        {!! $data->withQueryString()->links() !!}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section>

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
