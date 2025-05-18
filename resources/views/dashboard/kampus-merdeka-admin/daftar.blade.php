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
                    <a href="{{ route('kampus-merdeka.index') }}"
                        class="inline-flex items-center font-medium text-gray-700 hover:text-primary-600">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium md:ms-2">
                            Kampus Merdeka
                        </span>
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
                            Daftar
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="p-4 py-6 shadow bg-white rounded overflow-hidden relative">


            <form action="{{ route('kampus-merdeka.post-daftar') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')


                <div class="mb-3">
                    <label for="mitra">Nama Mitra</label>
                    <input type="text" id="mitra" name="mitra" required
                        class="
                        @error('mitra')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                        required value="{{ old('mitra') }}">
                    @error('mitra')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="jenis" class="label-ct">Jenis Kegiatan</label>
                        <select name="jenis" id="jenis"
                            class="@error('jenis')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            required>
                            <option value="">Pilih kegiatan</option>
                            <option value="study" {{ old('jenis') == 'study' ? 'selected' : '' }}>Study</option>
                            <option value="internship" {{ old('jenis') == 'internship' ? 'selected' : '' }}>Internship
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="mobilitas" class="label-ct">Mobilitas</label>
                        <select name="mobilitas" id="mobilitas"
                            class="@error('mobilitas')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            required>
                            <option value="">Pilih mobilitas</option>
                            <option value="online" {{ old('mobilitas') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="onsite" {{ old('mobilitas') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" required
                            class="
                        @error('tanggal_mulai')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" required
                            class="
                        @error('tanggal_selesai')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                            value="{{ old('tanggal_selesai') }}">
                        @error('tanggal_selesai')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="bukti_penerimaan">Bukti Penerimaan
                            @if (session('errors'))
                                <small class="text-gray-600"> (upload ulang file)</small>
                            @endif
                        </label>
                        <input type="file" accept=".pdf" id="bukti_penerimaan" name="bukti_penerimaan" required
                            class="
                        @error('bukti_penerimaan')
                        input-file-error
                            @else
                        input-file
                        @enderror">
                        @error('bukti_penerimaan')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="persetujuan_kampus">Persetujuan Kampus
                            @if (session('errors'))
                                <small class="text-gray-600"> (upload ulang file)</small>
                            @endif
                        </label>
                        <input type="file" accept=".pdf" id="persetujuan_kampus" name="persetujuan_kampus" required
                            class="
                        @error('persetujuan_kampus')
                        input-file-error
                            @else
                        input-file
                        @enderror">
                        @error('persetujuan_kampus')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 flex text-center flex-col-reverse w-full gap-2 sm:flex-row sm:justify-between">
                    <a href="{{ route('kampus-merdeka.index') }}" class="btn-secondary">Batal</a>
                    <Button type="submit" class="btn-primary">Simpan</Button>
                </div>
            </form>
        </div>
    </section>
@endsection
