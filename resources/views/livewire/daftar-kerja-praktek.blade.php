<div class="relative">
    <div class="flex border w-fit overflow-hidden rounded-md text-sm">
        <label for="tab_baru"
            class="{{ $tab == 'baru' ? 'py-1 px-4 bg-primary-500 text-white cursor-not-allowed' : 'py-1 px-4 bg-gray-400 text-white cursor-pointer' }}">
            Daftar Baru
        </label>
        <label for="tab_lama"
            class="{{ $tab == 'lama' ? 'py-1 px-4 bg-primary-500 text-white cursor-not-allowed' : 'py-1 px-4 bg-gray-400 text-white cursor-pointer' }}">
            Gabung Kelompok
        </label>
        <input type="radio" wire:model.live="tab" value="baru" id="tab_baru" class="hidden">
        <input type="radio" wire:model.live="tab" value="lama" id="tab_lama" class="hidden">
    </div>
    @if ($tab == 'baru')
        <div class="mt-6">
            <form wire:submit="simpanBaru" enctype="multipart/form-data" method="POST">

                <h2 class="mb-3">Data Mitra</h2>

                <div class="mb-3">
                    <label for="mitra" class="label-ct">Nama Mitra</label>
                    <input type="text" id="mitra" wire:model="mitra"
                        class="@error('mitra') input-error-ct  @else input-ct @enderror" required>
                    @error('mitra')
                        <small class="error-message-ct">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="tahun" class="label-ct">Tahun</label>
                        <input type="text" id="tahun" wire:model="tahun"
                            class="@error('tahun') input-error-ct @else input-ct @enderror" required>
                        @error('tahun')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="semester" class="label-ct">Periode Semester</label>
                        <select id="semester" wire:model="semester"
                            class="@error('semester') input-error-ct @else input-ct @enderror" required>
                            <option value="">Pilih periode</option>
                            <option value="genap">Genap</option>
                            <option value="ganjil">Ganjil</option>
                        </select>
                        @error('semester')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="tanggal_mulai" class="label-ct">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" wire:model="tanggal_mulai"
                            class="@error('tanggal_mulai') input-error-ct @else input-ct @enderror" required>
                        @error('tanggal_mulai')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_selesai" class="label-ct">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" wire:model="tanggal_selesai"
                            class="@error('tanggal_selesai') input-error-ct @else input-ct @enderror" required>
                        @error('tanggal_selesai')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <h2 class="mb-3 mt-5">Data Mahasiswa</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="sks_tempuh" class="label-ct">Jumlah SKS Tempuh</label>
                        <input type="number" id="sks_tempuh" wire:model="sks_tempuh"
                            class="@error('sks_tempuh') input-error-ct @else input-ct @enderror" required>
                        @error('sks_tempuh')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="transkrip_nilai" class="label-ct">Transkrip Nilai</label>
                        <input type="file" id="transkrip_nilai" accept=".pdf" wire:model="transkrip_nilai"
                            class="@error('transkrip_nilai') input-file-error @else input-file @enderror" required>
                        @error('transkrip_nilai')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="w-full flex justify-between mt-6">
                    <a href="{{ route('kerja-praktek.index') }}" onclick="return confirm('Yakin ingin kembali?')"
                        class="btn-secondary">Kembali</a>
                    <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="btn-primary">
                        <span wire:loading.remove wire:target="submit">Simpan</span>
                        <span wire:loading wire:target="submit">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="mt-6 relative">
            <div wire:loading wire:target="tahun,semester"
                class="absolute h-screen w-full inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                <div class="text-center">
                    <svg class="animate-spin h-8 w-8 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 100 16v4l3.5-3.5L12 20v-4a8 8 0 01-8-8z">
                        </path>
                    </svg>
                    <p class="mt-2 text-gray-600 text-sm">Memuat daftar mitra...</p>
                </div>
            </div>
            <div>

                <h2 class="mb-3">Data Mitra</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="tahun" class="label-ct">Tahun</label>
                        <select id="tahun" wire:model.live="tahun" wire:change="perbaruiTahun"
                            class="@error('tahun') input-error-ct @else input-ct @enderror" required>
                            <option value="">Pilih tahun</option>
                            @foreach ($listTahun as $r)
                                <option value="{{ $r }}">{{ $r }}</option>
                            @endforeach
                        </select>
                        @error('tahun')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="semester" class="label-ct">Periode Semester</label>
                        <select id="semester" wire:model.live="semester" wire:change="perbaruiSemester"
                            class="@error('semester') input-error-ct @else input-ct @enderror" required>
                            <option value="">Pilih semester</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                        @error('semester')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mitra" class="label-ct">Mitra Tempat KP</label>
                    <select id="mitra" wire:model.live="mitra" wire:change="perbaruiMitra"
                        class="@error('mitra') input-error-ct @else input-ct @enderror" required>
                        <option value="">Pilih mitra</option>
                        @foreach ($listMitra as $r)
                            <option value="{{ $r->id }}">{{ $r->mitra }} | {{ $r->diusulkan_oleh }}
                            </option>
                        @endforeach
                    </select>
                    @error('mitra')
                        <small class="error-message-ct">{{ $message }}</small>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="tanggal_mulai" class="label-ct">Tanggal Mulai</label>
                        <input readonly type="date" id="tanggal_mulai" wire:model="tanggal_mulai"
                            class="input-ct bg-gray-200 focus:border-none focus:ring-0" required>
                        @error('tanggal_mulai')
                            <small class="error-message-ct">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_selesai" class="label-ct">Tanggal Selesai</label>
                        <input type="date" readonly id="tanggal_selesai" wire:model="tanggal_selesai"
                            class="input-ct bg-gray-200 focus:border-none focus:ring-0" required>
                    </div>
                </div>


                <div class="mb-3 mt-5 flex gap-4">
                    <h2>Data Mahasiswa</h2>

                    @if (!empty($simpanMitra))
                        <button wire:click="bukaModal" class="btn-primary cursor-pointer">
                            {{ $loadingModal ? 'Membuka...' : 'Lihat Pendaftar' }}
                        </button>
                    @endif
                </div>

                <!-- Modal -->
                @if ($showModal)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" x-data
                        @keydown.escape.window="Livewire.emit('tutupModal')">
                        <div class="bg-white rounded shadow-lg w-full max-w-md p-4"
                            @click.outside="Livewire.emit('tutupModal')">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Daftar Mahasiswa di Mitra: {{ $simpanMitra->mitra }}
                                </h3>
                                <button wire:click="tutupModal"
                                    class="text-gray-500 hover:text-gray-700">&times;</button>
                            </div>

                            @if (count($listPendaftar) > 0)
                                <table class="w-full border">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="border px-3 py-2 text-sm">NIM</th>
                                            <th class="border px-3 py-2 text-sm">Nama</th>
                                            <th class="border px-3 py-2 text-sm">Status Pendaftaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listPendaftar as $m)
                                            <tr>
                                                <td class="border px-3 py-2 text-sm">
                                                    {{ $m->mahasiswa->user->identitas }}</td>
                                                <td class="border px-3 py-2 text-sm">{{ $m->mahasiswa->user->nama }}
                                                </td>
                                                <td class="border px-3 py-2 text-sm">{{ $m->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-sm text-gray-600">Belum ada mahasiswa terdaftar di mitra ini.</p>
                            @endif

                            <div class="mt-4 text-right">
                                <button wire:click="tutupModal"
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Tutup</button>
                            </div>
                        </div>
                    </div>
                @endif


                <form enctype="multipart/form-data" wire:submit="simpanLama" method="POST">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-3">
                        <div>
                            <label for="sks_tempuh" class="label-ct">Jumlah SKS Tempuh</label>
                            <input type="number" id="sks_tempuh" wire:model="sks_tempuh"
                                class="@error('sks_tempuh') input-error-ct @else input-ct @enderror" required>
                            @error('sks_tempuh')
                                <small class="error-message-ct">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="transkrip_nilai" class="label-ct">Transkrip Nilai</label>
                            <input type="file" id="transkrip_nilai" accept=".pdf" wire:model="transkrip_nilai"
                                class="@error('transkrip_nilai') input-file-error @else input-file @enderror"
                                required>
                            @error('transkrip_nilai')
                                <small class="error-message-ct">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full flex justify-between mt-6">
                        <a href="{{ route('kerja-praktek.index') }}" onclick="return confirm('Yakin ingin kembali?')"
                            class="btn-secondary">Kembali</a>
                        <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                            class="btn-primary">
                            <span wire:loading.remove wire:target="submit">Simpan</span>
                            <span wire:loading wire:target="submit">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
