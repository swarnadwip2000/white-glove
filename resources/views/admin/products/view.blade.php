@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | View Products Details
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">View</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">View Products Details</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Products Details</a> --}}
                    </div>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                @if ($product['id'])
                                    <div class="profile-img-wrap">
                                        <div class="profile-img">
                                            <a href="{{ Storage::url($product['image']) }}">
                                                <img
                                                    src="{{ Storage::url($product['image']) }}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $product['name'] }}</h3>
                                                <h6 class="text-muted">Category : {{ $product['category']['name'] }}</h6>
                                                <div class="small doj text-muted">Created At :
                                                    {{ date('d M, Y', strtotime($product['created_at'])) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Price:</div>
                                                    <div class="text">
                                                        ${{ $product['price'] }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Quantity:</div>
                                                    <div class="text">
                                                        {{ $product['quantity'] }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Discount:</div>
                                                    <div class="text">
                                                        {{ $product['discount'] }}%
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <div class="title">Meta Title:</div>
                                                    <div class="text">
                                                        {{ $product['meta_title'] }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Meta Description:</div>
                                                    <div class="text">
                                                        {{ $product['meta_description'] }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Featured Product:</div>
                                                    <div class="text">
                                                        @if ($product['feature_product'] == 1)
                                                            <span class="badge bg-success-light">Yes</span>
                                                        @else
                                                            <span class="badge bg-danger-light">No</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Status:</div>
                                                    <div class="text">
                                                        @if ($product['status'] == 1)
                                                            <span class="badge bg-success-light">Active</span>
                                                        @else
                                                            <span class="badge bg-danger-light">Inactive</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><u>Product Specification </u>:-</h3>
                                {!! $product['specification'] !!}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        @endsection

        @push('scripts')
        @endpush
