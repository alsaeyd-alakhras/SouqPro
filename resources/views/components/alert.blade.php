@if (session($type))
    <div class="alert alert-{{ $type != 'error' ? $type : 'danger' }}">
        {{ session($type) }}
    </div>
@endif