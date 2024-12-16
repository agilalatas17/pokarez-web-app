@props(['title', 'content', 'category', 'date', 'thumbnail', 'link'])

<div class="max-w-xs overflow-hidden bg-white rounded-lg shadow-md">
    @isset($thumbnail)
        <img class="object-cover w-full h-52" src="{{ $thumbnail }}" alt="Artikel">
    @endisset

    <div class="px-6 pt-4 pb-6">
        <div>
            <div class="flex justify-between items-center">
                <span
                    class="d-block text-xs font-medium bg-pink-400 px-2 py-1 rounded text-white uppercase">{{ Str::upper($category) }}</span><span
                    class="d-block text-sm font-medium text-pink-400">{{ $date->diffForHumans() }}</span>
            </div>
            <a href="{{ $link }}"
                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                tabindex="0" role="link">{{ Str::title($title) }}</a>
            <p class="mt-2 text-base text-gray-600">
                {!! Str::limit(strip_tags($content), 100, '...') !!}

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
