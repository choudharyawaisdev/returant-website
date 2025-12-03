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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.bootstrap4.css">
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

<footer class="text-dark text-center text-lg-start" style="background-color: #f8f9fa;">
    <div class="container p-4 pb-0">

        <section>
            <div class="row align-items-start">

                <!-- Logo -->
                <div class="col-md-3 col-lg-2 mb-3 d-flex justify-content-center justify-content-md-start">
                    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                        <img src="{{ asset('assets/images/logo.jpg') }}" class="rounded-2" 
                             style="width: 120px; height: auto;">
                    </a>
                </div>

                <!-- Contact Section -->
                <div class="col-md-5 col-lg-5 col-xl-5 mx-auto mt-3">
                    <h6 class="text-uppercase mb-3 fw-bold">Chinos Café</h6>
                    <p class="mb-1"><strong>Phone:</strong> +92 3197793578</p>
                    <p class="mb-1">
                        <strong>Address:</strong> Dr. Saucy - Sialkot Cantt, 15th Division, 
                        V Eats Food Court, Ghalib Rd, Sialkot Cantonment, Sialkot
                    </p>
                </div>

                <!-- Timings -->
                <div class="col-md-4 col-lg-5 col-xl-5 mt-3">
                    <h6 class="text-uppercase mb-3 fw-bold">Our Timing</h6>
                    <p class="mb-1"><strong>Monday - Sunday</strong></p>
                    <p class="mb-1"><strong>04:00 PM - 12:30 AM</strong></p>
                </div>

            </div>
        </section>

        <hr class="my-3">

        <section class="p-3 pt-0">
            <div class="row d-flex align-items-center">

                <div class="col-md-12 text-center">
                    <div class="p-3">
                        © 2025 Copyright:
                        <a class="text-dark fw-bold" href="#">cafechinos.cafe</a>
                        <br>
                        <span class="text-muted">
                            Developed by <strong>DevtaSoft Company</strong>
                        </span>
                    </div>
                </div>

            </div>
        </section>

    </div>
</footer>

    </div>
    <div id="responsive-overlay"></div>
    @include('includes.script')
</body>

</html>
