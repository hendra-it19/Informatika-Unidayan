@extends('layouts.dashboard')

@section('pages')
    <main class="min-h-screen relative">
        <section class="mt-4">
            <div class="w-full bg-primary-400 block text-center rounded-sm text-gray-200 p-2">
                <div>
                    <p>Selamat Datang {{ auth()->user()->nama }}!</p>
                    @if (empty(auth()->user()->nama))
                        <small class="text-gray-800">harap lengkapi data anda terlebih dahulu. Klik <a
                                href="{{ request()->url() . '/pengaturan-akun' }}" class="underline">disini</a></small>
                    @endif
                </div>
            </div>
        </section>

        <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-5">
            <div class="shadow rounded-sm relative">
                <div class="px-8 py-4 relative z-10 mb-4 flex items-center gap-3">
                    <h1 class="font-bold text-4xl text-gray-700">{{ $user }}</h1>
                    <p class="font-semibold">Pengguna</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute left-0 right-0 bottom-0">
                    <path fill="#c8d7ef" fill-opacity="1"
                        d="M0,32L26.7,37.3C53.3,43,107,53,160,58.7C213.3,64,267,64,320,74.7C373.3,85,427,107,480,144C533.3,181,587,235,640,245.3C693.3,256,747,224,800,208C853.3,192,907,192,960,170.7C1013.3,149,1067,107,1120,128C1173.3,149,1227,235,1280,256C1333.3,277,1387,235,1413,213.3L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                    </path>
                </svg>
            </div>

            <div class="shadow rounded-sm relative">
                <div class="px-8 py-4 relative z-10 mb-4 flex items-center gap-3">
                    <h1 class="font-bold text-4xl text-gray-700">{{ $alumni }}</h1>
                    <p class="font-semibold">Alumni</p>
                </div>
                <svg class="absolute left-0 right-0 bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#bbf7d0" fill-opacity="1"
                        d="M0,288L26.7,250.7C53.3,213,107,139,160,117.3C213.3,96,267,128,320,149.3C373.3,171,427,181,480,208C533.3,235,587,277,640,261.3C693.3,245,747,171,800,138.7C853.3,107,907,117,960,154.7C1013.3,192,1067,256,1120,261.3C1173.3,267,1227,213,1280,165.3C1333.3,117,1387,75,1413,53.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                    </path>
                </svg>
            </div>

            <div class="shadow rounded-sm relative">
                <div class="px-8 py-4 relative z-10 mb-4 flex items-center gap-3">
                    <h1 class="font-bold text-4xl text-gray-700">{{ $mahasiswa }}</h1>
                    <p class="font-semibold">Mahasiswa</p>
                </div>
                <svg class="absolute left-0 right-0 bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#bfdbfe" fill-opacity="1"
                        d="M0,96L26.7,101.3C53.3,107,107,117,160,138.7C213.3,160,267,192,320,208C373.3,224,427,224,480,218.7C533.3,213,587,203,640,186.7C693.3,171,747,149,800,128C853.3,107,907,85,960,69.3C1013.3,53,1067,43,1120,37.3C1173.3,32,1227,32,1280,32C1333.3,32,1387,32,1413,32L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                    </path>
                </svg>
            </div>

            <div class="shadow rounded-sm relative">
                <div class="px-8 py-4 relative z-10 mb-4 flex items-center gap-3">
                    <h1 class="font-bold text-4xl text-gray-700">{{ $kegiatanProdi }}</h1>
                    <p class="font-semibold">Postingan</p>
                </div>
                <svg class="absolute left-0 right-0 bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#fecdd3" fill-opacity="1"
                        d="M0,192L26.7,186.7C53.3,181,107,171,160,170.7C213.3,171,267,181,320,181.3C373.3,181,427,171,480,181.3C533.3,192,587,224,640,240C693.3,256,747,256,800,218.7C853.3,181,907,107,960,64C1013.3,21,1067,11,1120,37.3C1173.3,64,1227,128,1280,154.7C1333.3,181,1387,171,1413,165.3L1440,160L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                    </path>
                </svg>
            </div>
        </section>


        @if (auth()->user()->role == 'organisasi')
            <section class="mt-5 shadow rounded-sm p-4 bg-white">
                <h2 class="my-3 text-lg text-gray-800 ">Berikut daftar riwayat kepengurusan pada organisasi
                    <span class="font-semibold">{{ auth()->user()->organisasi->nama_organisasi }}</span>
                </h2>
                <div class="w-full">
                    <table class="table table-responsive w-full">
                        <thead class=" text-sm">
                            <th class="font-semibold text-gray-800 border p-1 max-w-fit text-center">No</th>
                            <th class="font-semibold text-gray-800 border p-1">Ketua</th>
                            <th class="font-semibold text-gray-800 border p-1">Wakil</th>
                            <th class="font-semibold text-gray-800 border p-1">Sekretaris</th>
                            <th class="font-semibold text-gray-800 border p-1">Bendahara</th>
                            <th class="font-semibold text-gray-800 border p-1">Periode</th>
                            <th class="font-semibold text-gray-800 border p-1">SK</th>
                        </thead>
                        <tbody class="text-xs">
                            @forelse ($daftarKepengurusan as $row)
                                <tr>
                                    <td class="border text-inherit p-1 max-w-fit text-center font-semibold">
                                        {{ ++$i }}</td>
                                    <td class="border text-inherit p-1">{{ $row->ketua }}</td>
                                    <td class="border text-inherit p-1">{{ $row->wakil }}</td>
                                    <td class="border text-inherit p-1">{{ $row->sekretaris }}</td>
                                    <td class="border text-inherit p-1">{{ $row->bendahara }}</td>
                                    <td class="border text-inherit p-1">{{ $row->awal_jabatan }} sampai
                                        {{ $row->akhir_jabatan }}</td>
                                    <td class="border text-inherit p-1 text-center max-w-fit">
                                        <a href="{{ asset($row->sk) }}" download
                                            class="py-0.5 px-2 rounded-sm bg-gray-600 hover:bg-gray-700 text-white">Download</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border text-center text-gray-700 text-sm p-2">Tidak ada data
                                        yang
                                        dapat
                                        ditampilkan!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4" id="pagination">
                        <div class="w-full lg:w-fit m-auto">
                            {!! $daftarKepengurusan->withQueryString()->links() !!}
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection

@push('css')
    <style>
        #pagination div nav div {
            font-size: 8px !important;
            gap: 4px;
        }
    </style>
@endpush
