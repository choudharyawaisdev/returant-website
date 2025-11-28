@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>
        </div>
        <div class="row g-4">

            <div class="col-xxl-3 col-lg-3 col-md-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="avatar avatar-md avatar-rounded bg-primary text-white">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div class="ms-3 flex-fill">
                            <p class="text-muted mb-0">Total Customers</p>
                            <h4 class="fw-semibold mt-1">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Menus Card -->
            <div class="col-xxl-3 col-lg-3 col-md-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="avatar avatar-md avatar-rounded bg-success text-white">
                            <i class="fas fa-utensils fa-lg"></i>
                        </div>
                        <div class="ms-3 flex-fill">
                            <p class="text-muted mb-0">Total Menus</p>
                            <h4 class="fw-semibold mt-1">{{ $totalMenus }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories Card -->
            <div class="col-xxl-3 col-lg-3 col-md-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="avatar avatar-md avatar-rounded bg-warning text-white">
                            <i class="fas fa-list fa-lg"></i>
                        </div>
                        <div class="ms-3 flex-fill">
                            <p class="text-muted mb-0">Total Categories</p>
                            <h4 class="fw-semibold mt-1">{{ $totalCategories }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders Card -->
            <div class="col-xxl-3 col-lg-3 col-md-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="avatar avatar-md avatar-rounded bg-danger text-white">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </div>
                        <div class="ms-3 flex-fill">
                            <p class="text-muted mb-0">Total Orders</p>
                            <h4 class="fw-semibold mt-1">{{ $totalOrders }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
