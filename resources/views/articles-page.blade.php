<x-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-800">
            Blog
        </h2>
    </x-slot>

    <section id="blogs">
        <div class="container px-4 md:p-0 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:mt-10 md:grid-cols-2 xl:grid-cols-3">
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    @if (isset($thumbnail))
                        <img class="object-cover object-center w-full h-64 rounded-lg" src="{{ $thumbnail }}"
                            alt="Artikel">
                    @else
                        <img class="object-cover object-center w-full h-64 rounded-lg"
                            src="https://t4.ftcdn.net/jpg/05/17/53/57/360_F_517535712_q7f9QC9X6TQxWi6xYZZbMmw5cnLMr279.jpg"
                            alt="gambar artikel">
                    @endif

                    <div class="px-6 pt-4 pb-6">
                        <div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="d-block text-xs font-medium bg-pink-500 px-2 py-1 rounded text-white uppercase">Artikel</span><span
                                    class="d-block text-sm font-medium text-pink-500">12 Hari yang lalu</span>
                            </div>
                            <a href="#"
                                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                                tabindex="0"
                                role="link">{{ Str::title('tips untuk makanan sehat dan bergizi') }}</a>
                            <p class="mt-2 text-base text-gray-600">
                                {!! Str::limit(
                                    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum, quod temporibus aperiam repellendus magni sed fugit quos tenetur et voluptatum a quas, asperiores alias laboriosam! Corrupti obcaecati excepturi qui ad ut repudiandae recusandae? At similique blanditiis cumque quos deleniti rerum perspiciatis eum tempore, quod architecto placeat unde alias ullam vel ut neque illum? Animi, accusamus voluptatum! Quam, voluptatem, dolores amet optio unde nesciunt reiciendis eligendi, ea mollitia repellendus fugit rem. Aliquam culpa quaerat dignissimos eaque obcaecati debitis maiores commodi tempora vel, blanditiis optio eveniet, dolore eum libero necessitatibus eos architecto perferendis similique natus iure atque. Provident, amet exercitationem laudantium eius quidem quisquam placeat reiciendis aspernatur reprehenderit soluta explicabo libero earum optio. Quam, nihil, sed accusantium in molestiae ea hic qui minima eum omnis modi voluptate ad iusto assumenda dignissimos? Numquam libero suscipit, nesciunt error, voluptas asperiores id quasi reprehenderit, quas excepturi cumque culpa atque quisquam. Consequuntur pariatur facere, corporis aspernatur reiciendis ipsam? Aliquam aliquid distinctio, facilis quibusdam omnis eos perspiciatis.',
                                    100,
                                    '...',
                                ) !!}

                            </p>
                        </div>


                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="font-semibold transition-colors duration-300 transform text-gray-700 hover:text-purple-500 hover:underline"
                                        tabindex="0" role="link">Baca
                                        selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    @if (isset($thumbnail))
                        <img class="object-cover object-center w-full h-64 rounded-lg" src="{{ $thumbnail }}"
                            alt="Artikel">
                    @else
                        <img class="object-cover object-center w-full h-64 rounded-lg"
                            src="https://t4.ftcdn.net/jpg/05/17/53/57/360_F_517535712_q7f9QC9X6TQxWi6xYZZbMmw5cnLMr279.jpg"
                            alt="gambar artikel">
                    @endif

                    <div class="px-6 pt-4 pb-6">
                        <div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="d-block text-xs font-medium bg-pink-500 px-2 py-1 rounded text-white uppercase">Artikel</span><span
                                    class="d-block text-sm font-medium text-pink-500">12 Hari yang lalu</span>
                            </div>
                            <a href="#"
                                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                                tabindex="0"
                                role="link">{{ Str::title('tips untuk makanan sehat dan bergizi') }}</a>
                            <p class="mt-2 text-base text-gray-600">
                                {!! Str::limit(
                                    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum, quod temporibus aperiam repellendus magni sed fugit quos tenetur et voluptatum a quas, asperiores alias laboriosam! Corrupti obcaecati excepturi qui ad ut repudiandae recusandae? At similique blanditiis cumque quos deleniti rerum perspiciatis eum tempore, quod architecto placeat unde alias ullam vel ut neque illum? Animi, accusamus voluptatum! Quam, voluptatem, dolores amet optio unde nesciunt reiciendis eligendi, ea mollitia repellendus fugit rem. Aliquam culpa quaerat dignissimos eaque obcaecati debitis maiores commodi tempora vel, blanditiis optio eveniet, dolore eum libero necessitatibus eos architecto perferendis similique natus iure atque. Provident, amet exercitationem laudantium eius quidem quisquam placeat reiciendis aspernatur reprehenderit soluta explicabo libero earum optio. Quam, nihil, sed accusantium in molestiae ea hic qui minima eum omnis modi voluptate ad iusto assumenda dignissimos? Numquam libero suscipit, nesciunt error, voluptas asperiores id quasi reprehenderit, quas excepturi cumque culpa atque quisquam. Consequuntur pariatur facere, corporis aspernatur reiciendis ipsam? Aliquam aliquid distinctio, facilis quibusdam omnis eos perspiciatis.',
                                    100,
                                    '...',
                                ) !!}

                            </p>
                        </div>


                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="font-semibold transition-colors duration-300 transform text-gray-700 hover:text-purple-500 hover:underline"
                                        tabindex="0" role="link">Baca
                                        selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    @if (isset($thumbnail))
                        <img class="object-cover object-center w-full h-64 rounded-lg" src="{{ $thumbnail }}"
                            alt="Artikel">
                    @else
                        <img class="object-cover object-center w-full h-64 rounded-lg"
                            src="https://t4.ftcdn.net/jpg/05/17/53/57/360_F_517535712_q7f9QC9X6TQxWi6xYZZbMmw5cnLMr279.jpg"
                            alt="gambar artikel">
                    @endif

                    <div class="px-6 pt-4 pb-6">
                        <div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="d-block text-xs font-medium bg-pink-500 px-2 py-1 rounded text-white uppercase">Artikel</span><span
                                    class="d-block text-sm font-medium text-pink-500">12 Hari yang lalu</span>
                            </div>
                            <a href="#"
                                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                                tabindex="0"
                                role="link">{{ Str::title('tips untuk makanan sehat dan bergizi') }}</a>
                            <p class="mt-2 text-base text-gray-600">
                                {!! Str::limit(
                                    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum, quod temporibus aperiam repellendus magni sed fugit quos tenetur et voluptatum a quas, asperiores alias laboriosam! Corrupti obcaecati excepturi qui ad ut repudiandae recusandae? At similique blanditiis cumque quos deleniti rerum perspiciatis eum tempore, quod architecto placeat unde alias ullam vel ut neque illum? Animi, accusamus voluptatum! Quam, voluptatem, dolores amet optio unde nesciunt reiciendis eligendi, ea mollitia repellendus fugit rem. Aliquam culpa quaerat dignissimos eaque obcaecati debitis maiores commodi tempora vel, blanditiis optio eveniet, dolore eum libero necessitatibus eos architecto perferendis similique natus iure atque. Provident, amet exercitationem laudantium eius quidem quisquam placeat reiciendis aspernatur reprehenderit soluta explicabo libero earum optio. Quam, nihil, sed accusantium in molestiae ea hic qui minima eum omnis modi voluptate ad iusto assumenda dignissimos? Numquam libero suscipit, nesciunt error, voluptas asperiores id quasi reprehenderit, quas excepturi cumque culpa atque quisquam. Consequuntur pariatur facere, corporis aspernatur reiciendis ipsam? Aliquam aliquid distinctio, facilis quibusdam omnis eos perspiciatis.',
                                    100,
                                    '...',
                                ) !!}

                            </p>
                        </div>


                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="font-semibold transition-colors duration-300 transform text-gray-700 hover:text-purple-500 hover:underline"
                                        tabindex="0" role="link">Baca
                                        selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    @if (isset($thumbnail))
                        <img class="object-cover object-center w-full h-64 rounded-lg" src="{{ $thumbnail }}"
                            alt="Artikel">
                    @else
                        <img class="object-cover object-center w-full h-64 rounded-lg"
                            src="https://t4.ftcdn.net/jpg/05/17/53/57/360_F_517535712_q7f9QC9X6TQxWi6xYZZbMmw5cnLMr279.jpg"
                            alt="gambar artikel">
                    @endif

                    <div class="px-6 pt-4 pb-6">
                        <div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="d-block text-xs font-medium bg-pink-500 px-2 py-1 rounded text-white uppercase">Artikel</span><span
                                    class="d-block text-sm font-medium text-pink-500">12 Hari yang lalu</span>
                            </div>
                            <a href="#"
                                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                                tabindex="0"
                                role="link">{{ Str::title('tips untuk makanan sehat dan bergizi') }}</a>
                            <p class="mt-2 text-base text-gray-600">
                                {!! Str::limit(
                                    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum, quod temporibus aperiam repellendus magni sed fugit quos tenetur et voluptatum a quas, asperiores alias laboriosam! Corrupti obcaecati excepturi qui ad ut repudiandae recusandae? At similique blanditiis cumque quos deleniti rerum perspiciatis eum tempore, quod architecto placeat unde alias ullam vel ut neque illum? Animi, accusamus voluptatum! Quam, voluptatem, dolores amet optio unde nesciunt reiciendis eligendi, ea mollitia repellendus fugit rem. Aliquam culpa quaerat dignissimos eaque obcaecati debitis maiores commodi tempora vel, blanditiis optio eveniet, dolore eum libero necessitatibus eos architecto perferendis similique natus iure atque. Provident, amet exercitationem laudantium eius quidem quisquam placeat reiciendis aspernatur reprehenderit soluta explicabo libero earum optio. Quam, nihil, sed accusantium in molestiae ea hic qui minima eum omnis modi voluptate ad iusto assumenda dignissimos? Numquam libero suscipit, nesciunt error, voluptas asperiores id quasi reprehenderit, quas excepturi cumque culpa atque quisquam. Consequuntur pariatur facere, corporis aspernatur reiciendis ipsam? Aliquam aliquid distinctio, facilis quibusdam omnis eos perspiciatis.',
                                    100,
                                    '...',
                                ) !!}

                            </p>
                        </div>


                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="font-semibold transition-colors duration-300 transform text-gray-700 hover:text-purple-500 hover:underline"
                                        tabindex="0" role="link">Baca
                                        selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    @if (isset($thumbnail))
                        <img class="object-cover object-center w-full h-64 rounded-lg" src="{{ $thumbnail }}"
                            alt="Artikel">
                    @else
                        <img class="object-cover object-center w-full h-64 rounded-lg"
                            src="https://t4.ftcdn.net/jpg/05/17/53/57/360_F_517535712_q7f9QC9X6TQxWi6xYZZbMmw5cnLMr279.jpg"
                            alt="gambar artikel">
                    @endif

                    <div class="px-6 pt-4 pb-6">
                        <div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="d-block text-xs font-medium bg-pink-500 px-2 py-1 rounded text-white uppercase">Artikel</span><span
                                    class="d-block text-sm font-medium text-pink-500">12 Hari yang lalu</span>
                            </div>
                            <a href="#"
                                class="block mt-4 text-xl font-semibold text-gray-800 transition-colors duration-300 transform hover:text-purple-500 hover:underline"
                                tabindex="0"
                                role="link">{{ Str::title('tips untuk makanan sehat dan bergizi') }}</a>
                            <p class="mt-2 text-base text-gray-600">
                                {!! Str::limit(
                                    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum, quod temporibus aperiam repellendus magni sed fugit quos tenetur et voluptatum a quas, asperiores alias laboriosam! Corrupti obcaecati excepturi qui ad ut repudiandae recusandae? At similique blanditiis cumque quos deleniti rerum perspiciatis eum tempore, quod architecto placeat unde alias ullam vel ut neque illum? Animi, accusamus voluptatum! Quam, voluptatem, dolores amet optio unde nesciunt reiciendis eligendi, ea mollitia repellendus fugit rem. Aliquam culpa quaerat dignissimos eaque obcaecati debitis maiores commodi tempora vel, blanditiis optio eveniet, dolore eum libero necessitatibus eos architecto perferendis similique natus iure atque. Provident, amet exercitationem laudantium eius quidem quisquam placeat reiciendis aspernatur reprehenderit soluta explicabo libero earum optio. Quam, nihil, sed accusantium in molestiae ea hic qui minima eum omnis modi voluptate ad iusto assumenda dignissimos? Numquam libero suscipit, nesciunt error, voluptas asperiores id quasi reprehenderit, quas excepturi cumque culpa atque quisquam. Consequuntur pariatur facere, corporis aspernatur reiciendis ipsam? Aliquam aliquid distinctio, facilis quibusdam omnis eos perspiciatis.',
                                    100,
                                    '...',
                                ) !!}

                            </p>
                        </div>


                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="font-semibold transition-colors duration-300 transform text-gray-700 hover:text-purple-500 hover:underline"
                                        tabindex="0" role="link">Baca
                                        selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
