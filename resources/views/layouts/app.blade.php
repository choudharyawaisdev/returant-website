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

        <footer class="text-dark text-center text-lg-start" style="background-color: #f8f9fa;">
            <div class="container p-4 pb-0">
                <section>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 fw-bold">Company Name</h6>
                            <p>
                                Here you can use rows and columns to organize your footer content.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>

                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 fw-bold">Products</h6>
                            <p><a class="text-dark">Product One</a></p>
                            <p><a class="text-dark">Product Two</a></p>
                            <p><a class="text-dark">Product Three</a></p>
                            <p><a class="text-dark">Product Four</a></p>
                        </div>

                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 fw-bold">Useful Links</h6>
                            <p><a class="text-dark">Your Account</a></p>
                            <p><a class="text-dark">Become an Affiliate</a></p>
                            <p><a class="text-dark">Shipping Rates</a></p>
                            <p><a class="text-dark">Help</a></p>
                        </div>

                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 fw-bold">Contact</h6>
                            <p><i class="fas fa-home me-2"></i> New York, NY 10012, US</p>
                            <p><i class="fas fa-envelope me-2"></i> info@gmail.com</p>
                            <p><i class="fas fa-phone me-2"></i> +01 234 567 88</p>
                            <p><i class="fas fa-print me-2"></i> +01 234 567 89</p>
                        </div>
                    </div>
                </section>

                <hr class="my-3">

                <section class="p-3 pt-0">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-7 col-lg-8 text-center text-md-start">
                            <div class="p-3">
                                © 2025 Copyright:
                                <a class="text-dark fw-bold" href="#">YourWebsite.com</a>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-4 text-center text-md-end">
                            <a class="btn btn-outline-dark btn-floating m-1"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1"><i class="fab fa-google"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1"><i class="fab fa-instagram"></i></a>
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
