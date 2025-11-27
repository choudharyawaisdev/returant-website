@extends('layouts.app')
@section('title', 'Café Chinos - Orders')
@section('body')
    <style>
        /* Table general styling */
        .table thead {
            background-color: #A9262B;
            color: #fff;
            font-weight: 600;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f1f0;
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 0.75rem;
            font-size: 0.95rem;
            color: #1A1A1A;
        }

        /* Badge colors */
        .badge-warning {
            background-color: #FFC107;
            color: #1A1A1A;
        }

        .badge-success {
            background-color: #28A745;
        }

        .badge-danger {
            background-color: #DC3545;
        }

        .badge-primary {
            background-color: #007BFF;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        /* Price tags */
        .price-tag {
            display: inline-block;
            background-color: #A9262B;
            color: #FFC000;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Add-ons and instructions */
        .text-muted {
            font-size: 0.85rem;
        }

        /* Responsive table */
        @media (max-width: 991px) {
            .table thead {
                font-size: 0.85rem;
            }

            .table td,
            .table th {
                font-size: 0.85rem;
            }
        }
    </style>
    <div class="container my-5">
        <h1 class="section-title mb-4 fw-bold" style="color:#A9262B;">My Orders</h1>
        @if ($orders->count())
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Subtotal</th>
                            <th>Delivery Fee</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Special Instructions</th>
                            <th>Items</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->mobile_number }}</td>
                                <td>{{ $order->email }}</td>
                                <td><span class="price-tag">Rs. {{ number_format($order->subtotal, 2) }}/-</span></td>
                                <td><span class="price-tag">Rs. {{ number_format($order->delivery_fee, 2) }}/-</span></td>
                                <td><span class="price-tag">Rs. {{ number_format($order->total_amount, 2) }}/-</span></td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                            'processing' => 'primary',
                                        ];
                                    @endphp
                                    <span class="badge badge-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $order->special_instructions ?? '-' }}</small>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($order->items as $item)
                                            <li>
                                                <strong>{{ $item->title }}</strong>
                                                @if ($item->size_name)
                                                    ({{ $item->size_name }})
                                                @endif
                                                x {{ $item->quantity }}
                                                <br>
                                                @php
                                                    $addons = is_array($item->add_ons_details)
                                                        ? array_column($item->add_ons_details, 'title')
                                                        : [];
                                                @endphp
                                                @if (count($addons))
                                                    <small class="text-muted">Add-ons: {{ implode(', ', $addons) }}</small>
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
            <div class="alert alert-info text-center">
                Your wishlist is empty.
            </div>
        @endif
    </div>
@endsection
