<a href="javascript:void(0)" data-modal-target="modal-terima-pengajuan" data-modal-toggle="modal-terima-pengajuan"
    class="flex items-center justify-center gap-1 py-0.5 px-5 rounded text-white bg-green-500 hover:bg-green-600 focus:ring-2 focus:ring-green-200 focus:bg-green-700">
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <span>Terima</span>
</a>
<div>
    <!-- Main modal -->
    <div id="modal-terima-pengajuan" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form action="{{ route('pemeriksaan-ta.terima') }}" method="post">
                @csrf
                @method('post')
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ">
                            Untuk mengkonfirmasi penerimaan judul anda harus memilih dosen pembimbing untuk judul
                            terkait.
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="modal-terima-pengajuan">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 text-sm w-full">
                        <input type="hidden" name="pengajuan_id" value="{{ $id }}">
                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                        <div class="w-full mb-4">
                            <div class="flex flex-col gap-0.5">
                                <label for="judul">Judul Tugas Akhir</label>
                                <input type="text" name="judul" id="judul" required
                                    class="rounded border border-gray-600 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 py-1">
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex flex-col gap-0.5">
                                <label for="pembimbing_utama">Dosen Pembimbing Utama</label>
                                <select name="pembimbing_utama" id="pembimbing_utama" required
                                    class="rounded border border-gray-600 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 py-1 cursor-pointer">
                                    <option value="">Pilih Dosen Pembimbing</option>
                                    @foreach ($dosen as $data)
                                        <option value="{{ $data->id }}" class="line-clamp-1 text-sm">
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <label for="pembimbing_pendamping">Dosen Pembimbing Pendamping</label>
                                <select name="pembimbing_pendamping" id="pembimbing_pendamping" required
                                    class="rounded border border-gray-600 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 py-1 cursor-pointer">
                                    <option value="">Pilih Dosen Pembimbing</option>
                                    @foreach ($dosen as $data)
                                        <option value="{{ $data->id }}" class="line-clamp-1 text-sm">
                                            {{ $data->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full mt-4" class="flex flex-col gap-0.5">
                            <label for="keterangan_tambahan">Masukkan Keterangan Tambahan</label>
                            <textarea name="keterangan_tambahan" id="keterangan_tambahan"
                                class="w-full rounded border border-gray-600 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 py-1"
                                rows="4" required></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" type="button"
                            onclick="return confirm('Yakin ingin konfirmasi penilaian ?')"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-2 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-1.5 text-center">
                            Simpan
                        </button>
                        <button type="reset" data-modal-hide="modal-terima-pengajuan" type="button"
                            class="py-1.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-100">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
