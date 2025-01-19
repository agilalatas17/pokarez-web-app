<x-layout>
    <header class="bg-white">
        <div class="container px-6 py-16 mx-auto">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg text-center md:text-left">
                        <h1 class="text-3xl font-semibold text-gray-800 lg:text-4xl mb-2">Selamat datang di
                            <span class="text-teal-600 font-lobster">Pokarez.</span>
                        </h1>

                        <p>Mengatur nutrisi mu diawal masa remaja melalui diet gizi seimbang. </p>

                        <div class="mt-6">
                            <a href="{{ route('blogs.videos-page') }}"
                                class="w-fit px-5 py-2 text-sm tracking-wider  text-white uppercase transition-colors duration-300 transform bg-teal-600 rounded-lg lg:w-auto hover:bg-teal-500 focus:outline-none focus:bg-teal-500">Gabung
                                sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                    <img class="w-full h-full lg:max-w-3xl animate-bounce"
                        src="{{ asset('assets/images/general/hero_image_teal_color.png') }}" alt="hero image">
                </div>
            </div>
        </div>
    </header>

    <section id="our-clients" class="my-14">
        <div class="flex space-x-4 lg:space-x-16 overflow-hidden group" id="running-img-wrapper">
            <div class="flex space-x-4 lg:space-x-16 animate-running-image group-hover:paused shrink-0"
                id="running-img">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/images/client/1.png') }}" alt="poltekes kemenkes yogyakarta"
                        class=" text-gray-500 fill-current h-14 lg:h-20 max-w-none">
                </div>

                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/images/client/2.png') }}" alt="poltekes kemenkes yogyakarta"
                        class="text-gray-500 fill-current h-14 lg:h-20 max-w-none">
                </div>

                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/images/client/3.png') }}" alt="SVASTHA HARENA"
                        class="text-gray-500 fill-current h-14 lg:h-20 max-w-none">
                </div>

                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/images/client/4.png') }}" alt="BADAN LAYANAN UMUM"
                        class="text-gray-500 fill-current h-14 lg:h-20 max-w-none">
                </div>
            </div>
        </div>

    </section>

    <section id="about" class="bg-fixed bg-center bg-cover md:h-[35vh]"
        style="background-image:
        url('{{ asset('assets/images/general/poltekes kemenkes jogja.JPG') }}');">
        <div class="flex h-full items-center justify-center bg-black bg-opacity-65 text-white">
            <div class="container px-2 py-6 md:px-6 md:py-8 mx-auto">
                <div class="w-fit text-center md:text-left" data-aos="zoom-in" data-aos-duration="500">
                    <h1 class="text-2xl font-semibold capitalize lg:text-3xl ">Sepintas tentang
                        kami
                    </h1>

                    <div class="flex mt-3 mb-6 mx-auto justify-center md:justify-normal md:mb-8 ">
                        <span class="inline-block w-40 h-1 bg-teal-600 rounded-full"></span>
                        <span class="inline-block w-3 h-1 mx-1 bg-teal-600 rounded-full"></span>
                        <span class="inline-block w-1 h-1 bg-teal-600 rounded-full"></span>
                    </div>

                    <p>Pokarez (Pola Makan Sehat Remaja Putri) Merupakan sebuah layanan kesehatan yang didesain untuk
                        membantu remaja dalam mendapatkan informasi yang relevan dan bermanfaat mengenai kesehatan,
                        khususnya bagi remaja putri yang mengalami masa pertumbuhan dengan menjaga pola makan yang lebih
                        sehat dengan melakukan Diet Gizi Seimbang</p>
                </div>
            </div>
        </div>
    </section>

    <section id="latest-blogs" class="my-8">
        <div class="container px-4 md:px-6 md:py-8 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl">Blog Terbaru</h1>
            <div class="grid grid-cols-1 gap-6 mt-8 md:mt-10 md:grid-cols-2 xl:grid-cols-3" data-aos="fade-up"
                data-aos-duration="500">
                @foreach ($data as $key => $value)
                    <x-card-blog title="{{ $value->judul }}"
                        image="{{ $value->kategori == 'artikel' ? $value->thumbnail : $value->youtube_video_id }}"
                        category="{{ $value->kategori }}" date="{{ $value->created_at->diffForHumans() }}"
                        content="{{ $value->kategori == 'artikel' ? strip_tags($value->konten) : strip_tags($value->deskripsi) }}"
                        link="{{ route('blogs.detail.blog-detail', ['slug' => $value->slug]) }}" />
                @endforeach
            </div>
            <div class="flex justify-end mt-4 md:mt-8">
                <a href='/blogs'
                    class="px-4 py-2 font-bold tracking-wide text-teal-600 capitalize transition-colors duration-300 transform  rounded-md hover:bg-teal-600 hover:text-white focus:outline-none focus:ring focus:ring-teal-400 focus:ring-opacity-80">
                    Lihat semua
                </a>
            </div>
    </section>

    <section id="testomoni" class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto" x-data="{
            activeSlide: 1,
            slides: [{
                    id: 1,
                    name: 'Delia',
                    title: '23 Tahun',
                    body: 'Edukasi diet gizi seimbang melalui website Pokarez menunjukkan dampak positif dalam meningkatkan pengetahuan dan perilaku makan sehat di berbagai kalangan, termasuk pada remaja putri.'
                },
                {
                    id: 2,
                    name: 'Enggar',
                    title: '26 Tahun',
                    body: 'POKAREZ sangat membantu saya yang masih awam dalam memahami kesehatan dan pola makan yang baik. Informasi yang disediakan sangat jelas, lengkap, dan mudah diakses, sehingga memudahkan saya untuk mencukupi kebutuhan gizi harian dengan tepat.'
                },
                {
                    id: 3,
                    name: 'Nada',
                    title: '37 Tahun',
                    body: 'Pokarez benar-benar mempermudah saya dalam memahami pola makan sehat untuk remaja. Situs ini sangat user-friendly dan informasi yang disajikan sangat bermanfaat. Fasilitas konsultasinya juga membuat saya lebih yakin dalam memilih makanan yang tepat. Pokarez kerenn!'
                }
            ],
            loop() {
                setInterval(() => { this.activeSlide = this.activeSlide === 3 ? 1 : this.activeSlide + 1 }, 5000)
            }
        }" x-init="loop">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">
                Apa kata Klien kami
            </h1>

            <div class="flex justify-center mx-auto mt-6">
                <span class="inline-block w-40 h-1 bg-teal-600 rounded-full"></span>
                <span class="inline-block w-3 h-1 mx-1 bg-teal-600 rounded-full"></span>
                <span class="inline-block w-1 h-1 bg-teal-600 rounded-full"></span>
            </div>

            <div class="flex items-start max-w-6xl mx-auto mt-16">

                {{-- Left Button --}}
                <button title="left arrow"
                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1"
                    class="hidden p-2 text-gray-800 transition-colors duration-300 border rounded-full rtl:-scale-x-100 lg:block hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                {{-- Display --}}
                <template x-for="slide in slides" :key="slide.id">
                    <div x-show="activeSlide === slide.id">
                        <p class="flex items-center text-center text-gray-500 lg:mx-8 " x-text="slide.body"></p>

                        <div class="flex flex-col items-center justify-center mt-8">
                            {{-- <img class="object-cover rounded-full w-14 h-14"
                                    src="https://images.unsplash.com/photo-1499470932971-a90681ce8530?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                    alt=""> --}}

                            <div class="mt-4 text-center">
                                <h1 class="font-semibold text-gray-800 dark:text-white" x-text="slide.name"></h1>
                                <span class="text-sm text-gray-500 dark:text-gray-400" x-text="slide.title"></span>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Right Button --}}
                <button x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1"
                    class="hidden p-2 text-gray-800 transition-colors duration-300 border rounded-full rtl:-scale-x-100 lg:block hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {{-- Slide Indicator --}}
            <div class="w-full flex justify-center items-center py-5 px-4 mt-6">
                <template x-for="slide in slides" :key="slide.id">
                    <button
                        class=" w-6 h-2 mt-4 mx-2 mb-2 rounded-full overflow-hidden tansition-colors duration-200 ease-out hover:bg-slate-600 hover:shadow-lg"
                        :class="{
                            'bg-teal-600': activeSlide === slide.id,
                            'bg-slate-200': activeSlide !== slide.id
                        }"
                        x-on:click="activeSlide = slide.id"></button>
                </template>
            </div>
        </div>

    </section>
</x-layout>
