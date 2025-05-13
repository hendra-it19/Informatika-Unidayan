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
                    <a href="{{ route('penetapan-pembimbing-ta.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Penetapan Pembimbing
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
                            Ubah
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8">
            <form action="{{ route('penetapan-pembimbing-ta.update', $data->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menyimpan?')">
                @csrf
                @method('put')

                @if (!empty($data->pembimbing_utama_id))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Perhatan!</span> pembimbing sudah ditetapkan.
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <x-form.input type="text" name="nama" label='Nama Mahasiswa' :value="$data->mahasiswa?->nama"
                        :readonly="true" />
                    <x-form.input type="text" name="nim" label='NIM' :value="$data->mahasiswa?->identitas" :readonly="true" />
                </div>
                <div class="my-3">
                    <x-form.input type="text" name="judul" label='Judul Tugas Akhir' :value="$data->judul" />
                </div>
                <div class="my-3">
                    <label for="abstrak" class="block mb-1.5 text-sm text-gray-800">Abstrak</label>
                    <textarea id="abstrak" name="abstrak"
                        class="w-full rounded border text-gray-700 py-2 px-3 border-gray-300 min-h-fit bg-gray-50 text-justify">{{ $data->abstrak }}</textarea>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div class="flex flex-col">
                        <label for="pembimbing_utama" class="label-ct">Pembimbing Utama <span
                                class="text-red-400">*</span></label>
                        <select name="pembimbing_utama" id="pembimbing_utama"
                            class="w-full overflow-x-hidden @error('pembimbing_utama')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            required>
                            <option value="">Pilih pembimbing utama</option>
                            @foreach ($dosen as $row)
                                @if ($row->id == old('pembimbing_utama', $data->pembimbing_utama_id))
                                    <option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('pembimbing_utama')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="pembimbing_pendamping" class="label-ct">Pembimbing Pendamping <span
                                class="text-red-400">*</span></label>
                        <select name="pembimbing_pendamping" id="pembimbing_pendamping"
                            class="w-full overflow-x-hidden @error('pembimbing_pendamping')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            required>
                            <option value="">Pilih pembimbing pendamping</option>
                            @foreach ($dosen as $row)
                                @if ($row->id == old('pembimbing_pendamping', $data->pembimbing_pendamping_id))
                                    <option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('pembimbing_pendamping')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mt-7 flex
                        gap-4 items-center">
                    <x-form.button-back :url="route('penetapan-pembimbing-ta.index')" />
                    <x-form.button-submit label="Simpan" />
                </div>
            </form>
        </div>
    </section>
@endsection

@push('css')
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#mahasiswa').select2();
            $('#pembimbing_utama').select2();
            $('#pembimbing_pendamping').select2();
        });
    </script>
@endpush
