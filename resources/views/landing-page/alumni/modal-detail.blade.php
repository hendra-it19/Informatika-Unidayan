<!-- Main modal -->
<div id="modal-detail-{{ $r->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-3 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Detail Alumni
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="modal-detail-{{ $r->id }}">
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
                <ol class="relative border-s border-gray-200 ms-3.5 mb-4 md:mb-5">
                    <li class="mb-5 ms-5">
                        <span
                            class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white">
                            <svg class="w-2.5 h-2.5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                            </svg>
                        </span>
                        <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900">
                            Foto
                        </h3>
                        <img src="@if (empty($r->user->foto)) https://placehold.co/100?text=? @else {{ asset($r->user->foto) }} @endif"
                            alt="foto {{ $r->nama }}"
                            class="rounded-md border-gray-300 border-[3px] aspect-square w-32 object-cover bg-cover"
                            loading="lazy">
                    </li>
                    <li class="mb-5 ms-5">
                        <span
                            class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white">
                            <svg class="w-2.5 h-2.5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.306-.613-.933-1-1.618-1H7.618c-.685 0-1.312.387-1.618 1M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                            </svg>
                        </span>
                        <h3 class="mb-1 text-lg font-semibold text-gray-900">Deskripsi</h3>
                        <time class="block mb-3 text-sm font-normal leading-none text-gray-500">Update data
                            {{ $r->updated_at }}</time>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Nama </td>
                                        <td class="pl-2 block"> : {{ $r->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIM </td>
                                        <td class="pl-2 block"> : {{ $r->nim }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir </td>
                                        <td class="pl-2 block"> : {{ $r->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir </td>
                                        <td class="pl-2 block"> :
                                            {{ $carbon::parse($r->tanggal_lahir)->format('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Lulus </td>
                                        <td class="pl-2 block"> : {{ $r->tahun_lulus }}</td>
                                    </tr>
                                    <tr>
                                        <td>IPK </td>
                                        <td class="pl-2 block"> : {{ $r->ipk }} / 4.0</td>
                                    </tr>
                                    <tr>
                                        <td>Status </td>
                                        <td class="pl-2 block uppercase"> : {{ $r->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan </td>
                                        <td class="pl-2 block"> : {{ $r->detail_status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ol>
                <button
                    class="text-white inline-flex w-full justify-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center">
                    Tutup Detail Data
                </button>
            </div>
        </div>
    </div>
</div>
