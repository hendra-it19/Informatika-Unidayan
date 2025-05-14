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
                    <a href="{{ route('admin-kp.index') }}"
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


        <div class="px-4 pb-6 overflow-hidden pt-4 shadow bg-white rounded">

            <a href="{{ route('admin-kp.index') }}" class="btn-secondary mb-4 flex item-center gap-1 w-fit text-sm">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m15 19-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <h2 class="mb-3 font-semibold text-base text-gray-800">Daftar tunggu</h2>
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
                                Transkrip
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Waktu Daftar
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($uncheck as $r)
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
                                    <a href="{{ asset($r->transkrip_nilai) }}" target="_blank"
                                        class="rounded bg-primary-500 text-white py-0.5 px-2 shadow text-xs">Lihat
                                        Transkrip</a>
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $carbon::parse($r->created_at) }}
                                </td>
                                <td class="p-2 lg:p-3 relative">
                                    <div class="flex flex-col gap-1 w-fit h-fit">
                                        <form action="{{ route('admin-kp.terima', $r->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin konfirmasi penerimaan?')"
                                                class="btn-primary py-0.5 px-2 flex items-center text-sm justify-center h-fit w-fit">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Terima</span>
                                            </button>
                                        </form>
                                        <button data-modal-target="modal-tolak-{{ $r->id }}"
                                            data-modal-toggle="modal-tolak-{{ $r->id }}"
                                            class="btn-danger py-0.5 px-2 flex items-center text-sm justify-evenly h-fit w-full">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Tolak</span>
                                        </button>
                                        @include('dashboard.kerja-praktek-admin.modal-tolak')
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

            <h2 class="mb-3 font-semibold text-base text-gray-800 mt-5">Telah Diperiksa</h2>
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
                                Waktu Konfirmasi
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Status
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Catatan
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($check as $r)
                            <tr class="bg-white border-b hover:bg-primary-50 text-xs">
                                <th scope="row" class="p-2 lg:p-3 uppercase font-normal">
                                    <p class="line-clamp-2 hover:line-clamp-none"> {{ $r->mahasiswa->user->nama }}
                                    </p>
                                </th>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->mahasiswa->user->identitas }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->updated_at }}
                                </td>
                                <td class="p-2 lg:p-3">
                                    @switch($r->status)
                                        @case('diterima')
                                            <span class="py-1 px-2 rounded shadow text-white bg-green-500">Diterima</span>
                                        @break

                                        @case('ditolak')
                                            <span class="py-1 px-2 rounded shadow text-white bg-red-500">Ditolak</span>
                                        @break
                                    @endswitch
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $r->catatan }}
                                </td>
                                <td class="p-2 lg:p-3 relative">
                                    <div class="flex flex-col gap-1 w-fit h-fit">
                                        @switch($r->status)
                                            @case('diterima')
                                                <a href="{{ route('admin-kp.laporan-mahasiswa', [
                                                    'kp' => $r->kerja_praktek_id,
                                                    'mhs' => $r->mahasiswa_id,
                                                ]) }}"
                                                    class="btn-primary py-0.5 px-2 flex items-center text-sm justify-center h-fit w-fit">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>Lihat Laporan</span>
                                                </a>
                                            @break

                                            @case('ditolak')
                                                <a
                                                    class="btn-secondary hover:bg-gray-500 hover:shadow-none hover:cursor-not-allowed hover:ring-0 py-0.5 px-2 flex items-center text-sm justify-center h-fit w-fit">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>Lihat Laporan</span>
                                                </a>
                                            @break
                                        @endswitch

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
            </div>
        </section>
    @endsection
