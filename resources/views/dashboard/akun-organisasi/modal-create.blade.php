<div id="modal-tambah-anggota" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <form action="{{ route('akun-organisasi.tambahAnggota') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="relative bg-white rounded-md shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Riwayat Kepengurusan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-tambah-anggota">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 text-sm w-full">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                        <input type="hidden" name="organisasi" value="{{ $organisasi->id }}">
                        <div>
                            <label for="awal_jabatan" class="label-ct">Awal Jabatan</label>
                            <input type="date" value="{{ date('Y-m-d') }}" id="awal_jabatan" name="awal_jabatan"
                                class="
                            @error('awal_jabatan')
                                input-error-ct
                            @else 
                                input-ct
                            @enderror
                            "
                                value="{{ old('awal_jabatan') }}" required>
                            @error('awal_jabatan')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="akhir_jabatan" class="label-ct">Akhir Jabatan</label>
                            <input type="date" id="akhir_jabatan" value="{{ date('Y-m-d') }}" name="akhir_jabatan"
                                class="
                            @error('akhir_jabatan')
                                input-error-ct
                            @else 
                                input-ct
                            @enderror
                            "
                                value="{{ old('akhir_jabatan') }}" required>
                            @error('akhir_jabatan')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="ketua" class="label-ct">Ketua</label>
                            <input type="text" id="ketua" name="ketua"
                                class="
                            @error('ketua')
                                input-error-ct
                            @else 
                                input-ct
                            @enderror
                            "
                                value="{{ old('ketua') }}" required>
                            @error('ketua')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="wakil_ketua" class="label-ct">Wakil Ketua</label>
                            <input type="text" id="wakil_ketua" name="wakil_ketua"
                                class="
                            @error('wakil_ketua')
                                input-error-ct
                            @else 
                                input-ct
                            @enderror
                            "
                                value="{{ old('wakil_ketua') }}" required>
                            @error('wakil_ketua')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="sekretaris" class="label-ct">Sekretaris</label>
                            <input type="text" id="sekretaris" name="sekretaris"
                                class="
                            @error('sekretaris')
                                input-error-ct
                            @else 
                                input-ct
                            @enderror
                            "
                                value="{{ old('sekretaris') }}" required>
                            @error('sekretaris')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="bendahara" class="label-ct">Bendahara</label>
                            <input type="text" id="bendahara" name="bendahara"
                                class="
                            @error('bendahara')
                                input-error-ct
                            @else 
                                input-ct
                            @enderror
                            "
                                value="{{ old('bendahara') }}" required>
                            @error('bendahara')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="sk" class="label-ct">SK</label>
                            <input type="file" id="sk" name="sk"
                                class="
                            @error('sk')
                                input-file-error
                            @else 
                                input-file
                            @enderror
                            "
                                value="{{ old('sk') }}" accept="application/pdf">
                            @error('sk')
                                <div class="error-message-ct">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" type="button" onclick="return confirm('Yakin ingin meyimpan data ?')"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-2 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-1.5 text-center">
                        Simpan
                    </button>
                    <button type="reset" data-modal-hide="modal-tambah-anggota" type="button"
                        class="py-1.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-100">
                        Batal
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
