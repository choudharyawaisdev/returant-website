<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    /* Navbar Link Hover Effect */
    .navbar-nav .nav-link {
        position: relative;
        color: #333;
        transition: color 0.3s ease;
        padding-bottom: 5px;
    }

    /* Hover underline color */
    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0%;
        height: 2px;
        background-color: #a9262b;
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #a9262b;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    /* Custom color for the main call-to-action button: #ffc000 */
    .btn-custom-amber {
        background-color: #ffc000 !important;
        border-color: #ffc000 !important;
        color: #333;
    }

    /* Z-index for sticky elements (important when they are stacked) */
    .top-bar {
        z-index: 1050;
    }

    .main-navbar {
        z-index: 1040;
    }

    /* Offcanvas specific styling for mobile links */
    .offcanvas-body .nav-link {
        padding-top: 10px;
        padding-bottom: 10px;
        color: #333 !important;
    }

    /* Ensure the Navbar links are not shown on mobile inside the main navbar */
    @media (max-width: 991.98px) {
        #offcanvasNavbarLabel .nav-link {
            display: block; /* Links visible inside offcanvas */
        }
    }
</style>

<div class="top-bar py-3 border-bottom bg-white shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold fs-3" href="#">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Grub Logo" width="120px" style="border-radius: 10px">
        </a>
        
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-custom-amber fw-bold shadow-sm px-4 py-2 rounded-pill d-none d-lg-block">
                <i class="fa-solid fa-user me-2"></i> Sign In / Sign Up
            </button>

            <button class="btn position-relative bg-dark shadow-sm rounded-circle" style="width:42px; height:42px;">
                <i class="fa-solid fa-cart-shopping text-white"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-white shadow-sm main-navbar sticky-top">
    <div class="container">
        
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="fw-bold">MENU</span> 
        </button>
        
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav fw-medium text-uppercase gap-3">
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
        
        <div class="d-flex align-items-center gap-2 d-none d-lg-block" style="width: 100px;">
        </div>

    </div>
</nav>

<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menu Categories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body">
        <ul class="navbar-nav fw-medium text-uppercase">
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#platter">Platter</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#wings">Wings</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#burger">Burger</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#pasta">Pasta</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#sandwich">Sandwich</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#rolls">Rolls</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#nuggets-shots">Nuggets & Shots</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#fries">Fries</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-dismiss="offcanvas" href="#drinks">Drinks</a></li>
        </ul>

        <hr>
        
        <button class="btn btn-custom-amber fw-bold shadow-sm w-100 py-2 rounded-pill">
            <i class="fa-solid fa-user me-2"></i> Sign In / Sign Up
        </button>

    </div>
</div>