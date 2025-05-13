@extends('layouts.dashboard')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    <section class="min-h-screen">
        <nav class="mt-4 mb-6 xl:mb-10 flex px-5 py-2 text-gray-700 rounded bg-white shadow-sm" aria-label="Breadcrumb">
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
                            Bimbingan TA
                        </span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="shadow bg-white rounded px-4 py-8">
            @if (empty($ta))
                <p class="py-0.5 px-2 bg-red-500 text-white w-fit rounded-sm mb-1 text-xs">Belum memenuhi persyaratan</p>
                <p class="text-gray-600 text-sm">Belum ada judul yang terverifikasi. Anda belum bisa melakukan bimbingan
                    Tugas
                    Akhir(TA)</p>
                <p class="text-gray-600 text-sm">Klik <a href="{{ route('pengajuan-ta.index') }}"
                        class="underline text-blue-400">disini</a> untuk kontrol
                    pengajuan TA</p>
            @else
                <p class="text-xs py-0.5 px-2 rounded-sm bg-green-600 text-white w-fit">Judul telah diverifikasi pada :
                    {{ $carbon::parse($ta->created_at)->diffForHumans() }}</p>
                <h1 class="text-base">{{ $ta->judul }}</h1>
                <div class="mt-3">
                    <div class="relative overflow-x-auto border sm:rounded">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        Pembimbing Utama
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $ta->pembimbing_utama->nama ?? 'Belum ditentukan!' }}
                                    </td>
                                    <td>
                                        @if (!empty($ta->pembimbing_utama_id))
                                            <a href="{{ route('bimbingan-ta.chat', $ta->id) }}" target="_blank"
                                                class="flex items-center justify-center gap-1 w-fit text-sm py-0.5 px-2 text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-200 rounded-sm">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                Mulai
                                                Bimbingan</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        Pembimbing Pendamping
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $ta->pembimbing_pendamping->nama ?? 'Belum ditentukan!' }}
                                    </td>
                                    <td>
                                        @if (!empty($ta->pembimbing_pendamping_id))
                                            <a href="{{ url('bimbingan-ta/' . $ta->id . '/chat?p=utama') }}" target="_blank"
                                                class="flex items-center justify-center gap-1 w-fit text-sm py-0.5 px-2 text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-200 rounded-sm">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Mulai
                                                Bimbingan</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
