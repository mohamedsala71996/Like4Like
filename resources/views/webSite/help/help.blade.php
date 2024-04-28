@extends('layouts.site.app')
@section('content')
    <div class="container3">
        <h1>تواصل معنا من خلال</h1>
        <div class="contact-info">
            <p>الهاتف: +1234567890</p>
            <p>البريد الإلكتروني: example@example.com</p>
        </div>
        <div class="social-media-icons">
            <a href="https://www.facebook.com"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://twitter.com"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>
    <div class="MyContainer" style="width: 100%; margin: auto; margin-top: 10px;">
        <div class="col-lg-5 col-md-6 col-12" style="width: 100%; padding-inline: 5px;  padding-right: 40px; ">
            <h1 style="color: #ff0000;">من نحن!!</h1>
            <p style="font-size: large;">
                @php $settings = \App\Models\Setting::all(); @endphp
                @foreach($settings as $setting)
                {{$setting->about_us}}
                @endforeach</p>
        </div>
    </div>
@endsection
