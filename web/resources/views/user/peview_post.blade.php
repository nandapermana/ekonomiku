@extends('master.layout')

@section('title')
        Manage Post
@endsection

@section('content')
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Dashboard aba</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="{{route('dashboard.logout')}}" title="sign out">
            <i class="fas fa-sign-out-alt fa-fw"></i>
          </a>
        </li>
       
      </ul>

    </nav>

    <div id="wrapper">

      @include('user.partials.sidebar')

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page">Manage Post</li>
          </ol>

          <div class="container">
               @include('master.notif')
          </div>
          <!-- Page Content -->
          <h1>Preview Post</h1>
          <h4>Created at : {{$post->created_at}}</h4>
          <hr>
          <img src="{{$post->image_url}}">
          <h2>{{$post->title}}</h2>
           {!! $post->body !!}.
        </div>
        <!-- /.container-fluid -->
        <!-- Modal -->
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright©Iqbal Permana 2018</span>
                </div>
            </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
      <script type="text/javascript"> 
        var delete_url  = '{{route('dashboard.deletePost')}}';
        var urlData     = '{{route('dashboard.get_jsonpost')}}';
      </script>
@endsection