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
                            Bimbingan TA
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div>
            <div class="w-full flex justify-between items-end">
                <form action="{{ route('bimbingan-ta.index') }}" method="GET">
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

            <div class="relative overflow-x-auto shadow-sm rounded mt-2">
                <table style="table-layout: responsive" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-100 bg-primary-400">
                        <tr>
                            <th scope="col" class="p-3">
                                NIM
                            </th>
                            <th scope="col" class="p-3">
                                Nama
                            </th>
                            <th scope="col" class="p-3">
                                Pembimbing Utama
                            </th>
                            <th scope="col" class="p-3">
                                Pembimbing Pendamping
                            </th>
                            <th scope="col" class="p-3">
                                Tanggal Verifikasi
                            </th>
                            <th scope="col" class="p-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $r)
                            <tr class="bg-white border-b hover:bg-primary-50 text-xs">
                                <th scope="row" class="p-2 text-gray-900 whitespace-nowrap">
                                    {{ $r->mahasiswa->identitas }}
                                </th>
                                <td class="p-2">
                                    {{ $r->mahasiswa->nama }}
                                </td>
                                <td class="p-2 min-w-40">
                                    @if (auth()->user()->id == $r->pembimbing_utama_id)
                                        <span class="bg-primary-200 text-slate-900 rounded-sm py-0.5 px-2">
                                            <span>{{ $r->pembimbing_utama->nama }}</span>
                                        </span>
                                    @else
                                        <span>{{ $r->pembimbing_utama->nama }}</span>
                                    @endif
                                </td>
                                <td class="p-2 min-w-40">
                                    @if (auth()->user()->id == $r->pembimbing_pendamping_id)
                                        <span class="bg-primary-200 text-slate-900 rounded-sm py-0.5 px-2">
                                            <span>{{ $r->pembimbing_pendamping->nama }}</span>
                                        </span>
                                    @else
                                        <span>{{ $r->pembimbing_pendamping->nama }}</span>
                                    @endif
                                </td>
                                <td class="p-2">
                                    {{ $carbon::parse($r->created_at)->format('d F Y') }}
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
                                        class="absolute peer-focus:flex top-0 -left-2 bg-white shadow-lg rounded p-2 hover:flex gap-1 hidden">
                                        <a href="javascript:void(0)" data-modal-target="static-modal-{{ $r->id }}"
                                            data-modal-toggle="static-modal-{{ $r->id }}"
                                            class="inline-block w-[18px] text-primary-400 hover:text-primary-600">
                                            <svg class="w-full aspect-square" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                        {{--  --}}
                                        <div id="static-modal-{{ $r->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Detail Judul
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="static-modal-{{ $r->id }}">
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
                                                    <!-- Modal body -->
                                                    <div class="p-4 md:p-5 space-y-4">
                                                        <p class="text-base leading-relaxed text-gray-700">
                                                            {{ $r->judul }}
                                                        </p>
                                                        <table class="text-base text-gray-800">
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>: {{ $r->mahasiswa->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>NIM</td>
                                                                <td>: {{ $r->mahasiswa->identitas }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>NO.Handphone</td>
                                                                <td>: {{ $r->mahasiswa->hp ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td>: {{ $r->mahasiswa->email ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alamat</td>
                                                                <td>: {{ $r->mahasiswa->alamat ?? '-' }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div
                                                        class="flex items-start p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button data-modal-hide="static-modal-{{ $r->id }}"
                                                            type="button"
                                                            class="py-1.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                            Tutup Modal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  --}}
                                        <a href="{{ route('bimbingan-ta.chat', $r->id) }}"
                                            class="inline-block w-[18px] h-7 text-yellow-400 hover:text-yellow-600">
                                            <svg class="w-full h-full" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
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
