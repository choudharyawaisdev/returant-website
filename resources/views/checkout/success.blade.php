@extends('layouts.app')
@section('title', 'Order Confirmed! 🎉')

<style>
    /* Inheriting existing color scheme */
    :root {
        --primary-color: #ff6f00;
        /* Deep Orange */
        --secondary-color: #ffd54f;
        /* Light Yellow/Amber */
        --success-green: #28a745;
        /* Success Green */
        --light-bg: #f9f9f9;
        --dark-text: #222;
        --border-color: #ddd;
    }

    body {
        background-color: var(--light-bg);
        color: var(--dark-text);
    }

    .success-container {
        max-width: 700px;
        margin: 50px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        border-top: 5px solid var(--success-green);
        /* Green accent strip */
    }

    .icon-circle {
        display: inline-block;
        width: 80px;
        height: 80px;
        line-height: 80px;
        border-radius: 50%;
        background: var(--success-green);
        color: white;
        font-size: 3rem;
        margin-bottom: 20px;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4);
        }

        70% {
            box-shadow: 0 0 0 20px rgba(40, 167, 69, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
    }

    .main-heading {
        color: var(--success-green);
        font-weight: 800;
        margin-bottom: 10px;
    }

    .sub-heading {
        color: var(--dark-text);
        font-size: 1.25rem;
        margin-bottom: 30px;
    }

    .timer-box {
        background-color: var(--secondary-color);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        border: 1px dashed var(--primary-color);
    }

    .timer-text {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .estimated-time {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--dark-text);
    }

    .order-details-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        display: block;
        margin-top: 20px;
    }

    .order-details-link:hover {
        text-decoration: underline;
    }

    .btn-custom-primary {
        /* Reusing custom primary button style for continuation */
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        font-weight: bold;
        transition: all 0.2s;
        border-radius: 8px;
        padding: 10px 30px;
    }

    .btn-custom-primary:hover {
        background-color: #e25f00;
        border-color: #e25f00;
    }
</style>

@section('body')
    <div class="container">
        <div class="success-container">
            <div class="icon-circle">
                <i class="fas fa-check"></i>
            </div>

            {{-- Display Success Message --}}
            @if (session('success'))
                <h2 class="main-heading">Order Placed Successfully!</h2>
                <p class="sub-heading">
                    {{ session('success') }}
                    {{-- This typically contains the message like 'Your order (#[ID]) has been placed...' --}}
                </p>
            @else
                <h2 class="main-heading">Thank You for Your Order!</h2>
                <p class="sub-heading">Your order has been received and is being prepared.</p>
            @endif

            <hr class="mb-4">

            {{-- Timer Information Box --}}
            <div class="timer-box">
                <p class="timer-text">
                    <i class="fas fa-clock me-2"></i> Estimated Preparation & Delivery Time
                </p>
                <div class="estimated-time">
                    30 to 35 Minutes ⏳
                </div>
            </div>

            {{-- Next Steps/Buttons --}}
            <p class="text-muted small">
                We will contact you on your registered mobile number for confirmation shortly.
            </p>

            {{-- Assuming you have a route for viewing order history --}}
            @auth
                <a href="{{ route('profile.orders') }}" class="order-details-link">
                    View Order Details <i class="fas fa-chevron-right ms-1"></i>
                </a>
            @endauth

            {{-- <a href="{{ route('clients') }}" class="btn btn-lg btn-custom-primary mt-4"> --}}
            <i class="fas fa-chevron-left me-2"></i> Continue Shopping
            {{-- </a> --}}
        </div>
    </div>
@endsection
