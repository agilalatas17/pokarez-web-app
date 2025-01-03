<x-layout>
    <header class="bg-white">
        <div class="container px-6 py-16 mx-auto">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg text-center md:text-left">
                        <h1 class="text-3xl font-semibold text-gray-800 lg:text-4xl">Selamat datang <br> di <span
                                class="text-pink-500 font-lobster">Pokarez</span> Website</h1>

                        <p class="mt-3 text-gray-600">Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Porro beatae error laborum ab amet sunt recusandae? Reiciendis natus
                            perspiciatis optio.</p>

                        <button
                            class="w-fit px-5 py-2 mt-6 text-sm tracking-wider text-white uppercase transition-colors duration-300 transform bg-pink-500 rounded-lg lg:w-auto hover:bg-pink-400 focus:outline-none focus:bg-pink-400">Gabung
                            sekarang</button>
                    </div>
                </div>

                <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                    <img class="w-full h-full lg:max-w-3xl" src="{{ asset('assets/images/general/hero_image.png') }}"
                        alt="hero image">
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
                <div class="w-fit text-center md:text-left">
                    <h1 class="text-2xl font-semibold capitalize lg:text-3xl ">Sepintas tentang
                        kami
                    </h1>

                    <div class="flex mt-3 mb-6 mx-auto justify-center md:justify-normal md:mb-8 ">
                        <span class="inline-block w-40 h-1 bg-pink-500 rounded-full"></span>
                        <span class="inline-block w-3 h-1 mx-1 bg-pink-500 rounded-full"></span>
                        <span class="inline-block w-1 h-1 bg-pink-500 rounded-full"></span>
                    </div>

                    <p> Pola Makan Sehat Remaja Putri - Pokarez, merupakan suatu bentuk kegiatan
                        edukasi
                        gizi
                        dan kesehatan pada
                        remaja putri sebagai upaya pencegahan anemia Pola makan kurang tepat pada remaja sebelum atau
                        selama
                        menstruasi yaitu dengan mengkonsumsi makanan yang tidak sehat Status gizi berkaitan dengan
                        asupan
                        zat
                        gizi termasuk zat besi, status gizi sangatlah penting bagi remaja karena dapat mempengaruhi
                        proses
                        pertumbuhan dan zat besi berperan dalam pembentukan darah merah.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="latest-blogs" class="my-8">
        <div class="container px-4 md:px-6 md:py-8 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl">Blog Terbaru</h1>
            <div class="grid grid-cols-1 gap-6 mt-8 md:mt-10 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($data as $key => $value)
                    <x-card-blog title="{{ $value->judul }}" thumbnail="{{ $value->thumbnail }}"
                        category="{{ $value->kategori }}" date="{{ $value->created_at->diffForHumans() }}"
                        content="{{ strip_tags($value->konten) }}"
                        link="{{ route('blog-detail', ['slug' => $value->slug]) }}" />
                @endforeach
            </div>
            <div class="flex justify-end mt-4 md:mt-8">
                <a href='/blogs'
                    class="px-4 py-2 font-bold tracking-wide text-pink-600 capitalize transition-colors duration-300 transform  rounded-md hover:bg-pink-500 hover:text-white focus:outline-none focus:ring focus:ring-pink-400 focus:ring-opacity-80">
                    Lihat semua
                </a>
            </div>
    </section>

    <section id="testomoni" class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto" x-data="{
            activeSlide: 1,
            slides: [{
                    id: 1,
                    name: 'Elon Musk',
                    title: 'Direktur utama Tesla, inc.',
                    body: 'Edukasi diet gizi seimbang melalui website Pokarez menunjukkan dampak positif dalam meningkatkan pengetahuan dan perilaku makan sehat di berbagai kalangan, termasuk pada remaja putri.'
                },
                {
                    id: 2,
                    name: 'Lisa Black Pink',
                    title: 'Penyanyi',
                    body: 'Edukasi diet gizi seimbang melalui website Pokarez menunjukkan dampak positif dalam meningkatkan pengetahuan dan perilaku makan sehat di berbagai kalangan, termasuk pada remaja putri. Edukasi diet gizi seimbang melalui website Pokarez menunjukkan dampak positif dalam meningkatkan pengetahuan dan perilaku makan sehat di berbagai kalangan, termasuk pada remaja putri'
                },
                {
                    id: 3,
                    name: 'Fadel',
                    title: 'Dancer',
                    body: 'Edukasi diet gizi seimbang melalui website Pokarez menunjukkan dampak positif dalam meningkatkan pengetahuan dan perilaku makan sehat di berbagai kalangan, termasuk pada remaja putri.'
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
                <span class="inline-block w-40 h-1 bg-pink-500 rounded-full"></span>
                <span class="inline-block w-3 h-1 mx-1 bg-pink-500 rounded-full"></span>
                <span class="inline-block w-1 h-1 bg-pink-500 rounded-full"></span>
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
                            'bg-pink-500': activeSlide === slide.id,
                            'bg-slate-200': activeSlide !== slide.id
                        }"
                        x-on:click="activeSlide = slide.id"></button>
                </template>
            </div>
        </div>

    </section>
</x-layout>
