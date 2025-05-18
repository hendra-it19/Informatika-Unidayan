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
                            Kampus Merdeka
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 py-6 shadow bg-white rounded">

            <div class="w-full lg:w-1/2">
                <form action="{{ route('admin-msib.index') }}" method="get">
                    <div class="flex gap-2">
                        <input type="text" name="keyword" value="{{ $filter_keyword }}" class="input-ct">
                        <select name="tahun" class="input-ct">
                            <option value="" {{ $filter_tahun == '' ? 'selected' : '' }}>Pilih tahun</option>
                            @foreach ($tahun as $t => $value)
                                <option value="{{ $value }}" {{ $filter_tahun == $value ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                        <select name="status" class="input-ct">
                            <option value="">Pilih status</option>
                            <option value="menunggu" {{ $filter_status == 'menunggu' ? 'selected' : '' }}>Tunggu</option>
                            <option value="diterima" {{ $filter_status == 'diterima' ? 'selected' : '' }}>Terima</option>
                            <option value="ditolak" {{ $filter_status == 'ditolak' ? 'selected' : '' }}>Tolak</option>
                        </select>
                    </div>
                    <div class="flex mt-2 gap-2">
                        <button type="submit" class="btn-primary flex items-center gap-2 py-0.5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('admin-msib.index') }}" class="btn-secondary flex items-center gap-2 py-0.5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Reset</a>
                    </div>
                </form>
            </div>

            <div class="relative overflow-x-auto rounded mt-4">
                <table style="table-layout: responsive"
                    class="w-full text-sm text-left rtl:text-right text-gray-500 border p-0.5">
                    <thead class="text-xs text-gray-100 bg-primary-500">
                        <tr>
                            <th scope="col" class="p-2 lg:p-3 px-6">
                                Nim
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Nama
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Mitra
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tanggal Mulai
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Tanggal Selesai
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Berkas
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
                                    {{ $r->user->identitas }}
                                </th>
                                <th scope="row" class="p-2 lg:p-3 uppercase font-normal">
                                    {{ $r->user->nama }}
                                </th>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->mitra }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $carbon::parse($r->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $carbon::parse($r->tanggal_selesai)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    <div class="flex gap-1.5 flex-col">
                                        <a href="{{ asset($r->bukti_penerimaan) }}" target="_blank"
                                            class="py-0.5 px-3 text-blue-500 underline">Penerimaan
                                            Mitra</a>
                                        <a href="{{ asset($r->persetujuan_kampus) }}" target="_blank"
                                            class="py-0.5 px-3 text-blue-500 underline">Persetujuan
                                            Kampus</a>
                                    </div>
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
                                                <div class="flex flex-col gap-1 w-full h-fit">
                                                    <form action="{{ route('admin-msib.terima-pendaftaran', $r->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button onclick="return confirm('Yakin ingin menerima pendaftaran?')"
                                                            class="btn-primary w-full text-sm py-0.5 px-2 flex items-center justify-center h-fit gap-1">
                                                            <svg class="w-4 h-4" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                fill="currentColor" viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd"
                                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Terima
                                                        </button>
                                                    </form>
                                                    <button data-modal-target="modal-tolak-{{ $r->id }}"
                                                        data-modal-toggle="modal-tolak-{{ $r->id }}"
                                                        class="btn-danger py-0.5 px-2 flex items-center text-sm justify-evenly h-fit w-full">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span>Tolak</span>
                                                    </button>
                                                    @include('dashboard.kampus-merdeka-admin.modal-tolak')
                                                </div>
                                            @break

                                            @case('diterima')
                                                <a href="{{ route('admin-msib.detail', $r->id) }}"
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
                                                <form action="{{ route('admin-msib.batal-daftar', $r->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button onclick="return confirm('Yakin ingin menghapus pendaftaran?')"
                                                        class="btn-danger text-sm py-0.5 px-2 flex items-center justify-center h-fit gap-1">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
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
                <div id="pagination" class="mt-4">
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
