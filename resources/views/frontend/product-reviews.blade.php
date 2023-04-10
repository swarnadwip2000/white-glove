@foreach($reviews as $review)
<div class="testimonial-box">
    <div class="box-top">
        <div class="profile">
            <div class="profile-img">                             
              @if ($review['user']['profile_picture'] == null)
              <img
              src="{{ asset("frontend_assets/images/logo.png") }}" />
              @else
              <img src="{{ storage::url($review['user']['profile_picture']) }}" />
              @endif
            </div>
            <div class="name-user">
                <strong>{{ $review->user->name }}</strong>
                <span class="date">Posted on {{ date('d M, Y', strtotime($review->created_at)) }}</span>
            </div>
        </div>
        <div class="">
            @php
                $count = 1;
            @endphp
            @for ($i = 1; $i <= 5; $i++)
            @if($i <= $review['rating'])
            <i class="fas fa-star reviews"></i>
            @else
            <i class="far fa-star" style="color: #bbb9ad"></i>
            @endif
            @php
             $count++   
            @endphp
            @endfor
            
        </div>
    </div>
    <div class="client-comment">
        <p>{{ $review->comment }}
        </p>
    </div>
</div>
@endforeach