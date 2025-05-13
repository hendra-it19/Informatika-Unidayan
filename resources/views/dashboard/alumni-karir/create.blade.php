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
                    <a href="{{ route('share-jobs.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Karir
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
            <form action="{{ route('share-jobs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')

                <div class="w-[70%] md:w-[55%] lg:w-[40%]">
                    <x-form.foto label="Sampul" name="foto" placeholder="SVG, PNG, JPEG atau JPG (Dimensi. 1:1)" />
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <x-form.input type="text" name="mitra" label='Nama Mitra' :value="old('mitra')"
                        placeholder="Ex : PT. Anonym" />
                    <x-form.input type="text" name="pekerjaan" label='Pekerjaan' :value="old('pekerjaan')"
                        placeholder="Ex : Web Developer" />
                    <x-form.input type="date" name="batas_penerimaan" label='Batas Penerimaan' :value="old('batas_penerimaan')" />
                </div>
                <div class="w-full mt-5">
                    <x-form.text-editor label="Deskripsi Pekerjaan" name="deskripsi" :value="old('deskripsi')" :required="true" />
                </div>
                <div class="mt-7 flex gap-4 items-center">
                    <x-form.button-back :url="route('share-jobs.index')" />
                    <x-form.button-submit label="Simpan" />
                </div>
            </form>
        </div>
    </section>
@endsection
