@extends('layouts.dashboard')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    @inject('str', 'Illuminate\Support\Str')
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
                    <a href="{{ route('admin-kp.detail', $kerjaPraktek->id) }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium">
                            {{ $kerjaPraktek->mitra }}
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
                            {{ $mahasiswa->user->identitas }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 pb-6 overflow-hidden pt-4 shadow bg-white rounded relative">

            @php
                $tgl_mulai = $carbon::parse($kerjaPraktek->tanggal_mulai);
                $tgl_selesai = $carbon::parse($kerjaPraktek->tanggal_selesai);
                $tgl_sekarang = $carbon::now();
                $laporan_akhir = false;
                $laporanRutin = false;
            @endphp

            <divc class="absolute top-0 left-0 right-0 w-full flex items-center justify-center">
                @if ($tgl_sekarang >= $tgl_mulai)
                    @if ($tgl_sekarang >= $tgl_selesai)
                        @php
                            $laporan_akhir = true;
                            if (empty($laporanTerakhir)) {
                                $laporanTerakhir = $carbon::now();
                            } else {
                                $laporanTerakhir = $laporanTerakhir->tanggal;
                            }
                            if ($carbon::parse($laporanTerakhir) <= $tgl_selesai) {
                                $laporanRutin = true;
                            } else {
                                $laporanRutin = false;
                            }
                        @endphp
                        @if ($kerjaPraktek->laporan_akhir)
                            <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-green-500">
                                Kegiatan Sudah Selesai</div>
                        @else
                            <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-yellow-500">
                                Laporan Akhir Kelompok Anda
                                Belum Terisi</div>
                        @endif
                    @else
                        <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-primary-500">Kegiatan
                            Masih Berlangsung</div>
                        @php
                            $laporanRutin = true;
                        @endphp
                    @endif
                @else
                    <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-gray-500">Kegiatan Belum
                        Dimulai</div>
                    @php
                        $laporanRutin = false;
                    @endphp
                @endif
            </divc>

            <a href="{{ route('admin-kp.detail', $kerjaPraktek->id) }}"
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
                    <div> : {{ $carbon::parse($kerjaPraktek->tanggal_mulai)->format('d-m-Y') }} Sampai
                        {{ $carbon::parse($kerjaPraktek->tanggal_selesai)->format('d-m-Y') }}</div>
                </div>
                <div class="flex gap-3">
                    <div>Laporan Akhir</div>
                    <div> :
                        @if (empty($kerjaPraktek->laporan_akhir))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($kerjaPraktek->laporan_akhir) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Surat Pengantar</div>
                    <div> :
                        @if (empty($kerjaPraktek->surat_pengantar))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($kerjaPraktek->surat_pengantar) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Balasan Surat Pengantar</div>
                    <div> :
                        @if (empty($kerjaPraktek->balasan_surat_pengantar))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($kerjaPraktek->balasan_surat_pengantar) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Surat Penarikan</div>
                    <div> :
                        @if (empty($kerjaPraktek->surat_penarikan))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($kerjaPraktek->surat_penarikan) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Balasan Surat Penarikan</div>
                    <div> :
                        @if (empty($kerjaPraktek->balasan_surat_penarikan))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($kerjaPraktek->balasan_surat_penarikan) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
            </div>


            <div class="flex gap-5 justify-between md:justify-start items-start w-full border-b">
                <h2 class="mb-2 font-semibold text-base md:text-lg text-gray-800">List Laporan Kerja Praktek</h2>
            </div>


            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">

                    @foreach ($laporanStatus as $item)
                        <div
                            class="p-4 rounded-xl shadow-md border @if ($item['isi_sekarang']) border-primary-500 @elseif($item['sudah_isi']) border-green-500 @else border-gray-300 @endif bg-white">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-base">
                                    {{ $carbon::parse($item['tanggal'])->translatedFormat('l, d M Y') }}</h3>
                                @if ($item['sudah_isi'])
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded capitalize">
                                        <i class="fas fa-check mr-1"></i> {{ $item['laporan']->kehadiran }}
                                    </span>
                                @elseif ($item['isi_sekarang'])
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-primary-700 bg-primary-100 rounded">
                                        <i class="fas fa-clock mr-1"></i> Isi Sekarang
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded">
                                        <i class="fas fa-hourglass-half mr-1"></i> Belum Isi
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500">Jenis: <span
                                    class="capitalize">{{ $item['jenis_laporan'] }}</span></p>
                            @if ($item['sudah_isi'])
                                <p class="mt-2 text-sm text-gray-700 line-clamp-2 hover:line-clamp-none">
                                    {{ $item['laporan']->deskripsi }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </section>
@endsection
