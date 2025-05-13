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
                    <a href="{{ route('akun-staff.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Dosen
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
            <form action="{{ route('akun-staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="w-[60%] md:w-[50%] lg:w-[30%]">
                    <x-form.foto label="Foto" name="foto" placeholder="SVG, PNG, JPEG atau JPG (Dimensi. 1:1)" />
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <x-form.input type="text" name="nama" label='Nama Lengkap' :value="old('nama')" />
                    <x-form.input type="number" name="nomor_identitas" label='Nomor Identitas' :value="old('nomor_identitas')" />
                    <x-form.input type="text" name="hp" label='Nomor HP' :value="old('hp')" :required="false" />
                    <x-form.input type="email" name="email" label='Email' :value="old('email')" :required="false" />
                    <x-form.input type="text" name="alamat" label='Alamat' :value="old('alamat')" :required="false" />
                    <x-form.select name="hak_akses" label='Hak Akses' placeholder='Pilih Hak Akses'>
                        @foreach ($hak_akses as $r)
                            @if ($r['nama'] == old('hak_akses'))
                                <option value=" {{ $r['nama'] }}" class="capitalize" selected> {{ $r['nama'] }}
                                </option>
                            @endif
                            <option value=" {{ $r['nama'] }}" class="capitalize"> {{ $r['nama'] }}</option>
                        @endforeach
                    </x-form.select>
                    <div>
                        <label for="verifikator" class="text-gray-700">Status Verifikator<span
                                class="text-red-400">*</span></label>
                        <div class="text-sm flex gap-3">
                            <div class="{{ $verifikator >= 5 ? 'text-gray-400 border-gray-400' : '' }}">
                                <input type="radio" name="verifikator" id="verifikator1"
                                    {{ $verifikator >= 5 ? 'disabled' : '' }} value="1">
                                <label for="verifikator1">
                                    Aktif
                                </label>
                            </div>
                            <div>
                                <input type="radio" name="verifikator" id="verifikatorx" checked value="0"> <label
                                    for="verifikatorx">Nonaktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-5 text-sm text-gray-500 mb-2">Note : Kosongkan field dibawah, maka username dan password akan
                    diambil
                    dari
                    nomor identitas</p>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <x-form.input type="text" name="username" label='Username' :value="old('username')" :required="false" />
                    <x-form.input type="text" name="password" label='Password' :value="old('password')" :required="false" />
                </div>
                <div class="mt-7 flex
                        gap-4 items-center">
                    <x-form.button-back :url="route('akun-staff.index')" />
                    <x-form.button-submit label="Simpan" />
                </div>
            </form>
        </div>
    </section>
@endsection
