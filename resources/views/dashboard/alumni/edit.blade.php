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
                    <a href="{{ route('alumni.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Alumni
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
            <form action="{{ route('alumni.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="w-[40%] md:w-[35%] lg:w-[27%]">
                    <x-form.foto label="Foto" name="foto" placeholder="SVG, PNG, JPEG atau JPG (Dimensi. 1:1)"
                        :foto="asset($data->user->foto)" />
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <x-form.input type="text" name="nama" label='Nama Lengkap' :value="old('nama', $data->nama)" />
                    <x-form.input type="number" name="nim" label='NIM' :value="old('nim', $data->nim)" />
                    <x-form.input type="text" name="tempat_lahir" label='Tempat Lahir' :value="old('tempat_lahir', $data->tempat_lahir)" />
                    <x-form.input type="date" name="tanggal_lahir" label='Tanggal Lahir' :value="old('tanggal_lahir', $data->tanggal_lahir)" />
                    <x-form.input type="number" name="tahun_masuk" label='Tahun Masuk' :value="old('tahun_masuk', $data->tahun_masuk)" />
                    <x-form.select name="status_masuk" label='Status Masuk' placeholder='Pilih Status Masuk'>
                        @foreach ($status_masuk as $r)
                            @if ($r['nama'] == old('status_masuk', $data->status_masuk))
                                <option value=" {{ $r['nama'] }}" class="capitalize" selected> {{ $r['nama'] }}
                                </option>
                            @endif
                            <option value=" {{ $r['nama'] }}" class="capitalize"> {{ $r['nama'] }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.input type="number" name="tahun_lulus" label='Tahun Lulus' :value="old('tahun_lulus', $data->tahun_lulus)" />
                    <x-form.input type="text" name="ipk" label='IPK' :value="old('ipk', $data->ipk)" />
                    <x-form.input type="text" name="hp" label='Nomor HP' :value="old('hp', $data->hp)" :required="false" />
                    <x-form.input type="email" name="email" label='Email' :value="old('email', $data->email)" :required="false" />
                    <x-form.input type="text" name="alamat" label='Alamat' :value="old('alamat', $data->alamat)" :required="false" />
                    <div>
                        <label for="status" class="block mb-2 text-sm text-gray-800">
                            Status Alumni
                        </label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                            disabled>
                            <option selected>Pilih status</option>
                            <option value="belum bekerja" {{ $data->status == 'belum bekerja' ? 'selected' : '' }}>
                                Belum Bekerja</option>
                            <option value="kerja" {{ $data->status == 'kerja' ? 'selected' : '' }}>Kerja
                            </option>
                            <option value="lanjut pendidikan" {{ $data->status == 'lanjut pendidikan' ? 'selected' : '' }}>
                                Lanjut Pendidikan
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="keterangan" class="block mb-2 text-sm text-gray-800">
                            Keterangan {{ $data->status }}
                        </label>
                        <textarea id="keterangan" rows="4" name="keterangan"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                            disabled>{{ $data->detail_status }}</textarea>
                    </div>
                </div>
                <div class="mt-7 flex gap-4 items-center">
                    <x-form.button-back :url="route('alumni.index')" />
                    <x-form.button-submit label="Simpan" />
                </div>
            </form>
        </div>
    </section>
@endsection
