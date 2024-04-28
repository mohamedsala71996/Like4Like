@extends('layouts.site.app')

@section('content')
    <!-- تنبيه -->
    <div class="alert alert-info custom-alert show fade" role="alert">
        <strong>ملاحظة:</strong> تتم مراجعة لقطات الشاشة من قبل الإدارة، وفي حال اكتشاف لقطة شاشة غير صحيحة سيتم إلغاء
        الاشتراك مباشرة. تتم عملية المراجعة بمدة تصل إلى 72 ساعة.
    </div>
    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    @if($promotionalVideo !== null)
    <div class="row">
    <div class="col-12">
      <div class="card bg-dark text-white video-container">
        <video id="myVideo" src="{{'https://newlike.labs1.online/public/'.$promotionalVideo->video}}" class="w-100 d-block" autoplay  loop></video>        
      </div>
    </div>
    <div style="margin-right: 45%;">
    <form id="myForm" action="{{route('storeVideoSubscription')}}" method="post">
        @csrf
      <input type="hidden" id="customer_id" name="customer_id" value="{{Auth::guard('customer')->id()}}" />
      <input type="hidden" id="video_id" name="video_id" value="{{$promotionalVideo->id}}" />
       <button type="submit" class="btn btn-danger" id="sub_btn" style="display:none;"> </button>
</form>
<a href="{{$promotionalVideo->link}}" class="btn btn-primary"> سجل الان</a>
</div>
  </div>
        @endif   
         @if($promotionalVideo !== null)   
        <div class="row my-5" style="display:none;">
            <div class="col-md-6 mx-auto">
                <div class="w-50 p-2 mx-auto shadow">                    
                    <a href="{{ route('facebook') }}" id="flink" class="">
                        <img src="{{ url('/') }}/website/assets/work/facebook.jfif" style="cursor: pointer"
                            class="w-100" alt="">
                    </a>                  
                               
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-50 p-2 mx-auto shadow">
                    <a href="{{ route('youtube') }}" id="ylink" class="">
                        <img src="{{ url('/') }}/website/assets/work/youtube.jfif" style="cursor: pointer"
                            class="w-100" alt="">
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="row my-5">
            <div class="col-md-6 mx-auto">
                <div class="w-50 p-2 mx-auto shadow">                    
                    <a href="{{ route('facebook') }}" id="flink" class="">
                        <img src="{{ url('/') }}/website/assets/work/facebook.jfif" style="cursor: pointer"
                            class="w-100" alt="">
                    </a>                  
                               
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-50 p-2 mx-auto shadow">
                    <a href="{{ route('youtube') }}" id="ylink" class="">
                        <img src="{{ url('/') }}/website/assets/work/youtube.jfif" style="cursor: pointer"
                            class="w-100" alt="">
                    </a>
                </div>
            </div>
        </div>
        @endif
        


    </div>
@endsection

<style>
    .custom-alert {
        background-color: #cce5ff;
        color: #004085;
        border-color: #b8daff;
        border-radius: 5px;
        padding: 15px;
        animation: slideInDown 0.5s ease-in-out;
    }

    @keyframes slideInDown {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0%);
            opacity: 1;
        }
    }
</style>
@push('scripts')
@if($promotionalVideo)
@if($promotionalVideo->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
  var video = document.getElementById('myVideo');
  var form = document.getElementById('myForm');
  
  setTimeout(function() {
    document.querySelector("form").submit();
    }, 14000);
});
</script>
@endif
@endif
@endpush