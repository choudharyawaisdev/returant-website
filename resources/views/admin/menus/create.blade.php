@extends('admin.layouts.app')

@section('title')
    Create Menu Item
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-20 mb-0">Create Menu Item</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body bg-white shadow p-4">
                        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
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
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="single_price" class="form-label">Single Price (No Type/Size)</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('single_price') is-invalid @enderror" id="single_price"
                                        name="single_price" value="{{ old('single_price') }}" min="0"
                                        placeholder="Optional price if no size is needed">
                                    @error('single_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Use this field OR the Type/Price rows below, not
                                        both.</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label d-block">Price Options (Size/Type & Price)</label>
                                    <div id="typePriceContainer">
                                    </div>
                                    <button type="button" id="addRowBtn" class="btn btn-sm btn-outline-secondary mt-2">Add
                                        Price/Type</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="discount" class="form-label">Discount (Optional)</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        name="discount" value="{{ old('discount') ?? 0 }}" min="0">
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
                                    <img id="imagePreview" src="#" alt="Image Preview" class="mt-2 img-fluid"
                                        style="display:none; max-height:200px;">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Menu</button>
                        </form>

                        <script>
                            const categoryTypes = {
                                'Pizza': ['Personal', 'Small Pizza', 'Medium Pizza', 'Large Pizza', 'XL Pizza', 'Cheese Burst',
                                    'Stuffed Crust'
                                ],
                                'Burger': ['Single', 'Double', 'Triple', 'Zinger', 'Grilled Beef', 'Crispy Chicken', 'Beef Patty',
                                    'Chicken Patty', 'Cheese', 'Grilled Cheese'
                                ],
                                'Drinks': ['Small', 'Regular', 'Large', 'XL', 'Jumbo'],
                                'Fries': ['Fries Small', 'Fries Large', 'Masala Fries', 'Loaded Fries'],
                                'Platter': ['Single', 'Double', 'Half', 'Large'],
                                'Wings': ['4 Pcs Wings', '6 Pcs Wings', '8 Pcs Wings', 'Spicy Wings', 'Crispy Wings'],
                                'Pasta': ['Pasta Small', 'Pasta Large', 'Creamy Pasta', 'Cheese Pasta', 'Chicken Pasta'],
                                'Sandwich': ['Sandwich Small', 'Sandwich Large', 'Grilled Sandwich', 'Chicken Sandwich', 'Beef Sandwich',
                                    'Club Sandwich'
                                ],
                                'Rolls': ['Chicken Roll', 'Beef Roll', 'Zinger Roll', 'Crispy Roll', 'Mayo Garlic Roll'],
                                'Nuggets & Shots': ['4 Pcs', '6 Pcs', '12 Pcs']
                            };

                            const categorySelect = document.getElementById('category_id');
                            const typePriceContainer = document.getElementById('typePriceContainer');
                            const addRowBtn = document.getElementById('addRowBtn');

                            let rowCounter = 0;

                            function createTypeSelectHtml(options, selectedValue = '') {
                                let html = '<select class="form-control mb-1 type-select" name="type[]">';
                                html += '<option value="">-- Select Type --</option>';
                                options.forEach(option => {
                                    const selected = option === selectedValue ? 'selected' : '';
                                    html += `<option value="${option}" ${selected}>${option}</option>`;
                                });
                                html += '</select>';
                                return html;
                            }

                            function addTypePriceRow(typeValue = '', priceValue = '', isDefault = false) {
                                const selectedText = categorySelect.options[categorySelect.selectedIndex].text;
                                const typeOptions = categoryTypes[selectedText] || [];

                                const row = document.createElement('div');
                                row.classList.add('row', 'mb-2', 'align-items-end', 'type-price-row');

                                const removeButtonHtml = isDefault ?
                                    '' // No remove button for default row
                                    :
                                    '<button type="button" class="btn btn-danger btn-sm remove-row-btn">Remove</button>';

                                // Use name="type[]" and name="price[]" for array submission
                                row.innerHTML = `
            <div class="col-5">
                ${createTypeSelectHtml(typeOptions, typeValue)}
            </div>
            <div class="col-5">
                <input type="number" step="0.01" placeholder="Price" class="form-control mb-1" name="price[]" value="${priceValue}" min="0">
            </div>
            <div class="col-2">
                ${removeButtonHtml}
            </div>
        `;

                                if (!isDefault) {
                                    row.querySelector('.remove-row-btn').addEventListener('click', () => {
                                        row.remove();
                                    });
                                }

                                typePriceContainer.appendChild(row);
                                rowCounter++;
                            }

                            function handleCategoryChange() {
                                typePriceContainer.innerHTML = '';
                                const selectedText = categorySelect.options[categorySelect.selectedIndex].text;

                                // Show the default row only if a category that needs sizing is selected
                                if (categoryTypes[selectedText]) {
                                    // Add the default row (isDefault = true)
                                    addTypePriceRow('{{ old('type.0') }}', '{{ old('price.0') }}', true);

                                    // If there are more old inputs (for validation error display), add them with remove buttons
                                    const oldTypes = {!! json_encode(old('type') ?: []) !!};
                                    const oldPrices = {!! json_encode(old('price') ?: []) !!};

                                    if (oldTypes.length > 1) {
                                        for (let i = 1; i < oldTypes.length; i++) {
                                            addTypePriceRow(oldTypes[i], oldPrices[i] || '');
                                        }
                                    }
                                }
                            }

                            // Event Listeners
                            categorySelect.addEventListener('change', handleCategoryChange);

                            // Add new row button
                            addRowBtn.addEventListener('click', () => {
                                const selectedText = categorySelect.options[categorySelect.selectedIndex].text;
                                if (categoryTypes[selectedText]) {
                                    // Add a new removable row (isDefault = false)
                                    addTypePriceRow('', '', false);
                                } else {
                                    alert('Please select a Category first to add size/type options.');
                                }
                            });

                            // Run on page load to handle validation errors and old input
                            if (categorySelect.value) {
                                handleCategoryChange();
                            }

                            // Image Preview Script
                            function previewImage(event) {
                                const reader = new FileReader();
                                reader.onload = function() {
                                    const output = document.getElementById('imagePreview');
                                    output.src = reader.result;
                                    output.style.display = 'block';
                                }
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>
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
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
