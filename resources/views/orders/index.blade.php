@extends('layouts.app')
@section('title', 'Café Chinos - Orders')
@section('body')
    <style>
        /* --- Professional Color Palette & Typography --- */
        :root {
            --brand-maroon: #7B1E21;
            /* Deep Maroon/Red for branding */
            --brand-gold: #FFC000;
            /* Rich Gold/Yellow for accents and highlights */
            --text-dark: #212529;
            /* Standard text color */
            --text-muted: #6C757D;
            /* Secondary text color */
            --bg-light: #FBFBFB;
            /* Very light background */
            --table-hover: #FFFDF5;
            /* Subtle hover effect */
        }

        /* General Container & Heading */
        .order-container {
            background-color: var(--bg-light);
            padding: 3rem 1.5rem;
        }

        .section-title {
            color: var(--brand-maroon);
            margin-bottom: 2rem;
            border-bottom: 3px solid var(--brand-gold);
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Table Styling */
        .table-order-list {
            margin-bottom: 0;
        }

        .table-order-list thead {
            background-color: var(--brand-maroon);
            color: #fff;
        }

        .table-order-list th {
            font-weight: 700;
            font-size: 0.9rem;
            padding: 1rem 0.75rem;
            white-space: nowrap;
            /* Prevent wrapping in headers */
        }

        .table-order-list td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            font-size: 0.875rem;
            color: var(--text-dark);
        }

        .table-order-list tbody tr:hover {
            background-color: var(--table-hover);
            cursor: default;
        }

        /* --- Badge Styling --- */
        .badge-base {
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
            /* Pill shape for a modern look */
            font-weight: 600;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            white-space: nowrap;
        }

        /* Status Badges */
        .badge-status {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            min-width: 90px;
        }

        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .status-processing {
            background-color: #D4EDDA;
            color: #155724;
        }

        .status-completed {
            background-color: #CCE5FF;
            color: #004085;
        }

        .status-cancelled {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .status-default {
            background-color: #E9ECEF;
            color: var(--text-muted);
        }

        /* Price/Amount Badges (The core requested feature) */
        .badge-price {
            background-color: var(--brand-maroon);
            color: var(--brand-gold);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            /* Slightly squarer look for amounts */
        }

        /* Order Items Detail */
        .item-detail-list {
            padding-left: 15px;
            margin-bottom: 0;
        }

        .item-title {
            font-weight: 600;
            color: var(--brand-maroon);
        }

        .item-meta,
        .instruction-text {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {

            .table-order-list td,
            .table-order-list th {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }

            .badge-base {
                padding: 0.3rem 0.5rem;
            }

            .badge-price {
                font-size: 0.75rem;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
    <div class="container my-5 order-container rounded shadow-lg">
        <h1 class="section-title fw-bold">
            <i class="fa-solid fa-mug-hot me-2"></i> My Recent Orders
        </h1>

        @if ($orders->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle table-order-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th class="d-none d-lg-table-cell">Contact</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-end d-none d-md-table-cell">Delivery Fee</th>
                            <th class="text-end">Total Amount</th>
                            <th class="d-none d-md-table-cell">Instructions</th>
                            <th>Items</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td class="d-none d-lg-table-cell">
                                    <span class="instruction-text">{{ $order->mobile_number }}</span>
                                    <span class="instruction-text">{{ $order->email }}</span>
                                </td>

                                {{-- Applying Price Badge Style --}}
                                <td class="text-end">
                                    <span class="badge-base badge-price">Rs.
                                        {{ number_format($order->subtotal, 2) }}/-</span>
                                </td>
                                <td class="text-end d-none d-md-table-cell">
                                    <span class="badge-base badge-price">Rs.
                                        {{ number_format($order->delivery_fee, 2) }}/-</span>
                                </td>
                                <td class="text-end">
                                    <span class="badge-base badge-price"
                                        style="background-color: var(--brand-gold); color: var(--brand-maroon);">
                                        Rs. {{ number_format($order->total_amount, 2) }}/-
                                    </span>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <span class="instruction-text">{{ $order->special_instructions ?: 'N/A' }}</span>
                                </td>
                                <td>
                                    <ul class="list-unstyled item-detail-list">
                                        @foreach ($order->items as $item)
                                            <li>
                                                <span class="item-title">{{ $item->title }}</span>
                                                @if ($item->size_name)
                                                    <span class="item-meta">Size: {{ $item->size_name }} | Qty:
                                                        {{ $item->quantity }}</span>
                                                @endif
                                                @php
                                                    // Ensure add_ons_details is an array before trying array_column
                                                    $addons = is_array($item->add_ons_details)
                                                        ? array_column($item->add_ons_details, 'title')
                                                        : [];
                                                @endphp
                                                @if (!empty($addons))
                                                    <span class="item-meta">Add-ons: {{ implode(', ', $addons) }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center py-5 border-0 rounded-3 shadow-sm" role="alert">
                <h4 class="alert-heading fw-bold" style="color:var(--brand-maroon);">No Orders Placed Yet</h4>
                <p>Start your delicious journey with Café Chinos by placing your first order!</p>
            </div>
        @endif
    </div>
@endsection
