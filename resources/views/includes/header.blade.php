<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    :root {
        --primary-color: #A9262B;
        --secondary-color: #FFC000;
        --dark-bg: #1A1A1A;
    }

    /* --- Existing Styles for Navbar & Active Links --- */

    .navbar-nav .nav-link {
        position: relative;
    }

    .navbar-nav .nav-link:hover {
        color: var(--primary-color) !important;
    }

    .navbar-nav .nav-link:hover::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background-color: var(--primary-color);
        transform: scaleX(1);
        transition: transform 0.3s ease;
    }

    /* Set active color for sticky nav links */
    .navbar-nav .nav-link.active {
        color: var(--primary-color) !important;
        font-weight: bold;
    }

    .navbar-nav .nav-link.active::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background-color: var(--primary-color);
        transform: scaleX(1);
    }
    
    /* --- Z-index and Sticky Classes --- */

    /* Z-index for sticky elements */
    .top-bar {
        z-index: 1050;
        background-color: #a9262b;
    }

    .main-navbar {
        z-index: 1040;
    }

    .offcanvas {
        z-index: 1060;
    }

    /* --- Offcanvas Specific Styles --- */

    .offcanvas-body .nav-link {
        padding-top: 10px;
        padding-bottom: 10px;
        color: #333 !important;
    }
    
    /* Set active color for offcanvas links */
    .offcanvas-body .nav-link.active {
        font-weight: bold;
        color: var(--primary-color) !important;
        background-color: #f8f9fa; /* Light background for highlight */
        border-radius: 8px;
    }

    @media (max-width: 991.98px) {
        #offcanvasNavbarLabel .nav-link {
            display: block;
        }
    }

    /* --- Custom Button Styles --- */

    .btn-login-custom {
        background-color: #fafcf9;
        color: #1A1A1A;
        border: none;
        padding: 10px 28px;
        font-size: 16px;
        transition: 0.3s ease;
    }

    .btn-login-custom:hover {
        background-color: #ffffff;
        color: #000;
    }
</style>

{{-- TOP BAR (Logo and Cart) - STICKY --}}
<div class="top-bar py-3 sticky-top">
    <div class="container d-flex justify-content-between align-items-center" >
        <a class="navbar-brand fw-bold fs-3" href="#">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Grub Logo" width="120px" style="border-radius: 10px">
        </a>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-login-custom fw-bold shadow-sm px-4 py-2 d-none d-lg-block">
                Register Now
            </button>

            {{-- Cart Button to open Offcanvas --}}
            <button id="cartButton" class="btn position-relative bg-dark shadow-sm rounded-circle"
                style="width:42px; height:42px;" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
                aria-controls="cartOffcanvas">
                <i class="fa-solid fa-cart-shopping text-white"></i>
                <span id="cartBadge"
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>
        </div>
    </div>
</div>


{{-- OFFCANVAS (Mobile Menu) --}}
<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasNavbar"
    aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menu Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav fw-medium text-uppercase">
            <li class="nav-item"><a class="nav-link" href="#platter">Platter</a></li>
            <li class="nav-item"><a class="nav-link" href="#wings">Wings</a></li>
            <li class="nav-item"><a class="nav-link" href="#burger">Burger</a></li>
            <li class="nav-item"><a class="nav-link" href="#pasta">Pasta</a></li>
            <li class="nav-item"><a class="nav-link" href="#sandwich">Sandwich</a></li>
            <li class="nav-item"><a class="nav-link" href="#rolls">Rolls</a></li>
            <li class="nav-item"><a class="nav-link" href="#nuggets-shots">Nuggets & Shots</a></li>
            <li class="nav-item"><a class="nav-link" href="#fries">Fries</a></li>
            <li class="nav-item"><a class="nav-link" href="#drinks">Drinks</a></li>
        </ul>
    </div>
</div>