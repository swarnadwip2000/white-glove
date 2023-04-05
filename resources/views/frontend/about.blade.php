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
                    <h1>{{ $aboutCms->banner_name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="abt_section section">
  <div class="container">
    <div class="row align-items-center mb-5" data-aos="fade-up" data-aos-duration="500">
      <div class="col-md-4">
        <div class="abt_img">
          <img src="{{ Storage::url($aboutCms['section_1_img']) }}" class="img-fluid" />
        </div>
      </div>
      <div class="col-md-8">
        <div class="abt_content heading_hp">
          <h2>{{ $aboutCms->section_1_name }}</h2>
          <h4>{{ $aboutCms->section_1_title }}</h4>
          <p>{!! $aboutCms->section_1_description !!}</p>
        </div>
      </div>
    </div>
    <div class="row mb-5" data-aos="fade-up" data-aos-duration="500">
      <div class="col-md-12">
        <div class="cannabis_tow_box py-5">
          <div class="can_img"><img src="{{ Storage::url($aboutCms['section_2_banner']) }}" alt=""/></div>
          <div class="position-relative">
            <div class="row justify-content-end">
              <div class="col-lg-6">
                <div class="heading_hp text_white">
                  <h2>{{ $aboutCms->section_2_title }}</h2>
                  <a class="sec_btn" href=""><span>Shop Now</span></a>
                </div>
              </div>                  
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row" data-aos="fade-up" data-aos-duration="500">
      <div class="col-md-12">
        <div class="abt_content_type2 heading_hp">
          <div class="abt_img_type2 float-end">
            <img src="{{ Storage::url($aboutCms['section_3_img']) }}" class="img-fluid"/>
          </div>                            
          <h2>{{ $aboutCms->section_3_name }}</h2>
          <h4>{{ $aboutCms->section_3_title }}</h4>
          <p>{!! $aboutCms->section_3_description !!}</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection