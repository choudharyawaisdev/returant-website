@extends('admin.layouts.app')

@section('title')
    Edit Menu Item
@endsection

@section('body')
<div class="container-fluid">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-20 mb-0">Edit Menu Item</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body bg-white shadow p-4">
                    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror"
                                    name="category_id" id="category_id" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Title -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    name="price" value="{{ old('price', $menu->price) }}" required min="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount -->
                            <div class="col-md-6 mb-3">
                                <label for="discount" class="form-label">Discount (Optional)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('discount') is-invalid @enderror" id="discount"
                                    name="discount" value="{{ old('discount', $menu->discount) }}" min="0">
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image (Optional)</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <!-- Show existing image if available -->
                                <img id="imagePreview" src="{{ $menu->image ? asset($menu->image) : '#' }}" 
                                    alt="Image Preview" class="mt-2 img-fluid" 
                                    style="display: {{ $menu->image ? 'block' : 'none' }}; max-height:200px;">
                            </div>

                            <!-- Description (full width) -->
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3">{{ old('description', $menu->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Script -->
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } 
    }
</script>
@endsection
