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
          <h1>Manage Post</h1>
          <hr>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Post List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <td>Judul</td>
                        <td>Text</td>
                        <td>Created At</td>
                        <td>Action Button</td>
                    </tr>
                  </thead>
                    @foreach($post as $p)
                    <tr>
                      <td>{{$p->title}}</td>
                      <td>{{strip_tags( mb_substr($p->body, 0, 100) )  }} ...</td>
                      <td>{{$p->created_at}}</td>
                      <td>
                      	<div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{route('dashboard.preview', ['id' => $p->id] )}}" class="button btn btn-info btn-sm">Preview</a>
						              <a href="{{route('dashboard.edit', ['id' => $p->id] )}}" class="button btn btn-primary btn-sm"> Edit</a>
                      		<a href="#" class="button btn btn-danger btn-sm delete-post" onclick="confimrationDelete({{$p->id}},)"> Delete</a>
						            </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
    </div>
        <!-- /.container-fluid -->
        <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			      <!-- Modal content-->
			      <div class="modal-content">
			      	<div class="modal-header">
				        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
			        <div class="modal-body">
			          <p>Do you want to delete this post?</p>
			        </div>
			        <div class="modal-footer">
			           <button type="button" class="btn btn-danger yesDelete">Yes</button>
			           <button type="button" class="btn btn-default" data-dismiss="modal" id="noDelete">No</button>
			        </div>
			      </div>
			    </div>
			  </div>
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