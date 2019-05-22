<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    @yield('description')
	    @yield('image')
	    <meta name="author" content="M iqbal Permana">
		<title>@yield('title')</title>
	    <link href="{{asset('css/montserrat_font.css')}}" rel="stylesheet">
	    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	    <link href="{{asset('css/ekko-lightbox.css')}}" rel="stylesheet">
	    <link href="{{asset('css/aos.css')}}" rel="stylesheet">
	    <link href="{{asset('css/style.css')}}" rel="stylesheet">
		@yield('styles')
	</head>
	<body>
		<div>
			@yield('content')
		</div>
		<script src="{{asset('js/jquery.js')}}"></script>
		<script src="{{asset('js/popper.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script src="{{asset('js/aos.js')}}"></script>
		<script src="{{asset('js/script.js')}}"></script>
		<script src="{{asset('js/main.js')}}"></script>
		<script>
		    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
		        event.preventDefault();
		        $(this).ekkoLightbox();
		    });
		</script>
		<script src="{{asset('js/main.js')}}"></script>
		@stack('scripts')
	</body>
	<footer>
	</footer>
</html>