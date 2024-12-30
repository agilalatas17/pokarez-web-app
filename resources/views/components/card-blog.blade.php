@props(['title', 'content', 'category', 'date', 'thumbnail', 'link'])

<div class="overflow-hidden bg-white rounded-lg shadow-md">
    <a href="{{ $link }}">
        @if ($thumbnail)
            <img class="object-contain object-center w-full h-60 rounded-lg lg:h-64"
                src="{{ asset(env('THUMBNAILS_LOCATION') . '/' . $thumbnail) }}" alt="Artikel image">
        @else
            <img class="object-cover object-center w-full h-60 rounded-lg lg:h-64"
                src="{{ asset('assets/images/general/default-image.jpg') }}">
        @endif
    </a>

    <div class="px-6 pt-4 pb-6">
        <div>
            <div class="flex justify-between items-center">
                <span
                    class="d-block text-xs font-medium bg-pink-500 px-2 py-1 rounded text-white uppercase">{{ Str::upper($category) }}</span><span
                    class="d-block text-sm font-medium text-pink-500">{{ $date }}</span>
            </div>
            <a href="{{ $link }}"
                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                tabindex="0" role="link">{{ Str::title($title) }}</a>
            <p class="mt-2 text-base text-gray-600">
                {!! Str::limit($content, 100, '...') !!}

            </p>
        </div>

        <div class="mt-4">
            <div class="flex items-center">
                <div class="flex items-center">
                    <a href="{{ $link }}"
                        class="font-semibold transition-colors duration-300 transform text-gray-700 hover:text-purple-500 hover:underline"
                        tabindex="0" role="link">Baca
                        selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
