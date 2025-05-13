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
                    <a href="{{ route('alumni-karir.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Lowongan
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
            <div class="">
                <small class="text-gray-700 inline-block my-3">Di Ajukan pada {{ $data->created_at }}</small>
                <div>
                    <img src="{{ $r->foto ?? 'https://placehold.co/480x484?text=?' }}" alt="foto"
                        class="w-52 aspect-square object-cover rounded border-2 border-gray-500">
                    <table class="p-2 mt-3 text-sm">
                        <tr>
                            <td class="p-1">Mitra</td>
                            <td class="p-1"> : {{ $data->mitra }}</td>
                        </tr>
                        <tr>
                            <td class="p-1">Pekerjaan</td>
                            <td class="p-1"> : {{ $data->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td class="p-1">Batas Waktu</td>
                            <td class="p-1"> : {{ $data->batas_penerimaan }}</td>
                        </tr>
                        <tr>
                            <td class="p-1">Di Upload Oleh</td>
                            <td class="p-1"> : {{ $data->alumni->nama }}</td>
                        </tr>
                        <tr>
                            <td class="p-1">Status</td>
                            <td class="p-1"> : {{ $data->status }}</td>
                        </tr>
                        @if ($data->status == 'tolak')
                            <tr>
                                <td class="p-1">Alasan Penolakan</td>
                                <td class="p-1"> : {{ $data->pesan }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="p-1">Deskripsi</td>
                            <td class="p-1"> : {!! $data->deskripsi !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                <x-form.button-back label="Kembali" :url="route('alumni-karir.index')" />
            </div>
        </div>
    </section>
@endsection
