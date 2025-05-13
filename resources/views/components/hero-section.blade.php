@props([
    'foto' => $foto,
    'judul' => $judul,
    'link' => $link,
])

<section class="custom-container m-auto rounded h-fit overflow-hidden">
    <div class="relative w-full h-fit rounded">
        <img src="{{ $foto }}" alt="{{ $judul }}"
            class="w-full h-28 md:h-40 lg:h-56 object-cover object-center rounded z-0">
        <div
            class="absolute top-0 bottom-0 left-0 right-0 bg-gradient-to-r from-gray-600 from-10% z-[1] rounded flex items-center">
            <div class="p-4 md:pl-10 lg:pl-20">
                <a href="{{ $link ?? '/' }}"
                    class="text-white font-semibold text-2xl md:text-4xl lg:text-5xl tracking-widest" data-aos="fade-down"
                    data-aos-delay="0" data-aos-duration="500" data-aos-mirror="false" data-aos-once="true">
                    {{ $judul }}
                </a>
            </div>
        </div>
    </div>
</section>
