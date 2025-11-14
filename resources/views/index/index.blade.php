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
            text-align: center;
            margin-bottom: 2rem;
            color: var(--dark-bg);
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 10px;
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
    </style>

    {{-- Category & Menus --}}
    @foreach ($categories as $category)
        @if ($category->menus->count())
            <section class="container my-5">
                <h2 id="{{ Str::slug($category->name) }}" class="section-title">{{ $category->name }}</h2>
                <div class="row g-4 justify-content-center">
                    @foreach ($category->menus as $menu)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm p-3 product-card" data-title="{{ $menu->title }}"
                                data-description="{{ $menu->description }}" data-price="{{ $menu->price }}"
                                data-image="{{ $menu->image }}">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $menu->image }}" alt="{{ $menu->title }}" class="rounded-4"
                                            style="width:120px; height:120px; object-fit:cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fw-bold fs-5 mb-1">{{ $menu->title }}</h6>
                                        <p class="text-muted small mb-2">{{ $menu->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold price-tag">Rs. {{ $menu->price }}/-</span>
                                        </div>
                                        <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">
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

    {{-- City/Area Selection Modal --}}
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

    {{-- Product Detail Modal --}}
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
                        <div class="d-flex align-items-center mt-3">
                            <button type="button" class="quantity-btn me-1" id="qtyDecrement">-</button>
                            <input type="text" id="qtyInput" value="1" class="form-control text-center"
                                style="width:60px;">
                            <button type="button" class="quantity-btn ms-1" id="qtyIncrement">+</button>
                        </div>
                        <button class="btn btn-custom-primary w-100 fw-bold rounded-pill mt-3">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- Location Modal ---
            if (!localStorage.getItem("selectedArea")) {
                var locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
                locationModal.show();
            }
            document.getElementById("locationForm").addEventListener("submit", function(e) {
                e.preventDefault();
                var selectedArea = document.getElementById("areaSelect").value;
                localStorage.setItem("selectedArea", selectedArea);
                window.location.href = window.location.pathname + "?area=" + encodeURIComponent(
                    selectedArea);
            });

            // --- Product Modal ---
            const productModal = new bootstrap.Modal(document.getElementById('productModal'));
            let qtyInput = document.getElementById('qtyInput');

            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', () => {
                    const menu = {
                        title: card.dataset.title,
                        description: card.dataset.description,
                        price: card.dataset.price,
                        image: card.dataset.image
                    };
                    document.getElementById('modalTitle').innerText = menu.title;
                    document.getElementById('modalDescription').innerText = menu.description;
                    document.getElementById('modalPrice').innerText = 'Rs. ' + menu.price + '/-';
                    document.getElementById('modalImage').src = menu.image;
                    qtyInput.value = 1;
                    productModal.show();
                });
            });

            document.getElementById('qtyIncrement').addEventListener('click', () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });
            document.getElementById('qtyDecrement').addEventListener('click', () => {
                if (parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
            });
        });
    </script>

@endsection
