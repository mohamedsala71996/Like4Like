@extends('layouts.site.app')

@section('content')
<div class="container">
    <div class="my-5 row">
        @foreach($facebookLinks as $link)
        <div class="my-3 col-md-6 col-12">
        @if($link->status == 1)
            <form action="{{ route('executeTask', $link->id )}}" method="POST" class="mb-3" enctype="multipart/form-data">
        @else
        <form id="face_status" action="{{route('work.changeStatus')}}" method="post">
        @endif        
                @csrf
                <div class="w-100 form p-3 px-4 shadow mx-auto">
                    <img src="{{url('/')}}/website/assets/work/facebook.jfif" class="my-2" style="width: 50px;" alt="card image">
                    <div class="my-3">
                        <label  class="my-2" style="font-size: 15px; font-weight: 600">{{$link->description}}</label>
                       
                        
                        <input type="hidden" id="id" name="id" value="{{$link->id}}" />
                        <input type="hidden" id="status" name="status" value="1" />
                        
                        @if($link->status == 0)
                        <a href="{{$link->link}}" target="_blank" class="btn btn-primary" id="face_link">اضغط على الرابط</a>
                        @else
                        <a href="{{$link->link}}" target="_blank" class="btn btn-primary" id="face_link" style="display:none;">اضغط على الرابط</a>
                        @endif
                        <label for="photo" class="my-2" style="font-size: 20px; font-weight: 500"></label>
                        <input type="file" name="photo" class="form-control w-75" style="font-size: 16px; font-weight: 500" >
                        @error('photo')
                        <div class="w-75 alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end" id="app">
                        <div class="d-flex justify-content-start">
                        @if($link->status == 0)
                        <button type="submit" class="btn btn-success" style="display:none;">تنفيذ المهمة</button>
                        @else
                            <button type="submit" class="btn btn-success">تنفيذ المهمة</button>
                         @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById("face_link").addEventListener("click", function() {
  document.getElementById("face_status").submit();
});
</script>
@endpush