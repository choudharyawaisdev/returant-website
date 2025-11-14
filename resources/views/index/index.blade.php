@extends('layouts.app')
@section('title', 'Café Chinos - Menu')
@section('body')

    <style>
        :root {
            --primary-color: #A9262B;
            --secondary-color: #FFC000;
            --dark-bg: #1A1A1A;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
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
            text-align: center;
            margin-bottom: 2rem;
            color: var(--dark-bg);
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .price-tag {
            display: inline-block;
            width: auto;
            background-color: var(--dark-bg);
            color: var(--secondary-color);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 1rem;
        }

        /* Quantity (+ / -) button theme fix */
        #qtyPlus,
        #qtyMinus {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        #qtyPlus:hover,
        #qtyMinus:hover {
            background-color: #8C1E22;
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

        .price-small-large {
            font-size: 0.9rem;
            color: #555;
            font-weight: 600;
        }

        .navbar-nav .nav-link.active {
            color: var(--secondary-color) !important;
        }

        #productDetailModal .modal-body-image {
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            width: 100%;
        }

        #locationModal .modal-content {
            border-radius: 20px;
        }

        /* Ensure the Add To Cart button inside the card does NOT trigger the modal */
        .btn-add-base-cart {
            pointer-events: all;
            z-index: 10;
        }
    </style>

    @foreach ($categories as $category)
        @if ($category->id == 1)
            <section class="container my-5">
                <h2 class="section-title" id="{{ Str::slug($category->name) }}">
                    {{ $category->name }}
                </h2>
                <div class="row g-4">
                    @forelse ($category->menus as $menu)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card shadow-sm p-3 menu-item-card h-100" data-bs-toggle="modal"
                                data-bs-target="#productDetailModal" data-id="{{ $menu->id }}"
                                data-title="{{ $menu->title }}" data-description="{{ $menu->description }}"
                                data-price="{{ $menu->price }}" data-image="{{ $menu->image }}"
                                data-route="{{ route('menu.show', $menu->id) }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $menu->image }}" alt="{{ $menu->title }}" class="rounded-4"
                                            style="width:120px; height:120px; object-fit:cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-3 d-flex flex-column">
                                        <h6 class="fw-bold fs-5 mb-1">{{ $menu->title }}</h6>
                                        <p class="text-muted small mb-2 description-wrap">
                                            {{ $menu->description }}
                                        </p>
                                        <div class="mt-auto">
                                            <span class="fw-bold price-tag d-block mb-2" style="width: 55%">
                                                Rs. {{ $menu->price }}
                                            </span>
                                            <button
                                                class="btn btn-custom-primary w-50 fw-bold rounded-pill py-1 btn-add-base-cart"
                                                data-product-id="{{ $menu->id }}">
                                                Add To Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">No items found in this category.</p>
                    @endforelse
                </div>
            </section>
        @endif
    @endforeach

    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <img src="" id="modalProductImage" alt="Product Image" class="modal-body-image shadow">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-bold" id="modalProductTitle"></h3>
                                <div class="d-flex align-items-center my-3">
                                    <span class="fw-bold fs-4 price-tag bg-primary-subtle text-danger"
                                        id="modalProductPrice"></span>
                                </div>
                                <p id="modalProductDescription" class="text-muted"></p>

                                <div class="my-4 p-3 bg-light rounded-3">
                                    <h5 class="fw-semibold">Add-Ons / Options (Example)</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="extraCheese">
                                        <label class="form-check-label" for="extraCheese">
                                            Extra Cheese (+Rs. 50)
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <label class="form-label mb-0 me-3">Quantity:</label>
                                        <div class="input-group input-group-sm w-50">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="qtyMinus">-</button>
                                            <input type="text" class="form-control text-center" id="modalProductQuantity"
                                                value="1" readonly>
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="qtyPlus">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-3">
                                <button class="btn btn-custom-primary btn-lg fw-bold rounded-pill" id="modalAddToCartBtn">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="locationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-center w-100" id="locationModalLabel">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i> Select Your Location
                    </h5>
                </div>
                <div class="modal-body">
                    <p class="text-center text-muted">Please select your city and area to see accurate menu items and
                        prices.</p>
                    <form id="locationForm">
                        <div class="mb-3">
                            <label for="selectCity" class="form-label fw-semibold">City</label>
                            <select class="form-select" id="selectCity" required>
                                <option value="" disabled selected>Choose your City</option>
                                <option value="Faisalabad">Faisalabad</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="selectArea" class="form-label fw-semibold">Area</label>
                            <select class="form-select" id="selectArea" required>
                                <option value="" disabled selected>Choose your Area</option>
                                <option value="Bhutto Colony">Bhutto Colony</option>
                                <option value="Green City Colony">Green City Colony</option>
                                <option value="Din Gardens">Din Gardens</option>
                            </select>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-custom-primary fw-bold rounded-pill">
                                Save Location
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- 1. Product Detail Modal Logic ---
            var productDetailModal = document.getElementById('productDetailModal');
            var qtyInput = document.getElementById('modalProductQuantity');

            productDetailModal.addEventListener('show.bs.modal', function(event) {
                var card = event.relatedTarget;

                // If the target is the 'Add To Cart' button inside the card, prevent modal from opening
                if (card.classList.contains('btn-add-base-cart')) {
                    event.preventDefault();
                    return;
                }

                // Extract info from data-* attributes
                var id = card.getAttribute('data-id');
                var title = card.getAttribute('data-title');
                var description = card.getAttribute('data-description');
                var price = card.getAttribute('data-price');
                var image = card.getAttribute('data-image');

                // Reset quantity to 1 every time modal opens
                qtyInput.value = 1;

                // Update the modal's content
                document.getElementById('modalProductTitle').textContent = title;
                document.getElementById('modalProductDescription').textContent = description;
                document.getElementById('modalProductPrice').textContent = `Rs. ${price}/-`;
                document.getElementById('modalProductImage').src = image;
                document.getElementById('modalAddToCartBtn').setAttribute('data-product-id', id);
            });

            // Quantity controls logic
            document.getElementById('qtyPlus').addEventListener('click', function() {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });

            document.getElementById('qtyMinus').addEventListener('click', function() {
                if (parseInt(qtyInput.value) > 1) {
                    qtyInput.value = parseInt(qtyInput.value) - 1;
                }
            });

            // Handle "Add to Cart" click inside the card (Base item add)
            document.querySelectorAll('.btn-add-base-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e
                        .stopPropagation(); // Stop the card's click event from bubbling up and opening the modal
                    e.preventDefault();

                    const productId = this.getAttribute('data-product-id');

                    console.log(`Base item added to cart: Product ID ${productId}`);

                    alert(`Product ${productId} added to cart!`);
                });
            });

            // Handle "Add to Cart" click inside the modal (Customized item add)
            document.getElementById('modalAddToCartBtn').addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const quantity = document.getElementById('modalProductQuantity').value;
                const extraCheese = document.getElementById('extraCheese').checked;

                console.log(
                    `Custom item added to cart: Product ID ${productId}, Qty: ${quantity}, Cheese: ${extraCheese}`
                );

                // Close modal
                var productDetailModal = bootstrap.Modal.getInstance(document.getElementById(
                    'productDetailModal'));
                productDetailModal.hide();

                alert(`Customized Product ${productId} added to cart!`);
            });


            // --- 2. Geo-Location Modal Logic and URL Manipulation ---

            const urlParams = new URLSearchParams(window.location.search);
            const cityParam = urlParams.get('city');
            const areaParam = urlParams.get('area');

            if (!cityParam || !areaParam) {
                var locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
                locationModal.show();
            }

            const locationForm = document.getElementById('locationForm');
            locationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const city = document.getElementById('selectCity').value;
                const area = document.getElementById('selectArea').value;

                if (city && area) {
                    const currentUrl = new URL(window.location.href);

                    currentUrl.searchParams.set('city', city);
                    currentUrl.searchParams.set('area', area.replace(/\s/g, '-'));

                    window.history.pushState({
                        path: currentUrl.href
                    }, '', currentUrl.href);

                    var locationModalElement = document.getElementById('locationModal');
                    var locationModal = bootstrap.Modal.getInstance(locationModalElement);
                    if (locationModal) {
                        locationModal.hide();
                    }
                } else {
                    alert('Please select both City and Area.');
                }
            });
        });
    </script>
@endsection
