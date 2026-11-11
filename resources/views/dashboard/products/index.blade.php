@extends('layouts.dashboard')

@section('title', 'Products')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush


@section('content')

    <x-alert type="success" />
    <x-alert type="error" />

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


                                <div class="d-flex gap-2">
                                    <form action="{{ route('dashboard.products.index') }}" method="GET" class="d-flex gap-2">

                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="form-control" placeholder="Search products...">

                                        <button type="submit" class="btn btn-primary px-4">Search</button>
                                    </form>

                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-success px-4">+ Add</a>
                                </div>

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
                                                    <img src="{{ $product->image_url }}" width="50" height="50"
                                                        class="me-2 rounded" style="object-fit: contain;" alt="{{ $product->name }}">
                                                    {{ $product->name }}
                                                </td>


                                                {{-- Price --}}
                                                <td>
                                                    {{ number_format($product->price, 2) }}
                                                </td>


                                                {{-- Store --}}
                                                <td>
                                                    {{ $stores[$product->store_id] ?? '---' }}
                                                </td>


                                                {{-- Category --}}
                                                <td>
                                                    {{ $categories[$product->category_id] ?? '---' }}
                                                </td>


                                                {{-- Description --}}
                                                <td>
                                                    {{ $product->description ?? '---' }}
                                                </td>


                                                {{-- Actions --}}
                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                        class="btn btn-info px-4">Edit</a>
                                                    <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger px-4">Delete</button>
                                                    </form>
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
