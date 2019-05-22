@extends('master.public_layout')

@section('title')
    Blog
@endsection

@section('content')


@include('public.partials.header')

<section class="banner innerpage-banner contact-banner">
    <div class="container">
        <h1 data-aos="fade-up" data-aos-duration="1000"> </h1>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</section>

<section class="blog-page" style="background: url(../images/index-service.jpg)">
    <div class="container">
        <h2 data-aos="fade-up" data-aos-duration="1000">read latest articles</h2>
        <ul class="row">
            @if($count > 0 )
                @foreach ($post->chunk(2) as $chunk)
                    @foreach ($chunk as $post)
                        <li class="col-md-6">
                            <div class="overlay" data-aos="fade-up" data-aos-duration="1000">
                                <a href="{{route('readBlog',['id'=> $post->id] )}}" class="blog-container">
                                    <div class="blog-img">
                                        <figure><img src="{{ URL::to('/') }}/{{$post->headerImage[0]->name}}" alt="img" class="img-fluid"></figure>
                                        <div class="blog-img-inner"></div>
                                    </div>
                                    <h5>
                                        {{$post->title}}
                                    </h5>
                                </a>
                                <a href="{{route('readBlog',['id'=> $post->id] )}}">read more</a>
                            </div>
                        </li>
                    @endforeach
                @endforeach
            @else
                <h1>No data to display</h1>
            @endif
        </ul>

        <div class="navigation">
            <ul>@if($pageControl['prevPage']!==null && $count > 0 )
                    <li><a  href="{{route('blog',['page'=>($page-1)])}}"> < </a></li>
                @endif
                @if($pageControl['nextPage']!==null && $count > 0 )
                    <li><a  href="{{route('blog',['page'=>($page+1)])}}"> > </a></li>
                @endif
            </ul>
        </div>
    </div>
</section>

@include('public.partials.contact')
@include('public.partials.footer')

<button class="scrolltop-btn">
    <i class="fa fa-angle-up"></i>
</button>
@endsection