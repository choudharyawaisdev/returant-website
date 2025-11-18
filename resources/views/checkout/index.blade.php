@extends('layouts.app')
@section('title', 'Checkout')

<style>
    :root {
        --primary-color: #A9262B;
        --secondary-color: #FFC000;
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
    .summary-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
    }
    .checkout-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 20px;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(169, 38, 43, 0.25);
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
        
        {{-- --- Customer Details Form (Left Column) --- --}}
        <div class="col-lg-7">
            <h4 class="mb-3 fw-bold">Delivery Information</h4>
            <form action="{{ route('order.place') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- Mobile Number --}}
                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                    @error('mobile_number') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- Email Address (Optional) --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address (Optional)</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- Address (New Field) --}}
                <div class="mb-3">
                    <label for="address" class="form-label">Delivery Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                {{-- Special Instructions (Optional) --}}
                <div class="mb-4">
                    <label for="special_instructions" class="form-label">Special Instructions (Optional)</label>
                    <textarea class="form-control" id="special_instructions" name="special_instructions" rows="2">{{ old('special_instructions') }}</textarea>
                    @error('special_instructions') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                
                {{-- Hidden Fields for Summary (Optional: Good practice for form re-submission) --}}
                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                <input type="hidden" name="delivery_fee" value="{{ $deliveryFee }}">
                <input type="hidden" name="total_amount" value="{{ $total }}">
                
                <hr class="my-4">

                {{-- Payment Method (Default Cash on Delivery) --}}
                <h4 class="mb-3 fw-bold">Payment Method</h4>
                <div class="form-check">
                    <input id="cod" name="payment_method" type="radio" class="form-check-input" checked required>
                    <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
                </div>
                <div class="form-check mb-5">
                    <input id="online" name="payment_method" type="radio" class="form-check-input" disabled>
                    <label class="form-check-label text-muted" for="online">Online Payment (Coming Soon)</label>
                </div>
                
                {{-- Place Order Button --}}
                <button class="btn btn-custom-primary btn-lg w-100 fw-bold" type="submit">
                    Place Order (Rs. {{ number_format($total) }}/-)
                </button>
            </form>
        </div>

        {{-- --- Order Summary (Right Column) --- --}}
        <div class="col-lg-5 order-lg-last">
            <div class="summary-card shadow-sm">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-dark fw-bold">Your Order</span>
                    <span class="badge bg-secondary rounded-pill">{{ count($cart) }} Items</span>
                </h4>
                
                <ul class="list-group mb-3">
                    {{-- Cart Items --}}
                    @foreach (array_values($cart) as $item)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 fw-bold">{{ $item['title'] }}</h6>
                                <small class="text-muted">Qty: {{ $item['quantity'] }} x Rs. {{ number_format($item['price']) }}/-</small>
                            </div>
                            <span class="text-muted fw-bold">Rs. {{ number_format($item['price'] * $item['quantity']) }}/-</span>
                        </li>
                    @endforeach

                    {{-- Subtotal --}}
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Subtotal</h6>
                        </div>
                        <span class="text-success fw-bold">Rs. {{ number_format($subtotal) }}/-</span>
                    </li>
                    
                    {{-- Delivery Fee --}}
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Delivery Fee</span>
                        <span class="fw-bold">Rs. {{ number_format($deliveryFee) }}/-</span>
                    </li>
                    
                    {{-- Total Amount --}}
                    <li class="list-group-item d-flex justify-content-between bg-dark text-white">
                        <h5 class="my-0 fw-bold">Total Payable</h5>
                        <h5 class="my-0 fw-bold">Rs. {{ number_format($total) }}/-</h5>
                    </li>
                </ul>
                
                {{-- <a href="{{ route('menu') }}" class="btn btn-outline-secondary btn-sm w-100">
                    ← Back to Menu
                </a> --}}
            </div>
        </div>
    </div>
</div>
@endsection