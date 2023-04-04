@extends('frontend.layouts.master')
@section('meta')
@endsection
@section('title')
White Globe | HOME
@endsection
@push('styles')
@endpush

@section('content')

<section class="inner_banner_sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner_banner_ontent">
              <h1>Blog</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
    <section class="blo_section section">
        <div class="container">
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-md-6">
                    <div class="single_blog">
                        <h6>{{date('d M, Y',strtotime($blog->updated_at))}} <span>{{ $blog->category->name }} </span></h6>
                        <h2>{{ Str::limit($blog->name,25,'..') }} </h2>
                        <div class="blog_img_wrapper">
                            <a href="{{ route('blog-detail',['slug' => $blog['slug'], 'id' => encrypt($blog['id'])]) }}"><img src="{{ Storage::url($blog->image) }}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            <p>{!! Str::limit($blog->description, 200, ' ...') !!}</p>
                            <a class="red_btn type_yellow" data-animation-in="fadeInUp" href="{{ route('blog-detail',['slug' => $blog['slug'], 'id' => encrypt($blog['id'])]) }}"><span>READ MORE</span></a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-md-6">
                    <div class="single_blog">
                        <h6>July 26, 2021 <span>STYLING </span></h6>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <div class="blog_img_wrapper">
                            <a href="blog-details.html"><img src="{{ asset('frontend_assets/images/featured_product1.jpg')}}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi...</p>
                            <a class="red_btn type_yellow" data-animation-in="fadeInUp" href="blog-details.html"><span>READ MORE</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single_blog">
                        <h6>July 26, 2021 <span>STYLING </span></h6>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <div class="blog_img_wrapper">
                            <a href="blog-details.html"><img src="{{ asset('frontend_assets/images/featured_product2.jpg')}}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi...</p>
                            <a class="red_btn type_yellow" data-animation-in="fadeInUp" href="blog-details.html"><span>READ MORE</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single_blog">
                        <h6>July 26, 2021 <span>STYLING </span></h6>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <div class="blog_img_wrapper">
                            <a href="blog-details.html"><img src="{{ asset('frontend_assets/images/featured_product3.jpg')}}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi...</p>
                            <a class="red_btn type_yellow" data-animation-in="fadeInUp" href="blog-details.html"><span>READ MORE</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single_blog">
                        <h6>July 26, 2021 <span>STYLING </span></h6>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <div class="blog_img_wrapper">
                            <a href="blog-details.html"><img src="{{ asset('frontend_assets/images/featured_product4.jpg')}}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi...</p>
                            <a class="red_btn type_yellow" data-animation-in="fadeInUp" href="blog-details.html"><span>READ MORE</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single_blog">
                        <h6>July 26, 2021 <span>STYLING </span></h6>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <div class="blog_img_wrapper">
                            <a href="blog-details.html"><img src="{{ asset('frontend_assets/images/featured_product.jpg')}}" class="img-fluid" /></a>
                        </div>
                        <div class="blog_desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi...</p>
                            <a class="red_btn type_yellow" data-animation-in="fadeInUp" href="blog-details.html"><span>READ MORE</span></a>
                        </div>
                    </div>
                </div> --}}
            </div>                
        </div>
    </section>

    @endsection