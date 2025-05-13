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
                    <a href="{{ route('akun-organisasi.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Organisasi
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
                            {{ $organisasi->nama_organisasi }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8">
            <table class="table text-sm">
                <tbody>
                    <tr>
                        <td>Nama Organisasi</td>
                        <td class="pl-3"> : {{ $organisasi->nama_organisasi }}</td>
                    </tr>
                    <tr>
                        <td>Akses Kegiatan</td>
                        <td class="pl-3 relative"> :
                            @if ($organisasi->can_upload)
                                <span
                                    class="px-3 rounded-sm inline-block w-fit h-fit bg-green-200 text-green-800">True</span>
                            @else
                                <span class="px-3 rounded-sm inline-block w-fit h-fit bg-red-200 text-red-800">False</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Penanggung Jawab</td>
                        <td class="pl-3"> : {{ $organisasi->user->nama }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                @if ($get = Session::get('errors'))
                    <div>
                        <div class="flex p-4 mb-4 text-xs text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Data tidak dapat diproses!</span>
                            <div>
                                <span class="font-medium">pastikan kesalahan penginputan berikut:</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    @foreach ($get->all() as $row)
                                        <li>{{ $row }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex gap-5 mb-2">
                    <h1 class="text-lg text-gray-800">Riwayat kepengurusan organisasi</h1>
                    <a href="javascript:void(0)" data-modal-target="modal-tambah-anggota"
                        data-modal-toggle="modal-tambah-anggota">
                        <x-input.button-add text="Tambah">
                            <svg class="h-3.5 aspect-square" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
                    @include('dashboard.akun-organisasi.modal-create')
                </div>

                <div>
                    <table class="table w-full">
                        <thead class="text-gray-700 font-light text-sm">
                            <th class="text-inherit border p-1">No</th>
                            <th class="text-inherit border p-1">Ketua</th>
                            <th class="text-inherit border p-1">Wakil</th>
                            <th class="text-inherit border p-1">Sekretaris</th>
                            <th class="text-inherit border p-1">Bendahara</th>
                            <th class="text-inherit border p-1">Periode</th>
                            <th class="text-inherit border p-1">SK</th>
                            <th class="text-inherit border p-1">Aksi</th>
                        </thead>
                        <tbody class="text-xs">
                            @forelse ($struktural as $row)
                                <tr>
                                    <td class="border text-inherit p-1">{{ ++$i }}</td>
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
                                    <td class="border text-inherit p-1 text-center max-w-fit">
                                        <form action="{{ route('akun-organisasi.hapusAnggota', $row->id) }}" method="post"
                                            onsubmit="return confirm('Yakin ingin menghapus data?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="py-0.5 px-2 rounded-sm bg-red-600 hover:bg-red-700 text-white">Hapus</button>
                                        </form>
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
                </div>
            </div>

            <div class="mt-7 flex
            gap-4 items-center">
                <x-form.button-back :url="route('akun-organisasi.index')" />
            </div>
        </div>
    </section>
@endsection
