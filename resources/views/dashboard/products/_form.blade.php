<div class="mb-3">
    <x-form.input label="Name" name="name" :value="$product->name" />
</div>

<div class="mb-3">
    <x-form.input type="number" label="Price" name="price" :value="$product->price" min="0" max="999999.99" step="0.01" />
</div>

<div class="mb-3">
    <label for="store_id" class="form-label">Store</label>
    <select name="store_id" id="store_id" class="form-select @error('store_id') is-invalid @enderror">
        <option value="">Select Store</option>
        @foreach ($stores as $store)
            <option value="{{ $store->id }}" @selected(old('store_id', $product->store_id) == $store->id)>
                {{ $store->name }}
            </option>
        @endforeach
    </select>
    @error('store_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">No Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image_path" class="form-label fw-semibold">Product Image</label>

    @if ($product->image_path)
        <div class="border rounded-3 p-3 mb-3 bg-light">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white border rounded-3 p-2 flex-shrink-0">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-2 d-block"
                        style="width: 100px; height: 100px; object-fit: contain;">
                </div>
                <div>
                    <span class="badge bg-success-subtle text-success mb-2">Current Image</span>
                    <p class="text-muted small mb-0">Upload a new image to replace the current one.</p>
                </div>
            </div>
        </div>
    @endif

    <input type="file" name="image_path" id="image_path" accept="image/*"
        class="form-control @error('image_path') is-invalid @enderror">
    @error('image_path')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">Supported formats: JPG, JPEG, PNG or WEBP. Maximum size: 10 MB.</div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        rows="4">{{ old('description', $product->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
