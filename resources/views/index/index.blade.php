@extends('layouts.app')
@section('title', 'Café Chinos - Menu')
@section('body')

    <style>
        /* New Color Scheme based on the images (Black, White, Red/Orange Accents) */
        :root {
            --primary-color: #A9262B;
            /* Deep Red from the logo */
            --secondary-color: #FFC000;
            /* Yellow/Orange accent */
            --dark-bg: #1A1A1A;
            /* Near-black background for contrast */
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Updated Card Styling */
        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            background-color: white;
            /* Ensure cards stand out */
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        /* Updated Badge Styling */
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

        /* Updated Heading Styling */
        h2.section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--dark-bg);
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 10px;
        }

        /* Styling for the price tag */
        .price-tag {
            background-color: var(--dark-bg);
            color: var(--secondary-color);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 1rem;
        }

        /* Styling for the "Add to Cart" button */
        .btn-custom-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            font-weight: bold;
        }

        .btn-custom-primary:hover {
            background-color: #8C1E22;
            /* Darker red on hover */
            border-color: #8C1E22;
        }

        /* Styling for Small/Large prices */
        .price-small-large {
            font-size: 0.9rem;
            color: #555;
            font-weight: 600;
        }

        /* Override for Navbar to match dark theme */

        .navbar-nav .nav-link.active {
            color: var(--secondary-color) !important;
        }
    </style>

    @foreach ($categories as $category)
        @if ($category->id == 1)
            <section class="container my-5">
                <h2 id="{{ Str::slug($category->name) }}">
                    {{ $category->name }}
                </h2>
                <div class="row g-4 justify-content-center">
                    @forelse ($category->menus as $menu)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow-sm p-3">
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
                    @empty
                        <p class="text-center text-muted">No items found in this category.</p>
                    @endforelse
                </div>
            </section>
        @endif
    @endforeach


@endsection