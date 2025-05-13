@extends('layouts.landing-page')

@section('pages')
    <main class="min-h-[100vh]">

        <x-hero-section judul="Tentang Kami" foto="{{ asset('assets/image/hero/kegiatan.webp') }}"
            link="{{ url('/tentan-kami') }}" />


        <section class="custom-container text-center my-16 mx-auto overflow-x-hidden overflow-y-hidden pb-24">

            <div class="w-fit m-auto">
                <h1 class="text-lg lg:text-2xl" data-aos="fade-up">Visi</h1>
                <p class="mt-3 text-xs md:text-sm lg:text-base" data-aos="fade-up">Menjadi Universitas yang Unggul di Kawasan
                    Timur Indonesia
                    pada Tahun
                    2035.</p>
            </div>

            <div class="mt-10">
                <h1 class="text-lg lg:text-2xl" data-aos="fade-up">Misi</h1>
                <ul class="flex flex-col gap-3 mt-3 text-xs md:text-sm lg:text-base">
                    <li data-aos="fade-up">
                        Menjadi Universitas yang Unggul di Kawasan Timur Indonesia pada Tahun 2035.
                    </li>
                    <li data-aos="fade-up">
                        Menyelenggarakan penelitian berstandar mutu nasional berbasis sumber daya
                        lokal untuk memenuhi tuntutan kebutuhan masyarakat.
                    </li>
                    <li data-aos="fade-up">
                        Menyelenggarakan pengabdian kepada masyarakat berbasis pemberdayaan
                        masyarakat.
                    </li>
                    <li data-aos="fade-up">
                        Meningkatkan akses dan relevansi penyelenggaraan ilmu pengetahuan dan
                        teknologi dalam memajukan perkembangan intelektual dan kesejahteraan
                        masyarakat.
                    </li>
                    <li data-aos="fade-up">
                        Menyelenggarakan pengelolaan pendidikan tinggi yang profesional dan
                        akuntabel untuk meningkatkan citra perguruan tinggi.
                    </li>
                    <li data-aos="fade-up">
                        Membentuk insan akademik yang menjunjung tinggi keluhuran budaya lokal dalam
                        keragaman budaya nasional.
                    </li>
                </ul>
            </div>

        </section>

    </main>
@endsection
