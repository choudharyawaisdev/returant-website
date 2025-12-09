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
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-md-3 col-lg-2 mb-3 d-flex justify-content-center justify-content-md-start">
                            <a class="navbar-brand fw-bold d-flex align-items-center" href="#" >
                                <img src="{{ asset('assets/images/logo.jpg') }}" class="rounded-2"
                                    style="width: 120px; height: auto;">
                            </a>
                        </div>

                        <!-- Contact Section -->
                        <div class="col-md-3 col-lg-3 mt-3">
                            <h6 class="text-uppercase mb-3 fw-bold">Chinos Café</h6>
                            <p class="mb-1"><strong>Phone:</strong> +92 3197793578</p>
                            <p class="mb-1">
                                <strong>Address:</strong> Dr. Saucy - Sialkot Cantt, 15th Division,
                                V Eats Food Court, Ghalib Rd, Sialkot Cantonment, Sialkot
                            </p>
                        </div>

                        <!-- Timings -->
                        <div class="col-md-2 col-lg-3 mt-3">
                            <h6 class="text-uppercase mb-3 fw-bold">Our Timing</h6>
                            <p class="mb-1"><strong>Monday - Sunday</strong></p>
                            <p class="mb-1"><strong>12:00 PM - 01:00 AM</strong></p>
                        </div>

                        <!-- Location Map (col-4) -->
                        <div class="col-md-4 col-lg-4 mt-3">
                            <h6 class="text-uppercase mb-3 fw-bold">Location</h6>
                            <div class="footer-map"
                                style="width: 100%; height: 180px; border-radius: 8px; overflow: hidden;">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3393.8912462511184!2d72.97650837399229!3d31.71886563731121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzHCsDQzJzA3LjkiTiA3MsKwNTgnNDQuNyJF!5e0!3m2!1sen!2s!4v1765282477986!5m2!1sen!2s"
                                    width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>

                    </div>
                </section>

                <hr class="my-3">

                <!-- Footer Bottom -->
                <section class="p-3 pt-0">
                    <div class="row">
                        <div class="col-12 text-center">
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

        <style>
            .footer-map iframe {
                border: 0;
            }

            @media (max-width: 768px) {
                .footer-map {
                    height: 150px !important;
                }
            }
        </style>


    </div>
    <div id="responsive-overlay"></div>
    @include('includes.script')
</body>

</html>
