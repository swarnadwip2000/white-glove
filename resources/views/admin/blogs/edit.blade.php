@extends('admin.layouts.master')
@section('title')
{{ env('APP_NAME') }} | Edit Blog Details
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
                        <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Edit Blog</li>
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
                        <h6 class="mb-0 text-uppercase">Edit Blog</h6>
                        <hr>
                        <div class="card border-0 border-4">
                            <div class="card-body">
                                <form action="{{ route('blogs.blogUpdate') }}" method="POST" enctype="multipart/form-data">
                                   
                                    @csrf
                                    <div class="border p-4 rounded">
                                        <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label">Category <span style="color: red;">*</span></label>
                                                <select name="category_id" id="" class="form-control select2">
                                                    @foreach($blog_categories as $category)
                                                    <option value="{{$category['id']}}" @if($blog['blog_category_id'] == $category['id']) selected @endif>{{$category['name']}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('category_id'))
                                                <div class="error" style="color:red;">{{ $errors->first('category_id') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Name <span style="color: red;">*</span></label>
                                                    <input type="text" name="name" id="" class="form-control" value="{{ $blog['name'] }}" placeholder="Blog Category Name">
                                                    @if($errors->has('name'))
                                                        <div class="error" style="color:red;">{{ $errors->first('name') }}</div>
                                                    @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Slug <span style="color: red;">*</span></label>                                        
                                                    <input type="text" name="slug" id="" class="form-control" value="{{ $blog['slug'] }}" placeholder="Blog Slug" >                                             
                                                    @if($errors->has('slug'))
                                                        <div class="error" style="color:red;">{{ $errors->first('slug') }}</div>
                                                    @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Description <span style="color: red;">*</span> </label>
                                               <textarea  cols="10" name="description" class="form-control" id="editor" placeholder="Write desctiption......">{{ $blog['description'] }}</textarea>
                                               @if($errors->has('description'))
                                                <div class="error" style="color:red;">{{ $errors->first('description') }}</div>
                                                @endif
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Image<span style="color:red">*<span></label>
                                                    <input type="file" class="form-control dropzone" id="image-upload" name="image" multiple>
                                                    @if($errors->has('image.*'))
                                                    <div class="error" style="color:red;">{{ $errors->first('image.*') }}</div>
                                                    @endif
                                                    @if($errors->has('image'))
                                                    <div class="error" style="color:red;">{{ $errors->first('image') }}</div>
                                                    @endif                                                 
                                            </div>
                                            @if($blog['image'])                                           
                                                <div class="col-md-6">
                                                    <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Image Preview</label>                                                 
                                                        <a href="{{Storage::url($blog['image'])}}" target="_blank">
                                                        <img src="{{Storage::url($blog['image'])}}" style="width: 100%; height:180px;" alt=""></a>
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