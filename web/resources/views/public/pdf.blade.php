@extends('master.public_layout')

@section('title')
        PDF
@endsection

@section('content')

@include('public.partials.header')


<section class="banner innerpage-banner contact-banner">
    <div class="container">
        <h1 data-aos="fade-up" data-aos-duration="1000">PDF</h1>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</section>

<section class="blog-page">
    <div class="container">
         <ul class="row">
            @if($count > 0)
                @foreach ($pdf->chunk(2) as $chunk)
                    @foreach ($chunk as $pdf)
                        <li class="col-md-6">
                            <div class="overlay" data-aos="fade-up" data-aos-duration="1000">
                                <a href="{{ asset ('/').$pdf->name }}" class="blog-container">
                                    <div class="blog-img">
                                        <figure><img src="{{$pdf->image_url}}" alt="img" class="img-fluid"></figure>
                                        <div class="blog-img-inner"></div>
                                    </div>
                                    <h5>{{$pdf->title}}</h5>
                                    <p>{{$pdf->description}}</p>
                                </a>
                                <a href="{{ asset('/').$pdf->name }}">Preview PDF</a>
                            </div>
                        </li>
                    @endforeach
                @endforeach
            @else
               <h1>No data to display </h1>
            @endif
        </ul>
        <div class="navigation">
            <ul>@if($pageControl['prevPage']!==null && $count > 0 )
                    <li><a  href="{{route('pdf',['page'=>($page-1)])}}"> < </a></li>
                @endif
                @if($pageControl['nextPage']!==null && $count > 0)
                    <li><a  href="{{route('pdf',['page'=>($page+1)])}}"> > </a></li>
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