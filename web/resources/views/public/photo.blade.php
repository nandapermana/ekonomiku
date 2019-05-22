@extends('master.public_layout')

@section('title')
        Photo
@endsection

@section('content')

@include('public.partials.header')


<section class="banner innerpage-banner contact-banner">
    <div class="container">
        <h1 data-aos="fade-up" data-aos-duration="1000">Photo</h1>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</section>

<section class="about-page contact-page portfolio-page" id="my-port">
    <div class="container">
        <h2 data-aos="fade-up" data-aos-duration="1000">Photo Archive</h2>
        <p class="text-left" data-aos="fade-up" data-aos-duration="1000">
            
        </p>
        <ul class="row tz-gallery">
            @foreach($photo as $poto)
            <li class="col-sm-6 col-md-4">
                <a href="#" class="lightbox">
                    <div class="" data-aos="fade-up" data-aos-duration="1000">
                        <figure>
                            <img src="{{asset('/').$poto->title}}" alt="one">
                        </figure>
                        <div class="overlay">
                            <!--<span> This is Heading <br> visit site</span>-->
                        </div>
                    </div>
                </a>
            </li>
            @endforeach 
        </ul>
    </div>
</section>



@include('public.partials.contact')
@include('public.partials.footer')
<button class="scrolltop-btn">
    <i class="fa fa-angle-up"></i>
</button>
<script>
    baguetteBox.run('.tz-gallery');
</script>
@endsection