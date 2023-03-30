@php
    use Illuminate\Support\Facades\Storage;
@endphp
@if(isset($searchProducts) && count($searchProducts) > 0)
@foreach($searchProducts as $searchProduct)
<li>
    <a href="{{ route('product-detail', ['slug' => $searchProduct['slug'], 'id' => encrypt($searchProduct['id'])]) }}">
      <div class="">
        <span><img src="{{ storage::url($searchProduct['image']) }}" alt=""/></span>
      </div>                      
      <div class="">
        <h5>{{ $searchProduct['name'] }}</h5>
        <p>{!! Str::limit($searchProduct['description'], 30, ' ...') !!}</p>
      </div>
    </a>
  </li>
@endforeach
@endif