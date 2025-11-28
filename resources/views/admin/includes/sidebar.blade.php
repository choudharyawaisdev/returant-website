<!-- SIDEBAR -->
<aside class="app-sidebar sticky" id="sidebar">
    <div class="main-sidebar-header">
        <a href="" class="header-logo text-center">
            <img src="assets/images/logo getwelll.png" alt="Get Well">
        </a>
    </div>

    <div class="main-sidebar" id="sidebar-scroll">
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>

            <li class="slide__category"><span class="category-name">Main</span></li>

            <ul class="main-menu">
                <!-- Dashboard -->
                <li class="slide">
                    <a href="{{ url('admin/dashboard') }}" class="side-menu__item">
                        <i class="fa-solid fa-house side-menu__icon text-sm"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <!-- Orders -->
                <li class="slide mt-2">
                    <a href="{{ url('admin/orders') }}" class="side-menu__item">
                        <i class="fa-solid fa-cart-flatbed side-menu__icon"></i>
                        <span class="side-menu__label">Orders</span>
                    </a>
                </li>

                <!-- Add Ons -->
                <li class="slide mt-2">
                    <a href="{{ url('admin/addons') }}" class="side-menu__item">
                        <i class="fa-solid fa-burger side-menu__icon"></i>
                        <span class="side-menu__label">Add Ons</span>
                    </a>
                </li>

                <!-- Categories -->
                <li class="slide mt-2">
                    <a href="{{ route('admin.categories.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-layer-group side-menu__icon"></i>
                        <span class="side-menu__label">Categories</span>
                    </a>
                </li>

                <!-- Menus -->
                <li class="slide mt-2">
                    <a href="{{ route('admin.menus.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-utensils side-menu__icon"></i>
                        <span class="side-menu__label">Menus</span>
                    </a>
                </li>
            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
    </div>

</aside>
