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
                            Tambah
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8">
            <form action="{{ route('penetapan-pembimbing-ta.store') }}" method="POST"
                onsubmit="return confirm('Yakin ingin menyimpan data?')">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div class="flex flex-col">
                        <label for="tanggal_diterima" class="label-ct">Tanggal Diterima<span
                                class="text-red-400">*</span></label>
                        <input type="date" id="tanggal_diterima" name="tanggal_diterima"
                            class="@error('tanggal_diterima')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            value="{{ old('tanggal_diterima') }}" required>
                        @error('tanggal_diterima')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="mahasiswa" class="label-ct">Mahasiswa <span class="text-red-400">*</span></label>
                        <select name="mahasiswa" id="mahasiswa"
                            class="w-full overflow-x-hidden @error('mahasiswa')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            required>
                            <option value="">Pilih mahasiswa</option>
                            @foreach ($mahasiswa as $row)
                                @if ($row->id == old('mahasiswa'))
                                    <option value="{{ $row->id }}" selected>{{ $row->identitas }} | {{ $row->nama }}
                                    </option>
                                @else
                                    <option value="{{ $row->id }}">{{ $row->identitas }} | {{ $row->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('mahasiswa')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col mt-3">
                    <label for="judul" class="label-ct">Judul<span class="text-red-400">*</span></label>
                    <input type="text" id="judul" name="judul"
                        class="@error('judul')
                input-error-ct
                    @else
                input-ct
                @enderror"
                        value="{{ old('judul') }}" required>
                    @error('judul')
                        <small class="error-message-ct">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col mt-3">
                    <label for="judul" class="label-ct">Abstrak<span class="text-red-400">*</span></label>
                    <textarea name="abstrak" id="abstrak" rows="8"
                        class="@error('abstrak')
                    input-error-ct
                        @else
                        input-ct
                    @enderror"
                        required>{{ old('abstrak') }}</textarea>
                    @error('judul')
                        <small class="error-message-ct">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mt-3">
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
                                @if ($row->id == old('pembimbing_utama'))
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
                                @if ($row->id == old('pembimbing_pendamping'))
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
                    <x-form.button-submit label="Simpan" onclick="return confirm('Yakin ingin menngajukan?')" />
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
