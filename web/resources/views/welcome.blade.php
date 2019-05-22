@extends('master.layout')

@section('title')
        Login
@endsection

@section('content')
<body style="background-color:#f5f5f5;">
<div class="container" style="max-width: 18rem; padding-top: 150px;" >
    <form action="{{route('proceed.login')}}" method="post">
        <center><h1 class="h3 mb-3 font-weight-normal">Please sign in</h1></center>
        <fieldset >
            <input id="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="" type="email">
            <input id="password" name="password" class="form-control" placeholder="Password" required="" autofocus="" type="password">
        </fieldset>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        {{ csrf_field() }}
        <center> <p class="mt-5 mb-3 text-muted">© Iqbal Permana 2018-2019</p> </center>
    </form>
</div>
</body>
        
@endsection