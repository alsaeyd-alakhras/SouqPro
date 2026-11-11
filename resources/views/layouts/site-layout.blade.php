{{-- head --}}
@include('layouts.partials.site.head')
{{-- header --}}
@include('layouts.partials.site.header')

{{-- content --}}
{{ $slot }}

{{-- footer --}}
@include('layouts.partials.site.footer')
