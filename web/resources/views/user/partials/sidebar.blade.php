 <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        @if($modul == 'profile')
          <li class="nav-item active">
        @else
          <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.landing')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span title="setting profile">Profile</span>
          </a>
         </li>
        @if($modul == 'manage')
          <li class="nav-item active">
        @else
          <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.managePost')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Manage Post</span></a>
        </li>
        @if($modul == 'write')
          <li class="nav-item active">
        @else
          <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.writePost')}}">
           <i class="fas fa-feather-alt"></i>
            <span>Write New Post</span></a>
        </li>
        @if($modul == 'image')
          <li class="nav-item active">
        @else
          <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.image')}}">
           <i class="far fa-image"></i>
            <span>Upload Images</span></a>
        </li>
        @if($modul == 'comment')
          <li class="nav-item active">
        @else
         <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.comment',['page' => 1 ])}}">
           <i class="fa fa-comment"></i>
            <span>Comment</span></a>
        </li>
        @if($modul == 'pdf')
          <li class="nav-item active">
        @else
         <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.pdf')}}">
           <i class="fa fa-file"></i>
            <span>PDF</span></a>
        </li>
        @if($modul == 'ads')
          <li class="nav-item active">
        @else
         <li class="nav-item">
        @endif
          <a class="nav-link" href="{{route('dashboard.ads')}}">
           <i class="fa fa-ad"></i>
            <span>Ads</span></a>
        </li>
      </ul>