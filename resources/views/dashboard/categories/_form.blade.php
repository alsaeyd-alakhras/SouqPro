<div class="mb-3">
    {{-- <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $category->name) }}" /> --}}
    <x-form.input label="Name" name="name" :value="$category->name" class="text-red" aria-label="With textarea" />
</div>

<div class="mb-3">
    <label for="image_path" class="form-label fw-semibold">
        Category Image
    </label>

    @if ($category->image_path)
        <div class="border rounded-3 p-3 mb-3 bg-light">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white border rounded-3 p-2 flex-shrink-0">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                        class="rounded-2 d-block" style="width: 100px; height: 100px; object-fit: contain;">
                </div>

                <div>
                    <span class="badge bg-success-subtle text-success mb-2">
                        Current Image
                    </span>
                    <p class="text-muted small mb-0">
                        Upload a new image to replace the current one.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <input type="file" name="image_path" id="image_path" accept="image/*"
        class="form-control @error('image_path') is-invalid @enderror">

    @error('image_path')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <div class="form-text">
        Supported formats: JPG, JPEG, PNG or image.
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" aria-label="With textarea">{{ old('description', $category->description) }}</textarea>
</div>
<div class="mb-3 form-check">
    <input type="checkbox" name="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
        class="form-check-input" id="is_active" />
    <label class="form-check-label" for="is_active">Active</label>
</div>
