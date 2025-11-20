@extends('admin.layouts.app')

@section('title')
    Products Index
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products Index</li>
                </ol>
            </nav>
        </div>

        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header justify-content-between align-items-center">
                    <div class="card-title">All Products List</div>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Action</th> <!-- Added Action column -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($menu->image)
                                                <img src="{{ asset($menu->image) }}" alt="{{ $menu->title }}"
                                                    style="height:50px; width:auto;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $menu->title }}</td>
                                        <td>{{ $menu->category?->title ?? 'N/A' }}</td>
                                        <td>{{ $menu->description }}</td>
                                        <td>{{ number_format($menu->price, 2) }}</td>
                                        <td>{{ number_format($menu->discount, 2) }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="fa fa-pen-to-square"></i> Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this menu item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mb-1">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No menu items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
