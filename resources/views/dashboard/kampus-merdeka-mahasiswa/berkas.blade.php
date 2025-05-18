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
                            Kerja Praktek
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="px-4 py-6 shadow bg-white rounded">
            <div class="relative overflow-x-auto rounded mt-4">
                <table style="table-layout: responsive" class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-100 bg-primary-400">
                        <tr>
                            <th scope="col" class="p-2 lg:p-3 px-6">
                                No
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Judul
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Uploader
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Kategori
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Sampul
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Excerpt
                            </th>
                            <th scope="col" class="p-2 lg:p-3">
                                Waktu Pembuatan
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
                                    {{ ++$i }}
                                </th>
                                <th scope="row" class="p-2 lg:p-3 uppercase font-normal">
                                    <p class="line-clamp-2 hover:line-clamp-none"> {{ $r->judul }}</p>
                                </th>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->user->role }}
                                </td>
                                <td class="p-2 lg:p-3 uppercase">
                                    {{ $r->kategori->nama }}
                                </td>
                                <td class="p-2 lg:p-3 h-16 aspect-video">
                                    <img src="{{ asset($r->foto) }}" alt="{{ $r->slug }}"
                                        class="h-16 rounded shadow-sm aspect-video object-fill">
                                </td>
                                <td class="p-2 lg:p-3 w-5">
                                    <p class="line-clamp-2 text-wrap">{{ $r->excerpt }}</p>
                                </td>
                                <td class="p-2 lg:p-3">
                                    {{ $carbon::parse($r->created_at) }}
                                </td>
                                <td class="p-2 lg:p-3 relative">
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
                                        <a href="{{ route('kegiatan-prodi.edit', $r->id) }}"
                                            class="inline-block w-[18px] text-yellow-400 hover:text-yellow-600">
                                            <svg class="aspect-square w-full" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('kegiatan-prodi.destroy', $r->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')"
                                                class="inline-block w-[18px] text-red-500 hover:text-red-700">
                                                <svg class="aspect-square w-full" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </form>
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
