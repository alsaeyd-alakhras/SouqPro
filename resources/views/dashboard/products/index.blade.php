@extends('layouts.dashboard')

@section('title', 'Products')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush


@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Products</h3>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            Products
                        </li>
                    </ol>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content Header-->


    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="card mb-4">

                        {{-- Card Header --}}
                        <div class="card-header bg-white py-3">

                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                                <h5 class="card-title mb-0 fw-semibold">
                                    Products Table
                                </h5>


                                {{-- Search --}}
                                <form action="{{ route('dashboard.products.index') }}" method="GET" class="d-flex gap-2">

                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search products...">

                                    <button type="submit" class="btn btn-primary px-4">
                                        Search
                                    </button>

                                </form>

                            </div>

                        </div>


                        {{-- Card Body --}}
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-hover">

                                    <thead>
                                        <tr>
                                            <th style="width: 60px">#</th>

                                            <th>
                                                Name
                                            </th>

                                            <th>
                                                Price
                                            </th>

                                            <th>
                                                Store
                                            </th>

                                            <th>
                                                Category
                                            </th>

                                            <th>
                                                Description
                                            </th>

                                            <th style="width: 120px">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @forelse ($products as $product)
                                            <tr class="align-middle">

                                                {{-- ID --}}
                                                <td>
                                                    {{ $product->id }}
                                                </td>


                                                {{-- Name --}}
                                                <td>
                                                    {{ $product->name }}
                                                </td>


                                                {{-- Price --}}
                                                <td>
                                                    {{ number_format($product->price, 2) }}
                                                </td>


                                                {{-- Store --}}
                                                <td>
                                                    {{ $product->store?->name ?? '---' }}
                                                </td>


                                                {{-- Category --}}
                                                <td>
                                                    {{ $product->category?->name ?? '---' }}
                                                </td>


                                                {{-- Description --}}
                                                <td>
                                                    {{ $product->description ?? '---' }}
                                                </td>


                                                {{-- Actions --}}
                                                <td>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    No products found
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        {{-- Pagination --}}
                        @if ($products->hasPages())
                            <div class="card-footer clearfix">
                                <div class="float-end">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

@endsection
