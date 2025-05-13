<li>
    <button type="button" class="w-full @if (request()->routeIs(['pengajuan-ta.*', 'bimbingan-ta.*', 'detail-ta.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-akun" data-collapse-toggle="dropdown-akun">
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
    <ul id="dropdown-akun" class="hidden py-1 space-y-0.5">
        <li>
            <a href="{{ route('pengajuan-ta.index') }}"
                class="@if (request()->routeIs(['pengajuan-ta.*'])) sidebar-child-active
        @else sidebar-child @endif">Pengajuan</a>
        </li>
        <li>
            <a href="{{ route('bimbingan-ta.index') }}"
                class="@if (request()->routeIs(['bimbingan-ta.*'])) sidebar-child-active
    @else sidebar-child @endif">Bimbingan</a>
        </li>
    </ul>
</li>

<li>
    <button type="button" class="w-full @if (request()->routeIs(['kerja-praktek.*', 'kampus-merdeka.*'])) sidebar-active @else sidebar @endif"
        aria-controls="dropdown-kp-msib" data-collapse-toggle="dropdown-kp-msib">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M12 8a1 1 0 0 0-1 1v10H9a1 1 0 1 0 0 2h11a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-8Zm4 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z"
                clip-rule="evenodd" />
            <path fill-rule="evenodd"
                d="M5 3a2 2 0 0 0-2 2v6h6V9a3 3 0 0 1 3-3h8c.35 0 .687.06 1 .17V5a2 2 0 0 0-2-2H5Zm4 10H3v2a2 2 0 0 0 2 2h4v-4Z"
                clip-rule="evenodd" />
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tugas Akhir</span>
        <svg class="w-2.5 h-2.5 group-focus:rotate-180 duration-300 transition" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-kp-msib" class="hidden py-1 space-y-0.5">
        <li>
            <a href="{{ route('kerja-praktek.index') }}"
                class="@if (request()->routeIs(['kerja-praktek.*'])) sidebar-child-active
        @else sidebar-child @endif">Kerja
                Praktek</a>
        </li>
        <li>
            <a href="{{ route('kampus-merdeka.index') }}"
                class="@if (request()->routeIs(['kampus-merdeka.*'])) sidebar-child-active
    @else sidebar-child @endif">Kampus
                Merdeka</a>
        </li>
    </ul>
</li>
