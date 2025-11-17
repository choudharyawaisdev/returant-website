@extends('layouts.app')
@section('title', 'Café Chinos - Menu')
@section('body')

    <style>
        :root {
            --primary-color: #A9262B;
            --secondary-color: #FFC000;
            --dark-bg: #1A1A1A;
        }

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
            color: var(--secondary-color) !important;
        }

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

        .new-badge {
            background-color: var(--primary-color);
            color: white;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            padding: 4px 10px;
            display: inline-block;
            margin-bottom: 8px;
        }

        h2.section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-bg);
        }

        .price-tag {
            background-color: var(--dark-bg);
            color: var(--secondary-color);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 1rem;
        }

        .btn-custom-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            font-weight: bold;
        }

        .btn-custom-primary:hover {
            background-color: #8C1E22;
            border-color: #8C1E22;
        }

        .quantity-btn {
            background-color: var(--primary-color);
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

        .top-bar {
            z-index: 1050;
        }

        .main-navbar {
            z-index: 1040;
        }

        .offcanvas {
            z-index: 1060;
        }

        .offcanvas-body .nav-link {
            padding-top: 10px;
            padding-bottom: 10px;
            color: #333 !important;
        }

        @media (max-width: 991.98px) {
            #offcanvasNavbarLabel .nav-link {
                display: block;
            }
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


    @foreach ($categories as $category)
        @if ($category->menus->count())
            <section class="container my-5">

                <h2 id="{{ Str::slug($categoryNames[$category->id] ?? $category->name) }}" class="section-title">
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


    <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Select Your Area</h5>
                </div>
                <div class="modal-body">
                    <form id="locationForm">
                        <div class="mb-3">
                            <label for="areaSelect" class="form-label">Choose Area</label>
                            <select class="form-select" id="areaSelect">
                                <option value="Chiniot" selected>Chiniot</option>
                                <option value="Area 1">Area 1</option>
                                <option value="Area 2">Area 2</option>
                                <option value="Area 3">Area 3</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom-primary w-100 fw-bold rounded-pill">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">🛒 Your Cart (<span id="cartCountHeader">0</span>)
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
                <a href="/checkout" class="btn btn-custom-primary w-100 fw-bold rounded-pill py-2">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartButton = document.getElementById('cartButton');
            const cartBadge = document.getElementById('cartBadge');
            const cartCountHeader = document.getElementById('cartCountHeader');
            const cartItemsContainer = document.getElementById('cartItemsContainer');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const cartSummary = document.getElementById('cartSummary');
            const emptyCartMessage = document.getElementById('emptyCartMessage');

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function updateCartUI() {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

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

                cart.forEach((item, index) => {
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
                                <button class="btn btn-sm btn-danger p-1 border-0 remove-item-btn" data-index="${index}" style="font-size: 0.75rem;">Remove</button>
                            </div>
                        </div>
                    `;
                    cartItemsContainer.insertAdjacentHTML('beforeend', itemHtml);
                });

                document.querySelectorAll('.remove-item-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const indexToRemove = parseInt(e.target.dataset.index);
                        cart.splice(indexToRemove, 1);
                        saveCart();
                        updateCartUI();
                    });
                });
            }

            function addToCart(menu, quantity) {
                const existingItem = cart.find(item => item.id === menu.id);

                if (existingItem) {
                    existingItem.quantity += quantity;
                } else {
                    cart.push({
                        id: menu.id,
                        title: menu.title,
                        price: parseFloat(menu.price),
                        image: menu.image,
                        quantity: quantity
                    });
                }
                saveCart();
                updateCartUI();

                const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
                cartOffcanvas.show();
            }

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

            const productModal = new bootstrap.Modal(document.getElementById('productModal'));
            let qtyInput = document.getElementById('qtyInput');
            let modalQtyDisplay = document.getElementById('modalQtyDisplay');
            let currentMenu = {};

            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', () => {
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

            updateCartUI();
        });
    </script>

    <div class="d-lg-none p-3 border-top">
        <a href="/login" class="btn btn-outline-dark w-100 mb-2 rounded-pill fw-bold">Sign In</a>
        <a href="/register" class="btn btn-custom-primary w-100 rounded-pill fw-bold">Sign Up</a>
    </div>

@endsection
