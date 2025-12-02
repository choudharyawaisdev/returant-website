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

        #categoryMenu::-webkit-scrollbar {
            display: none;
        }

        h2.section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1A1A1A;
        }

        .price-tag {
            background-color: green;
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

        #categoryNav {
            position: relative;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        #categoryNav.sticky {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            background: white;
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

        $wishlistMenus = [];
        if (auth()->check()) {
            $wishlistMenus = auth()->user()->wishlists()->pluck('menu_id')->toArray();
        }
    @endphp

    {{-- RESPONSIVE SINGLE IMAGE SLIDER --}}
    <div class="container my-4">
        <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/banner image.png') }}" class="d-block w-100" alt="Special Offer Banner"
                        style="object-fit: cover; height: 60vh; border-radius: 15px;">
                </div>
            </div>
        </div>
    </div>


    {{-- MAIN NAVIGATION BAR (Sticky Categories with Scroll Arrows) --}}
    <nav id="categoryNav" class="navbar navbar-expand-lg bg-white shadow-sm main-navbar py-4">

        <div class="container position-relative">
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
        </div>
    </nav>

    {{-- NEW: FULL-WIDTH SEARCH BAR --}}
    <div class="container-fluid bg-light py-3 border-bottom">
        <div class="container">
            <form action="{{ url('/') }}" method="GET" class="row g-2">
                <div class="col-12">
                    <div class="input-group">
                        <input type="search" name="q" value="{{ $searchQuery }}"
                            class="form-control rounded-pill pe-5" placeholder="Search menu items..." aria-label="Search"
                            style="height: 48px;">

                        <span class="input-group-text bg-transparent border-0 position-absolute end-0"
                            style="z-index: 10; top: 0; bottom: 0;">
                            <button type="submit" class="btn btn-link p-0 text-dark">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach ($categories as $category)
        @if ($category->menus->count())
            <section class="container my-5" id="{{ Str::slug($categoryNames[$category->id] ?? $category->name) }}">
                <h2 class="section-title">
                    {{ $categoryNames[$category->id] ?? $category->name }}
                </h2>
                <div class="row g-4">
                    @foreach ($category->menus as $menu)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm p-3 product-card" data-id="{{ $menu->id }}"
                                data-title="{{ $menu->title }}" data-description="{{ $menu->description }}"
                                data-price="{{ $menu->price }}" data-image="{{ $menu->image }}"
                                data-sizes="{{ $menu->sizes->toJson() }}" data-addons="{{ $menu->addons->toJson() }}">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $menu->image }}" alt="{{ $menu->title }}" class="rounded-4"
                                            style="height:120px; width:115px; object-fit:cover;">
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fw-bold fs-5 mb-1">{{ $menu->title }}</h6>

                                        {{-- Show only first 10 words of description --}}
                                        <p class="text-muted small mb-2">
                                            {{ \Illuminate\Support\Str::words($menu->description, 10, '...') }}
                                        </p>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold price-tag" id="card-price-{{ $menu->id }}">
                                                Rs. {{ $menu->price }}/-
                                            </span>

                                            {{-- Show discount only if it exists --}}
                                            @if (!empty($menu->discount) && $menu->discount > 0)
                                                <span class="badge bg-danger">-{{ $menu->discount }}%</span>
                                            @endif
                                        </div>

                                        <button
                                            class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1 add-to-cart-trigger"
                                            data-bs-toggle="modal" data-bs-target="#productModal">
                                            Add To Cart
                                        </button>

                                        <div class="position-absolute top-0 end-0 m-2">
                                            <button class="btn btn-light rounded-circle shadow wishlist-btn"
                                                data-id="{{ $menu->id }}">
                                                <i class="wishlist-icon 
                                                {{ in_array($menu->id, $wishlistIds) ? 'fas fa-heart text-danger' : 'far fa-heart' }}"
                                                    data-id="{{ $menu->id }}"
                                                    style="cursor:pointer; font-size:22px;"></i>
                                            </button>
                                        </div>
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
                        <img id="modalImage" class="rounded-4 me-md-3 mb-3 img-thumbnail"
                            style="height:200px; width:200px object-fit:cover;">

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
                                <span id="modalTotalPriceDisplay" class="fw-bold badge bg-success">Total: Rs. 0/-</span>
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
    {{-- CART OFFCANVAS (Right Sidebar) --}}
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
                <div class="d-flex justify-content-between fw-bold mb-2">
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
            let selectedSizeName = '';
            let currentMenu = {};
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');

            const modal = new bootstrap.Modal(document.getElementById('productModal'));
            const addToCartForm = document.getElementById('addToCartForm');
            const qtyInput = document.getElementById('qtyInput');
            const modalQtyDisplay = document.getElementById('modalQtyDisplay');
            const modalTotalPriceDisplay = document.getElementById('modalTotalPriceDisplay');

            const sizesContainer = document.getElementById('sizesContainer');
            const sizeOptions = document.getElementById('sizeOptions');
            const selectedSizeId = document.getElementById('selectedSizeId');
            const addOnsOptions = document.getElementById('addOnsOptions');
            const selectedAddOnsJson = document.getElementById('selectedAddOnsJson');

            const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
            const cartItemsContainer = document.getElementById('cartItemsContainer');
            const emptyCartMessage = document.getElementById('emptyCartMessage');
            const cartSummary = document.getElementById('cartSummary');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const cartCountHeader = document.getElementById('cartCountHeader');


            function getSelectedAddOns() {
                const selectedAddOns = [];
                addOnsOptions.querySelectorAll('input[name="add_ons[]"]:checked').forEach(cb => {
                    selectedAddOns.push({
                        id: cb.value,
                        name: cb.dataset
                            .name,
                        price: parseFloat(cb.dataset.price)
                    });
                });
                return selectedAddOns;
            }

            function updateTotalPrice() {
                let price = basePrice + selectedSizeExtra;
                const selectedAddOns = getSelectedAddOns();

                selectedAddOns.forEach(addOn => {
                    price += addOn.price;
                });

                const qty = parseInt(qtyInput.value);
                const finalPrice = price * qty;

                modalTotalPriceDisplay.textContent = `Total: Rs. ${finalPrice.toFixed(2)}/-`;
                modalQtyDisplay.textContent = qty;
            }

            function renderSizes(sizes) {
                sizeOptions.innerHTML = '';

                if (sizes.length === 0) {
                    sizesContainer.style.display = "none";
                    selectedSizeName = '';
                    selectedSizeExtra = 0; // Reset extra price if no sizes
                    selectedSizeId.value = '';
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
                            data-name="${size.name}"
                            data-price="${size.price}"
                            id="size_${size.id}"
                            ${index === 0 ? 'checked' : ''}>
                        <label class="form-check-label" for="size_${size.id}">
                            ${size.name} (Rs. ${size.price})
                        </label>
                    </div>
                `;
                    sizeOptions.insertAdjacentHTML('beforeend', html);

                    if (index === 0) {
                        selectedSizeExtra = extra;
                        selectedSizeId.value = size.id;
                        selectedSizeName = size.name;
                    }
                });
            }

            function renderAddOns(addons) {
                addOnsOptions.innerHTML = '';
                if (addons.length === 0) {
                    document.getElementById('addOnsContainer').style.display = "none";
                    return;
                }

                document.getElementById('addOnsContainer').style.display = "block";

                addons.forEach(add => {
                    const html = `
                    <div class="form-check mb-2">
                        <input type="checkbox" 
                            class="form-check-input addon-checkbox"
                            name="add_ons[]" 
                            value="${add.id}" 
                            data-price="${add.price}"
                            data-name="${add.name}"
                            id="addon_${add.id}">
                        <label class="form-check-label d-flex justify-content-between" for="addon_${add.id}">
                            <span>${add.name}</span>
                            <span class="text-success fw-bold">+ Rs. ${parseFloat(add.price).toFixed(2)}</span>
                        </label>
                    </div>
                `;
                    addOnsOptions.insertAdjacentHTML('beforeend', html);
                });
            }

            function renderCart(cartItems, cartCount, subtotal) {
                cartItemsContainer.innerHTML = '';

                if (cartItems.length === 0) {
                    emptyCartMessage.style.display = 'block';
                    cartSummary.style.display = 'none';
                } else {
                    emptyCartMessage.style.display = 'none';
                    cartSummary.style.display = 'block';

                    cartItems.forEach(item => {
                        let priceDisplay = `Rs. ${(item.price * item.quantity).toFixed(2)}/-`;

                        let optionsHtml = '';
                        if (item.size_name) {
                            optionsHtml +=
                                `<small class="d-block text-muted">Size: ${item.size_name}</small>`;
                        }
                        if (item.add_ons && item.add_ons.length > 0) {
                            optionsHtml +=
                                `<small class="d-block text-muted">Add-ons: ${item.add_ons.map(ao => ao.name).join(', ')}</small>`;
                        }

                        const itemHtml = `
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom cart-item" data-configkey="${item.configKey}">
                            <img src="${item.image}" alt="${item.title}" class="rounded-3 me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-0">${item.title}</h6>
                                ${optionsHtml}
                                <div class="d-flex align-items-center mt-1">
                                    <button type="button" class="btn btn-sm btn-outline-secondary me-2 update-qty" data-action="decrement" data-configkey="${item.configKey}">-</button>
                                    <span class="fw-bold">${item.quantity}</span>
                                    <button type="button" class="btn btn-sm btn-outline-secondary ms-2 update-qty" data-action="increment" data-configkey="${item.configKey}">+</button>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="fw-bold d-block">${priceDisplay}</span>
                                <button type="button" class="btn btn-sm text-danger remove-item" data-configkey="${item.configKey}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    `;
                        cartItemsContainer.insertAdjacentHTML('beforeend', itemHtml);
                    });
                }

                cartSubtotal.textContent = `Rs. ${subtotal.toFixed(2)}/-`;
                cartCountHeader.textContent = cartCount;
            }

            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', (e) => {
                    if (!e.target.closest('.add-to-cart-trigger')) return;

                    qtyInput.value = 1;
                    selectedSizeExtra = 0;
                    selectedSizeName = '';

                    currentMenu = {
                        id: card.dataset.id,
                        title: card.dataset.title,
                        description: card.dataset.description,
                        image: card.dataset.image,
                        basePrice: parseFloat(card.dataset.price),
                        sizes: JSON.parse(card.dataset.sizes || '[]'),
                        addons: JSON.parse(card.dataset.addons || '[]'),
                    };
                    basePrice = currentMenu.basePrice;

                    document.getElementById('modalTitle').innerText = currentMenu.title;
                    document.getElementById('modalDescription').innerText = currentMenu.description;
                    document.getElementById('modalImage').src = currentMenu.image;
                    document.getElementById('modalMenuId').value = currentMenu.id;

                    renderSizes(currentMenu.sizes);
                    renderAddOns(currentMenu.addons);

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
                    selectedSizeName = e.target.dataset.name;
                    updateTotalPrice();
                }

                if (e.target.classList.contains('addon-checkbox')) {
                    updateTotalPrice();
                }
            });

            addToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const selectedAddOns = getSelectedAddOns();

                formData.append('title', currentMenu.title);
                formData.append('image', currentMenu.image);
                formData.append('quantity', qtyInput.value);
                formData.append('base_price', basePrice + selectedSizeExtra);
                formData.append('size_name', selectedSizeName);

                formData.append('add_ons_json', JSON.stringify(selectedAddOns));

                fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: new URLSearchParams(
                            formData),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            modal.hide();
                            alert(data.message);

                            fetchCartData();
                            cartOffcanvas.show();
                        } else {
                            alert('Error: ' + (data.message || 'Could not add item to cart.'));
                        }
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error);
                        alert('An error occurred. Please try again.');
                    });
            });

            function fetchCartData() {
                fetch('/cart/get')
                    .then(response => response.json())
                    .then(data => {
                        renderCart(data.cart, data.cartCount, data.subtotal);
                    })
                    .catch(error => {
                        console.error('Error fetching cart data:', error);
                    });
            }

            fetchCartData();

            cartItemsContainer.addEventListener('click', (e) => {
                const btn = e.target.closest('.update-qty');
                if (btn) {
                    const configKey = btn.dataset.configkey;
                    const action = btn.dataset.action;
                    const currentQtyEl = btn.parentElement.querySelector('span');
                    let currentQty = parseInt(currentQtyEl.textContent);
                    let newQty = currentQty;

                    if (action === 'increment') {
                        newQty += 1;
                    } else if (action === 'decrement' && currentQty > 1) {
                        newQty -= 1;
                    } else if (action === 'decrement' && currentQty === 1) {
                        if (confirm('Are you sure you want to remove this item?')) {
                            removeItem(configKey);
                            return;
                        }
                        return;
                    } else {
                        return;
                    }

                    updateCartItemQuantity(configKey, newQty);
                }

                const removeBtn = e.target.closest('.remove-item');
                if (removeBtn) {
                    removeItem(removeBtn.dataset.configkey);
                }
            });

            function updateCartItemQuantity(configKey, quantity) {
                fetch('/cart/update-quantity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            configKey: configKey,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            fetchCartData();
                        } else {
                            alert('Error updating quantity: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error updating quantity:', error));
            }

            function removeItem(configKey) {
                fetch(`/cart/remove/${configKey}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            fetchCartData();
                        } else {
                            alert('Error removing item: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error removing item:', error));
            }


        });
    </script>
    <script>
        $(document).on("click", ".wishlist-icon", function() {
            let icon = $(this);
            let menuId = icon.data("id");

            $.ajax({
                url: "{{ route('wishlist.toggle') }}",
                type: "POST",
                data: {
                    menu_id: menuId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status === "added") {
                        icon.removeClass("far fa-heart").addClass("fas fa-heart text-danger");
                    } else {
                        icon.removeClass("fas fa-heart text-danger").addClass("far fa-heart");
                    }
                }
            });
        });
    </script>
    <script>
        window.addEventListener("scroll", function() {
            let nav = document.getElementById("categoryNav");
            let topBarHeight = 60; // Change based on your top bar height

            if (window.scrollY > topBarHeight) {
                nav.classList.add("sticky");
            } else {
                nav.classList.remove("sticky");
            }
        });
    </script>
@endsection
