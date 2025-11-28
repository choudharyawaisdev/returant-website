@extends('admin.layouts.app')

@section('title')
    Orders Index
@endsection

@section('body')
<div class="container-fluid">
    <!-- PAGE HEADER -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>
    </div>

    <!-- TABLE -->
    <div class="col-xl-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title">All Orders</h6>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="example" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Delivery Address</th>
                                <th>Special Instructions</th>
                                <th>Subtotal</th>
                                <th>Delivery Fee</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->mobile_number }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td>{{ $order->special_instructions ?? 'N/A' }}</td>
                                <td>{{ $order->subtotal ?? '0' }}</td>
                                <td>{{ $order->delivery_fee ?? '0' }}</td>
                                <td>{{ $order->total_amount ?? '0' }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Qty</th>
                                                <th>Unit Price</th>
                                                <th>Total Price</th>
                                                <th>Size</th>
                                                <th>Add-Ons</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->unit_price }}</td>
                                                <td>{{ $item->total_price }}</td>
                                                <td>{{ $item->size_name ?? 'N/A' }}</td>
                                                <td>{{ !empty($item->add_ons_details) ? json_encode($item->add_ons_details) : 'N/A' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
