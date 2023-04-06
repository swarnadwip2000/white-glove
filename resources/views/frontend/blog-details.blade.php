
@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
{{ env('APP_NAME') }} | HOME
@endsection
@push('styles')
@endpush

@section('content')

<section class="inner_banner_sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner_banner_ontent">
              <h1>Blog Details</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

    <section class="blo_section section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="single_blog">
                        <h6>{{date('d M, Y',strtotime($blog->updated_at))}} <span>{{ $blog->category->name }} </span></h6>
                        <h2>{{ $blog->name }}</h2>
                        <div class="blog_img_wrapper">
                            <a href="#"><img src="{{ Storage::url($blog->image) }}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog_right_cate">
                        <div class="box_1">
                            <h4>Search</h4>
                            <div class="inner_search_box">
                              <div class="search_box">
                                <div class="search_field">                        
                                  <input type="text" class="input" placeholder="Search">
                                  <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="box_1">
                            <h4>CATEGORIES</h4>
                            <ul>
                                @foreach($blog_category as $category)
                                <li><a href="{{ route('blogs',['slug' => $category['slug'],'id' => $category['id']]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="box_1">
                            <h4>RECENT POSTS</h4>
                            <ul>
                                @foreach($blog_list as $blog)
                                 <li><a href="{{ route('blog-detail',['slug' => $blog['slug'], 'id' => encrypt($blog['id'])]) }}">{{ $blog->name }}</a></li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
