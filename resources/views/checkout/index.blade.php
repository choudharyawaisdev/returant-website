@extends('layouts.app')
@section('title', 'Checkout')

<style>
    :root {
        --primary-color: #ff6f00;
        --secondary-color: #ffd54f;
        --success-green: #28a745;
        --light-bg: #f9f9f9;
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
        border-color: #e25f00;
    }

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
        border-radius: 12px;
        padding: 30px;
        border: 1px solid var(--border-color);
    }

    .checkout-title {
        color: var(--primary-color);
        font-weight: 800;
        margin-bottom: 25px;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 111, 0, 0.25);
    }

    .form-check-input:checked {
        background-color: var(--success-green);
        border-color: var(--success-green);
    }

    .list-group-item {
        border-color: rgba(0, 0, 0, 0.05);
    }

    .modal-title {
        color: var(--primary-color);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }

    #useLocationBtn {
        background-color: var(--success-green);
        border-color: var(--success-green);
        color: white;
    }

    #useLocationBtn:hover {
        background-color: #1e7e34;
        border-color: #1e7e34;
    }

    .total-row {
        background-color: #fff3e0;
        /* Light orange background for emphasis */
        border-top: 2px solid var(--primary-color);
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
                <form action="{{ route('order.place') }}" method="POST" class="needs-validation" novalidate id="checkoutForm">
                    @csrf

                    <div class="row g-3 mb-3 p-3 bg-light" style="border-radius:10px">
                        <p class="mb-3 fw-bold">Delivery Information</p>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" placeholder="Full Name"
                                value="{{ old('name', auth()->user()->name ?? '') }}" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="tel" class="form-control" name="mobile_number" placeholder="Mobile Number"
                                value="{{ old('mobile_number', auth()->user()->mobile_number ?? '') }}" required>
                            @error('mobile_number')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" placeholder="Email (Optional)"
                                value="{{ old('email', auth()->user()->email ?? '') }}">
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 bg-light p-3" style="border-radius:10px;">
                        <p class="mb-3 fw-bold">Special Instructions (Optional)</p>
                        <textarea name="special_instructions" class="form-control" rows="4"
                            placeholder="E.g. Leave at the gate, call upon arrival, or any specific instructions">{{ old('special_instructions') }}</textarea>
                    </div>

                    <div class="mb-4 bg-light p-3" style="border-radius:10px;">
                        <p class="mb-3 fw-bold">Add Adress Area/House</p>
                        {{-- Address textarea with new placeholder --}}
                        <textarea name="address" class="form-control" rows="4"
                            placeholder="Enter your street address, house/apartment number, and area/sector here." required>{{ old('address') }}</textarea>
                        {{-- Added error display for 'address' field (assuming a 'name' of 'address' for the input) --}}
                        @error('address')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Hidden inputs for financial data (Backend MUST re-calculate this for security) --}}
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" name="delivery_fee" value="{{ $deliveryFee }}">
                    <input type="hidden" name="total_amount" value="{{ $total }}">

                    <div class="mb-4 bg-light p-3" style="border-radius:10px">
                        <p class="mb-3 fw-bold">Payment Method</p>
                        <div class="form-check cod-option p-3 border rounded">
                            <label class="form-check-label d-flex align-items-center" for="cod">
                                <i class="fas fa-money-bill-wave me-2"
                                    style="color: var(--success-green); font-size: 1.5rem;"></i>
                                <span class="fw-bold ">Cash on Delivery (COD)</span>
                            </label>
                        </div>
                        @error('payment_method')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>

            <div class="col-lg-4 order-lg-last bg-light " style="border-radius:10px">
                <div class="summary-card shadow mt-3">
                    <h4 class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <span class="text-dark fw-bold"><i class="fas fa-shopping-cart me-2"
                                style="color: var(--primary-color);"></i> Your Order</span>
                    </h4>

                    <ul class="list-group">
                        {{-- LOOPING OVER $cartItems (fixed the undefined variable error) --}}
                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div class="d-flex w-100">
                                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}"
                                        alt="{{ $item['title'] }}" class="img-fluid rounded me-3"
                                        style="height:60px; object-fit:cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="my-0 fw-bold">{{ $item['title'] }}</h6>

                                        {{-- Display Size --}}
                                        @if (!empty($item['size_name']))
                                            <small class="d-block text-muted">Size: {{ $item['size_name'] }}</small>
                                        @endif

                                        {{-- Display Add-ons --}}
                                        @if (!empty($item['add_ons']))
                                            @php
                                                // Decode add_ons if stored as JSON string
                                                $addons = is_string($item['add_ons'])
                                                    ? json_decode($item['add_ons'], true)
                                                    : $item['add_ons'];
                                            @endphp
                                            @if (!empty($addons))
                                                <small class="d-block text-muted">Add-ons:
                                                    {{ collect($addons)->pluck('name')->implode(', ') }}</small>
                                            @endif
                                        @endif

                                        <small class="text-muted">Qty: {{ $item['quantity'] }} x Rs.
                                            {{ number_format($item['price']) }}/-</small>
                                    </div>
                                </div>
                                <span class="text-dark fw-bold text-nowrap">Rs.
                                    {{ number_format($item['price'] * $item['quantity']) }}/-</span>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="list-group mb-0">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="my-0">Subtotal</span>
                            <span class="text-dark fw-bold">Rs. {{ number_format($subtotal) }}/-</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Delivery Charges</span>
                            <span class="fw-bold">Rs. {{ number_format($deliveryFee) }}/-</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between total-row pt-3 pb-3">
                            <span class="my-0 fw-bold text-dark">Grand Total</span>
                            <h5 class="my-0 fw-bold text-dark">Rs. {{ number_format($total) }}/-</h5>
                        </li>
                    </ul>

                    {{-- The button submits the main form using its ID --}}
                    <button type="submit" form="checkoutForm" class="btn btn-lg w-100 mt-3 text-white"
                        style="background-color: #a9262b">
                        <i class="fas fa-motorcycle me-2"></i> Place Order Now
                    </button>
                </div>
            </div>
        </div>
    </div>



@endsection
