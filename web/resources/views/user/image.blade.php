@extends('master.layout')

@section('title')
        Image Dashboard
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
            <li class="breadcrumb-item active" aria-current="page">Upload Image</li>
          </ol>
          <div class="container">
               @include('master.notif')
          </div>
          <!-- Page Content -->
          <h1>Upload Image</h1>
          <hr>
          <div class="containerfluid">
          	 <a href="{{route('dashboard.image.upload')}}" class="btn btn-primary" style="margin-bottom: 10px;">Upload New Image</a>
          </div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Image List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Image URL</th>
                        <th>Created Date</th>
                        <th>Action Button</th>
                    </tr>
                  </thead>
                   @foreach($image as $i)
                    <tr>
                      <td>{{$i->title}}</td>
                      <td><img src="{{ asset('/').$i->title}}" class="rounded image-profile"></td>
                      <td class="copy">{{ asset('/').$i->title}}</td>
                      <td>{{$i->created_at}}</td>
                      <td>
                        <div class="btn-group" role="group" >
                          @if($i->title=='poto_profile.jpg')
                            <a href="#" class="btn btn-danger btn-sm disabled" role="button" aria-disabled="true">Delete</a>
                          @else
                            <a href="#" class="button btn btn-danger btn-sm delete-image" onclick="confirmPotoDelete({{$i->id}})"> Delete</a>
                          @endif
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
			          <p>Do you want to delete this Image?</p>
			        </div>
			        <div class="modal-footer">
			           <button type="button" class="btn btn-danger deletePic">Yes</button>
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
   <script type="text/javascript"> 
        var delete_img  = '{{route('dashboard.image.delete')}}';
    </script>
@endsection