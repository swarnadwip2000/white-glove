@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Edit Home Cms
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Home Cms</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home Cms</a></li>
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
                                <h6 class="mb-0 text-uppercase">Edit Home Cms</h6>
                                <hr>
                                <div class="card border-0 border-4">
                                    <div class="card-body">
                                        <form action="{{ route('home-cms.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                           
                                            @csrf
                                            <div class="border p-4 rounded">
                                                <h3>Banner Section:- </h3> 
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $home['id'] }}">
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Banner Title
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="banner_title" id=""
                                                            class="form-control" value="{{ $home['banner_title'] }}"
                                                            placeholder="Enter Banner Title">
                                                        @if ($errors->has('banner_title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('banner_title') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Banner
                                                            Description<span style="color: red;">*</span></label>
                                                        <textarea name="banner_description" cols="30" rows="10" class="form-control"
                                                            placeholder="Enter Banner Description">{{ $home['banner_description'] }}</textarea>
                                                        @if ($errors->has('banner_description'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('banner_description') }}</div>
                                                        @endif
                                                    </div>
                                                </div>    
                                                <hr>
                                                <label for="inputEnterYourName" class="col-form-label"><h3>Section 2:- </h3></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 2
                                                            Image </label>
                                                        <input type="file" name="section_2_image" class="form-control">
                                                        @if ($errors->has('section_2_image'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_2_image') }}</div>
                                                        @endif
                                                    </div>
                                                    @if ($home['section_2_image'])
                                                        <div class="col-md-6">
                                                            <label for="inputEnterYourName" class="col-form-label">Image
                                                                Preview </label>
                                                            <br>
                                                            <img src="{{ Storage::url($home['section_2_image']) }}"
                                                                alt="" >
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Section 2
                                                            Title<span style="color: red;">*</span></label>
                                                        <input type="text" name="section_2_title" id=""
                                                            class="form-control" value="{{ $home['section_2_title'] }}"
                                                            placeholder="Enter Seection2 Title">
                                                        @if ($errors->has('section_2_title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_2_title') }}</div>
                                                        @endif
                                                    </div>
                                                </div>  
                                                <hr>
                                                <label for="inputEnterYourName" class="col-form-label"><h3>Section 3:- </h3></label>  
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 3
                                                            Image </label>
                                                        <input type="file" name="section_3_image" class="form-control">
                                                        @if ($errors->has('section_3_image'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_3_image') }}</div>
                                                        @endif
                                                    </div>
                                                    @if ($home['section_3_image'])
                                                        <div class="col-md-6">
                                                            <label for="inputEnterYourName" class="col-form-label">Image
                                                                Preview </label>
                                                            <br>
                                                            <img src="{{ Storage::url($home['section_3_image']) }}"
                                                                alt="" >
                                                        </div>
                                                    @endif

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Section 3
                                                            Title<span style="color: red;">*</span></label>
                                                        <input type="text" name="section_3_title" id=""
                                                            class="form-control" value="{{ $home['section_3_title'] }}"
                                                            placeholder="Enter Seection3 Title">
                                                        @if ($errors->has('section_3_title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_3_title') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 3
                                                            Description<span style="color: red;">*</span></label>
                                                        <textarea name="section_3_description" cols="30" rows="10" class="form-control"
                                                            placeholder="Enter section 3 Description">{{ $home['section_3_description'] }}</textarea>
                                                        @if ($errors->has('section_3_description'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_3_description') }}</div>
                                                        @endif
                                                    </div>     
                                                </div>      
                                                    <div class="row" style="margin-top: 20px; float: left;">
                                                        <div class="col-sm-9">
                                                            <button type="submit"
                                                                class="btn px-5 submit-btn">Update</button>
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
