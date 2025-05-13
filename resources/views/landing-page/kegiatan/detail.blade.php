@extends('layouts.landing-page')

@section('pages')
    @inject('carbon', 'Carbon\carbon')
    @php
        $hari = $carbon::parse($data->created_at)->dayOfWeekIso;
        switch ($hari) {
            case '1':
                $hari = 'Senin';
                break;
            case '2':
                $hari = 'Selasa';
                break;
            case '3':
                $hari = 'Rabu';
                break;
            case '4':
                $hari = 'kamis';
                break;
            case '5':
                $hari = 'Jumat';
                break;
            case '6':
                $hari = 'Sabtu';
                break;
            case '7':
                $hari = 'Minggu';
                break;
        }
    @endphp
    <main class="min-h-[100vh]">

        <x-hero-section judul="Kegiatan" foto="{{ asset('assets/image/hero/kegiatan.webp') }}" link="/kegiatan" />


        <section class="mb-10 mt-5 lg:mt-10 relative">
            <div class="custom-container mx-auto flex flex-col lg:flex-row justify-between">
                <div class="w-full lg:w-[70%] lg:border-r-2 lg:pr-6">
                    <img src="{{ asset($data->foto) }}" alt="gambar" class="w-full aspect-video object-cover rounded">
                    <div class="flex gap-3 text-gray-700 text-xs lg:text-sm my-5">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 aspect-square lg:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="capitalize">{{ $data->user->role }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 aspect-square lg:w-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $hari }}, {{ $carbon::parse($data->created_at)->format('d-m-Y') }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 aspect-square lg:w-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $views }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 aspect-square lg:w-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="capitalize">{{ strtolower($data->kategori->nama) }}</span>
                        </span>
                    </div>

                    <h1 class="my-8 font-bold text-xl md:text-2xl lg:text-3xl">{{ $data->judul }}</h1>

                    <div class="mb-16 konten">
                        {!! $data->deskripsi !!}
                    </div>

                    <div class="mb-14 text-gray-400 font-semibold text-sm w-full border-t-2 border-gray-300 py-2">
                        <h4>Hashtag : </h4>
                        @foreach (explode(',', $data->hashtag) as $r => $v)
                            <span class="mr-1   ">#{{ $v }}</span>
                        @endforeach
                    </div>

                    {{-- comment --}}
                    <div>
                        <div id="disqus_thread"></div>
                    </div>
                </div>

                {{-- side --}}
                <div class="w-full overflow-x-hidden lg:w-[30%] lg:mt-0 mt-8">
                    <div class="rounded p-0 lg:p-4 lg:pt-0 bg-white" id="sidebar">
                        <div class="flex flex-row gap-5 md:justify-between md:items-center lg:gap-80">
                            <div class="flex gap-5 items-center justify-between w-full" data-aos="fade-left"
                                data-aos-offset="80" data-aos-delay="0" data-aos-duration="500" data-aos-easing="ease-in"
                                data-aos-mirror="false" data-aos-once="false">
                                <h1 class="text-nowrap font-semibold text-lg md:text-xl text-primary-700">
                                    Kegiatan Terbaru
                                </h1>
                                <hr class="inline-block h-1 w-full bg-yellow-300 rounded-sm" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 lg:gap-0.5 pb-4 py-2">
                            @forelse ($kegiatanTerbaru as $r)
                                <div onclick="window.location.href='{{ url('/kegiatan/' . $r->slug) }}'"
                                    class="flex flex-row gap-2.5 bg-white rounded shadow lg:shadow-sm overflow-hidden p-0.5 w-full justify-start cursor-pointer group items-center"
                                    data-aos="fade-left">
                                    <div class="aspect-video w-40 md:w-52 overflow-hidden rounded">
                                        <img src="{{ asset($r->foto) }}" alt="{{ $r->judul }}"
                                            class="object-cover w-full h-full hover:scale-110 group-hover:scale-110 duration-300">
                                    </div>
                                    <div
                                        class="pt-0 px-0.5 flex flex-col gap-2 lg:gap-0.5 justify-center items-start w-full">
                                        <a href="{{ url('/kegiatan/' . $r->slug) }}"
                                            class="line-clamp-2 hover:underline hover:text-gray-800 capitalize text-sm lg:text-xs font-semibold text-gray-700">
                                            {{ $r->judul }}
                                        </a>
                                        <div class="flex flex-col gap-1 justify-between text-gray-500 text-[10px]">
                                            <div class="capitalize">{{ strtolower($r->kategori->nama) }}</div>
                                            <div class="flex gap-1 items-center">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                                </svg>
                                                <span>{{ $carbon::parse($r->created_at)->format('d-m-Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">Belum ada postingan</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="p-10 block"></div>
    </main>
@endsection

@push('css')
    <style>
        .konten ul li {
            list-style-type: disc;
            list-style-position: inside;
        }

        .konten ol li {
            list-style-type: decimal;
            list-style-position: inside;
        }
    </style>
@endpush
@push('js')
    <div id="disqus_thread"></div>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
         */

        var disqus_config = function() {
            this.page.url = '{{ url()->current() }}';
            this.page.identifier = '{{ $data }}';
        };
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://informatika-unidayan.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments
            powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//informatika-unidayan.disqus.com/count.js" async></script>
@endpush
