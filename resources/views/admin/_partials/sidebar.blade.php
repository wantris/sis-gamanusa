<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">SIS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">

          <li><a class="nav-link" href="{{route('admin.home.index')}}"><i class="far fa-tachometer-slowest"></i> <span>Dashboard</span></a></li>

          <li class="menu-header">Akun</li>
          <li><a class="nav-link" href="{{route('admin.admin.index')}}"><i class="fal fa-unlock-alt"></i> <span>Admin</span></a></li>
          <li><a class="nav-link" href="{{route('admin.admin.index')}}"><i class="fas fa-user"></i> <span>Siswa</span></a></li>

          <li class="menu-header">Kelas</li>
          <li><a class="nav-link" href="{{route('admin.class.index')}}"><i class="fas fa-users-class"></i><span>Data Kelas</span></a></li>

          <li class="menu-header">Siswa</li>
          <li><a class="nav-link" href="{{route('admin.student.index')}}"><i class="fad fa-user-graduate"></i> <span>Data Siswa</span></a></li>

          <li class="menu-header">Konfigurasi</li>
          <li><a class="nav-link" href="{{route('admin.npsn.index')}}"><i class="fas fa-sort-numeric-up-alt"></i> <span>NPSN</span></a></li>

        </ul>
    </aside>
  </div>