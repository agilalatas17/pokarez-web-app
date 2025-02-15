<nav x-data="{ open: false }" class="bg-pink-500 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-white" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="url('/')" :active="request()->routeIs('/')">
                    Beranda
                </x-nav-link>

                <x-nav-link :href="url('/blogs/video')" :active="request()->routeIs('blogs.videos-page')">
                    Video
                </x-nav-link>

                {{-- <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-pink-700 focus:outline-none transition ease-in-out duration-150">
                                <div>Blog</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('blogs.articles-page')">
                                Artikel
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('blogs.videos-page')">
                                Video
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown> 
            </div> --}}
                {{-- <x-nav-link :href="url('/blogs/artikel')" :active="request()->routeIs('blogs.articles-page')">
                    Artikel
                </x-nav-link>
                <x-nav-link :href="url('/blogs/video')" :active="request()->routeIs('blogs.videos-page')">
                    Video
                </x-nav-link> --}}
                <x-nav-link :href="url('/konsultasi')" :active="request()->routeIs('konsultasi')">
                    Konsultasi
                </x-nav-link>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->routeIs('/')">
                Beranda
            </x-responsive-nav-link>
            {{-- <x-responsive-nav-link :href="url('/blogs/artikel')" :active="request()->routeIs('blogs.articles-page')">
                Tentang kami
            </x-responsive-nav-link> --}}
            <x-responsive-nav-link :href="url('/blogs/video')" :active="request()->routeIs('blogs.videos-page')">
                Video
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/konsultasi')" :active="request()->routeIs('konsultasi')">
                Konsultasi
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
