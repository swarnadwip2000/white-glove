@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Create Offer
@endsection
@push('styles')
@endpush

@section('content')
<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Offers</a></li>
                        <li class="breadcrumb-item active">Create Offer</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Customer</a> --}}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Create Offer</h6>
                        <hr>
                        <div class="card border-0 border-4">
                            <div class="card-body">
                                <form action="{{ route('offers.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="border p-4 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Offer <span style="color: red;">*</span></label>
                                                <input type="text" name="offer" id="" class="form-control" value="{{ old('offer') }}" placeholder="Enter Offer">
                                                @if($errors->has('offer'))
                                                <div class="error" style="color:red;">{{ $errors->first('offer') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Title <span style="color: red;">*</span></label>
                                                <input type="text" name="title" id="" class="form-control" value="{{ old('title') }}" placeholder="Enter Title">
                                                @if($errors->has('title'))
                                                <div class="error" style="color:red;">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Image <span style="color: red;">*</span></label>
                                                <input type="file" name="image" id="" class="form-control" value="{{ old('image') }}">
                                                @if($errors->has('profile_picture'))
                                                <div class="error" style="color:red;">{{ $errors->first('image') }}</div>
                                                @endif
                                            </div>
                                        <div class="row" style="margin-top: 20px; float: left;">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn px-5 submit-btn">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')

@endpush