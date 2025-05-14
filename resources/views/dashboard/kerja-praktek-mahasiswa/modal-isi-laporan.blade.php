<!-- Main modal -->
<div id="modal-isi-laporan-{{ $isiSekarang['tanggal'] }}" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md lg:max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white capitalize">
                    Laporan {{ $isiSekarang['jenis_laporan'] }}
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal-isi-laporan-{{ $isiSekarang['tanggal'] }}">
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
                <p class="mb-4 text-sm">Isi status kehadiran anda serta berikan keterangan kegiatan yang anda lakukan
                    atau isi keterangan
                    sesuai kondisi jika anda tidak mengikuti kegiatan pada tanggal
                    {{ $carbon::parse($isiSekarang['tanggal'])->format('d-m-Y') }}</p>
                <form class="space-y-4" action="{{ route('kerja-praktek.simpanLaporan', $kerjaPraktek->id) }}"
                    method="POST">

                    @csrf
                    @method('post')

                    <input type="hidden" name="tanggal" value="{{ $carbon::parse($isiSekarang['tanggal']) }}">
                    <input type="hidden" name="jenis_laporan" value="{{ $isiSekarang['jenis_laporan'] }}">

                    <div>
                        {{-- Radio Kehadiran --}}
                        <div>
                            <label class="label-ct">Kehadiran</label>
                            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2">
                                @php
                                    $kehadiranOptions = [
                                        [
                                            'value' => 'hadir',
                                            'label' => 'Hadir',
                                            'icon' => '',
                                        ],
                                        ['value' => 'sakit', 'label' => 'Sakit', 'icon' => 'heart-crack'],
                                        ['value' => 'izin', 'label' => 'Izin', 'icon' => 'calendar-days'],
                                        ['value' => 'alpa', 'label' => 'Alpa', 'icon' => 'circle-slash'],
                                        ['value' => 'libur', 'label' => 'Libur', 'icon' => 'calendar-x'],
                                    ];
                                @endphp

                                @foreach ($kehadiranOptions as $item)
                                    <label
                                        class="flex items-center justify-center text-sm p-1 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <input type="radio" name="kehadiran" value="{{ $item['value'] }}"
                                            class="hidden peer" required>
                                        <div
                                            class="flex items-center gap-2 peer-checked:text-primary-600 peer-checked:font-semibold">
                                            <span>{{ ucfirst($item['label']) }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Textarea Deskripsi --}}
                        <div class="mt-3">
                            <label for="deskripsi" class="label-ct">Deskripsi /
                                Keterangan</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" required class="input-ct"
                                placeholder="Tuliskan keterangan kegiatan hari ini..."></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 text-center">
                        <button type="submit" class="btn-primary">
                            Simpan Laporan
                        </button>
                        <a type="submit" class="btn-secondary"
                            data-modal-hide="modal-isi-laporan-{{ $isiSekarang['tanggal'] }}">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
