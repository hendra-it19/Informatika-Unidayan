<div id="modal-periksa-ta" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form action="{{ route('pemeriksaan-ta.store') }}" method="post">
            @csrf
            <input type="hidden" name="pengajuan_tugas_akhir_id" value="{{ $data->id }}">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Masukkan Penilaian Sebagai Verifikator
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-periksa-ta">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 text-sm flex flex-col items-center justify-center w-full">
                    <div class="w-full">
                        <h5 class="underline font-semibold">Judul Pertama</h5>
                        <p class="mt-1.5">Status :</p>
                        <div class="flex gap-3 items-center">
                            <div>
                                <input type="radio" name="status_judul_pertama" id="terima1" value="terima"
                                    required>
                                <label for="terima1">Terima</label>
                            </div>
                            <div>
                                <input type="radio" name="status_judul_pertama" id="revisi1" value="revisi"
                                    required>
                                <label for="revisi1">Revisi</label>
                            </div>
                            <div>
                                <input type="radio" name="status_judul_pertama" id="tolak1" value="tolak"
                                    required>
                                <label for="tolak1">Tolak</label>
                            </div>
                        </div>
                        <label for="keterangan_judul_pertama" class="block mt-1.5">Keterangan tambahan
                            :</label>
                        <textarea required name="keterangan_judul_pertama" id="keterangan_judul_pertama" rows="3"
                            class="w-full rounded focus:border-primary-500"></textarea>
                    </div>
                    <div class="mt-3 w-full">
                        <h5 class="underline font-semibold">Judul Kedua</h5>
                        <p class="mt-1.5">Status :</p>
                        <div class="flex gap-3 items-center">
                            <div>
                                <input type="radio" name="status_judul_kedua" id="terima2" value="terima" required>
                                <label for="terima2">Terima</label>
                            </div>
                            <div>
                                <input type="radio" name="status_judul_kedua" id="revisi2" value="revisi" required>
                                <label for="revisi2">Revisi</label>
                            </div>
                            <div>
                                <input type="radio" name="status_judul_kedua" id="tolak2" value="tolak" required>
                                <label for="tolak2">Tolak</label>
                            </div>
                        </div>
                        <label for="keterangan_judul_kedua" class="block mt-1.5">Keterangan tambahan
                            :</label>
                        <textarea required name="keterangan_judul_kedua" id="keterangan_judul_kedua" rows="3"
                            class="w-full rounded focus:border-primary-500"></textarea>
                    </div>
                    <div class="mt-3 w-full">
                        <h5 class="underline font-semibold">Judul Ketiga</h5>
                        <p class="mt-1.5">Status :</p>
                        <div class="flex gap-3 items-center">
                            <div>
                                <input type="radio" name="status_judul_ketiga" id="terima3" value="terima" required>
                                <label for="terima3">Terima</label>
                            </div>
                            <div>
                                <input type="radio" name="status_judul_ketiga" id="revisi3" value="revisi" required>
                                <label for="revisi3">Revisi</label>
                            </div>
                            <div>
                                <input type="radio" name="status_judul_ketiga" id="tolak3" value="tolak" required>
                                <label for="tolak3">Tolak</label>
                            </div>
                        </div>
                        <label for="keterangan_judul_ketiga" class="block mt-1.5">Keterangan tambahan
                            :</label>
                        <textarea required name="keterangan_judul_ketiga" id="keterangan_judul_ketiga" rows="3"
                            class="w-full rounded focus:border-primary-500"></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" type="button"
                        onclick="return confirm('Yakin ingin meyimpan penilaian ?')"
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
