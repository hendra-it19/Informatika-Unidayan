@extends('layouts.dashboard')

@section('pages')
    <section class="min-h-screen">

        <nav class="mt-4 mb-6 flex px-5 py-2 text-gray-700 rounded bg-white shadow-sm" aria-label="Breadcrumb">
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
                <li class="inline-flex items-center">
                    <a href="{{ route('pengajuan-ta.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Pemeriksaan TA
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
                            Detail
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8">
            <div class="mb-4">
                @switch($data->step)
                    @case(0)
                        <span class="pb-0.5 border-b-2 border-b-yellow-500">Pengajuan</span>
                    @break

                    @case(1)
                        <span class="pb-0.5 border-b-2 border-b-gray-800">Pemeriksaan</span>
                    @break

                    @case(2)
                        <span class="pb-0.5 border-b-2 border-b-green-500">Diterima</span>
                    @break

                    @case(3)
                        <span class="pb-0.5 border-b-2 border-b-red-500">Ditolak</span>
                    @break

                    @default
                        -
                @endswitch
            </div>
            <div>
                <table class="text-xs md:text-sm table table-fixed text-left">
                    <thead>
                        <th scope="col" class="p-2 border">No.</th>
                        <th scope="col" class="p-2 border">Judul Tugas Akhir</th>
                        <th scope="col" class="p-2 border">Abstrak</th>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td class="p-2 border">1</td>
                            <td class="p-2 border">{{ $data->judul1 }}</td>
                            <td class="p-2 border">{{ $data->abstrak1 }}</td>
                        </tr>
                        <tr scope="row">
                            <td class="p-2 border">2</td>
                            <td class="p-2 border">{{ $data->judul2 }}</td>
                            <td class="p-2 border">{{ $data->abstrak2 }}</td>
                        </tr>
                        <tr scope="row">
                            <td class="p-2 border">3</td>
                            <td class="p-2 border">{{ $data->judul3 }}</td>
                            <td class="p-2 border">{{ $data->abstrak3 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="mt-5 text-lg font-semibold">Berikut hasil pemeriksaan dari para verifikator TA</h2>
            @php
                $no = 1;
            @endphp
            @forelse ($pemeriksaan as $data)
                <div class="mt-3 pl-3 text-xs md:text-sm">
                    <p>{{ $no++ }}. {{ $data->getVerifikator->nama }} ({{ $data->getVerifikator->role }})</p>
                    <table class="table table-fixed">
                        <thead>
                            <th class="border p-2">Urutan Judul</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Keterangan Tambahan</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2">Judul Pertama</td>
                                <td class="border p-2">{{ $data->status1 }}</td>
                                <td class="border p-2">{{ $data->pesan1 }}</td>
                            </tr>
                            <tr>
                                <td class="border p-2">Judul Kedua</td>
                                <td class="border p-2">{{ $data->status2 }}</td>
                                <td class="border p-2">{{ $data->pesan2 }}</td>
                            </tr>
                            <tr>
                                <td class="border p-2">Judul Ketiga</td>
                                <td class="border p-2">{{ $data->status3 }}</td>
                                <td class="border p-2">{{ $data->pesan3 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @empty
                <p class="pl-3 text-gray-600">Belum ada pemeriksaan</p>
            @endforelse


            <h2 class="font-semibold text-lg mt-5">Keputusan akhir sistem</h2>
            @if (empty($ta))
                @if ($data->step == 3)
                    <p class="text-red-600 mt-3">Berdasarkan hasil pemeriksaan para verifikator, judul anda telah
                        ditolak!.</p>
                @else
                    <p class="text-gray-600 mt-3">Judul belum terverifikasi!</p>
                @endif
            @else
                <div class="mt-3">
                    <div class="relative overflow-x-auto border sm:rounded">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 w-fit">
                                        Judul Tugas Akhir
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $ta->judul }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 w-fit">
                                        Abstrak
                                    </th>
                                    <td class="px-6 py-4 text-wrap">
                                        <p class="text-wrap">{{ $ta->abstrak }}</p>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 w-fit">
                                        Pembimbing Utama
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $ta->pembimbing_utama?->nama }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 w-fit">
                                        Pembimbing Pendamping
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $ta->pembimbing_pendamping?->nama }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif


            <div class="mt-10 flex
            gap-4 items-center">
                <x-form.button-back :url="route('pengajuan-ta.index')" />
            </div>
        </div>
    </section>
@endsection
