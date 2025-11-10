@extends('layouts.app')
@section('title', 'Café Chinos - Menu')
@section('body')

    <style>
        /* New Color Scheme based on the images (Black, White, Red/Orange Accents) */
        :root {
            --primary-color: #A9262B; /* Deep Red from the logo */
            --secondary-color: #FFC000; /* Yellow/Orange accent */
            --dark-bg: #1A1A1A; /* Near-black background for contrast */
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        /* Updated Card Styling */
        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            background-color: white; /* Ensure cards stand out */
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
            background-color: #8C1E22; /* Darker red on hover */
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
    
    <div class="collapse navbar-collapse justify-content-center bg-dark" id="navbarNav">
        <ul class="navbar-nav fw-medium text-uppercase">
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
    
    <section class="container my-4 py-3 bg-danger text-white rounded-3 shadow-lg">
        <h3 class="text-center fw-bold mb-3">🔥 Family Deal - Rs. 3590 🔥</h3>
        <p class="text-center mb-0 small">1 Large Pizza, 1 Large Pasta, 10 Hot Wings, 2 Crispy Chicken Patty Burger, 2 Liter Drink</p>
    </section>

    <section class="container my-5">
        <h2 id="platter" class="section-title">🍽️ Platter</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?food,platter" alt="Special Platter" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Special Platter</h6>
                            <p class="text-muted small mb-2">5 Oven Baked Wings, 4 Pcs Spin Rolls, 1 Fries, 1 Dip Sauce</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 950/-</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="wings" class="section-title">🍗 Wings</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?hot+wings" alt="Hot Wings" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Hot Wings (5/10)</h6>
                            <p class="text-muted small mb-2">Spicy and crispy chicken wings.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 350/690</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?oven+baked+wings" alt="Oven Baked Wings" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Oven Baked Wings (6/12)</h6>
                            <p class="text-muted small mb-2">Healthy and flavorful baked wings.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 380/780</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?barbecue+wings" alt="Bar-B.Q Wings" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Bar-B.Q Wings (6/12)</h6>
                            <p class="text-muted small mb-2">Smoky BBQ sauce coated wings.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 400/800</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="burger" class="section-title">🍔 Burgers</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?tower+burger" alt="Tower Burger" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Tower Burger</h6>
                            <p class="text-muted small mb-2">A towering stack of flavor.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 690</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?zinger+burger" alt="Zinger Burger" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Zinger Burger</h6>
                            <p class="text-muted small mb-2">Classic crispy chicken zinger.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 450</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?cheese+zinger+burger" alt="Zinger Cheese Burger" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Zinger Cheese Burger</h6>
                            <p class="text-muted small mb-2">Zinger with melting cheese.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 500</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?heavy+zinger+burger" alt="Heavy Zinger Burger" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Heavy Zinger Burger</h6>
                            <p class="text-muted small mb-2">Extra large and heavy zinger.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 750</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?zinger+with+fries" alt="Zinger with Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Zinger with Fries</h6>
                            <p class="text-muted small mb-2">Zinger served with a side of fries.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 490</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?chicken+patty+burger" alt="Chicken Patty Burger" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Chicken Patty Burger</h6>
                            <p class="text-muted small mb-2">Simple and tasty chicken patty burger.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 350</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?bbq+zinger+burger" alt="Bar.B.Q Zinger Burger" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Bar.B.Q Zinger Burger</h6>
                            <p class="text-muted small mb-2">Zinger topped with tangy BBQ sauce.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 450</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="pasta" class="section-title">🍝 Pasta</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?chef+pasta" alt="Chef Special Pasta" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Chef Special Pasta (S/L)</h6>
                            <p class="text-muted small mb-2">Our signature pasta dish.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 550/700</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?creamy+pasta" alt="Creamy Chicken Pasta" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Creamy Chicken Pasta (S/L)</h6>
                            <p class="text-muted small mb-2">Rich and creamy chicken pasta.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 550/700</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?lasagna+pasta" alt="Lasagna Pasta" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Lasagna Pasta</h6>
                            <p class="text-muted small mb-2">Baked layers of pasta and sauce.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 700</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="sandwich" class="section-title">🥪 Sandwich</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?special+sandwich" alt="Special Sandwich with Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Special Sandwich with Fries</h6>
                            <p class="text-muted small mb-2">Chef's special recipe, served with fries.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 790</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?mexican+sandwich" alt="Mexican Sandwich with Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Mexican Sandwich with Fries</h6>
                            <p class="text-muted small mb-2">Spicy Mexican twist, served with fries.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 790</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?jalapeno+sandwich" alt="Jalapeno Sandwich" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Jalapeno Sandwich</h6>
                            <p class="text-muted small mb-2">For those who love a bit of heat.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 790</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?crispy+sandwich" alt="Crispy Sandwich" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Crispy Sandwich</h6>
                            <p class="text-muted small mb-2">Crunchy chicken in a soft bun.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 850</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="rolls" class="section-title">🍣 Rolls</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?chicken+spin+rolls" alt="Chicken Spin Rolls" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">4 Chicken Spin Rolls</h6>
                            <p class="text-muted small mb-2">Savory chicken filling in a crispy roll.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 600</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?behari+roll" alt="Behari Rolls" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">4 Behari Rolls</h6>
                            <p class="text-muted small mb-2">Spiced behari style meat rolls.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 600</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?paratha+roll" alt="Tikka Paratha Roll" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Tikka Paratha Roll</h6>
                            <p class="text-muted small mb-2">Spicy tikka boti wrapped in paratha.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 350</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-100 rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?chapli+kabab+roll" alt="Chapli Kabab Paratha" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Chapli Kabab Paratha</h6>
                            <p class="text-muted small mb-2">Traditional Chapli Kabab in a paratha.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 350</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?crispy+roll" alt="Crunchy Paratha Roll" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Crunchy Paratha Roll</h6>
                            <p class="text-muted small mb-2">Extra crispy chicken roll.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 350</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container my-5">
        <h2 id="nuggets-shots" class="section-title">🍚 Nuggets & Hot Shots</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?chicken+nuggets" alt="Nuggets" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Nuggets (6/12)</h6>
                            <p class="text-muted small mb-2">Crispy and tender chicken nuggets.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 280/560</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?hot+shots" alt="Hot Shots" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Hot Shots (10/15)</h6>
                            <p class="text-muted small mb-2">Small, spicy, and irresistible chicken pieces.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 400/590</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="fries" class="section-title">🍟 Fries</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?plain+fries" alt="Plain Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Plain Fries / Family Fries</h6>
                            <p class="text-muted small mb-2">The classic potato fries.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 250/500</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?mayo+fries" alt="Mayo Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Mayo Fries</h6>
                            <p class="text-muted small mb-2">Fries topped with creamy mayonnaise.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 300/600</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?masala+fries" alt="Masala Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Masala Fries</h6>
                            <p class="text-muted small mb-2">Fries tossed in a spicy masala mix.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 270/540</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?loaded+fries" alt="Loaded Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Loaded Fries</h6>
                            <p class="text-muted small mb-2">Fries with toppings and sauce.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 400/600</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?pizza+fries" alt="Pizza Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Pizza Fries Small/Large</h6>
                            <p class="text-muted small mb-2">Fries topped like a pizza.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 400/600</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?cheese+fries" alt="Cheese Fries" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Cheese Fries</h6>
                            <p class="text-muted small mb-2">Fries drenched in delicious cheese sauce.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 400/600</span>
                                <span class="price-small-large">Small/Large</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 id="drinks" class="section-title">🥤 Dips & Drinks</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?sauce" alt="Ranch Sauce" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Ranch Sauce</h6>
                            <p class="text-muted small mb-2">A side of creamy ranch dip.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 50</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?soda+bottle" alt="1.5 L Drink" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Soft Drink (1.5 Ltr)</h6>
                            <p class="text-muted small mb-2">Large bottle of your favorite soda.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 220</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?soda+can" alt="1 L Drink" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Soft Drink (1 Ltr)</h6>
                            <p class="text-muted small mb-2">Medium bottle of your favorite soda.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 180</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?coke+tin" alt="500 ml Tin" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Soft Drink (500 ml Tin)</h6>
                            <p class="text-muted small mb-2">Individual tin of soft drink.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 120</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="https://source.unsplash.com/400x300/?drink" alt="Disposable Glass" class="rounded-4"
                                style="width:120px; height:120px; object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold fs-5 mb-1">Disposable Glass</h6>
                            <p class="text-muted small mb-2">For your convenience.</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold price-tag">Rs. 05</span>
                            </div>
                            <button class="btn btn-custom-primary w-100 fw-bold rounded-pill py-1">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container my-5 py-3 bg-light rounded-3 text-center">
        <p class="fw-bold mb-1">Minimum Order: **Rs. 1000**</p>
        <p class="fw-bold text-success mb-0">FREE HOME DELIVERY (Above Rs. 600)</p>
    </section>

@endsection