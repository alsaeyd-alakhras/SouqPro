<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ old('name',$category->name) }}" />
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" aria-label="With textarea">{{ old('description',$category->description) }}</textarea>
</div>
<div class="mb-3 form-check">
    <input type="checkbox" name="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="form-check-input" id="is_active" />
    <label class="form-check-label" for="is_active">Active</label>
</div>
