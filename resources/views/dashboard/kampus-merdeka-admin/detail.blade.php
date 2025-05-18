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
                    <a href="{{ route('kerja-praktek.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium">
                            Kampus Merdeka
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
                            {{ $msib->mitra }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 pb-6 overflow-hidden pt-4 shadow bg-white rounded relative">

            @php
                $tgl_mulai = $carbon::parse($msib->tanggal_mulai);
                $tgl_selesai = $carbon::parse($msib->tanggal_selesai);
                $tgl_sekarang = $carbon::now();
                $laporan_akhir = false;
                $laporanRutin = false;
            @endphp

            <divc class="absolute top-0 left-0 right-0 w-full flex items-center justify-center">
                @if ($tgl_sekarang >= $tgl_mulai)
                    @if ($tgl_sekarang > $tgl_selesai)
                        @php
                            if (empty($laporanTerakhir)) {
                                $laporanTerakhir = $tgl_mulai;
                            } else {
                                $laporanTerakhir = $laporanTerakhir->tanggal;
                            }
                            if ($carbon::parse($laporanTerakhir) < $tgl_selesai) {
                                $laporanRutin = true;
                                $laporan_akhir = false;
                            } elseif ($carbon::parse($laporanTerakhir) == $tgl_selesai) {
                                $laporanRutin = true;
                                $laporan_akhir = true;
                            } else {
                                $laporanRutin = false;
                                $laporan_akhir = false;
                            }
                        @endphp
                        @if ($msib->laporan_akhir)
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
                        @php
                            $laporanRutin = true;
                        @endphp
                    @endif
                @else
                    <div class="py-1 px-4 text-xs md:text-sm rounded-b-md shadow-md text-white bg-gray-500">Kegiatan Belum
                        Dimulai</div>
                    @php
                        $laporanRutin = false;
                        $laporan_akhir = false;
                    @endphp
                @endif
            </divc>

            <a href="{{ route('kerja-praktek.index', $msib->id) }}"
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
                    <div> : {{ $carbon::parse($msib->tanggal_mulai)->format('d-m-Y') }} Sampai
                        {{ $carbon::parse($msib->tanggal_selesai)->format('d-m-Y') }}</div>
                </div>
                <div class="flex gap-3">
                    <div>Laporan Akhir</div>
                    <div> :
                        @if (empty($msib->laporan_akhir))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($msib->laporan_akhir) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Bukti Penerimaan</div>
                    <div> :
                        @if (empty($msib->bukti_penerimaan))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($msib->bukti_penerimaan) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <div>Persetujuan Kampus</div>
                    <div> :
                        @if (empty($msib->persetujuan_kampus))
                            <span class="capitalize text-gray-600 italic text-xs">Belum dilengkapi</span>
                        @else
                            <a href="{{ asset($msib->persetujuan_kampus) }}" target="_blank"
                                class="text-blue-500 underline italic">Lihat</a>
                        @endif
                    </div>
                </div>
            </div>


            <div class="flex gap-5 justify-between md:justify-start items-start w-full border-b">
                <h2 class="mb-2 font-semibold text-base md:text-lg text-gray-800">List Laporan Kerja Praktek</h2>
                <div><small>(Belum Terisi - {{ $sisaLaporan }} Laporan)</small></div>
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
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-{{ $item['laporan']->kehadiran == 'hadir' ? 'green' : 'yellow' }}-700 bg-{{ $item['laporan']->kehadiran == 'hadir' ? 'green' : 'yellow' }}-100 rounded capitalize">
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
                            @if ($item['isi_sekarang'])
                                <button data-modal-target="modal-isi-laporan-{{ $isiSekarang['tanggal'] }}"
                                    data-modal-toggle="modal-isi-laporan-{{ $isiSekarang['tanggal'] }}"
                                    class="mt-3 inline-flex items-center px-3 py-1 bg-primary-600 hover:bg-primary-700 text-white text-xs rounded shadow">
                                    <svg class="w-3 h-3 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                    </svg>
                                    Isi Laporan
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $laporanStatus->links() }}
                </div>
            </div>

        </div>

    </section>
@endsection
