 <a href="/" class="brand-link h4">
      <img src="{{env('APP_URL')}}/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">A&Z Visa Consultancy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::guard('staff')->check())
            <img src="{{Auth::guard('staff')->user()->avatar}}" class="img-circle elevation-2" alt="{{Auth::guard('staff')->user()->name}}">
          @endif
          
        </div>
        <div class="info">
          <a href="#" class="d-block">
          
          @if(Auth::guard('staff')->check())
            {{Auth::guard('staff')->user()->name}}
          @endif

          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if(Auth::guard('staff')->check())
          
          <li class="nav-item">
            <a href="{{route('admin.job_seeker')}}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Job Holder</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.company')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Company</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.staff')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Staff</p>
            </a>
          </li>
          

          <li class="nav-item">
            <a href="{{route('admin.change.password')}}" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Change Password</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Logout</p>
            </a>
          </li>
        @endif


       

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>