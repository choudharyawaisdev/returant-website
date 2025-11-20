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
                                data-sizes="{{ $menu->sizes->toJson() }}"
                                data-addons="{{ $menu->addons->toJson() }}">

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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body d-flex flex-column flex-md-row">
                        <img id="modalImage" src="" alt="" class="rounded-4 me-md-3 mb-3 mb-md-0"
                            style="width:200px; height:200px; object-fit:cover;">
                        
                        <div class="flex-grow-1">
                            <p id="modalDescription" class="text-muted"></p>

                            {{-- DYNAMIC SIZE OPTIONS --}}
                            <div id="sizesContainer" class="mb-3" style="display:none;">
                                <h6 class="fw-bold mb-2">Select Size</h6>
                                <div id="sizeOptions" class="d-flex flex-wrap gap-2">
                                    {{-- Size radio buttons will be injected here --}}
                                </div>
                                <input type="hidden" name="selected_size_id" id="selectedSizeId">
                            </div>

                            {{-- DYNAMIC ADD-ON OPTIONS --}}
                            <div id="addOnsContainer" class="mb-3" style="display:none;">
                                <h6 class="fw-bold mb-2">Add-ons (Optional)</h6>
                                <div id="addOnsOptions">
                                    {{-- Add-on checkboxes will be injected here --}}
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="fw-bold mb-2">Quantity</h6>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="quantity-btn me-1" id="qtyDecrement">-</button>
                                    <input type="number" id="qtyInput" value="1" min="1" name="quantity"
                                        class="form-control text-center" style="width:60px;" readonly>
                                    <button type="button" class="quantity-btn ms-1" id="qtyIncrement">+</button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="fw-bold modal-price-badge" id="modalTotalPriceDisplay">
                                    Total: Rs. 0/-
                                </span>
                                <button type="submit" class="btn btn-custom-primary fw-bold rounded-pill"
                                    id="addToCartButton">
                                    Add <span id="modalQtyDisplay">1</span> Item to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODIFIED PRODUCT MODAL --}}


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

    {{-- MODIFIED JAVASCRIPT LOGIC --}}
    <script>
        // Note: I'm keeping your existing cart functions but modifying the modal logic heavily.
        // Assuming your Laravel routes are defined:
        // const ADD_TO_CART_URL = "{{ route('cart.add') }}";
        // const GET_CART_URL = "{{ route('cart.get') }}";
        // const CSRF_TOKEN = "{{ csrf_token() }}";

        document.addEventListener("DOMContentLoaded", function() {

            // --- Cart/UI initialization (Keeping your original logic for existing code) ---
            const cartBadge = document.getElementById('cartBadge');
            const cartCountHeader = document.getElementById('cartCountHeader');
            const cartItemsContainer = document.getElementById('cartItemsContainer');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const cartSummary = document.getElementById('cartSummary');
            const emptyCartMessage = document.getElementById('emptyCartMessage');
            const productModalElement = document.getElementById('productModal');
            const productModal = new bootstrap.Modal(productModalElement);
            // ... (Your existing cart update, add, remove functions should remain here) ...


            // --- NEW MODAL VARIABLES ---
            let basePrice = 0; // Base price of the menu item
            let selectedSizePrice = 0; // Price difference due to size
            let currentMenuData = {}; // Stores all data from the card

            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalImage = document.getElementById('modalImage');
            const modalMenuId = document.getElementById('modalMenuId');
            
            const qtyInput = document.getElementById('qtyInput');
            const modalQtyDisplay = document.getElementById('modalQtyDisplay');
            const modalTotalPriceDisplay = document.getElementById('modalTotalPriceDisplay');
            const addToCartForm = document.getElementById('addToCartForm');
            
            const sizesContainer = document.getElementById('sizesContainer');
            const sizeOptions = document.getElementById('sizeOptions');
            const selectedSizeId = document.getElementById('selectedSizeId');
            
            const addOnsContainer = document.getElementById('addOnsContainer');
            const addOnsOptions = document.getElementById('addOnsOptions');


            // --- PRICE CALCULATION LOGIC ---
            function updateTotalPrice() {
                // 1. Calculate Add-ons Price
                let addOnsPrice = 0;
                const selectedAddOns = addOnsOptions.querySelectorAll('input[name="add_ons[]"]:checked');
                selectedAddOns.forEach(checkbox => {
                    addOnsPrice += parseFloat(checkbox.dataset.price) || 0;
                });

                // 2. Calculate Total Item Price (Base + Size Diff + Add-ons)
                // Note: The selectedSizePrice stores the DIFFERENCE, not the full price.
                const pricePerItem = basePrice + selectedSizePrice + addOnsPrice;

                // 3. Calculate Final Price (Total Item Price * Quantity)
                const quantity = parseInt(qtyInput.value) || 1;
                const finalTotal = pricePerItem * quantity;

                // 4. Update UI
                modalTotalPriceDisplay.textContent = `Total: Rs. ${finalTotal.toFixed(0)}/-`;
                modalQtyDisplay.textContent = quantity;
            }

            // --- RENDER FUNCTIONS ---
            function renderSizes(sizes) {
                sizeOptions.innerHTML = '';
                sizesContainer.style.display = sizes.length > 0 ? 'block' : 'none';

                if (sizes.length > 0) {
                    sizes.forEach((size, index) => {
                        // The size price here is relative to the menu item's base price
                        const priceDifference = parseFloat(size.price) - basePrice;
                        const isChecked = index === 0;

                        const sizeHtml = `
                            <div class="form-check form-check-inline">
                                <input class="form-check-input size-option-radio" type="radio" name="size_id" 
                                       id="size_${size.id}" value="${size.id}" 
                                       data-price="${priceDifference}" ${isChecked ? 'checked' : ''}>
                                <label class="form-check-label" for="size_${size.id}">
                                    ${size.name} 
                                    <span class="text-muted small">${priceDifference > 0 ? '(+Rs. ' + priceDifference.toFixed(0) + '/-)' : ''}</span>
                                </label>
                            </div>
                        `;
                        sizeOptions.insertAdjacentHTML('beforeend', sizeHtml);

                        if (isChecked) {
                            selectedSizePrice = priceDifference;
                            selectedSizeId.value = size.id; // Set default selected ID
                        }
                    });
                }
            }

            function renderAddOns(addOns) {
                addOnsOptions.innerHTML = '';
                addOnsContainer.style.display = addOns.length > 0 ? 'block' : 'none';

                if (addOns.length > 0) {
                    addOns.forEach(addOn => {
                        const addOnHtml = `
                            <div class="form-check">
                                <input class="form-check-input addon-checkbox" type="checkbox" 
                                       name="add_ons[]" value="${addOn.id}" id="addon_${addOn.id}" 
                                       data-price="${addOn.price}">
                                <label class="form-check-label d-flex justify-content-between" for="addon_${addOn.id}">
                                    <span>${addOn.name}</span>
                                    <span class="text-success fw-bold">+ Rs. ${parseFloat(addOn.price).toFixed(0)}/-</span>
                                </label>
                            </div>
                        `;
                        addOnsOptions.insertAdjacentHTML('beforeend', addOnHtml);
                    });
                }
            }
            
            // --- EVENT LISTENERS ---
            
            // 1. Open Modal and Load Data
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', (e) => {
                    // Only respond to the button click for the modal
                    if (!e.target.closest('.add-to-cart-trigger')) return;

                    // Reset state
                    qtyInput.value = 1;
                    selectedSizePrice = 0;
                    selectedSizeId.value = '';

                    // Get data from card attributes
                    currentMenuData.id = card.dataset.id;
                    currentMenuData.title = card.dataset.title;
                    currentMenuData.description = card.dataset.description;
                    basePrice = parseFloat(card.dataset.price); // Set base price for calculation
                    currentMenuData.image = card.dataset.image;

                    // Parse JSON data for sizes and add-ons
                    const sizes = JSON.parse(card.dataset.sizes);
                    const addons = JSON.parse(card.dataset.addons);
                    
                    // Set modal data
                    modalTitle.innerText = currentMenuData.title;
                    modalDescription.innerText = currentMenuData.description;
                    modalImage.src = currentMenuData.image;
                    modalMenuId.value = currentMenuData.id;

                    // Render dynamic options
                    renderSizes(sizes);
                    renderAddOns(addons);
                    
                    // Initial price update
                    updateTotalPrice();
                });
            });

            // 2. Quantity Change Listener
            document.getElementById('qtyIncrement').addEventListener('click', () => {
                let currentQty = parseInt(qtyInput.value) || 1;
                qtyInput.value = currentQty + 1;
                updateTotalPrice();
            });
            document.getElementById('qtyDecrement').addEventListener('click', () => {
                let currentQty = parseInt(qtyInput.value) || 1;
                if (currentQty > 1) {
                    qtyInput.value = currentQty - 1;
                    updateTotalPrice();
                }
            });

            // 3. Size/Add-on Change Listener (Delegation)
            productModalElement.addEventListener('change', function(e) {
                if (e.target.closest('.size-option-radio')) {
                    selectedSizePrice = parseFloat(e.target.dataset.price) || 0;
                    selectedSizeId.value = e.target.value;
                    updateTotalPrice();
                } else if (e.target.closest('.addon-checkbox')) {
                    updateTotalPrice();
                }
            });

            // 4. Form Submission (Add to Cart)
            addToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Final calculation of the price *per item* (Base + Size + Add-ons)
                let itemPrice = basePrice + selectedSizePrice;
                addOnsOptions.querySelectorAll('input[name="add_ons[]"]:checked').forEach(checkbox => {
                    itemPrice += parseFloat(checkbox.dataset.price) || 0;
                });
                
                const quantity = parseInt(qtyInput.value) || 1;
                
                // Collect all selected add-ons
                const selectedAddOns = Array.from(addOnsOptions.querySelectorAll('input[name="add_ons[]"]:checked'))
                                            .map(cb => cb.value);

                // This is the data structure you should send to your backend CartController:
                const cartData = {
                    menu_id: modalMenuId.value,
                    quantity: quantity,
                    price_per_item: itemPrice.toFixed(2), // Price including size/addons
                    size_id: selectedSizeId.value, // Will be empty if no sizes exist/selected
                    add_on_ids: selectedAddOns,
                    // Optionally pass names for better logging
                    title: modalTitle.innerText, 
                    image: modalImage.src 
                };

                // --- Implement your actual AJAX call here ---
                /*
                fetch(ADD_TO_CART_URL, { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify(cartData)
                })
                .then(response => response.json())
                .then(result => {
                    // Handle success (e.g., show notification, update cart offcanvas)
                    updateCartUI(); 
                    productModal.hide();
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                });
                */
                
                // DEMO ALERT (Remove this when implementing the actual fetch)
                alert('Sending to cart:\n' + JSON.stringify(cartData, null, 2));
                productModal.hide();
            });


            // ... (Your existing scroll and intersection observer logic should follow) ...
        });
    </script>
    {{-- END MODIFIED JAVASCRIPT LOGIC --}}

    <div class="d-lg-none p-3 border-top">
        <a href="/login" class="btn btn-outline-dark w-100 mb-2 rounded-pill fw-bold">Sign In</a>
        <a href="/register" class="btn btn-custom-primary w-100 rounded-pill fw-bold">Sign Up</a>
    </div>

@endsection