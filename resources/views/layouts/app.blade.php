<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/frontend.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Intel+One+Mono:ital,wght@0,300..700;1,300..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    <style>
        .intel-one-mono-<uniquifier> {
            font-family: "Intel One Mono", monospace;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .raleway-<uniquifier> {
            font-family: "Raleway", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }
    </style>
</head>

<body>
    <div class="page">
        {{-- Header --}}
        @include('includes.header')

        {{-- Main Content --}}
        <main class="content">
            @yield('body')
        </main>

        {{-- Footer --}}
        <footer class="footer mt-5">
            <div class="container text-center">
                <h5 class="mb-3">Gourmet Grub</h5>
                <p class="mb-1">Delicious food delivered to your doorstep.</p>
                <div class="d-flex justify-content-center gap-3 mb-3">
                    <a href="#">Home</a>
                    <a href="#">Menu</a>
                    <a href="#">Contact</a>
                    <a href="#">Privacy Policy</a>
                </div>
                <p class="text-muted small mb-0">© 2025 Gourmet Grub. All Rights Reserved.</p>
            </div>
        </footer>
    </div>

    <div id="responsive-overlay"></div>

    @include('includes.script')
</body>

</html>
