<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<title>@yield('title')</title>
		<link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
	    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
	    <link href="{{asset('css/main.css')}}" rel="stylesheet">
		@yield('styles')
	</head>
	<body>
		<div>
			@yield('content')
		</div>
		<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
	    <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
   		<script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
   		<script src="{{asset('js/sb-admin.min.js')}}"></script>
   		<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
   		<script src="{{asset('js/main.js')}}"></script>
		@stack('scripts')
	</body>
	<footer>
	</footer>
</html>