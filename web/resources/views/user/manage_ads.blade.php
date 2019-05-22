@extends('master.layout')

@section('title')
        Manage Ads
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
            <li class="breadcrumb-item active" aria-current="page">Upload Ads</li>
          </ol>
          <div class="container">
               @include('master.notif')
          </div>
          <!-- Page Content -->
          <h1>Upload Ads</h1>
          <hr>
          <div class="containerfluid">
             <a href="#" class="btn btn-primary" style="margin-bottom: 10px;" onclick="uploadAds()">Upload New Ads</a>
              <div class="card-body">
              <div class="table-responsive">
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ads Name</th>
                        <th>Created Date</th>
                        <th>Ads Image </th>
                        <th>Action Button</th>
                    </tr>
                  </thead>
                   @foreach($ads as $file)
                    <tr>
                      <td>{{$file->id}}</td>
                      <td>{{$file->name}}</td>
                      <td>{{$file->created_at}}</td>
                      <td><img src="{{ asset('/').$file->file_name}}" class="rounded image-profile"></td>
                      <td>
                        <div class="btn-group" role="group" >
                            <a href="#" class="button btn btn-success btn-sm" onclick='editAds({{$file->id}},"{{$file->url}}","{{$file->name}}","{{$file->description}}") '>Edit</a>
                            <a href="#" class="button btn btn-danger btn-sm" onclick="deleteAds({{$file->id}})"> Delete</a>
                        </div>
                      </td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- /.container-fluid -->
        <!-- Modal -->
        <div class="modal fade" id="deleteAds" role="dialog">
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
                <p>Do you want to delete this file?</p>
              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-danger delete-ads">Yes</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal" id="noDelete">No</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal upload PDF -->
         <div class="modal fade" id="adsModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ads Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <form action="{{route('dashboard.uploadAds')}}" method="post" enctype="multipart/form-data" >
                      <div class="form-group">
                          <label >Upload Image of Advertising</label> <small><br>(Must be .PNG/JPG  and have  resolution 1280 x 640 px)</small>
                          <input type="file" class="form-control-file" name="image">
                      </div>
                      <div class="form-group">
                         <label>Ads Name</label>
                         <input type="text" name="name" maxlength="255" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Ads Url</label>
                        <input type="text" name="url" class="form-control">
                      </div>
                      <div class="form-group">
                         <label>Ads Description</label>
                         <textarea type="text" name="description" maxlength="1000" class="form-control"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Upload Ads</button>
                      {{ csrf_field() }}
                  </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal edit PDF -->
         <div class="modal fade" id="adsEdit" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ads Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <form action="{{route('dashboard.editAds')}}" method="post">
                      <div class="form-group">
                         <label>Ads Name</label>
                         <input id="name_edit"  type="text" name="name" maxlength="255" class="form-control" value="">
                         <input type="hidden" name="id" id="id_edit" value="">
                      </div>
                      <div class="form-group">
                        <label>Ads Url</label>
                        <input id="url_edit" type="text" name="url" class="form-control" value="">
                      </div>
                      <div class="form-group">
                         <label>Description</label>
                         <textarea id ="description_edit" type="text" name="description" maxlength="1000" class="form-control"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                      {{ csrf_field() }}
                  </form>
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
         var deleteadsurl = '{{route('dashboard.deleteAds')}}';
    </script>
@endsection