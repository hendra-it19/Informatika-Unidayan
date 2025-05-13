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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180  w-2.5 h-2.5 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 font-medium text-gray-500 md:ms-2">
                            Pengaturan Akun
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="bg-white shadow rounded px-4 py-8 mb-6">
            <h2 class="font-semibold text-sm">Ganti Password</h2>
            <form action="{{ route('pengaturan-akun.password') }}" method="POST" class="pt-3">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
                    <x-form.input type="password" name="password" label="Password Baru" :value="old('password')" />
                    <x-form.input type="password" name="konfirmasi_password" label="Konfirmasi Password"
                        :value="old('konfirmasi_password')" />
                </div>
                <x-form.button-submit label="Ubah Password" />
            </form>
        </div>

        @if (auth()->user()->role == 'mahasiswa')
            <div class="bg-white shadow rounded px-4 py-8 mb-6">
                <h2 class="font-semibold text-sm">Lengkapi Profile</h2>
                <form action="{{ route('pengaturan-akun.mahasiswa') }}" method="POST" class="pt-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="w-[70%] md:w-[55%] lg:w-[40%]">
                        <x-form.foto label="Foto" name="foto" placeholder="SVG, PNG, JPEG atau JPG (Dimensi. 1:1)"
                            :foto="auth()->user()->foto" />
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
                        <x-form.input type="text" name="username" label='Username' :value="auth()->user()->username" disabled="true" />
                        <x-form.input type="text" name="nama" label='Nama Lengkap' :value="auth()->user()->nama"
                            disabled="true" />
                        <x-form.input type="number" name="nim" label='NIM' :value="auth()->user()->identitas" disabled="true" />
                        <x-form.input type="number" name="tahun_masuk" label='Tahun Masuk' :value="auth()->user()->mahasiswa->tahun_masuk"
                            disabled="true" />
                        <x-form.input type="text" name="status_masuk" label='Status Masuk' :value="auth()->user()->mahasiswa->status_masuk"
                            disabled="true" />
                        <x-form.input type="text" name="tempat_lahir" label='Tempat Lahir' :value="old('tempat_lahir', auth()->user()->mahasiswa->tempat_lahir)" />
                        <x-form.input type="date" name="tanggal_lahir" label='Tanggal Lahir' :value="old('tanggal_lahir', auth()->user()->mahasiswa->tanggal_lahir)" />
                        <x-form.input type="number" name="hp" label='Nomor HP' :value="old('hp', auth()->user()->hp)" />
                        <x-form.input type="email" name="email" label='Email' :value="old('email', auth()->user()->email)" />
                        <x-form.input type="text" name="alamat" label='Alamat' :value="old('alamat', auth()->user()->alamat)" />
                    </div>
                    <x-form.button-submit label="Simpan Perubahan" />
                </form>
            </div>
        @endif

        @if (auth()->user()->role == 'alumni')
            <div class="bg-white shadow rounded px-4 py-8 mb-6">
                <h2 class="font-semibold text-sm">Lengkapi Profile</h2>
                <form action="{{ route('pengaturan-akun.alumni') }}" method="POST" class="pt-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="w-[70%] md:w-[55%] lg:w-[40%]">
                        <x-form.foto label="Foto" name="foto" placeholder="SVG, PNG, JPEG atau JPG (Dimensi. 1:1)"
                            :foto="auth()->user()->foto" />
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
                        <x-form.input type="text" name="username" label='Username' :value="auth()->user()->username" disabled="true" />
                        <x-form.input type="text" name="nama" label='Nama Lengkap' :value="auth()->user()->nama"
                            disabled="true" />
                        <x-form.input type="number" name="nim" label='NIM' :value="auth()->user()->identitas" disabled="true" />
                        <x-form.input type="number" name="tahun_masuk" label='Tahun Masuk' :value="auth()->user()->alumni->tahun_masuk"
                            disabled="true" />
                        <x-form.input type="text" name="status_masuk" label='Status Masuk' :value="auth()->user()->alumni->status_masuk"
                            disabled="true" />
                        <x-form.input type="text" name="tempat_lahir" label='Tempat Lahir' :value="old('tempat_lahir', auth()->user()->alumni->tempat_lahir)" />
                        <x-form.input type="date" name="tanggal_lahir" label='Tanggal Lahir' :value="old('tanggal_lahir', auth()->user()->alumni->tanggal_lahir)" />
                        <x-form.input type="number" name="hp" label='Nomor HP' :value="old('hp', auth()->user()->hp)" />
                        <x-form.input type="email" name="email" label='Email' :value="old('email', auth()->user()->email)" />
                        <x-form.input type="text" name="alamat" label='Alamat' :value="old('alamat', auth()->user()->alamat)" />
                        <div>
                            <label for="status" class="block mb-2 text-sm text-gray-800">
                                Status Alumni
                                <span class="text-red-400">*</span>
                            </label>
                            <select id="status" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                required>
                                <option selected>Pilih status</option>
                                <option value="belum bekerja"
                                    {{ auth()->user()->alumni->status == 'belum bekerja' ? 'selected' : '' }}>Belum Bekerja
                                </option>
                                <option value="kerja" {{ auth()->user()->alumni->status == 'kerja' ? 'selected' : '' }}>
                                    Kerja
                                </option>
                                <option value="lanjut pendidikan"
                                    {{ auth()->user()->alumni->status == 'lanjut pendidikan' ? 'selected' : '' }}>Lanjut
                                    Pendidikan
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="keterangan" class="block mb-2 text-sm text-gray-800">
                                Keterangan <span class="text-red-400">*</span>
                            </label>
                            <textarea id="keterangan" rows="4" name="keterangan"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Isi dengan detail pekerjaan atau nama kampus anda jika telah bekerja ataupun melanjutkan pendidikan..."
                                required>{{ auth()->user()->alumni->detail_status }}</textarea>
                        </div>
                    </div>
                    <x-form.button-submit label="Simpan Perubahan" />
                </form>
            </div>
        @endif

        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'kaprodi' || auth()->user()->role == 'dosen')
            <div class="bg-white shadow rounded px-4 py-8 mb-6">
                <h2 class="font-semibold text-sm">Lengkapi Profile</h2>
                <form action="{{ route('pengaturan-akun.staff') }}" method="POST" class="pt-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="w-[70%] md:w-[50%] lg:w-[30%]">
                        <x-form.foto label="Foto" name="foto" placeholder="SVG, PNG, JPEG atau JPG (Dimensi. 1:1)"
                            :foto="auth()->user()->foto" />
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
                        <x-form.input type="text" name="username" label='Username' :value="auth()->user()->username"
                            disabled="true" />
                        <x-form.input type="text" name="nama" label='Nama Lengkap' :value="auth()->user()->nama" />
                        <x-form.input type="number" name="nomor_identitas" label='Nomor Identitas' :value="auth()->user()->identitas" />
                        <x-form.input type="number" name="hp" label='Nomor HP' :value="old('hp', auth()->user()->hp)" />
                        <x-form.input type="email" name="email" label='Email' :value="old('email', auth()->user()->email)" />
                        <x-form.input type="text" name="alamat" label='Alamat' :value="old('alamat', auth()->user()->alamat)" />
                    </div>
                    <x-form.button-submit label="Simpan Perubahan" />
                </form>
            </div>
        @endif
    </section>
@endsection
