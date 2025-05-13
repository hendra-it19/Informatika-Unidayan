<li>
    <button type="button" class="w-full @if (request()->routeIs(['slider.*', 'mitra.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-slider" data-collapse-toggle="dropdown-slider">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Slider</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-slider" class="hidden py-1 space-y-0.5">
        <li>
            <a href="{{ route('slider.index') }}"
                class="@if (request()->routeIs(['slider.*'])) sidebar-child-active
        @else sidebar-child @endif">Beranda</a>
        </li>
        <li>
            <a href="{{ route('mitra.index') }}"
                class="@if (request()->routeIs(['mitra.*'])) sidebar-child-active
    @else sidebar-child @endif">Mitra</a>
        </li>
    </ul>
</li>
<li>
    <button type="button" class="w-full @if (request()->routeIs(['kegiatan-prodi.*', 'kategori-kegiatan-prodi.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-kegiatan" data-collapse-toggle="dropdown-kegiatan">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Kegiatan Prodi</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-kegiatan" class="hidden py-2 space-y-1.5">
        <li>
            <a href="{{ route('kategori-kegiatan-prodi.index') }}"
                class="@if (request()->routeIs(['kategori-kegiatan-prodi.*'])) sidebar-child-active
    @else sidebar-child @endif">Kategori</a>
        </li>
        <li>
            <a href="{{ route('kegiatan-prodi.index') }}"
                class="@if (request()->routeIs(['kegiatan-prodi.*'])) sidebar-child-active
            @else sidebar-child @endif">Postingan</a>
        </li>
    </ul>
</li>

<li>
    <button type="button" class="w-full @if (request()->routeIs(['akun-organisasi.*', 'postingan-organisasi.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-organisasi" data-collapse-toggle="dropdown-organisasi">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Organisasi</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-organisasi" class="hidden py-2 space-y-1.5">
        <li>
            <a href="{{ route('akun-organisasi.index') }}"
                class="@if (request()->routeIs(['akun-organisasi.*'])) sidebar-child-active
        @else sidebar-child @endif">
                Akun
            </a>
        </li>
        <li>
            <a href="{{ route('postingan-organisasi.index') }}"
                class="@if (request()->routeIs(['postingan-organisasi.*'])) sidebar-child-active
            @else sidebar-child @endif">Postingan</a>
        </li>
    </ul>
</li>

<li>
    <button type="button" class="w-full @if (request()->routeIs(['alumni.*', 'alumni-karir.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-alumni" data-collapse-toggle="dropdown-alumni">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Alumni</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-alumni" class="hidden py-1 space-y-0.5">
        <li>
            <a href="{{ route('alumni.index') }}"
                class="@if (request()->routeIs(['alumni.*'])) sidebar-child-active
            @else sidebar-child @endif">Alumni</a>
        </li>
        <li>
            <a href="{{ route('alumni-karir.index') }}"
                class="@if (request()->routeIs(['alumni-karir.*'])) sidebar-child-active
        @else sidebar-child @endif">Karir</a>
        </li>
    </ul>
</li>
<li>
    <button type="button" class="w-full @if (request()->routeIs(['pemeriksaan-ta.*', 'bimbingan-ta.*', 'penetapan-pembimbing-ta.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-tugas-akhir" data-collapse-toggle="dropdown-tugas-akhir">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                clip-rule="evenodd" />
            <path fill-rule="evenodd"
                d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tugas Akhir</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-tugas-akhir" class="hidden py-1 space-y-0.5">
        <li>
            <a href="{{ route('pemeriksaan-ta.index') }}"
                class="@if (request()->routeIs(['pemeriksaan-ta.*'])) sidebar-child-active
                            @else sidebar-child @endif">Pemeriksaan
            </a>
        </li>
        <li>
            <a href="{{ route('penetapan-pembimbing-ta.index') }}"
                class="@if (request()->routeIs(['penetapan-pembimbing-ta.*'])) sidebar-child-active
                            @else sidebar-child @endif">
                Penetapan Pembimbing
            </a>
        </li>
        @if (auth()->user()->role == 'kaprodi')
            <li>
                <a href="{{ route('bimbingan-ta.index') }}"
                    class=" @if (request()->routeIs(['bimbingan-ta.*'])) sidebar-child-active
                        @else sidebar-child @endif">Bimbingan</a>
            </li>
        @endif
    </ul>
</li>
{{--  --}}
<li>
    <button type="button" class="w-full @if (request()->routeIs(['akun-mahasiswa.*', 'akun-staff.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-akun" data-collapse-toggle="dropdown-akun">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manajemen Pengguna</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-akun" class="hidden py-1 space-y-0.5">
        <li>
            <a href="{{ route('akun-staff.index') }}"
                class="@if (request()->routeIs(['akun-staff.*'])) sidebar-child-active
        @else sidebar-child @endif">Dosen</a>
        </li>
        <li>
            <a href="{{ route('akun-mahasiswa.index') }}"
                class="@if (request()->routeIs(['akun-mahasiswa.*'])) sidebar-child-active
            @else sidebar-child @endif">Mahasiswa</a>
        </li>
    </ul>
</li>
