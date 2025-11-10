<!-- Top Bar -->
<style>
    /* Navbar Link Hover Effect */
    .navbar-nav .nav-link {
        position: relative;
        color: #333;
        transition: color 0.3s ease;
        padding-bottom: 5px;
    }

    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0%;
        height: 2px;
        background-color: #ff5722;
        /* orange theme color */
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #ff5722;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }
</style>

<div class="top-bar py-2 border-bottom bg-light shadow-sm">
    <div class="container d-flex justify-content-between align-items-center small">
        <div>
            <i class="fa-solid fa-phone me-1"></i> +92 308 5277092
        </div>
        <div>
            <i class="fa-solid fa-envelope me-1"></i> contact@grub.com
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="#">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="" width="120px" style="border-radius: 10px ">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
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

        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-warning text-white fw-bold shadow-sm px-4 py-2 rounded-pill">
                <i class="fa-solid fa-user me-2"></i> Sign In / Sign Up
            </button>


            <button class="btn position-relative bg-light shadow-sm rounded-circle" style="width:42px; height:42px;">
                <i class="fa-solid fa-cart-shopping text-warning"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>
        </div>
    </div>
</nav>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
