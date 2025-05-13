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
                            Ubah
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8">
            <form action="{{ route('akun-organisasi.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-3 aspect-video max-h-64 bg-gray-100 rounded shadow-sm overflow-hidden">
                    <img src="{{ asset($data->foto) }}" alt="preview" id="foto-preview" class="w-full h-full object-fill">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="label-ct" for="foto">Foto (Ratio 16:9)</label>
                        <input
                            class="@error('foto')
                                input-file-error
                                @else
                                input-file
                            @enderror"
                            id="foto" name="foto" type="file" accept=".svg,.png,.jpg,.jpeg,.webp">
                        @error('foto')
                            <small class="-mt-[1px] block text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex gap-2 w-full items-center">
                        <div class="w-full">
                            <label class="label-ct" for="logo">Logo (Ratio 1:1)</label>
                            <input
                                class="@error('logo')
                                input-file-error
                                @else
                                input-file
                            @enderror"
                                id="logo" name="logo" type="file" accept=".svg,.png,.jpg,.jpeg,.webp">
                            @error('logo')
                                <small class="-mt-[1px] block text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-[130px] relative">
                            <img src="{{ asset($data->logo) }}" alt="logo" class="w-[100px] absolute -bottom-[58px]"
                                id="logo-preview">
                        </div>
                    </div>
                    <x-form.input type="text" name="nama_organisasi" label='Nama Organisasi' :value="old('nama_organisasi', $data->nama_organisasi)" />
                    <x-form.input type="text" name="nama_penanggung_jawab" label='Nama Penanggung Jawab'
                        :value="old('nama_penanggung_jawab', $data->user->nama)" />
                    <x-form.input type="text" name="username" label='Username' :value="old('username', $data->user->username)" />
                    <div>
                        <x-form.input type="text" name="password" label='Password' :value="old('password')" :required='false' />
                        <small class="text-gray-600 -mt-0.5 block">Kosongkan jika tidak ingin mengganti password
                            lama</small>
                    </div>
                    <div>
                        <label for="postingan" class="text-gray-800">Membuat Postingan</label>
                        <div class="flex gap-3">
                            <div>
                                <input type="radio" name="hak_akses_upload_kegiatan" id="hak_akses_upload_kegiatan1"
                                    value="1" @if ($data->can_upload) checked @else @endif>
                                <label for="hak_akses_upload_kegiatan1">Beri Akses</label>
                            </div>
                            <div>
                                <input type="radio" name="hak_akses_upload_kegiatan" id="hak_akses_upload_kegiatan2"
                                    value="0" @if ($data->can_upload) @else checked @endif>
                                <label for="hak_akses_upload_kegiatan2">Cegah Akses</label>
                            </div>
                        </div>
                    </div>
                </div>
                <x-form.text-editor type="text" name="keterangan_tambahan" label='Keterangan Tambahan' :value="old('keterangan_tambahan', $data->keterangan_tambahan)"
                    :required="true" />
                <div class="mt-7 flex
                        gap-4 items-center">
                    <x-form.button-back :url="route('akun-organisasi.index')" />
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

        const inputLogo = document.getElementById('logo');
        const previewLogo = document.getElementById('logo-preview');
        const previewLogo2 = () => {
            const file = inputLogo.files;
            if (file) {
                const fileReader = new FileReader();
                fileReader.onload = function(event) {
                    previewLogo.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(file[0]);
            }
        }
        inputLogo.addEventListener("change", previewLogo2);
    </script>
@endpush
