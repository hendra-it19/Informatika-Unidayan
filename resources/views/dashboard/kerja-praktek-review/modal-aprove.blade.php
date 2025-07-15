<!-- Main modal -->
<div id="modal-isi-laporan-{{ $item['laporan']->id }}" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tentukan Dosen Pembimbing
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal-isi-laporan-{{ $item['laporan']->id }}">
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
                <form action="{{ route('admin-kp.updatePembimbing', $item['laporan']->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <div>
                        <div class="flex flex-col">
                            <label for="dosen_pembimbing" class="label-ct">Dosen Pembimbing<span
                                    class="text-red-400">*</span></label>
                            <select name="dosen_pembimbing" id="dosen_pembimbing"
                                class="w-full overflow-x-hidden @error('dosen_pembimbing')
                        input-error-ct
                            @else
                        input-ct
                        @enderror"
                                required>
                                <option value="">Pilih pembimbing utama</option>
                                @foreach ($dosen as $row)
                                    @if ($row->id == old('dosen_pembimbing'))
                                        <option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
                                    @else
                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('dosen_pembimbing')
                                <small class="error-message-ct">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <button type="submit" class="btn-primary w-full mt-5">Konfirmasi Perubahan</button>
                    <button
                        class="btn-secondary w-full mt-2"data-modal-hide="modal-isi-laporan-{{ $item['laporan']->id }}">Tutup
                        Modal</button>
                </form>
            </div>
        </div>
    </div>
</div>
