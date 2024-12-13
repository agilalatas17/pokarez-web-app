<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Tulisan
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Edit Data Tulisan
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Silakan melakukan perubahan data
                            </p>
                        </header>

                        <form method="post" action="{{ route('admin.blogs.update', ['post' => $data->id]) }}"
                            class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="judul" value="Judul" />
                                <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full"
                                    value="{{ old('judul', $data->judul) }}" />
                            </div>
                            <div>
                                <x-input-label for="deskripsi" value="Deskripsi" />
                                <x-text-input id="deskripsi" name="deskripsi" type="text" class="mt-1 block w-full"
                                    value="{{ old('deskripsi', $data->deskripsi) }}" />
                            </div>
                            <div>
                                <x-input-label for="file_input" value="Thumbnail" name="thumbnail" />
                                <input type="file" id="file_input"
                                    class="mt-1 block w-full border border-gray-300 rounded-md" />
                            </div>

                            <div>
                                <x-textarea-summernote id="summernote" name="konten"
                                    value="{!! old('konten', $data->konten) !!}"></x-textarea-summernote>
                            </div>

                            <div>
                                <x-input-label for="status" value="Status" />
                                <x-select name="status" id="status"
                                    class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="draft"
                                        {{ old('status', $data->status === 'draft' ? 'selected' : '') }}>Simpan sebagai
                                        draft</option>
                                    <option value="publish"
                                        {{ old('status', $data->status === 'publish' ? 'selected' : '') }}>Publish
                                    </option>
                                </x-select>
                            </div>

                            <a href="/blogs">
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