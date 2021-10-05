<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Arca Internasional</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          {{-- <li class="menu-header">Admin</li>
          <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Admin</span></a></li> --}}
          
          <li class="menu-header">Jabatan</li>
          <li><a class="nav-link" href="{{route('admin.position.index')}}"><i class="far fa-square"></i> <span>Jabatan</span></a></li>
          
          <li class="menu-header">Akun</li>
          <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Akun</span></a></li>
         
          <li class="menu-header">Karyawan</li>
          <li><a class="nav-link" href="{{route('admin.employee.index')}}"><i class="far fa-square"></i> <span>Karyawan</span></a></li>
          
          <li class="menu-header">Salary Bonus</li>
          <li><a class="nav-link" href="{{route('admin.salaryBonus.index')}}"><i class="far fa-square"></i> <span>Bonus Gaji</span></a></li>

          
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div>
    </aside>
  </div>