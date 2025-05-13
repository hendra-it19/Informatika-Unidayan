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
                    <a href="{{ route('postingan-organisasi.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Kegiatan Organisasi
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
            <form action="{{ route('postingan-organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 aspect-video max-h-64 bg-gray-100 rounded shadow-sm overflow-hidden">
                    <img src="https://placehold.co/1920x1080?text=preview" alt="preview" id="foto-preview"
                        class="w-full h-full object-fill">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="label-ct" for="foto">Foto (Ratio 16:9)<span class="text-red-400">*</span></label>
                        <input
                            class="@error('foto')
                                input-file-error
                                @else
                                input-file
                            @enderror"
                            id="foto" name="foto" type="file" required accept=".svg,.png,.jpg,.jpeg,.webp">
                        @error('foto')
                            <small class="-mt-[1px] block text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <x-form.input type="text" name="judul" label='Judul Postingan' :value="old('judul')" />
                    @if ($role == 'organisasi')
                        <x-form.input type="text" name="organisasi" label='Organisasi' :value="old('organisasi', $organisasi->nama_organisasi)"
                            readonly="true" />
                        <input type="hidden" name="organisasi_id" value="{{ $organisasi->id }}">
                    @else
                        <x-form.select name="organisasi" label='Organisasi' placeholder='Pilih organisasi'>
                            @foreach ($organisasi as $r)
                                @if ($r->id == old('organisasi'))
                                    <option value=" {{ $r->id }}" class="capitalize" selected>
                                        {{ $r->nama_organisasi }}
                                    </option>
                                @else
                                    <option value=" {{ $r->id }}" class="capitalize"> {{ $r->nama_organisasi }}
                                    </option>
                                @endif
                            @endforeach
                        </x-form.select>
                    @endif
                    <div>
                        <label for="tags-input">Input Hastag <span class="text-red-400">*</span></label>
                        <small class="text-xs text-gray-500" for="taginput">(masukkan tag min 3 karakter, pisahkan dengan
                            koma)</small>
                        <div id="tags-input">
                            <input id="tags-input" name="hashtag" type="text" placeholder="Masukkan Tag" class="input-ct"
                                value="{{ old('hashtag') }}" required />
                            @error('hashtag')
                                <small class="-mt-[1px] block text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <x-form.text-editor type="text" name="deskripsi" label='Isi Postingan' :value="old('deskripsi')"
                    :required="true" />
                <div class="mt-7 flex
                        gap-4 items-center">
                    <x-form.button-back :url="route('postingan-organisasi.index')" />
                    <x-form.button-submit label="Simpan" />
                </div>
            </form>
        </div>
    </section>
@endsection

@push('js')
    <script>
        const input = document.getElementById('foto');
        const preview = document.getElementById('foto-preview');
        const previewPhoto = () => {
            const file = input.files;
            if (file) {
                const fileReader = new FileReader();
                fileReader.onload = function(event) {
                    preview.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(file[0]);
            }
        }
        input.addEventListener("change", previewPhoto);
    </script>
@endpush
