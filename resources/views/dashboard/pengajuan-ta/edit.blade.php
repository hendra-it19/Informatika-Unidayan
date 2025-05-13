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
                    <a href="{{ route('pengajuan-ta.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Pengajuan TA
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
                            Edit
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8">
            <form action="{{ route('pengajuan-ta.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

                    <div>
                        <label for="judul_pertama" class="label-ct">Judul Pertama</label>
                        <input type="text" id="judul_pertama" name="judul_pertama"
                            class="
                        @error('judul_pertama')
                            input-error-ct
                        @else 
                            input-ct
                        @enderror
                        "
                            value="{{ old('judul_pertama', $data->judul1) }}">
                        @error('judul_pertama')
                            <div class="error-message-ct">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="abstrak_judul_pertama">Abstrak</label>
                        <textarea name="abstrak_judul_pertama" id="abstrak_judul_pertama"
                            class="
                        @error('abstrak_judul_pertama')
                            input-error-ct
                        @else
                        input-ct
                        @enderror"
                            rows="7">{{ old('abstrak_judul_pertama', $data->abstrak1) }}</textarea>
                        @error('abstrak_judul_pertama')
                            <div class="error-message-ct">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}
                    <div>
                        <label for="judul_kedua" class="label-ct">Judul Kedua</label>
                        <input type="text" id="judul_kedua" name="judul_kedua"
                            class="
                        @error('judul_kedua')
                            input-error-ct
                        @else 
                            input-ct
                        @enderror
                        "
                            value="{{ old('judul_kedua', $data->judul2) }}">
                        @error('judul_kedua')
                            <div class="error-message-ct">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="abstrak_judul_kedua">Abstrak</label>
                        <textarea name="abstrak_judul_kedua" id="abstrak_judul_kedua"
                            class="
                        @error('abstrak_judul_kedua')
                            input-error-ct
                        @else
                        input-ct
                        @enderror"
                            rows="7">{{ old('abstrak_judul_kedua', $data->abstrak2) }}</textarea>
                        @error('abstrak_judul_kedua')
                            <div class="error-message-ct">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}
                    <div>
                        <label for="judul_ketiga" class="label-ct">Judul Ketiga</label>
                        <input type="text" id="judul_ketiga" name="judul_ketiga"
                            class="
                        @error('judul_ketiga')
                            input-error-ct
                        @else 
                            input-ct
                        @enderror
                        "
                            value="{{ old('judul_ketiga', $data->judul3) }}">
                        @error('judul_ketiga')
                            <div class="error-message-ct">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="abstrak_judul_ketiga">Abstrak</label>
                        <textarea name="abstrak_judul_ketiga" id="abstrak_judul_ketiga"
                            class="
                        @error('abstrak_judul_ketiga')
                            input-error-ct
                        @else
                        input-ct
                        @enderror"
                            rows="7">{{ old('abstrak_judul_ketiga', $data->abstrak3) }}</textarea>
                        @error('abstrak_judul_ketiga')
                            <div class="error-message-ct">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="mt-7 flex
                        gap-4 items-center">
                    <x-form.button-back :url="route('pengajuan-ta.index')" />
                    <x-form.button-submit label="Simpan" onclick="return confirm('Yakin ingin mengubah data?')" />
                </div>
            </form>
        </div>
    </section>
@endsection
