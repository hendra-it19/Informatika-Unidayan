<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 md:z-10 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium text-xs xl:text-sm 2xl:text-base relative">
            <li>
                <a href="{{ url('/dashboard') }}"
                    class="@if (request()->is('dashboard')) sidebar-active @else sidebar @endif">
                    <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'kaprodi')
                @include('layouts.dashboard.sidebar-admin')
            @endif

            @if (auth()->user()->role == 'alumni')
                @include('layouts.dashboard.sidebar-alumni')
            @endif

            @if (auth()->user()->role == 'mahasiswa')
                @include('layouts.dashboard.sidebar-mahasiswa')
            @endif

            @if (auth()->user()->role == 'dosen')
                @include('layouts.dashboard.sidebar-dosen')
            @endif

            @if (auth()->user()->role == 'organisasi')
                @include('layouts.dashboard.sidebar-organisasi')
            @endif

            <li>
                <a href="{{ route('pengaturan-akun.index') }}"
                    class="@if (request()->routeIs(['pengaturan-akun.*'])) sidebar-active @else sidebar @endif">
                    <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Pengaturan Akun</span>
                </a>
            </li>


            <li class="pt-8 w-full">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button onclick="return confirm('Yakin ingin keluar?')" type="submit"
                        class="flex items-center justify-center gap-2 w-fit m-auto px-4 py-1 rounded text-gray-100 bg-gray-600 hover:bg-gray-700 focus:outline-none outline-none focus:ring-2 focus:ring-gray-200">
                        <svg class="aspect-square h-3 lg:h-4 transition duration-75" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="ms-3 whitespace-nowrap">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
