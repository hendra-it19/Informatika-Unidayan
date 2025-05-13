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
                    <a href="{{ route('pemeriksaan-ta.index') }}"
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
                        <span class="pb-0.5 border-b-green-500">Diterima</span>
                    @break

                    @case(3)
                        <span class="pb-0.5 border-b-red-500">Ditolak</span>
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
                        <th scope="col" class="p-2 border">Tujuan</th>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td class="p-2 border">1</td>
                            <td class="p-2 border">{{ $data->judul1 }}</td>
                            <td class="p-2 border">{{ $data->tujuan1 }}</td>
                        </tr>
                        <tr scope="row">
                            <td class="p-2 border">2</td>
                            <td class="p-2 border">{{ $data->judul2 }}</td>
                            <td class="p-2 border">{{ $data->tujuan2 }}</td>
                        </tr>
                        <tr scope="row">
                            <td class="p-2 border">3</td>
                            <td class="p-2 border">{{ $data->judul3 }}</td>
                            <td class="p-2 border">{{ $data->tujuan3 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1 class="mt-4">Berikut hasil pemeriksaan dari para verifikator TA</h1>
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


            <h1 class="mt-5">Berikut hasil keputusan akhir dari pengajuan judul anda</h1>
            <div class="pl-3">
                @if (empty($hasil))
                    <p class="text-gray-600">Belum ada hasil yang diberikan</p>
                @else
                    <div>
                        <p>Status :</p>
                        <p
                            class="block w-fit h-fit py-0.5 px-4 text-white rounded @if ($hasil->status == 'terima') bg-green-700
                            @elseif($hasil->status == 'tolak') bg-red-700 @elseif ($hasil->status == 'revisi') bg-yellow-700 @endif">
                            {{ $hasil->status }}</p>
                        <p>Keterangan Tambahan : </p>
                        <p>{{ $hasil->pesan }}</p>
                    </div>
                @endif
            </div>


            <div class="mt-10 flex
            gap-4 items-center">
                <x-form.button-back :url="route('pengajuan-ta.index')" />
            </div>
        </div>
    </section>
@endsection
