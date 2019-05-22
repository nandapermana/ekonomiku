@extends('master.layout')

@section('title')
        Write Post
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

      <!-- Sidebar -->
     @include('user.partials.sidebar')
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
          </ol>

          <div class="container">
               @include('master.notif')
          </div>
          <!-- Page Content -->
         <h1>Write Post</h1>
         <hr>
         <form action="{{route('dashboard.post')}}" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputEmail1">Tittle</label>
                <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="Enter Title">
              </div>
              <div class="form-group">
                <label >Upload Header Image</label> <small>(Must be .jpeg or .png , max: 2500 x 2500 px)</small>
                <input type="file" class="form-control-file" name="header_image">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Text</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Post</button>
            {{ csrf_field() }}
        </form>

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

    <!--script text editor-->
    <script type="text/javascript"> var url = '{{ URL::asset('js/nicEditorIcons.gif')}}';</script>
    <script src="{{asset('js/nicEdit.js')}}"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>
@endsection