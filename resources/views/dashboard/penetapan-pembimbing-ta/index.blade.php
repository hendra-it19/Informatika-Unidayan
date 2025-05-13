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
                            Penetapan Pembimbing
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div>
            <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-end gap-2">
                <form action="{{ route('penetapan-pembimbing-ta.index') }}" method="GET">
                    @if (!empty($tabs))
                        <input type="hidden" name="tabs" value="{{ $tabs }}">
                    @endif
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
                <a href="{{ route('penetapan-pembimbing-ta.create') }}">
                    <x-input.button-add text="Tambah">
                        <svg class="me-2 h-3.5 aspect-square" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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
            </div>
            <div class="mt-3">
                <a href="javascript:void(0)" data-modal-target="modal-export" data-modal-toggle="modal-export"
                    class="inline-block py-1 px-4 rounded border-[1.5px] border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-2 focus:ring-gray-200 text-xs">
                    PDF
                </a>
                @include('dashboard.penetapan-pembimbing-ta.modal-export')
            </div>
            <div class="mt-3 -mb-1">
                <ul
                    class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                    <li class="me-2">
                        <a href="@if (empty($q)) {{ route('penetapan-pembimbing-ta.index') . '?tabs=semua' }}
                            @else {{ route('penetapan-pembimbing-ta.index') . '?keyword=' . $q . '&tabs=semua' }} @endif"
                            aria-current="page"
                            class="inline-block p-2 rounded-t-md {{ url()->full() == route('penetapan-pembimbing-ta.index') || $tabs == 'semua' ? 'active text-white bg-primary-400' : 'hover:text-gray-600 hover:bg-gray-50' }}">
                            Semua
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="@if (empty($q)) {{ route('penetapan-pembimbing-ta.index') . '?tabs=sudah' }}
                            @else {{ route('penetapan-pembimbing-ta.index') . '?keyword=' . $q . '&tabs=sudah' }} @endif"
                            class="inline-block p-2 rounded-t-md {{ $tabs == 'sudah' ? 'active text-white bg-primary-400' : 'hover:text-gray-600 hover:bg-gray-50' }}">Sudah
                            Ditetapkan</a>
                    </li>
                    <li class="me-2">
                        <a href="@if (empty($q)) {{ route('penetapan-pembimbing-ta.index') . '?tabs=belum' }}
                            @else {{ route('penetapan-pembimbing-ta.index') . '?keyword=' . $q . '&tabs=belum' }} @endif"
                            class="inline-block p-2 rounded-t-md {{ $tabs == 'belum' ? 'active text-white bg-primary-400' : 'hover:text-gray-600 hover:bg-gray-50' }}">Belum
                            Ditetapkan</a>
                    </li>
                </ul>
            </div>
            <div class="relative overflow-x-auto shadow-sm rounded ">
                <table style="table-layout: responsive" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-100 bg-primary-400">
                        <tr>
                            <th scope="col" class="p-2">
                                No
                            </th>
                            <th scope="col" class="p-2">
                                NIM
                            </th>
                            <th scope="col" class="p-2">
                                Nama
                            </th>
                            <th scope="col" class="p-2">
                                Judul
                            </th>
                            <th scope="col" class="p-2">
                                Waktu verifikasi
                            </th>
                            <th scope="col" class="p-2">
                                Status
                            </th>
                            <th scope="col" class="p-2">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $r)
                            <tr class="bg-white border-b hover:bg-primary-50 text-xs text-gray-700">
                                <th scope="row" class="p-2 text-gray-900 whitespace-nowrap">
                                    {{ ++$i }}
                                </th>
                                <td class="p-2">
                                    {{ $r->mahasiswa->nama }}
                                </td>
                                <td class="p-2">
                                    {{ $r->mahasiswa->identitas }}
                                </td>
                                <td class="p-2 text-wrap">
                                    {{ $r->judul }}
                                </td>
                                <td class="p-2 text-nowrap">
                                    {{ $carbon::parse($r->created_at)->format('d M Y') }}
                                </td>
                                <td class="p-2">
                                    @if (empty($r->pembimbing_utama_id) || empty($r->pembimbing_pendamping_id))
                                        <span class="py-0.5 px-3 bg-red-200 rounded-sm">Proses</span>
                                    @else
                                        <span class="py-0.5 px-3 bg-green-200 rounded-sm">Selesai</span>
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
                                        class="absolute peer-focus:flex top-0 right-0 bg-white items-center shadow-lg rounded p-2 hover:flex gap-2 hidden">
                                        <a href="{{ route('penetapan-pembimbing-ta.show', $r->id) }}"
                                            class="inline-block w-[18px] aspect-square text-blue-400 hover:text-blue-600">
                                            <svg class="aspect-square w-full" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('penetapan-pembimbing-ta.edit', $r->id) }}"
                                            class="inline-block w-[18px] aspect-square text-yellow-400 hover:text-yellow-600">
                                            <svg class="aspect-square w-full" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                            </svg>
                                        </a>
                                        {{-- <form action="{{ route('penetapan-pembimbing-ta.destroy', $r->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus data?')"
                                                    class="inline-block w-[18px] aspect-square text-red-500 hover:text-red-700">
                                                    <svg class="aspect-square w-full" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>
                                                </button>
                                            </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-center" colspan="7">
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
{{-- <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                    </div> --}}
