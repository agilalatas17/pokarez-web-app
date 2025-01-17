<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/logo/pokarez-logo.jpg') }}" type="image/jpg">

    <title>{{ config('app.name', 'POKAREZ WEB') }}</title>

    <!-- Google Site Verification -->
    @if (config('services.google_site_verification'))
        <meta name="google-site-verification" content="{{ config('services.google_site_verification') }}" />
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lobster:400|nunito-sans:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        @include('layouts.navbar')
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-pink-50 shadow md:max-h-40 py-3 md:py-6 border-b border-violet-200 mb-6">
                <div class="container px-4 md:px-8 mx-auto">
                    <div class="my-6">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('layouts.footer')
    </div>

    <script>
        // Clone running image
        let runningImg = document.querySelector('#running-img');
        let runningImgWrapper = document.querySelector('#running-img-wrapper');

        for (let i = 0; i <= 6; i++) {
            let clonedImg = runningImg.cloneNode(true);
            runningImgWrapper.appendChild(clonedImg);
        }
    </script>
</body>

</html>
