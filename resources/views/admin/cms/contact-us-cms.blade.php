@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Edit Contact-us Cms
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Contact-us Cms</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Contact-us Cms</a></li>
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
                                <h6 class="mb-0 text-uppercase">Edit Contact-us Cms</h6>
                                <hr>
                                <div class="card border-0 border-4">
                                    <div class="card-body">
                                        <form action="{{ route('contact-us-cms.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                           
                                            @csrf
                                            <div class="border p-4 rounded">
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $contactUs['id'] }}">
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Title
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="title" id=""
                                                            class="form-control" value="{{ $contactUs['title'] }}"
                                                            placeholder="Enter Title">
                                                        @if ($errors->has('title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('title') }}</div>
                                                        @endif
                                                    </div>   
                                                
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> 
                                                            Description<span style="color: red;">*</span></label>
                                                        <textarea name="description"  class="form-control"
                                                            placeholder="Enter section 1 Description">{{ $contactUs['description'] }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('description') }}</div>
                                                        @endif
                                                    </div>                                                  
                                                                                                            
                                                    
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Visit Us
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="visit_us" id=""
                                                            class="form-control" value="{{ $contactUs['visit_us'] }}"
                                                            placeholder="Enter Address">
                                                        @if ($errors->has('visit_us'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('visit_us') }}</div>
                                                        @endif
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Call Us
                                                            Title<span style="color: red;">*</span></label>
                                                        <input type="text" name="call_us" id=""
                                                            class="form-control" value="{{ $contactUs['call_us'] }}"
                                                            placeholder="Enter Number">
                                                        @if ($errors->has('call_us'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('call_us') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Mail Us
                                                            Title<span style="color: red;">*</span></label>
                                                        <input type="text" name="mail_us" id=""
                                                            class="form-control" value="{{ $contactUs['mail_us'] }}"
                                                            placeholder="Enter Mail">
                                                        @if ($errors->has('mail_us'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('mail_us') }}</div>
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
