@extends('layouts.app')
@section('title', 'Café Chinos - Menu')

@section('body')

    <style>
        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            background-color: white;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        h2.section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1A1A1A;
        }

        .price-tag {
            background-color: #1A1A1A;
            color: #FFC000;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 1rem;
        }

        .btn-custom-primary {
            background-color: #A9262B;
            border-color: #A9262B;
            color: white;
            font-weight: bold;
        }

        /* NEW: Keep background color on hover */
        .btn-custom-primary:hover {
            background-color: #A9262B;
            border-color: #A9262B;
            color: white;
        }

        .quantity-btn {
            background-color: #A9262B;
            border: none;
            color: white;
            font-weight: bold;
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .modal-price-badge {
            display: inline-block;
            background-color: black;
            color: #ffc000;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            min-width: auto;
        }
        
        /* NEW: Navbar Link Hover Effect */
        .main-navbar .nav-link {
            position: relative;
            padding-bottom: 5px; 
            transition: color 0.3s ease;
        }

        .main-navbar .nav-link::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 3px;
            background-color: #A9262B; /* Primary color for the line */
            transition: width 0.3s ease, left 0.3s ease;
        }

        .main-navbar .nav-link:hover::after,
        .main-navbar .nav-link.active::after {
            width: 100%;
            left: 0;
        }
    </style>

    @php
        $categoryNames = [
            1 => 'Platter',
            2 => 'Wings',
            3 => 'Burger',
            4 => 'Pasta',
            5 => 'Sandwich',
            6 => 'Rolls',
            7 => 'Nuggets & Shots',
            8 => 'Fries',
            9 => 'Drinks',
        ];
    @endphp

    {{-- NEW: SINGLE IMAGE SLIDER (Carousel) --}}
    <div id="imageSlider" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            {{-- Assuming a single banner image for simplicity. Add more .carousel-item for a true slider. --}}
            <div class="carousel-item active">
               p <img src="{{ asset('assets/images/banner image.png') }}" class="d-block w-100" alt="Special Offer Banner" style="object-fit: cover; height: 300px;">
            </div>
        </div>
    </div>

    {{-- MAIN NAVIGATION BAR (Sticky Categories) --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm main-navbar sticky-top">
        <div class="container">

            {{-- Mobile Menu Toggle --}}
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="fw-bold">MENU</span>
            </button>

            {{-- Desktop Navigation Links --}}
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

            {{-- Spacer to center the menu --}}
            <div class="d-flex align-items-center gap-2 d-none d-lg-block" style="width: 100px;">
            </div>
        </div>
    </nav>
    
    {{-- NEW: FULL-WIDTH SEARCH BAR --}}
    <div class="container-fluid bg-light py-3 border-bottom">
        <div class="container">
            <form action="{{ url('/menu/search') }}" method="GET" class="row g-2">
                <div class="col-12">
                    <div class="input-group">
                        <input type="search" name="q" class="form-control rounded-pill pe-5" placeholder="Search menu items..." aria-label="Search" style="height: 48px;">
                        <span class="input-group-text bg-transparent border-0 position-absolute end-0" style="z-index: 10; top: 0; bottom: 0;">
                            <button type="submit" class="btn btn-link p-0 text-dark"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MAIN MENU SECTIONS --}}
    @foreach ($categories as $category)
        @if ($category->menus->count())
            {{-- Section ID is critical for navigation to work --}}
            <section class="container my-5" id="{{ Str::slug($categoryNames[$category->id] ?? $category->name) }}">

                <h2 class="section-title">
                    {{ $categoryNames[$category->id] ?? $category->name }}
                </h2>

                <div class="row g-4">
                    @foreach ($category->menus as $menu)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm p-3 product-card" data-id="{{ $menu->id }}"
                                data-title="{{ $menu->title }}" data-description="{{ $menu->description }}"
                                data-price="{{ $menu->price }}" data-image="{{ $menu->image }}">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $menu->image }}" alt="{{ $menu->title }}" class="rounded-4"
                                            style="width:120px; height:120px; object-fit:cover;">
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fw-bold fs-5 mb-1">{{ $menu->title }}</h6>
                                        <p class="text-muted small mb-2">{{ $menu->description }}</p>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold price-tag">
                                                Rs. {{ $menu->price }}/-
                                            </span>
                                        </div>

                                        <button
                                            class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1 add-to-cart-trigger"
                                            data-bs-toggle="modal" data-bs-target="#productModal">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach


    {{-- LOCATION MODAL --}}
    <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
        {{-- ... (Location Modal content remains the same) ... --}}
    </div>

    {{-- PRODUCT MODAL (For Quantity Selection) --}}
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column flex-md-row align-items-center">
                    <img id="modalImage" src="" alt="" class="rounded-4 me-md-3 mb-3 mb-md-0"
                        style="width:200px; height:200px; object-fit:cover;">
                    <div class="flex-grow-1">
                        <p id="modalDescription" class="text-muted"></p>
                        <h6 class="fw-bold modal-price-badge" id="modalPrice"></h6>
                        <div class="mt-3">
                            <h6 class="fw-bold mb-2">Quantity</h6>
                            <div class="d-flex align-items-center">
                                <button type="button" class="quantity-btn me-1" id="qtyDecrement">-</button>
                                <input type="text" id="qtyInput" value="1" class="form-control text-center"
                                    style="width:60px;">
                                <button type="button" class="quantity-btn ms-1" id="qtyIncrement">+</button>
                            </div>
                        </div>
                        <button class="btn btn-custom-primary w-100 fw-bold rounded-pill mt-4" id="addToCartButton">
                            Add <span id="modalQtyDisplay">1</span> Item to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CART OFFCANVAS (Right Sidebar) --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">🛒 Your Cart (<span
                    id="cartCountHeader">0</span>)
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div id="cartItemsContainer" class="flex-grow-1">
                <div class="text-center text-muted mt-5" id="emptyCartMessage">Your cart is empty.</div>
            </div>

            <div class="mt-4 pt-3 border-top" id="cartSummary" style="display: none;">
                <div class="d-flex justify-content-between fw-bold mb-3">
                    <span>Subtotal:</span>
                    <span id="cartSubtotal">Rs. 0/-</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-custom-primary w-100 fw-bold rounded-pill py-2">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>


    {{-- JAVASCRIPT LOGIC --}}
    <script>
        const ADD_TO_CART_URL = "{{ route('cart.add') }}";
        const GET_CART_URL = "{{ route('cart.get') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";
        const REMOVE_FROM_CART_BASE_URL = "/cart/remove/";

        document.addEventListener("DOMContentLoaded", function() {

            const cartButton = document.getElementById('cartButton');
            const cartBadge = document.getElementById('cartBadge');
            const cartCountHeader = document.getElementById('cartCountHeader');
            const cartItemsContainer = document.getElementById('cartItemsContainer');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const cartSummary = document.getElementById('cartSummary');
            const emptyCartMessage = document.getElementById('emptyCartMessage');
            const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));

            const productModalElement = document.getElementById('productModal');
            const productModal = new bootstrap.Modal(productModalElement);
            let qtyInput = document.getElementById('qtyInput');
            let modalQtyDisplay = document.getElementById('modalQtyDisplay');
            let currentMenu = {};


            async function updateCartUI() {
                try {
                    const response = await fetch(GET_CART_URL);
                    if (!response.ok) throw new Error('Failed to fetch cart');
                    const data = await response.json();

                    const totalItems = data.cartCount;
                    const subtotal = data.subtotal;
                    const cart = data.cart;

                    cartBadge.innerText = totalItems;
                    cartCountHeader.innerText = totalItems;

                    if (totalItems > 0) {
                        cartSummary.style.display = 'block';
                        emptyCartMessage.style.display = 'none';
                    } else {
                        cartSummary.style.display = 'none';
                        emptyCartMessage.style.display = 'block';
                    }

                    cartSubtotal.innerText = `Rs. ${subtotal.toFixed(0)}/-`;

                    cartItemsContainer.innerHTML = '';
                    if (cart.length === 0) {
                        cartItemsContainer.appendChild(emptyCartMessage);
                        return;
                    }

                    cart.forEach((item) => {
                        const itemTotal = item.price * item.quantity;
                        const itemHtml = `
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                <img src="${item.image}" alt="${item.title}" class="rounded-3 me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0">${item.title}</h6>
                                    <div class="small text-muted">Rs. ${item.price}/- x ${item.quantity}</div>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold d-block">Rs. ${itemTotal.toFixed(0)}/-</span>
                                    <button class="btn btn-sm btn-danger p-1 border-0 remove-item-btn" data-id="${item.id}" style="font-size: 0.75rem;">Remove</button>
                                </div>
                            </div>
                        `;
                        cartItemsContainer.insertAdjacentHTML('beforeend', itemHtml);
                    });

                    document.querySelectorAll('.remove-item-btn').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const itemId = e.target.dataset.id;
                            removeFromCart(itemId);
                        });
                    });

                } catch (error) {
                    console.error('Error updating cart UI:', error);
                }
            }


            async function addToCart(menu, quantity) {
                try {
                    const response = await fetch(ADD_TO_CART_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        body: JSON.stringify({
                            id: menu.id,
                            title: menu.title,
                            price: parseFloat(menu.price),
                            image: menu.image,
                            quantity: quantity
                        })
                    });

                    if (!response.ok) throw new Error('Failed to add item to cart');

                    await updateCartUI();

                } catch (error) {
                    console.error('Error adding to cart:', error);
                }
            }

            async function removeFromCart(itemId) {
                try {
                    const response = await fetch(REMOVE_FROM_CART_BASE_URL + itemId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        }
                    });

                    if (!response.ok) throw new Error('Failed to remove item from cart');

                    await updateCartUI();

                } catch (error) {
                    console.error('Error removing from cart:', error);
                }
            }

            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', (e) => {
                    if (e.target.closest('.add-to-cart-trigger')) {
                    }

                    currentMenu = {
                        id: card.dataset.id,
                        title: card.dataset.title,
                        description: card.dataset.description,
                        price: card.dataset.price,
                        image: card.dataset.image
                    };

                    document.getElementById('modalTitle').innerText = currentMenu.title;
                    document.getElementById('modalDescription').innerText = currentMenu.description;
                    document.getElementById('modalPrice').innerText = 'Rs. ' + currentMenu.price +
                        '/-';
                    document.getElementById('modalImage').src = currentMenu.image;

                    qtyInput.value = 1;
                    modalQtyDisplay.innerText = 1;

                    if (!e.target.closest('.add-to-cart-trigger')) {
                        productModal.show();
                    }
                });
            });

            document.getElementById('qtyIncrement').addEventListener('click', () => {
                let currentQty = parseInt(qtyInput.value);
                qtyInput.value = currentQty + 1;
                modalQtyDisplay.innerText = currentQty + 1;
            });
            document.getElementById('qtyDecrement').addEventListener('click', () => {
                let currentQty = parseInt(qtyInput.value);
                if (currentQty > 1) {
                    qtyInput.value = currentQty - 1;
                    modalQtyDisplay.innerText = currentQty - 1;
                }
            });
            qtyInput.addEventListener('input', () => {
                let value = parseInt(qtyInput.value);
                if (isNaN(value) || value < 1) {
                    value = 1;
                }
                qtyInput.value = value;
                modalQtyDisplay.innerText = value;
            });

            document.getElementById('addToCartButton').addEventListener('click', () => {
                const quantity = parseInt(qtyInput.value);
                addToCart(currentMenu, quantity);
                productModal.hide();
            });


            if (!localStorage.getItem("selectedArea")) {
                var locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
                locationModal.show();
            }
            document.getElementById("locationForm").addEventListener("submit", function(e) {
                e.preventDefault();
                var selectedArea = document.getElementById("areaSelect").value;
                localStorage.setItem("selectedArea", selectedArea);
                var locationModal = bootstrap.Modal.getInstance(document.getElementById('locationModal'));
                locationModal.hide();
            });


            const mainNavbar = document.querySelector('.main-navbar');
            const navLinks = document.querySelectorAll('.main-navbar .nav-link');
            const offcanvasLinks = document.querySelectorAll('.offcanvas-body .nav-link');
            const sections = document.querySelectorAll('section[id]');
            let activeLink = null;

            const observerOptions = {
                root: null,
                rootMargin: `-120px 0px -70% 0px`,
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const id = entry.target.getAttribute('id');
                    const link = document.querySelector(`.main-navbar .nav-link[href="#${id}"]`);
                    const offcanvasLink = document.querySelector(
                        `.offcanvas-body .nav-link[href="#${id}"]`);

                    if (entry.isIntersecting) {
                        navLinks.forEach(l => l.classList.remove('active'));
                        offcanvasLinks.forEach(l => l.classList.remove('active'));

                        if (link) {
                            link.classList.add('active');
                            if (offcanvasLink) offcanvasLink.classList.add('active');
                            activeLink = link;
                        }
                    }
                });

                if (window.scrollY < 200 && sections.length > 0) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    offcanvasLinks.forEach(l => l.classList.remove('active'));

                    const firstSectionId = sections[0].getAttribute('id');
                    const firstLink = document.querySelector(
                        `.main-navbar .nav-link[href="#${firstSectionId}"]`);
                    const firstOffcanvasLink = document.querySelector(
                        `.offcanvas-body .nav-link[href="#${firstSectionId}"]`);

                    if (firstLink) firstLink.classList.add('active');
                    if (firstOffcanvasLink) firstOffcanvasLink.classList.add('active');
                }
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });

            const allNavLinks = document.querySelectorAll('.navbar-nav .nav-link, .offcanvas-body .nav-link');
            allNavLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (this.closest('.offcanvas-body')) {
                        const offcanvas = bootstrap.Offcanvas.getInstance(this.closest(
                            '.offcanvas'));
                        if (offcanvas) offcanvas.hide();
                    }

                    if (targetElement) {
                        const topBar = document.querySelector('.top-bar');
                        const mainNavbar = document.querySelector('.main-navbar');
                        const searchBar = document.querySelector('.container-fluid.bg-light'); // NEW
                        const topBarHeight = topBar ? topBar.offsetHeight : 0;
                        const mainNavbarHeight = mainNavbar ? mainNavbar.offsetHeight : 0;
                        const searchBarHeight = searchBar ? searchBar.offsetHeight : 0; // NEW
                        const offset = topBarHeight + mainNavbarHeight + searchBarHeight + 20; // Adjusted offset

                        window.scrollTo({
                            top: targetElement.offsetTop - offset,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            updateCartUI();
        });
    </script>

    <div class="d-lg-none p-3 border-top">
        <a href="/login" class="btn btn-outline-dark w-100 mb-2 rounded-pill fw-bold">Sign In</a>
        <a href="/register" class="btn btn-custom-primary w-100 rounded-pill fw-bold">Sign Up</a>
    </div>

@endsection