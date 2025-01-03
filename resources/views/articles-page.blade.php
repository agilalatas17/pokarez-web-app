<x-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-800 text-center">
            Blog
        </h2>
    </x-slot>

    <section id="blogs">
        <div class="container px-4 my-16 md:p-0 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:mt-10 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($data as $key => $value)
                    <x-card-blog title="{{ $value->judul }}" thumbnail="{{ $value->thumbnail }}"
                        category="{{ $value->kategori }}" date="{{ $value->created_at->diffForHumans() }}"
                        content="{{ strip_tags($value->konten) }}"
                        link="{{ route('blog-detail', ['slug' => $value->slug]) }}" />
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
