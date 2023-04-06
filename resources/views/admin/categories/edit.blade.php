@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Edit Category Details
@endsection
@push('styles')
@endpush

@section('content')
<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Edit Category Details</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Category</a> --}}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Edit A Category</h6>
                        <hr>
                        <div class="card border-0 border-4">
                            <div class="card-body">
                                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="border p-4 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Name <span style="color: red;">*</span></label>
                                                <input type="text" name="name" id="" class="form-control" value="{{ $category['name'] }}" placeholder="Enter Category Name">
                                                @if($errors->has('name'))
                                                <div class="error" style="color:red;">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Slug <span style="color: red;">*</span></label>
                                                @if($category['main'] == 1)
                                                <input type="text" name="slug" id="" class="form-control" value="{{ $category['slug'] }}" placeholder="Slug" >
                                                @else
                                                <input type="text" name="slug" id="" class="form-control" value="{{ $category['slug'] }}" placeholder="Slug" >
                                                @endif
                                                @if($errors->has('slug'))
                                                <div class="error" style="color:red;">{{ $errors->first('slug') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Meta Title <span style="color: red;">*</span></label>
                                                <input type="text" name="meta_title" id="" class="form-control" value="{{ $category['meta_title'] }}" placeholder="Enter Meta Title">
                                                @if($errors->has('meta_title'))
                                                <div class="error" style="color:red;">{{ $errors->first('meta_title') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Meta Description </label>
                                               <textarea name="meta_description" id="" cols="30" rows="10" class="form-control">{{ $category['meta_description'] }}</textarea>
                                               @if($errors->has('meta_description'))
                                               <div class="error" style="color:red;">{{ $errors->first('meta_description') }}</div>
                                               @endif
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Status <span style="color: red;">*</span></label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="">Select a Status</option>
                                                    <option value="1" @if($category['status'] == 1) selected="" @endif>Active</option>
                                                    <option value="0" @if($category['status'] == 0) selected="" @endif>Inactive</option>
                                                </select>
                                                @if($errors->has('status'))
                                                <div class="error" style="color:red;">{{ $errors->first('status') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Image </label>
                                                <input type="file" name="image" id="" class="form-control" value="{{ $category['image'] }}">
                                                @if($errors->has('image'))
                                                <div class="error" style="color:red;">{{ $errors->first('image') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6"></div>
                                            @if($category['image'])
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label">View Profile Picture </label>
                                                <br>
                                               <img src="{{ Storage::url($category['image']) }}" alt="" class="img-design">
                                            </div>
                                            @endif
                                        <div class="row" style="margin-top: 20px; float: left;">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn px-5 submit-btn">Update</button>
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