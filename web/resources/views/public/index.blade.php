@extends('master.public_layout')

@section('title')
        Home
@endsection

@section('content')

<section class="banner">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <h6>{{$quote}}</h6>
        <br><br><br><br><br><br><br><br>
    </h6>
    </div>
</section>

@include('public.partials.header')

<section class="index-services">
    <div class="container">
        <div class="services-filter">
            <div class="service-list">
                <h3 class="tab-link current" data-tab="tab-1">Newest Article</h3>
                 
                <h3 class="tab-link responsive-tab" id="tabfour" style="padding-bottom : 265px;" 
                    data-tab="tab-4">Jurnal/ Paper</h3>
            </div>
            <div class="service-images">
                <ul id="tab-1" class="tab-content article-section current">
                   @foreach($post as $p)
                        <li>
                            <a href="{{route('readBlog',['id' => $p->id])}}">
                                <figure style="background:url({{ URL::to('/') }}/{{$p->headerImage[0]->name}}); background-position: center right"></figure>
                                <h4>{{$p->title}}</h4>
                                <p>
                                    {{ strip_tags( mb_substr($p->body, 0, 100) )  }} ...
                                </p>
                                <a href="{{route('readBlog',['id' => $p->id])}}" class="article-btn">Baca</a>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <ul id="tab-4" class="tab-content pricing-section" >
                    @foreach($pdf as $file)
                    <li>
                        <div class="content">
                            <h2>PDF Content</h2>
                            <h6>{{$file->title}}</h6>
                        </div>
                        <ul class="features">
                            <li>Tentang Jurnal / About the journal</li>
                            <p>{{$file->description}}</p>
                        </ul>
                        <a href="{{ asset('/').$file->name }}" class="buy-now">Preview PDF</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>



@include('public.partials.contact')
<section class="index-ads">
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                   <center><img class="d-block " src="https://dummyimage.com/1280x640/000/fff&text=Advertising" alt="First slide"></center>
                </div>
                @foreach($ads as $iklan)
                <div class="carousel-item">
                    <a href="{{$iklan->url}}"><img class="d-block  " src="{{asset('/').$iklan->file_name}}" alt="Second slide"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><font style="color: white">{{$iklan->name}}</font></h5>
                        <p><font style="color: white"> {{$iklan->description}} </font></p>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <hr>
    </div>
</section>
@include('public.partials.footer')

<button class="scrolltop-btn">
    <i class="fa fa-angle-up"></i>
</button>

<script>
    var w = window.innerWidth;
    if (+w <= 1025){
        document.getElementById("tabfour").setAttribute("style", "");
        var y = document.getElementById("tabfour").getAttribute("style");
    }
</script>

@endsection
