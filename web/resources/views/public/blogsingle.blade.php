@extends('master.public_layout')

@section('description')
<meta property="og:description"   content="{{$post->title}}" />
@endsection

@section('image')
<meta property="og:image" content="{{$post->image_url}}" />
@endsection

@section('title')
        Blog | The Battle of Ideas
@endsection

@section('content')


@include('public.partials.header')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<section class="banner innerpage-banner contact-banner">
    <div class="container">
        <h1 data-aos="fade-up" data-aos-duration="1000">Blog</h1>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</section>

<section class="blog-page blogsingle">
    <h3 data-aos="fade-up" data-aos-duration="1000">{{$post->title}}</h3>
    <div class="overlay">
        <a href="blogsingle.html">
            <div class="blog-img" data-aos="fade-up" data-aos-duration="1200">
                <img src="{{ URL::to('/') }}/{{$header->name}}" alt="blog-single" class="img-fluid w-100">
                <div class="blog-img-inner"></div>
            </div>
        </a>
    </div>
    <h6>
        {{ $post->created_at->format('d/m/Y') }}  Posted by <span>{{$author}} </span> <br>
    </h6>
    <p data-aos="fade-up" data-aos-duration="1000">{!! $post->body !!}</p>
    <hr>
    Shared on: <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-1" style="margin-right: 5px;">
                    <div class="fb-share-button" data-href="{{route('readBlog',['id'=> $post->id])}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                </div>
                <div class="col-sm-1" style="top: 4px;">
                    <script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                    <script type="IN/Share" data-url="{{route('readBlog',['id'=> $post->id])}}"></script>
                </div>
                <div class="col-sm-10">
                </div>
            </div>
        </div>
    <hr>
    <div class="comments-posted">
        <h2>comments Posted</h2>
        @foreach($comment as $c)
        <div class="comments">
            <h5>{{$c->name}}<span> - {{$c->created_at->format('d/m/Y')}}</span></h5>
            <p>{{$c->message}}</p>
        </div>
        @endforeach
    </div>
    <div class="write-comment">
        <h2 data-aos="fade-up" data-aos-duration="1000">Tulis Comment</h2>
        <form data-aos="fade-up" data-aos-duration="1000" 
        action="{{ route( 'commentBlog',['blogId' => $post->id] ) }}" method="post">
            <ul class="row">
                @if(Auth::check())
                    <li class="col-md-4">
                        <input type="hidden" required class="w-100" placeholder="Masukan nama anda" name="nama" value="{{Auth::user()->name }}">
                    </li>
                    <li class="col-md-4">
                        <input type="hidden" required class="w-100" placeholder="masukan email anda" name="email" value="{{Auth::user()->email }}">
                    </li>
                @else
                   <li class="col-md-4">
                        <input type="text" required class="w-100" placeholder="Masukan nama anda" name="nama">
                    </li>
                    <li class="col-md-4">
                        <input type="email" required class="w-100" placeholder="masukan email anda" name="email">
                    </li>
                    <li class="col-md-4">
                        <input type="text" required class="w-100" placeholder="Website anda" name="website">
                    </li>
                @endif
                <li class="col-12">
                    <textarea class="w-100" required placeholder=" Pesan anda" name="message"></textarea>
                </li>
            </ul>
            <button type="submit">post your comment</button>
            {{ csrf_field() }}
        </form>
    </div>
</section>
<div class="modal fade" id="modal-share" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Copy Link to</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input id="share-link" class="form-control" type="text"  value="">
                    </div>
                </form>
            </div>
         </div>
    </div>
</div>

@include('public.partials.contact')
@include('public.partials.footer')
<button class="scrolltop-btn">
    <i class="fa fa-angle-up"></i>
</button>


@endsection