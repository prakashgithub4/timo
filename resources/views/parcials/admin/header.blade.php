<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
      </li>
  </ul>
    <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
        <i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-item">
          <a href="{{route('admin.logout')}}"><i class="fas fa-sign-out-alt mr-2"></i> Log out</a><br/>
          <a href="{{route('reset-password')}}"><i class="fas fa-cog mr-2"></i> Change Password</a>
        </div>
        <div class="dropdown-divider"></div>          
      </div>
    </li>
    
    <li class="nav-item adminimg">
      <div class="image">
            <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="javascript:void(0)" class="d-block">{{\Auth::user()->name}}</a>
        </div>
    </li>
  </ul>
</nav>