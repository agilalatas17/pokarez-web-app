<x-layout>
    <x-slot name="header">
        <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl text-left text-gray-800">
            {{ $data->judul }}
        </h1>
        <p class="text-xs md:text-sm lg:text-base mt-4">Diposting pada
            <span>{{ $data->created_at->isoFormat('dddd, DD MMMM Y') }}</span> oleh
            <span>{{ Str::title($data->user->name) }}</span>
        </p>
    </x-slot>

    <div class="container px-4 md:px-8 md:py-8 mx-auto">
        <article>
            <div class="px-2 mb-20">
                @if ($data->kategori === 'artikel')
                    <img src="{{ asset(env('THUMBNAILS_LOCATION') . '/' . $data->thumbnail) }}"
                        class="object-cover object-center max-w-[5xl] max-h-[512px] mx-auto">
                @elseif ($data->kategori === 'video')
                    <div class="flex justify-center">
                        <iframe class="w-[320px] h-[180px] md:w-[720px] md:h-[405px] rounded-md md:rounded-xl"
                            src="https://www.youtube.com/embed/{{ $data->youtube_video_id }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <img src="{{ asset('assets/images/general/default-image.jpg') }}"
                        class="object-cover object-center max-w-[5xl] max-h-[512px] mx-auto">
                @endif
            </div>

            <div>
                @if ($data->kategori === 'artikel')
                    {!! $data->konten !!}
                @else
                    {!! $data->deskripsi !!}
                @endif
            </div>
        </article>

        <div class="flex items-center w-full gap-x-3 shrink-0 sm:w-auto justify-end mt-8">
            <a href="{{ url()->previous() }}"
                class="flex items-center justify-center w-1/2 px-5 py-2 text-base text-white transition-colors duration-200 bg-pink-500 border rounded-lg  gap-x-2 sm:w-auto hover:bg-pink-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>


                <span>Kembali</span>
            </a>

        </div>
    </div>
</x-layout>
