@extends('layouts.app')
@section('title', 'Checkout')

<style>
    /*
     * Color Scheme Overridden to use Orange/Yellow colors:
     * --primary-color: #ff6f00; (Deep Orange)
     * --secondary-color: #ffd54f; (Light Yellow/Amber)
     */
    :root {
        --primary-color: #ff6f00;
        /* Deep Orange for buttons/accents */
        --secondary-color: #ffd54f;
        /* Light Yellow for contrast */
        --success-green: #28a745;
        /* Keeping standard green for COD check */
        --light-bg: #f9f9f9;
        /* Light background from your first CSS block */
        --dark-text: #222;
        --border-color: #ddd;
    }

    body {
        background-color: var(--light-bg);
        color: var(--dark-text);
    }

    .btn-custom-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        font-weight: bold;
        transition: all 0.2s;
        border-radius: 8px;
    }

    .btn-custom-primary:hover {
        background-color: #e25f00;
        /* Darker orange on hover */
        border-color: #e25f00;
    }

    /* Style for the button inside the modal, using success green */
    .btn-outline-success {
        color: var(--success-green);
        border-color: var(--success-green);
    }

    .btn-outline-success:hover {
        background-color: var(--success-green);
        color: white;
    }

    .summary-card {
        background-color: #fff;
        /* White background for summary card */
        border-radius: 12px;
        padding: 30px;
        border: 1px solid var(--border-color);
    }

    .checkout-title {
        color: var(--primary-color);
        /* Orange title */
        font-weight: 800;
        margin-bottom: 25px;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 111, 0, 0.25);
        /* Orange focus glow */
    }

    .form-check-input:checked {
        background-color: var(--success-green);
        border-color: var(--success-green);
    }



    .cod-option:hover {
        border-color: var(--success-green);
    }

    /* Total Row uses the primary orange color */


    .list-group-item {
        border-color: rgba(0, 0, 0, 0.05);
    }

    .modal-title {
        color: var(--primary-color);
    }

    /* Change Address Button uses primary color */
    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }

    /* Use Current Location Button inside modal */
    #useLocationBtn {
        background-color: var(--success-green);
        border-color: var(--success-green);
        color: white;
    }

    #useLocationBtn:hover {
        background-color: #1e7e34;
        /* Darker green on hover */
        border-color: #1e7e34;
    }
</style>

@section('body')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="checkout-title">Proceed to Checkout</h1>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-8">
                <form action="{{ route('order.place') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3 mb-3 mt-4 bg-light" style="border-radius:10px">
                        <p class="mb-3">Delivery Information</p>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" placeholder="Full Name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="tel" class="form-control" name="mobile_number" placeholder="Mobile Number"
                                value="{{ old('mobile_number') }}" required>
                            @error('mobile_number')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" placeholder="Email (Optional)"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-outline w-10 py-2 fw-bold text-white"
                                data-bs-toggle="modal" data-bs-target="#addressModal" style="background-color: #a9262b;">
                                <i class="fas fa-map-marker-alt me-2 text-white"></i> Add / Change Address
                            </button>
                            <input type="hidden" name="address" id="addressInput" value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="mb-4 bg-light p-3" style="border-radius:10px;">
                        <p class="mb-3 ">Special Instructions (Optional)</p>
                        <textarea name="special_instructions" class="form-control" rows="4"
                            placeholder="E.g. Leave at the gate, call upon arrival, or any specific instructions">{{ old('special_instructions') }}</textarea>
                    </div>

                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" name="delivery_fee" value="{{ $deliveryFee }}">
                    <input type="hidden" name="total_amount" value="{{ $total }}">
                    <div class="mb-4 bg-light " style="border-radius:10px">
                        <p class="mb-3 p-2">Payment Method</p>
                        <div class="form-check cod-option " style="border-radius ">
                            <label class="form-check-label d-flex align-items-center" for="cod">
                                <i class="fas fa-money-bill-wave me-2"
                                    style="color: var(--success-green); font-size: 1.5rem;"></i>
                                <span class="fw-bold ">Cash on Delivery (COD)</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 order-lg-last bg-light p-4" style="border-radius:10px">
                <div class="summary-card shadow">
                    <h4 class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <span class="text-dark fw-bold"><i class="fas fa-shopping-cart me-2"
                                style="color: var(--primary-color);"></i> Your Order</span>
                    </h4>

                    <ul class="list-group mb-0">
                        @foreach (array_values($cart) as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0 fw-bold">{{ $item['title'] }}</h6>
                                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}"
                                        alt="{{ $item['title'] }}" class="img-fluid rounded me-3"
                                        style="width:60px; height:60px; object-fit:cover;">

                                    <small class="text-muted">Qty: {{ $item['quantity'] }} x Rs.
                                        {{ number_format($item['price']) }}/-</small>

                                </div>
                                <span class="text-dark fw-bold">Rs.
                                    {{ number_format($item['price'] * $item['quantity']) }}/-</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between mt-2">
                            <span class="my-0">Subtotal</span>
                            <span class="text-dark fw-bold">Rs. {{ number_format($subtotal) }}/-</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Delivery Charger</span>
                            <span class="fw-bold">Rs. {{ number_format($deliveryFee) }}/-</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between total-row pt-3 pb-3">
                            <span class="my-0">Grand Total</span>
                            <h5 class="my-0 fw-bold">Rs. {{ number_format($total) }}/-</h5>
                        </li>
                        <button class="btn btn-lg text-white" style="background-color: #a9262b;">Order Now</button>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addressModalLabel">Enter Delivery Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <button type="button" class="btn w-100 mb-3" id="useLocationBtn">
                            <i class="fas fa-crosshairs me-2"></i> Use Current Location
                        </button>
                    </div>

                    <h6 class="text-muted text-center my-3">OR Enter Manually</h6>

                    <div class="mb-3">
                        <label for="modalAddress" class="form-label">Address (with post code if applicable)</label>
                        <textarea class="form-control" id="modalAddress" rows="3" placeholder="Enter your complete street address">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-custom-primary" id="saveAddressBtn">
                        Save and Use Address
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Save address from modal to hidden input
        document.getElementById('saveAddressBtn').addEventListener('click', function() {
            // Get address and region (simplified concatenation for the example)
            const address = document.getElementById('modalAddress').value;
            const region = document.getElementById('modal-region').value;

            let fullAddress = address;
            if (region && region !== 'Select Region...') {
                fullAddress += `, ${region}`;
            }

            document.getElementById('addressInput').value = fullAddress.trim();
            // You might want to update the button text here to show the selected address

            // Close modal manually if not using data-bs-dismiss on the button
            // const addressModal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
            // addressModal.hide();
        });

        // Use current location
        document.getElementById('useLocationBtn').addEventListener('click', function() {
            document.getElementById('modalAddress').value = 'Locating...';
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    // In a real application, you would use a Geocoding API (like Google Maps or OpenStreetMap)
                    // to convert these lat/lon coordinates into a human-readable street address.
                    // For this example, we mock the result.
                    document.getElementById('modalAddress').value =
                        `Address near (${lat.toFixed(4)}, ${lon.toFixed(4)}) - Please refine manually.`;
                    alert('Location retrieved. Please refine the address and select the region.');
                }, function(error) {
                    document.getElementById('modalAddress').value = '';
                    alert('Unable to retrieve your location: ' + error.message);
                });
            } else {
                document.getElementById('modalAddress').value = '';
                alert('Geolocation is not supported by your browser.');
            }
        });
    </script>
@endsection
