<nav class="bg-primary-950 text-gray-300 border-gray-200 border-b border-t-0 text-[11px] lg:text-sm bg-opacity-90">
    <div class="flex flex-wrap justify-between items-center mx-auto custom-container py-1.5">
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="tel:{{ config('app.und-telp') }}" class="hover:underline flex items-center justify-center gap-1">
                <svg class="w-5 h-5 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z" />
                </svg>
                <span>{{ config('app.und-telp') }}</span>
            </a>
            <a href="mailto:{{ config('app.und-mail') }}"
                class="hover:underline flex items-center justify-center gap-1">
                <svg class="w-5 h-5 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2"
                        d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>
                <span>{{ config('app.und-mail') }}</span>
            </a>
        </div>
    </div>
</nav>

<nav id="navbar-container" class="bg-transparent border-gray-200 top-0 left-0 right-0 relative z-50">
    <div class="custom-container flex flex-wrap items-center justify-between mx-auto py-1.5 lg:py-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img id="navbar-image" src="{{ asset('assets/image/logo/unidayan.png') }}" class="h-10 lg:h-12"
                alt="Logo Unidayan PNG" />
            <span class="self-center text-xl lg:text-2xl xl:text-3xl font-bold whitespace-nowrap text-yellow-400">
                Informatika <span class="text-primary-500">Unidayan</span>
            </span>
        </a>
        <button data-collapse-toggle="navbar-multi-level" type="button"
            class="inline-flex items-center p-2 w-8 h-8 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-multi-level" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full lg:block lg:w-auto" id="navbar-multi-level">
            <ul
                class="flex flex-col font-medium p-4 lg:p-0 mt-4 border lg:space-x-6 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0 text-sm xl:text-base">
                <li>
                    <a href="{{ url('/') }}"
                        class="@if (request()->is('/')) navbar-link-active @else navbar-link @endif after:content-[' '] after:w-0 after:h-0.5 after:bg-yellow-300 after:absolute after:-bottom-0 after:left-0 relative hover:after:w-full after:transition-all after:duration-500"
                        aria-current="page">Beranda</a>
                </li>
                <li>
                    <button id="dropdownNavbarLinkOrganisasi" data-dropdown-toggle="dropdownNavbarOrganisasi"
                        class="flex items-center justify-between w-full lg:w-auto @if (request()->routeIs('daftar-organisasi.*')) navbar-link-active @else navbar-link @endif after:content-[' '] after:w-0 after:h-0.5 after:bg-yellow-300 after:absolute after:-bottom-0 after:left-0 relative hover:after:w-full after:transition-all after:duration-500">Mahasiswa
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarOrganisasi"
                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded shadow w-44">
                        <ul class="py-1.5 text-sm text-gray-700 pt-2" aria-labelledby="dropdownLargeButton">
                            <li aria-labelledby="dropdownNavbarLinkOrganisasi">
                                <button id="doubleDropdownButtonOrganisasi" data-dropdown-toggle="doubleDropdown"
                                    data-dropdown-placement="right-start" type="button"
                                    class="flex items-center justify-between w-full px-4 py-1.5 @if (request()->is('daftar-organisasi/*')) bg-gray-200 text-gray-700 @else hover:bg-gray-100 @endif">Daftar
                                    Organisasi<svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg></button>
                                <div id="doubleDropdown"
                                    class="z-50 hidden bg-white divide-y divide-gray-100 rounded shadow w-36">
                                    <ul class="py-1.5 text-sm text-gray-700"
                                        aria-labelledby="doubleDropdownButtonOrganisasi">
                                        @php
                                            use App\Models\Organisasi\Organisasi;
                                            $daftarOrganisasi = Organisasi::latest('id')->get();
                                        @endphp
                                        @forelse ($daftarOrganisasi as $row)
                                            <li>
                                                <a href="{{ url('/daftar-organisasi/' . $row->slug) }}"
                                                    class="block px-4 py-1.5 line-clamp-1 text-wrap @if (request()->is('daftar-organisasi/*') && $row->slug == $data->slug) bg-gray-200 text-gray-700 @else hover:bg-gray-100 @endif">{{ $row->nama_organisasi }}</a>
                                            </li>
                                        @empty
                                            <li>
                                                <a href="#" class="block px-4 py-1.5 hover:bg-gray-100">--</a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="{{ url('/kegiatan-organisasi') }}"
                                    class="block px-4 py-1.5  @if (request()->is('kegiatan-organisasi')) bg-gray-200 text-gray-700 @else hover:bg-gray-100 @endif">Kegiatan
                                    Organisasi</a>
                            </li>
                        </ul>
                        <div class="py-1 pt-2 text-sm text-gray-700 ">
                            <a href="{{ url('/kampus-merdeka') }}"
                                class="block px-4 py-1.5
                                @if (request()->is('kampus-merdeka')) bg-gray-200 text-gray-700 @else hover:bg-gray-100 @endif">Kampus
                                Merdeka</a>
                            <a href="{{ url('/kerja-praktek') }}"
                                class="block px-4 py-1.5
                                @if (request()->is('kerja-praktek')) bg-gray-200 text-gray-700 @else hover:bg-gray-100 @endif">Kerja
                                Praktek</a>
                        </div>
                    </div>
                </li>
                <li>
                    <button id="dropdownNavbar" data-dropdown-toggle="dropdownNavbarAlumni"
                        class="flex items-center justify-between w-full lg:w-auto @if (request()->is('alumni') || request()->is('karir')) navbar-link-active @else navbar-link @endif after:content-[' '] after:w-0 after:h-0.5 after:bg-yellow-300 after:absolute after:-bottom-0 after:left-0 relative hover:after:w-full after:transition-all after:duration-500;">Alumni
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownNavbarAlumni"
                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded shadow w-44">
                        <ul class="py-1.5 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ url('/alumni') }}"
                                    class="block px-4 py-1.5 hover:bg-gray-100 @if (request()->is('alumni')) bg-gray-100 @endif">
                                    Daftar
                                    Alumni</a>
                            </li>
                            <li>
                                <a href="{{ url('/karir') }}"
                                    class="block px-4 py-1.5 hover:bg-gray-100 @if (request()->is('karir')) bg-gray-100 @endif">
                                    Karir</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ url('/kegiatan') }}"
                        class="@if (request()->is(['kegiatan', 'kegiatan/*'])) navbar-link-active @else navbar-link @endif after:content-[' '] after:w-0 after:h-0.5 after:bg-yellow-300 after:absolute after:-bottom-0 after:left-0 relative hover:after:w-full after:transition-all after:duration-500">
                        Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ url('/tentang-kami') }}"
                        class="@if (request()->is('tentang-kami')) navbar-link-active @else navbar-link @endif after:content-[' '] after:w-0 after:h-0.5 after:bg-yellow-300 after:absolute after:-bottom-0 after:left-0 relative hover:after:w-full after:transition-all after:duration-700">
                        Tentang
                    </a>
                </li>
                <li>
                    <a href="{{ url('/login') }}"
                        class="block py-1.5 lg:py-0.5 px-4 rounded bg-yellow-400 mt-8 lg:mt-0 hover:bg-yellow-500 text-gray-100 duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-200">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
