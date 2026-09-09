@extends('layouts.dashboard')

@section('title','Home')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ $supported_mail }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            {{-- @foreach ($items as $item)
                <li>{{ $item }}</li>
            @endforeach --}}

            @forelse ($items as $item)
                <li>{{ $item }}</li>
            @empty
                <li>Items Is Empty</li>
            @endforelse
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
