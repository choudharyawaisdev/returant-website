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
        background-color: #f8f9fa;
        /* Light background for highlight */
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
<style>
    /* Avatar */
    .user-avatar {
        width: 42px;
        height: 42px;
        object-fit: cover;
        border: 2px solid #fff;
        transition: 0.2s ease-in-out;
    }

    .user-avatar:hover {
        transform: scale(1.05);
    }

    /* Dropdown Menu */
    .user-dropdown {
        border-radius: 12px;
        padding: 6px 0;
        border: none;
        background: #ffffff;
        min-width: 200px;
    }

    /* Dropdown Items */
    .user-dropdown-item {
        font-size: 14px;
        padding: 10px 18px;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
    }

    .user-dropdown-item:hover {
        background: #f4f4f4;
        color: #a9262b;
    }

    /* Divider Styling */
    .dropdown-divider {
        margin: 6px 0;
        border-color: #e6e6e6;
    }

    /* Dark mode hover or Primary hover? */
    .user-dropdown-item.text-danger:hover {
        background: #ffeaea;
    }
</style>
{{-- TOP BAR (Logo and Cart) - STICKY --}}
{{-- TOP BAR (Logo and Cart) - STICKY --}}
<div class="top-bar py-3 sticky-top bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Grub Logo" class="rounded-2"
                style="width: 120px; height: auto;">
        </a>

        {{-- Right Side: Auth / Cart --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Guest: Login/Register --}}
            @guest
                <a href="{{ route('login') }}" class="btn btn-login-custom fw-bold shadow-sm d-none d-lg-inline-block">
                    Register Now
                </a>
            @endguest

            {{-- Authenticated User --}}
            @auth
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center user-dropdown-toggle" id="userDropdown"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/coffee-break.png') }}" class="rounded-circle shadow-sm user-avatar"
                            alt="User">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end user-dropdown shadow-lg" aria-labelledby="userDropdown">
                        <li class="px-3 py-2 text-center">
                            <span class="fw-bold text-dark" style="font-size: 14px;">{{ Auth::user()->name }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item user-dropdown-item" href="{{ route('wishlist.index') }}">
                                <i class="fa-regular fa-heart me-2 text-danger"></i> My Wishlist
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item user-dropdown-item" href="{{ route('client.order') }}">
                                <i class="fa-solid fa-bag-shopping me-2 text-primary"></i> My Orders
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item user-dropdown-item text-danger fw-bold" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            {{-- Cart Button (hide on wishlist/order/checkout) --}}
            @if (!request()->routeIs(['wishlist.index', 'client.order', 'checkout.index']))
                @php
                    $cartCount = collect(session()->get('cart', []))->sum('quantity');
                @endphp

                <button id="cartButton" class="btn position-relative bg-light shadow-sm rounded-circle"
                    style="width:42px; height:42px;" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
                    aria-controls="cartOffcanvas">
                    <i class="fa-solid fa-cart-shopping text-dark"></i>
                    <span id="cartBadge"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cartCount }}
                    </span>
                </button>
            @endif

        </div>
    </div>
</div>
<script>
    // Update Cart Badge via AJAX
    function updateCartBadge() {
        fetch('/cart/get')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('cartBadge');
                if (badge) badge.textContent = data.cartCount ?? 0;
            });
    }

    // Run on page load
    document.addEventListener('DOMContentLoaded', updateCartBadge);
</script>
