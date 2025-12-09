<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    :root {
        --primary-color: #A9262B;
        --secondary-color: #FFC000;
        --dark-bg: #1A1A1A;
    }

    /* --- Navbar Hover & Active --- */
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

    /* Sticky Layers */
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

    /* Offcanvas */
    .offcanvas-body .nav-link {
        padding-top: 10px;
        padding-bottom: 10px;
        color: #333 !important;
    }

    .offcanvas-body .nav-link.active {
        font-weight: bold;
        color: var(--primary-color) !important;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    /* Login Button */
    .btn-login-custom {
        background-color: rgba(252, 203, 11, 0.2);
        color: #1A1A1A;
        border: 1px solid black;
        padding: 7px;
        font-size: 12px;
        transition: 0.3s ease;
    }

    .btn-login-custom:hover {
        background-color: rgba(252, 203, 11, 0.2);
        color: #000;
    }

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

    /* Dropdown */
    .user-dropdown {
        border-radius: 12px;
        padding: 6px 0;
        border: none;
        background: #ffffff;
        min-width: 200px;
    }

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
</style>


{{-- TOP BAR --}}
<div class="top-bar py-3 sticky-top bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        {{-- LOGO + LOCATION --}}
        <div class="d-flex align-items-center gap-3">
<<<<<<< HEAD
            <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="" style="background: yellow">
                <img src="{{ asset('assets/images/cafe_chinos_logo.png') }}" class="rounded-2"
=======
            <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="">
                <img src="{{ asset('assets/images/logo.jpg') }}" class="rounded-2"
>>>>>>> 5f9fd0ea760c3e6a0c291a1d8569e387d9a4a443
                     style="width: 120px; height: auto;">
            </a>

            {{-- LOCATION --}}
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-location-dot text-dark fs-5"></i>
                <div class="d-flex flex-column">
                    <span class="fw-bold" style="font-size: 0.9rem;">Visit Now</span>
                    <span class="text-muted" style="font-size: 0.8rem;">
                        Chiniot Pizza Shop & Hub
                    </span>
                </div>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="d-flex align-items-center gap-3">

            {{-- GUEST USER --}}
            @guest
                <a href="{{ route('register') }}"
                   class="btn btn-login-custom fw-bold shadow-sm d-inline-block">
                    Register Now
                </a>
            @endguest

            {{-- AUTH USER --}}
            @auth
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center" id="userDropdown"
                       data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/coffee-break.png') }}" class="rounded-circle shadow-sm user-avatar"
                             alt="User">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end user-dropdown shadow-lg">

                        <li class="px-3 py-2 text-center">
                            <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        {{-- <li>
                            <a class="dropdown-item user-dropdown-item" href="{{ route('wishlist.index') }}">
                                <i class="fa-regular fa-heart me-2 text-danger"></i> My Wishlist
                            </a>
                        </li> --}}

                        <li>
                            <a class="dropdown-item user-dropdown-item" href="{{ route('client.order') }}">
                                <i class="fa-solid fa-bag-shopping me-2 text-primary"></i> My Orders
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item user-dropdown-item text-danger fw-bold"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            @endauth

            {{-- CART BUTTON --}}
            @if (!request()->routeIs(['wishlist.index', 'client.order', 'checkout.index']))
                @php $cartCount = collect(session()->get('cart', []))->sum('quantity'); @endphp

                <button id="cartButton"
                        class="btn position-relative shadow-sm bg-dark"
                        style="width:42px; height:42px;"
                        data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">

                    <i class="fa-solid fa-cart-shopping text-white"></i>

                    <span id="cartBadge"
                          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-white shadow-sm">
                        {{ $cartCount }}
                    </span>
                </button>
            @endif

        </div>
    </div>
</div>


{{-- CART UPDATE SCRIPT --}}
<script>
    function updateCartBadge() {
        fetch('/cart/get')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('cartBadge');
                if (badge) badge.textContent = data.cartCount ?? 0;
            });
    }

    document.addEventListener('DOMContentLoaded', updateCartBadge);
</script>
