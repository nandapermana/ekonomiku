@extends('master.layout')

@section('title')
        Dashboard
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
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>

          <div class="container">
               @include('master.notif')
          </div>
          <!-- Page Content -->
          <h1>Profile</h1>
          <hr>
            <div class="container">
                <div class="col-sm">
                    <form action="{{route('dashboard.uploadImageProfile')}}" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <img src="{{ URL::to('/') }}/{{$photo}}" class="rounded image-profile">
                        </div>
                        <div class="form-group">
                            <label >Upload New Image</label> <small>(Must be .jpeg  , max: 2500 x 2500 px)</small>
                            <input type="file" class="form-control-file" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Upload Image</button>
                        {{ csrf_field() }}
                    </form>
                    <hr>
                    <form action="{{route('dashboard.updateProfile')}}" method="post" >
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{$user->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                        {{ csrf_field() }}
                    </form>
                    <hr>
                    <form action="{{route('dashboard.updatePassword')}}" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Old Password</label>
                            <input type="password" class="form-control" name="oldPassword">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">New Password</label>
                            <input type="password" class="form-control" name="newPassword">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Confirm Password</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
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