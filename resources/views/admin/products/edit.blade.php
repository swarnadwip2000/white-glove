@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Edit Product Details
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
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Edit Product Details</li>
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
                        <h6 class="mb-0 text-uppercase">Edit A Product</h6>
                        <hr>
                        <div class="card border-0 border-4">
                            <div class="card-body">
                                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="border p-4 rounded">
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Select a Category <span style="color: red;">*</span></label>
                                                <select name="category_id" id="" class="form-control select2">
                                                    <option value="">Select a Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('category_id'))
                                                <div class="error" style="color:red;">{{ $errors->first('category_id') }}</div>
                                                @endif
                                            </div>

                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Name <span style="color: red;">*</span></label>
                                                <input type="text" name="name" id="" class="form-control" value="{{ $product->name}}" placeholder="Enter Product Name">
                                                @if($errors->has('name'))
                                                <div class="error" style="color:red;">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Slug <span style="color: red;">*</span></label>
                                                <input type="text" name="slug"  class="form-control" value="{{ $product->slug}}" placeholder="Enter Product Slug">
                                                @if($errors->has('slug'))
                                                <div class="error" style="color:red;">{{ $errors->first('slug') }}</div>
                                                @endif
                                            </div>

                                            
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Description <span style="color: red;">*</span> </label>
                                               <textarea  cols="30" name="description" rows="10"  class="form-control" placeholder="Write desctiption......">{{ $product->description}}</textarea>
                                               @if($errors->has('description'))
                                                <div class="error" style="color:red;">{{ $errors->first('description') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Price($) <span style="color: red;">*</span></label>
                                                <input type="text" name="price" class="form-control" value="{{ $product->price}}" placeholder="Enter Product Price">
                                                @if($errors->has('price'))
                                                <div class="error" style="color:red;">{{ $errors->first('price') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Discount(%) <span style="color: red;">*</span></label>
                                                <input type="text" name="discount"  class="form-control" value="{{ $product->discount}}" placeholder="Enter Product Discount">
                                                @if($errors->has('discount'))
                                                <div class="error" style="color:red;">{{ $errors->first('discount') }}</div>
                                                @endif
                                            </div>


                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Quantity <span style="color: red;">*</span></label>
                                                <input type="text" name="quantity"  class="form-control" value="{{ $product->quantity}}" placeholder="Enter Product Quantity">
                                                @if($errors->has('quantity'))
                                                <div class="error" style="color:red;">{{ $errors->first('quantity') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Meta Title <span style="color: red;">*</span></label>
                                                <input type="text" name="meta_title" id="" class="form-control" value="{{ $product->meta_title }}" placeholder="Enter Meta Title">
                                                @if($errors->has('meta_title'))
                                                <div class="error" style="color:red;">{{ $errors->first('meta_title') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Meta Description <span style="color: red;">*</span></label>
                                               <textarea name="meta_description" id="" cols="30" rows="10" class="form-control">{{ $product->meta_description }}</textarea>
                                               @if($errors->has('meta_description'))
                                               <div class="error" style="color:red;">{{ $errors->first('meta_description') }}</div>
                                               @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label">Select a Status <span style="color: red;">*</span></label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="1" @if($product->status == 1) selected @endif>Active</option>
                                                    <option value="0" @if($product->status == 0) selected @endif>Inactive</option>
                                                </select>
                                               @if($errors->has('status'))
                                               <div class="error" style="color:red;">{{ $errors->first('status') }}</div>
                                               @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEnterYourName" class="col-form-label"> Specification <span style="color: red;">*</span></label>
                                               <textarea name="specification" id="editor" cols="30" rows="10" class="form-control">{{ $product->specification }}</textarea>
                                               @if($errors->has('specification'))
                                               <div class="error" style="color:red;">{{ $errors->first('specification') }}</div>
                                               @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Image <span style="color: red;">*</span></label>
                                                <input type="file" name="image" id="image-upload" class="form-control" >
                                                @if($errors->has('image.*'))
                                                    <div class="error" style="color:red;">{{ $errors->first('image.*') }}</div>
                                                @endif
                                                @if($errors->has('image'))
                                                    <div class="error" style="color:red;">{{ $errors->first('image') }}</div>
                                                @endif  
                                            </div>

                                            @if($product['image'])
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label">View Profile Picture </label>
                                                <br>
                                               <img src="{{ Storage::url($product['image']) }}" alt="" class="img-design">
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

<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
<script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/jquery.min.js"></script>
<script src='http://ckeditor.com/cke4/addon/wordcount.js'></script>

<script>
    $(() => {
  CKEDITOR.config.toolbar = [
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Undo', 'Redo' ] },
    { name: 'links', items: [ 'Link', 'Unlink'] },
    { name: 'insert', items: [ 'Image', 'Table' ] },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline'] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
    { name: 'styles', items: [ 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor' ] },
    { name: 'others', items: [ '-' ] },
    { name: 'document', items : [ 'Source'] },
  ];  
  CKEDITOR.on( 'dialogDefinition', function( ev ) {
    // Take the dialog name and its definition from the event data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    if ( dialogName == 'link' ) {
        // Get a reference to the "Link Info" tab.
        var targetTab = dialogDefinition.getContents( 'target' );
        // Set the default value for the URL field.
//         var urlField = infoTab.get( 'url' );
//         urlField[ 'default' ] = 'www.example.com';
      
//         var linkTpyeField = infoTab.get('linkType');
//         linkTpyeField['items'] = [["URL", 'url']];
      // 重写target 效果
        var targetField = targetTab.elements[0].children[0];
        
        targetField['items'] = [["New Window (_blank)", "_blank"]];
        targetField['default'] = '_blank';
      // 隐藏advance
      var advancedtab = dialogDefinition.getContents( "advanced" );
      advancedtab['hidden'] = true;
      //
      //
      //
     
    } else  if(dialogName === 'image'){
      var imageInfo = dialogDefinition.getContents('info');
      console.log('ccc', imageInfo)
    }
});
  CKEDITOR.replace('editor');
  $('#export').click(() => {
    $('#result').html(CKEDITOR.instances.editor.getData().toString());
  })
});


</script>

@endpush