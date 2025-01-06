<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Blog
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Tambah Data Blog
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Silakan melakukan penambahan data
                            </p>
                        </header>

                        <form method="post" action="{{ route('admin.blogs.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data" x-data="{ kategori: '{{ old('kategori', 'artikel') }}' }">
                            @csrf

                            <div>
                                <x-input-label for="kategori" value="Kategori" />
                                <select name="kategori" id="kategori" x-model="kategori"
                                    class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="artikel" {{ old('kategori') === 'artikel' ? 'selected' : '' }}>
                                        Artikel
                                    </option>
                                    <option value="video" {{ old('kategori') === 'video' ? 'selected' : '' }}>Video
                                    </option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="judul" value="Judul" />
                                <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full"
                                    value="{{ old('judul') }}" />
                            </div>

                            <div x-show="kategori === 'artikel'" x-cloak>
                                <x-input-label for="file_input" value="Unggah Gambar" />
                                <div class="d-flex">
                                    <input type="file" id="file_input" name="thumbnail"
                                        class="mt-1 block w-full border border-gray-300 rounded-md" />

                                </div>
                            </div>

                            <div x-show="kategori === 'video'" x-cloak>
                                <x-input-label for="file_input" value="Unggah video" />
                                <div class="d-flex">
                                    <input type="file" id="file_input" name="video_url"
                                        class="mt-1 block w-full border border-gray-300 rounded-md" />

                                </div>
                            </div>

                            <div x-show="kategori === 'artikel'" x-cloak>
                                <x-input-label for="tiny-editor" value="Konten artikel" />
                                <x-textarea-tinymce id="tiny-editor" name="konten"
                                    value="{!! old('konten') !!}"></x-textarea-tinymce>
                            </div>

                            <div x-show="kategori === 'video'" x-cloak>
                                <x-input-label for="deskripsi" value="Deskripsi video" />
                                <x-textarea-tinymce id="tiny-editor" name="konten"
                                    value="{!! old('konten') !!}"></x-textarea-tinymce>
                            </div>

                            <div>
                                <x-input-label for="status" value="Status" />
                                <x-select name="status" id="status"
                                    class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan
                                        sebagai
                                        draft</option>
                                    <option value="publish" {{ old('status') === 'publish' ? 'selected' : '' }}>Publish
                                    </option>
                                </x-select>
                            </div>

                            <a href="/dashboard">
                                <x-secondary-button>Kembali</x-secondary-button>
                            </a>
                            <x-primary-button>Simpan</x-primary-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
