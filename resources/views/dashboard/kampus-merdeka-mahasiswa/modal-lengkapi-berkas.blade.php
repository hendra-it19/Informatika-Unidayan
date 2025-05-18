<!-- Main modal -->
<div id="modal-lengkapi-berkas" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Laporan Akhir
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal-lengkapi-berkas">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-sm py-3">
                    Pilih file yang akan diupload untuk menyimpan file baru atau mengganti file yang sudah ada
                    sebelumnya.
                </p>
                <form class="space-y-4" action="{{ route('kampus-merdeka.update-berkas', $msib->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div>

                        <div class="grid grid-cols-1 gap-4">

                            <!-- Laporan Akhir -->
                            <div>
                                <label class="text-sm font-medium text-gray-900">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 4v16h12V8.828L13.172 4H6z" />
                                        </svg>
                                        Laporan Akhir
                                    </div>
                                </label>
                                <input type="file" name="laporan_akhir" accept="application/pdf"
                                    @if (!$laporan_akhir) disabled @endif
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                @if (!$laporan_akhir) bg-gray-100 text-gray-400 cursor-not-allowed @endif">
                                @if (!$laporan_akhir)
                                    <p class="mt-1 text-sm text-gray-500 italic">Laporan akhir hanya dapat diunggah
                                        setelah semua laporan selesai.</p>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="flex flex-col text-center gap-2 w-full">
                        <button class="btn-primary">Simpan</button>
                        <a class="btn-secondary cursor-pointer" data-modal-hide="modal-lengkapi-berkas">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
