@extends('layouts.app')
@section('title', 'My Wishlist')
@section('body')
<style>
    /* Card Styling */
    .wishlist-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .wishlist-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Wishlist Button */
    .wishlist-btn {
        transition: transform 0.2s ease;
    }

    .wishlist-btn:hover {
        transform: scale(1.2);
    }

    .price-tag {
        background-color: #A9262B;
        color: #FFC000;
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1A1A1A;
    }

    .card-text {
        font-size: 0.875rem;
        color: #6b6b6b;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1A1A1A;
        text-align: center;
        margin-bottom: 2rem;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="container my-5">
    <h2 class="section-title">My Wishlist</h2>

    <div class="row g-4">
        @forelse ($wishlists as $wishlist)
            @if ($wishlist->menu)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card wishlist-card shadow-sm p-0">
                        {{-- Wishlist remove button --}}
                        <div class="position-absolute top-0 end-0 m-2 z-index-2">
                            <button class="btn btn-light rounded-circle shadow wishlist-btn"
                                data-id="{{ $wishlist->menu->id }}">
                                <i class="fa-solid text-danger fa-heart fs-5"></i>
                            </button>
                        </div>

                        {{-- Menu Image --}}
                        <img src="{{ $wishlist->menu->image }}" class="card-img-top"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $wishlist->menu->title }}</h5>
                            <p class="card-text">{{ $wishlist->menu->description }}</p>
                            <span class="price-tag">Rs. {{ $wishlist->menu->price }}/-</span>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Your wishlist is empty.</p>
            </div>
        @endforelse
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.wishlist-btn', function(e) {
    e.preventDefault();
    let btn = $(this);
    let menuId = btn.data('id');

    $.ajax({
        url: "{{ route('wishlist.toggle') }}",
        type: "POST",
        data: {
            menu_id: menuId,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            if (response.status === 'removed') {
                btn.closest('.col-12').remove();
            }
        }
    });
});
</script>
@endsection
