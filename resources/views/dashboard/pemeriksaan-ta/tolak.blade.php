<a href="javascript:void(0)" data-modal-target="modal-tolak-pengajuan" data-modal-toggle="modal-tolak-pengajuan"
    class="flex items-center justify-center gap-1 py-0.5 px-5 rounded text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-200 focus:bg-red-700">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <span>Tolak</span>
</a>
<div>
    <!-- Main modal -->
    <div id="modal-tolak-pengajuan" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form action="{{ route('pemeriksaan-ta.tolak') }}" method="post">
                @csrf
                @method('post')
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ">
                            Dengan konfirmasi ini, anda meyatakan penolakan atas pengajuan judul
                            mahasiswa yang bersangkutan.
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="modal-tolak-pengajuan">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 text-sm flex flex-col items-center justify-center w-full">
                        <div class="w-full">
                            <input type="hidden" name="pengajuan_id" value="{{ $id }}">
                            <label for="keterangan_tambahan">Masukkan Keterangan Tambahan</label>
                            <textarea name="keterangan_tambahan" id="keterangan_tambahan"
                                class="w-full rounded border border-gray-600 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 py-1"
                                rows="6" required></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" type="button"
                            onclick="return confirm('Yakin ingin konfirmasi penilaian ?')"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-1.5 text-center">
                            Simpan
                        </button>
                        <button type="reset" data-modal-hide="modal-tolak-pengajuan" type="button"
                            class="py-1.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
