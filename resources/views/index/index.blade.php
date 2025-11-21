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
            background-color: #A9262B;
            /* Primary color for the line */
            transition: width 0.3s ease, left 0.3s ease;
        }

        .main-navbar .nav-link:hover::after,
        .main-navbar .nav-link.active::after {
            width: 100%;
            left: 0;
        }
    </style>
    <style>
        /* Hide scrollbar */
        #categoryMenu::-webkit-scrollbar {
            display: none;
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
    <div class="container my-4">
        <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                {{-- Single banner image --}}
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/banner image.png') }}" class="d-block mx-auto" alt="Special Offer Banner"
                        style="object-fit: cover; height: 300px; max-width: 95%; border-radius: 15px;">
                </div>
            </div>
        </div>
    </div>


    {{-- MAIN NAVIGATION BAR (Sticky Categories with Scroll Arrows) --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm main-navbar sticky-top py-2">
        <div class="container position-relative">

            {{-- Left Scroll Button --}}
            <button id="scrollLeft" class="btn position-absolute start-0 top-50 translate-middle-y shadow-sm text-white"
                style="z-index: 10; background-color: #dc3545;"> <i class="fas fa-chevron-left"></i>
            </button>

            {{-- Scrollable Menu Wrapper --}}
            <div class="overflow-hidden" style="margin: 0 50px;">
                <ul id="categoryMenu" class="navbar-nav d-flex flex-row gap-3 text-uppercase fw-medium"
                    style="white-space: nowrap; overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none;">
                    <li class="nav-item"><a class="nav-link" href="#platter">Platter</a></li>
                    <li class="nav-item"><a class="nav-link" href="#wings">Wings</a></li>
                    <li class="nav-item"><a class="nav-link" href="#burger">Burger</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pasta">Pasta</a></li>
                    <li class="nav-item"><a class="nav-link" href="#sandwich">Sandwich</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rolls">Rolls</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nuggets-shots">Nuggets & Shots</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fries">Fries</a></li>
                    <li class="nav-item"><a class="nav-link" href="#drinks">Drinks</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pizza">Pizza</a></li>
                    <li class="nav-item"><a class="nav-link" href="#deals">Deals</a></li>
                </ul>
            </div>

            {{-- Right Scroll Button --}}
            <button id="scrollRight" class="btn position-absolute end-0 top-50 translate-middle-y shadow-sm text-white"
                style="z-index: 10; background-color: #dc3545;"> <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </nav>

    {{-- NEW: FULL-WIDTH SEARCH BAR --}}
    <div class="container-fluid bg-light py-3 border-bottom">
        <div class="container">
            <form action="{{ url('/menu/search') }}" method="GET" class="row g-2">
                <div class="col-12">
                    <div class="input-group">
                        <input type="search" name="q" class="form-control rounded-pill pe-5"
                            placeholder="Search menu items..." aria-label="Search" style="height: 48px;">
                        <span class="input-group-text bg-transparent border-0 position-absolute end-0"
                            style="z-index: 10; top: 0; bottom: 0;">
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
                            {{-- MODIFIED: Added data-sizes and data-addons --}}
                            <div class="card shadow-sm p-3 product-card" data-id="{{ $menu->id }}"
                                data-title="{{ $menu->title }}" data-description="{{ $menu->description }}"
                                data-price="{{ $menu->price }}" data-image="{{ $menu->image }}"
                                data-sizes="{{ $menu->sizes->toJson() }}" data-addons="{{ $menu->addons->toJson() }}">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $menu->image }}" alt="{{ $menu->title }}" class="rounded-4"
                                            style="width:120px; height:120px; object-fit:cover;">
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fw-bold fs-5 mb-1">{{ $menu->title }}</h6>
                                        <p class="text-muted small mb-2">{{ $menu->description }}</p>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold price-tag" id="card-price-{{ $menu->id }}">
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

    {{-- MODIFIED: PRODUCT MODAL (For Quantity, Sizes, and Add-ons) --}}
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 p-3">
                <form id="addToCartForm">
                    <input type="hidden" id="modalMenuId" name="menu_id">

                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body d-flex flex-column flex-md-row">
                        <img id="modalImage" class="rounded-4 me-md-3 mb-3"
                            style="width:200px;height:200px;object-fit:cover;">

                        <div class="flex-grow-1">

                            <p id="modalDescription" class="text-muted"></p>

                            <!-- Accordion Start -->
                            <div class="accordion" id="menuAccordion">

                                <!-- Sizes -->
                                <div class="accordion-item" id="sizesContainer" style="display:none;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#sizesCollapse">
                                            Sizes
                                        </button>
                                    </h2>
                                    <div id="sizesCollapse" class="accordion-collapse collapse">
                                        <div class="accordion-body" id="sizeOptions"></div>
                                    </div>
                                </div>

                                <!-- Add-ons -->
                                <div class="accordion-item" id="addOnsContainer" style="display:none;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#addonsCollapse">
                                            Add-ons
                                        </button>
                                    </h2>
                                    <div id="addonsCollapse" class="accordion-collapse collapse">
                                        <div class="accordion-body" id="addOnsOptions"></div>
                                    </div>
                                </div>

                            </div>
                            <!-- Accordion End -->

                            <div class="mt-3">
                                <h6 class="fw-bold mb-2">Quantity</h6>
                                <div class="d-flex align-items-center">
                                    <button type="button" id="qtyDecrement" class="quantity-btn">-</button>
                                    <input type="number" id="qtyInput" value="1" min="1"
                                        class="form-control text-center mx-2" style="width:60px;" readonly>
                                    <button type="button" id="qtyIncrement" class="quantity-btn">+</button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span id="modalTotalPriceDisplay" class="fw-bold">Total: Rs. 0/-</span>
                                <button type="submit" class="btn btn-custom-primary fw-bold rounded-pill">
                                    Add <span id="modalQtyDisplay">1</span> Item to Cart
                                </button>
                            </div>

                            <input type="hidden" id="selectedSizeId" name="size_id">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- CART OFFCANVAS (Right Sidebar - Remaining same) --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel"
        style="border-radius: 25px 0px 0px 25px">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel"><i class="fa-solid fa-cart-arrow-down"></i> Your
                Cart (<span id="cartCountHeader">0</span>)
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let basePrice = 0;
            let selectedSizeExtra = 0;
            let currentMenu = {};

            const modal = new bootstrap.Modal(document.getElementById('productModal'));
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalImage = document.getElementById('modalImage');
            const modalMenuId = document.getElementById('modalMenuId');

            const qtyInput = document.getElementById('qtyInput');
            const modalQtyDisplay = document.getElementById('modalQtyDisplay');
            const modalTotalPriceDisplay = document.getElementById('modalTotalPriceDisplay');

            const sizesContainer = document.getElementById('sizesContainer');
            const sizeOptions = document.getElementById('sizeOptions');
            const selectedSizeId = document.getElementById('selectedSizeId');

            const addOnsContainer = document.getElementById('addOnsContainer');
            const addOnsOptions = document.getElementById('addOnsOptions');

            function updateTotalPrice() {
                let price = basePrice + selectedSizeExtra;

                addOnsOptions.querySelectorAll('input[name="add_ons[]"]:checked').forEach(cb => {
                    price += parseFloat(cb.dataset.price);
                });

                const qty = parseInt(qtyInput.value);
                const finalPrice = price * qty;

                modalTotalPriceDisplay.textContent = `Total: Rs. ${finalPrice}/-`;
                modalQtyDisplay.textContent = qty;
            }

            function renderSizes(sizes) {
                sizeOptions.innerHTML = '';
                if (sizes.length === 0) {
                    sizesContainer.style.display = "none";
                    return;
                }

                sizesContainer.style.display = "block";

                sizes.forEach((size, index) => {
                    const extra = parseFloat(size.price) - basePrice;

                    const html = `
                <div class="form-check mb-2">
                    <input type="radio" class="form-check-input size-radio"
                        name="size_id"
                        value="${size.id}"
                        data-extra="${extra}"
                        id="size_${size.id}"
                        ${index === 0 ? 'checked' : ''}>
                    <label class="form-check-label" for="size_${size.id}">
                        ${size.name} (${size.price})
                    </label>
                </div>
            `;
                    sizeOptions.insertAdjacentHTML('beforeend', html);

                    if (index === 0) {
                        selectedSizeExtra = extra;
                        selectedSizeId.value = size.id;
                    }
                });
            }

            function renderAddOns(addons) {
                addOnsOptions.innerHTML = '';
                if (addons.length === 0) {
                    addOnsContainer.style.display = "none";
                    return;
                }

                addOnsContainer.style.display = "block";

                addons.forEach(add => {
                    const html = `
                <div class="form-check mb-2">
                    <input type="checkbox" 
                        class="form-check-input addon-checkbox"
                        name="add_ons[]" 
                        value="${add.id}" 
                        data-price="${add.price}"
                        id="addon_${add.id}">
                    <label class="form-check-label d-flex justify-content-between" for="addon_${add.id}">
                        <span>${add.name}</span>
                        <span class="text-success fw-bold">+ Rs. ${add.price}</span>
                    </label>
                </div>
            `;
                    addOnsOptions.insertAdjacentHTML('beforeend', html);
                });
            }

            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', (e) => {
                    if (!e.target.closest('.add-to-cart-trigger')) return;

                    qtyInput.value = 1;
                    selectedSizeExtra = 0;

                    currentMenu.id = card.dataset.id;
                    currentMenu.title = card.dataset.title;
                    currentMenu.description = card.dataset.description;
                    currentMenu.image = card.dataset.image;
                    basePrice = parseFloat(card.dataset.price);

                    modalTitle.innerText = currentMenu.title;
                    modalDescription.innerText = currentMenu.description;
                    modalImage.src = currentMenu.image;
                    modalMenuId.value = currentMenu.id;

                    const sizes = JSON.parse(card.dataset.sizes);
                    const addons = JSON.parse(card.dataset.addons);

                    renderSizes(sizes);
                    renderAddOns(addons);

                    updateTotalPrice();
                });
            });

            document.getElementById('qtyIncrement').addEventListener('click', () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateTotalPrice();
            });

            document.getElementById('qtyDecrement').addEventListener('click', () => {
                let qty = parseInt(qtyInput.value);
                if (qty > 1) qtyInput.value = qty - 1;
                updateTotalPrice();
            });

            document.getElementById('productModal').addEventListener('change', (e) => {
                if (e.target.classList.contains('size-radio')) {
                    selectedSizeExtra = parseFloat(e.target.dataset.extra);
                    selectedSizeId.value = e.target.value;
                    updateTotalPrice();
                }

                if (e.target.classList.contains('addon-checkbox')) {
                    updateTotalPrice();
                }
            });

        });
    </script>
@endsection
