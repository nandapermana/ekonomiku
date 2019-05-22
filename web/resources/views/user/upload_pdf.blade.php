@extends('master.layout')

@section('title')
        Upload pdf
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
          <h1>Upload PDF</h1>
          <hr>
          <div class="containerfluid">
          	 <a href="#" class="btn btn-primary" style="margin-bottom: 10px;" onclick="uploadPDF()">Upload New Pdf</a>
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
                        <th>PDF</th>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th>Action Button</th>
                    </tr>
                  </thead>
                   @foreach($pdf as $file)
                    <tr>
                      <td>{{$file->title}}</td>
                      <td>{{$file->description}}</td>
                      <td>{{$file->created_at}}</td>
                      <td>
                        <div class="btn-group" role="group" >
                            <a href="{{ asset('/').$file->name }}" class="button btn btn-primary btn-sm">Preview</a>
                            <a href="#" class="button btn btn-success btn-sm" onclick='editPDF({{$file->id}},"{{$file->title}}","{{$file->description}}","{{$file->image_url}}")'>Edit</a>
                            <a href="#" class="button btn btn-danger btn-sm" onclick="deletePDF({{$file->id}})"> Delete</a>
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
			  <div class="modal fade" id="delete_pdf" role="dialog">
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
			           <button type="button" class="btn btn-danger deletePdf">Yes</button>
			           <button type="button" class="btn btn-default" data-dismiss="modal" id="noDelete">No</button>
			        </div>
			      </div>
			    </div>
			  </div>
        <!-- Modal upload PDF -->
         <div class="modal fade" id="pdf_upload" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">PDF Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <form action="{{route('dashboard.uploadpdf')}}" method="post" enctype="multipart/form-data" >
                      <div class="form-group">
                          <label >Upload New PDF</label> <small>(Must be .PDF )</small>
                          <input type="file" class="form-control-file" name="pdf">
                      </div>
                      <div class="form-group">
                          <label>Image Thumbnail for the PDF (url)</label>
                          <input type="text" class="form-control" name="url">
                      </div>
                      <div class="form-group">
                         <label>File Name</label>
                         <input type="text" name="title" maxlength="255" class="form-control">
                      </div>
                      <div class="form-group">
                         <label>Description</label>
                         <textarea type="text" name="description" maxlength="1000" class="form-control"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Upload PDF</button>
                      {{ csrf_field() }}
                  </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal edit PDF -->
         <div class="modal fade" id="pdf_edit" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">PDF Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <form action="{{route('dashboard.editpdf')}}" method="post">
                      <div class="form-group">
                          <label>Image Thumbnail for the PDF (url)</label>
                          <input id="pdf_url" type="text" class="form-control" name="url" value ="">
                          <input type="hidden" id="pdf_id" name="id" value="">
                      </div>
                      <div class="form-group">
                         <label>File title</label>
                         <input id="pdf_title" type="text" name="title" maxlength="255" class="form-control" value="">
                      </div>
                      <div class="form-group">
                         <label>Description</label>
                         <textarea id="pdf_description" type="text" name="description" maxlength="1000" class="form-control"></textarea>
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
         var deletepdfurl = '{{route('dashboard.deletepdf')}}';
    </script>
@endsection