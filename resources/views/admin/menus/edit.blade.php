@extends('admin.layouts.app')

@section('title')
    Edit Menu Item - {{ $menu->title }}
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-20 mb-0">Edit Menu Item</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Menu Items</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body bg-white shadow p-4">
                        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}
                                                data-title="{{ $category->title }}">
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Single Price (No Type/Size)</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('single_price') is-invalid @enderror"
                                        id="single_price"
                                        name="single_price"
                                        value="{{ old('single_price', is_array($menu->price) ? '' : $menu->price) }}"
                                        min="0" placeholder="Optional if no sizes">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Use this OR Type/Price rows below</small>
                                </div>

                                <div class="col-6 mb-3">
                                    <label class="form-label">Add Ons (Optional)</label>
                                    <div
                                        style="max-height:250px; overflow-y:auto; border:1px solid #ddd; padding:10px; border-radius:5px;">
                                        @foreach ($addons as $addon)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="addons[]"
                                                    value="{{ $addon->id }}" id="addon{{ $addon->id }}"
                                                    {{ (old('addons') ? in_array($addon->id, old('addons')) : $menu->addons->contains($addon->id)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="addon{{ $addon->id }}">
                                                    {{ $addon->name }} - {{ number_format($addon->price, 2) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label d-block">Price Options (Size/Type & Price)</label>
                                    <div id="typePriceContainer"></div>
                                    <button type="button" id="addRowBtn" class="btn btn-sm btn-outline-secondary mt-2">
                                        Add Price/Type
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="discount" class="form-label">Discount (Optional)</label>
                                   <input 
                                    type="number" 
                                    step="0.01"
                                    class="form-control @error('single_price') is-invalid @enderror" 
                                    id="single_price"
                                    name="single_price"
                                    value="{{ old('single_price', $menu->price) }}"
                                    min="0"
                                    placeholder="Optional if no sizes">

                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Image (Optional)</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if ($menu->image)
                                        <div class="mt-3">
                                            <p><strong>Current Image:</strong></p>
                                            <img src="{{ asset($menu->image) }}" alt="Current" class="img-fluid"
                                                style="max-height:200px;">
                                        </div>
                                    @endif

                                    <img id="imagePreview" src="#" alt="Preview" class="mt-2 img-fluid"
                                        style="display:none; max-height:10px;">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description', $menu->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Update Menu Item</button>
                                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       const categoryTypes = {
            'Pizza': ['Personal', 'Small Pizza', 'Medium Pizza', 'Large Pizza', 'XL Pizza', 'XXL Pizza', 'Family Pizza'],
            'Burger': ['Single', 'Double', 'Triple', 'Zinger'],
            'Drinks': ['Small', 'Regular', 'Large', 'XL'],
            'Fries': ['Fries Small', 'Fries Large', 'Mayo Fries', 'Masala Fries', 'Loaded Fries', 'Pizza Fries Small', 'Pizza Fries Large', 'Cheese Fries'],
            'Platter': ['Single', 'Double', 'Half', 'Large', 'Special Platter'],
            'Wings': ['4 Pcs Wings', '6 Pcs Wings', '8 Pcs Wings', '10 Pcs Wings', '12 Pcs Wings', '15 Pcs Wings', 'Hot Wings', 'Oven Baked Wings', 'Bar-B-Q Wings'],
            'Pasta': ['Pasta Small', 'Pasta Large', 'Chef Special Pasta', 'Creamy Chicken Pasta', 'Lagana Pasta'],
            'Sandwich': ['Sandwich Small', 'Sandwich Large', 'Special Sandwich', 'Mexican Sandwich', 'Jalapeno Sandwich', 'Crispy Sandwich'],
            'Rolls': ['Chicken Roll', 'Beef Roll', '4 Chicken Spin Rolls', '4 Behari Rolls', 'Tikka Paratha Rolls', 'Chapli Kabab Paratha', 'Crunchy Paratha Roll'],
            'Nuggets & Shots': ['4 Pcs', '5 Pcs', '6 Pcs', '7 Pcs', '12 Pcs', '15 Pcs', 'Hot Shot'],
        };

        const categorySelect = document.getElementById('category_id');
        const typePriceContainer = document.getElementById('typePriceContainer');
        const addRowBtn = document.getElementById('addRowBtn');

        // Existing sizes from DB
        const existingSizes = @json($menu->sizes);

        function createTypeSelect(options, selected = '') {
            let html = '<select class="form-control mb-1" name="type[]"><option value="">-- Select Type --</option>';
            options.forEach(opt => {
                html += `<option value="${opt}" ${opt === selected ? 'selected' : ''}>${opt}</option>`;
            });
            html += '</select>';
            return html;
        }

        function addRow(type = '', price = '') {
            const catText = categorySelect.options[categorySelect.selectedIndex]?.text || '';
            const options = categoryTypes[catText] || [];

            const row = document.createElement('div');
            row.className = 'row mb-2 align-items-end type-price-row';
            row.innerHTML = `
            <div class="col-5">${createTypeSelect(options, type)}</div>
            <div class="col-5"><input type="number" step="0.01" class="form-control" name="price[]" value="${price}" min="0"></div>
            <div class="col-2"><button type="button" class="btn btn-danger btn-sm remove-row-btn">Remove</button></div>
        `;
            row.querySelector('.remove-row-btn')?.addEventListener('click', () => row.remove());
            typePriceContainer.appendChild(row);
        }

        function loadExistingRows() {
            typePriceContainer.innerHTML = '';
            if (existingSizes.length > 0) {
                existingSizes.forEach(s => addRow(s.name, s.price));
            } else if (categoryTypes[categorySelect.options[categorySelect.selectedIndex]?.text]) {
                addRow();
            }
        }

        categorySelect.addEventListener('change', loadExistingRows);
        addRowBtn.addEventListener('click', () => {
            const cat = categorySelect.options[categorySelect.selectedIndex]?.text;
            if (categoryTypes[cat]) addRow();
            else alert('Select a category first');
        });

        // Load on page ready
        window.addEventListener('DOMContentLoaded', () => {
            loadExistingRows();
        });

        function previewImage(e) {
            const preview = document.getElementById('imagePreview');
            if (e.target.files[0]) {
                preview.src = URL.createObjectURL(e.target.files[0]);
                preview.style.display = 'block';
            }
        }
    </script>
@endsection
