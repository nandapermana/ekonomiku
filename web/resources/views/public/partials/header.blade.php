<header class="fixed-top p-auto">
    <div class="container">
        <nav class="navbar navbar-expand p-0">
            <a class="navbar-brand mr-0 pr-4" href="{{route('index')}}">
                <img src="{{asset('images/logo2.png')}}" alt='' style="padding-top: 15px;">
            </a>
            <a href="javascript:void(0)" id="cls-btn">&times;</a>
            <div class="navbar-collapse nav-sec" id="sidenav">
                <ul class="navbar-nav mr-auto header-nav">
                    @if($modul =='index')
                        <li class="nav-item active">
                        <a class="nav-link active text-white" href="{{route('index')}}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('index')}}">                      
                    @endif
                            Home
                        </a>
                    </li>
                    @if($modul =='about')
                        <li class="nav-item active">
                        <a class="nav-link active text-white" href="{{route('about')}}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('about')}}">
                    @endif
                            About
                        </a>
                    </li>
                    @if($modul =='blog')
                        <li class="nav-item active">
                        <a class="nav-link active text-white" href="{{route('blog',['page'=> 1])}}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('blog',['page'=> 1])}}">
                    @endif
                            Blog
                        </a>
                    </li>
                    @if($modul =='photo')
                        <li class="nav-item active">
                        <a class="nav-link active text-white" href="{{route('photo')}}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('photo')}}">
                    @endif
                          Photo
                        </a>
                    </li>
                     @if($modul =='pdf')
                        <li class="nav-item active">
                        <a class="nav-link active text-white" href="{{route('pdf',['page' => 1 ])}}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('pdf',['page' => 1 ])}}">
                    @endif
                            pdf
                        </a>
                    </li>

                </ul>

                <div class="search-box mr-lg-0">
                    <input type="text" placeholder="Search here..." name="search1">
                    <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="menu-icon d-lg-none">
                    <span class="ml-auto"></span>
                    <span class="ml-auto"></span>
                    <span class="ml-auto"></span>
                </div>
        </nav>
    </div>
</header>