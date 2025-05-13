<nav class="fixed top-0 z-20 w-full bg-white border-b border-gray-200 shadow-sm">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ url('/') }}" class="flex ms-2 md:me-24">
                    <img src="{{ asset('assets/image/logo/unidayan.png') }}" class="h-8 md:h-10 me-3"
                        alt="Logo Unidayan" />
                    <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap text-primary-600">IT<span
                            class="text-yellow-400">UND</span></span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="text-xs lg:text-sm"">
                        <button type="button" class="flex bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="@if (empty(auth()->user()->foto)) https://placehold.co/100x100?text=ADM
                                    @else {{ asset(auth()->user()->foto) }} @endif"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 mx-2 text-base list-none bg-white divide-y divide-gray-100 rounded shadow max-w-[200px]"
                        id="dropdown-user">
                        <div class="px-8 py-3" role="none">
                            <p class="text-gray-900 uppercase text-xs" role="none">
                                {{ auth()->user()->role }}
                            </p>
                            <p class="font-medium text-gray-900 text-wrap line-clamp-1" role="none">
                                {{ auth()->user()->nama }}
                            </p>
                        </div>
                        <ul class="py-1 text-xs lg:text-sm"" role="none">
                            <li>
                                <a href="{{ route('pengaturan-akun.index') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Akun</a>
                            </li>
                            <li class="px-4 pb-3 mt-3">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 py-1 rounded text-gray-100 bg-gray-600 w-full hover:bg-gray-700 focus:outline-none outline-none focus:ring-2 focus:ring-gray-200"
                                        role="menuitem" onclick="return confirm('Yakin ingin keluar?')">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
