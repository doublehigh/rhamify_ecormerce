<nav class="navbar navbar-expand-lg main-navbar admin-dashboard-menu">
    <a href="#" data-toggle="sidebar" class="admin-sidebar-toggle" aria-label="Toggle admin menu">
        <i class="fas fa-bars"></i>
    </a>

    <ul class="navbar-nav navbar-right">
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-user admin-dashboard-user">
        <img alt="{{ auth()->user()->name }}" src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('frontend/images/ts-2.jpg') }}" class="rounded-circle">
        <span>Hi, {{auth()->user()->name}}</span></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
          </a>

          <a href="{{route('admin.settings.index')}}" class="dropdown-item has-icon">
            <i class="fas fa-cog"></i> Settings
          </a>
          <div class="dropdown-divider"></div>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <a href="{{route('logout')}}" onclick="event.preventDefault();
                this.closest('form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </div>
      </li>
    </ul>
  </nav>
