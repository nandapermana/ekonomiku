@extends('master.public_layout')

@section('title')
        About
@endsection

@section('content')

@include('public.partials.header')


<section class="banner innerpage-banner contact-banner">
    <div class="container">
        <h1 data-aos="fade-up" data-aos-duration="1000"></h1>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</section>

<section class="about-page">
    <div class="container">
        <h2 data-aos="zoom-in" data-aos-duration="1000">about Iqbal Permana</h2>
        <ul class="row">
            <li class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <figure><img src="{{asset('poto_profile.jpg')}}" alt="about-page" ></figure>
            </li>
            <li class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <p>{{$user->description}}</p>
            </li>
        </ul>
    </div>
</section>

@include('public.partials.footer')

<button class="scrolltop-btn">
    <i class="fa fa-angle-up"></i>
</button>

@endsection