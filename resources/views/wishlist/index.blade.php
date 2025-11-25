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
    </style>

@endsection
