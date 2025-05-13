@extends('layouts.landing-page')

@section('pages')
    <main class="bg-gray-200">
        <section class="m-auto">
            <div class="px-2 py-5 md:py-8 lg:py-10 w-full max-w-md h-fit m-auto">
                <div class="bg-white rounded px-5 py-10">

                    <div class="flex gap-3 items-center mb-3">
                        {{-- <hr class="h-0.5 w-full bg-gray-400 rounded-md"> --}}
                        <H1 class="text-gray-700 lg:text-lg font-semibold">LOGIN</H1>
                        {{-- <hr class="h-0.5 w-full bg-gray-400 rounded-md"> --}}
                    </div>

                    @if (Session::get('errors'))
                        <p class="text-sm text-gray-700 mb-4">Harap masukkan username dan password anda untuk proses validasi
                        </p>
                    @else
                        <p class="text-sm text-gray-700 mb-2">Harap masukkan username dan password anda untuk proses validasi
                        </p>
                    @endif

                    @error('username')
                        <div>
                            <div class="bg-red-400 text-gray-900 w-full rounded-sm shadow-sm my-2 text-sm p-2">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                    @error('captcha')
                        <div>
                            <div class="bg-red-400 text-gray-900 w-full rounded-sm shadow-sm my-2 text-sm p-2">
                                Kode keamanan captcha anda salah!
                            </div>
                        </div>
                    @enderror


                    <form method="post" action="{{ route('loginPost') }}">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">
                                Username
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-3 h-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                    </svg>
                                </div>
                                <input type="text" id="username" name="username" class="input-primary"
                                    placeholder="username" required value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="@error('password') input-error @else input-primary @enderror"
                                    placeholder="password" required value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="flex items-center justify-end mb-3 mt-3">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="1"
                                    class="w-3 h-3 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" />
                            </div>
                            <label for="remember" class="ms-2 text-sm text-gray-900 cursor-pointer">
                                Lihat password
                            </label>
                        </div>
                        <div class="{{ $errors->has('captcha') ? 'has-error' : '' }}">
                            <div class="flex gap-10">
                                <div class="captcha flex gap-3 items-center">
                                    <span
                                        class="inline-block w-28 h-8 rounded overflow-hidden bg-gray-200 object-contain bg-contain">{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-success btn-refresh">
                                        <img src="{{ asset('assets/image/icons/refresh.svg') }}"
                                            class="w-4 aspect-square opacity-70" alt="refresh-icon">
                                    </button>
                                </div>
                                <div class="w-full">
                                    <input id="captcha" type="text"
                                        class="@error('captcha') captcha-error @else captcha-primary @enderror"
                                        placeholder="Enter Captcha" name="captcha" required onfocus="select()">
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-5 text-center p-2 rounded bg-yellow-400 hover:bg-yellow-500 text-white w-full focus:outline-none focus:ring-2 focus:ring-yellow-200">Masuk</button>
                    </form>

                    <div class=" mt-10 flex gap-4 items-center justify-evenly">
                        <hr class="w-full h-0.5 bg-gray-400">
                        <p class="text-gray-600">NOTE</p>
                        <hr class="w-full h-0.5 bg-gray-400">
                    </div>
                    <p class="text-center text-xs mt-1 xl:text-sm text-gray-500">pastikan anda masuk dengan otoritas akun
                        atau role yang sesuai</p>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('js')
    <script>
        const inputPassword = document.getElementById('password');
        const checkbox = document.getElementById('remember');
        checkbox.addEventListener('change', function(e) {
            const target = e.target || e.srcElement
            if (target.checked) {
                inputPassword.setAttribute('type', 'text');
            } else {
                inputPassword.setAttribute('type', 'password');
            }
        })
    </script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(".btn-refresh").click(function() {
            $(".btn-refresh").addClass('animate-spin');
            $.ajax({
                type: 'GET',
                url: '/resresh-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                    $(".btn-refresh").removeClass('animate-spin');
                }
            });
        });
    </script>
@endpush
