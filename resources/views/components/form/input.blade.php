@props([
    'type' => 'text',
    'label' => null,
    'name',
    'id' => $name,
    'value' => null,
])


@if ($label)
    <label for="{{ $id }}" class="form-label">
        {{ $label }}
    </label>
@endif

<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
    {{ $attributes->merge([
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : ''),
    ]) }} />

@error($name)
    <div class="invalid-feedback">
        {{ $message  }}
    </div>
@enderror

