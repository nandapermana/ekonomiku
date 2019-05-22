@extends('master.layout')

@section('title')
        Comment
@endsection

@section('content')
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Dashboard aba</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
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
            <li class="breadcrumb-item active" aria-current="page">Comment</li>
          </ol>

          <div class="container">
               @include('master.notif')
          </div>
          <!-- Page Content -->

          <h3>Page {{$page}} of {{$totalPage}}</h3>
          <hr>
            @foreach($comment as $c)
              <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">By : {{$c->name}}</h4>
                <p>Date: {{$c->created_at}} , Phone : {{$c->mobile}} , Email : {{$c->email}}</p>
                <hr>
               <p>{{$c->message}}</p>
              </div>
            @endforeach

              <hr>
              @if($pageControl['prevPage']!==null)
                <a href="{{route('dashboard.comment',['page'=> $page-1 ])}}" class="btn btn-primary"> prev </a>
              @endif
              @if($pageControl['nextPage']!==null)
                <a href="{{route('dashboard.comment',['page'=> $page+1 ])}}" class="btn btn-primary"> Next </a>
              @endif
               <hr>
          </div>
        <!-- /.container-fluid -->

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
@endsection