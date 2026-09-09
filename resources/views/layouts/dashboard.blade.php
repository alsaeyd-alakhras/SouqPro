{{-- head --}}
@include('layouts.partials.head',[
    'title' => 'Home',
])
{{-- start::Header --}}
{{-- nav --}}
@include('layouts.partials.nav')
<!--end::Header-->
<!--begin::Sidebar-->
{{-- aside --}}
@include('layouts.partials.aside')

<!--end::Sidebar-->
<!--begin::App Main-->
<main class="app-main">
    {{-- Content --}}
    @yield('content')
</main>
<!--end::App Main-->
<!--begin::Footer-->
{{-- footer --}}
@include('layouts.partials.footer')
