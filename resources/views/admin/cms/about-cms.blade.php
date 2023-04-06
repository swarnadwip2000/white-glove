@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Edit About Cms
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">About Cms</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">About Cms</a></li>
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
                                <h6 class="mb-0 text-uppercase">Edit About Cms</h6>
                                <hr>
                                <div class="card border-0 border-4">
                                    <div class="card-body">
                                        <form action="{{ route('about-cms.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                           
                                            @csrf
                                            <div class="border p-4 rounded">
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $about['id'] }}">
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Banner Name
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="banner_name" id=""
                                                            class="form-control" value="{{ $about['banner_name'] }}"
                                                            placeholder="Enter Banner Name">
                                                        @if ($errors->has('banner_name'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('banner_name') }}</div>
                                                        @endif
                                                    </div>
                                                </div>    
                                                <hr>
                                                <label for="inputEnterYourName" class="col-form-label"><h3>Section 1:- </h3></label>  
                                                <div class="row">  
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 1
                                                            Image </label>
                                                        <input type="file" name="section_1_img" class="form-control">
                                                        @if ($errors->has('section_1_img'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_1_img') }}</div>
                                                        @endif
                                                    </div>
                                                    @if ($about['section_1_img'])
                                                        <div class="col-md-6">
                                                            <label for="inputEnterYourName" class="col-form-label">Image
                                                                Preview </label>
                                                            <br>
                                                            <img src="{{ Storage::url($about['section_1_img']) }}"
                                                                alt="" >
                                                        </div>
                                                    @endif

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 1 name
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="section_1_name" id=""
                                                            class="form-control" value="{{ $about['section_1_name'] }}"
                                                            placeholder="Enter Section 1 Name">
                                                        @if ($errors->has('section_1_name'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_1_name') }}</div>
                                                        @endif
                                                        
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 1 title
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="section_1_title" id=""
                                                            class="form-control" value="{{ $about['section_1_title'] }}"
                                                            placeholder="Enter Section 1 Title">
                                                        @if ($errors->has('section_1_title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_1_title') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 1
                                                            Description<span style="color: red;">*</span></label>
                                                        <textarea name="section_1_description" cols="30" rows="10" class="form-control"
                                                            placeholder="Enter section 1 Description">{{ $about['section_1_description'] }}</textarea>
                                                        @if ($errors->has('section_1_description'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_1_description') }}</div>
                                                        @endif
                                                    </div>                                                  
                                                </div>
                                                <hr>
                                                <label for="inputEnterYourName" class="col-form-label"><h3>Section 2:- </h3></label>                                                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 2
                                                            Banner </label>
                                                        <input type="file" name="section_2_banner" class="form-control">
                                                        @if ($errors->has('section_2_banner'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_2_banner') }}</div>
                                                        @endif
                                                    </div>
                                                    @if ($about['section_2_banner'])
                                                        <div class="col-md-6">
                                                            <label for="inputEnterYourName" class="col-form-label">Image
                                                                Preview </label>
                                                            <br>
                                                            <img src="{{ Storage::url($about['section_2_banner']) }}"
                                                                alt="" >
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Section 2
                                                            Title<span style="color: red;">*</span></label>
                                                        <input type="text" name="section_2_title" id=""
                                                            class="form-control" value="{{ $about['section_2_title'] }}"
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
                                                        <input type="file" name="section_3_img" class="form-control">
                                                        @if ($errors->has('section_3_img'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_3_img') }}</div>
                                                        @endif
                                                    </div>
                                                    @if ($about['section_3_img'])
                                                        <div class="col-md-6">
                                                            <label for="inputEnterYourName" class="col-form-label">Image
                                                                Preview </label>
                                                            <br>
                                                            <img src="{{ Storage::url($about['section_3_img']) }}"
                                                                alt="" >
                                                        </div>
                                                    @endif

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Section 3
                                                            Name<span style="color: red;">*</span></label>
                                                        <input type="text" name="section_3_name" id=""
                                                            class="form-control" value="{{ $about['section_3_name'] }}"
                                                            placeholder="Enter Seection3 Title">
                                                        @if ($errors->has('section_3_name'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_3_name') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Section 3
                                                            Title<span style="color: red;">*</span></label>
                                                        <input type="text" name="section_3_title" id=""
                                                            class="form-control" value="{{ $about['section_3_title'] }}"
                                                            placeholder="Enter Seection3 Title">
                                                        @if ($errors->has('section_3_title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('section_3_title') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputEnterYourName" class="col-form-label"> Section 3
                                                            Description<span style="color: red;">*</span></label>
                                                        <textarea name="section_3_description" cols="30" rows="12" class="form-control"
                                                            placeholder="Enter section 3 Description">{{ $about['section_3_description'] }}</textarea>
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
