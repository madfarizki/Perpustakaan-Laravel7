<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('admin')}}">Perpus Nesas</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('admin')}}">PN</a>
    </div>
    <ul class="sidebar-menu">
        <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
          <a href="{{ url('admin')}}" class="nav-link"><i class="fas fa-school"></i><span>Dashboard</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/buku') ? 'active' : '' }}"><a class="nav-link" href="{{ route('buku.index')}} "><i class="fas fa-book"></i> <span>Buku</span></a></li>
        <li class="nav-item {{ Request::is('admin/siswa') ? 'active' : '' }}"><a class="nav-link" href="{{ route('siswa.index')}} "><i class="fas fa-users"></i> <span>Siswa</span></a></li>
        <li class="nav-item {{ Request::is('admin/peminjaman') ? 'active' : '' }}"><a class="nav-link" href="{{ route('peminjaman.index')}} "><i class="fas fa-book-reader"></i> <span>Peminjaman</span></a></li>
        <li class="nav-item {{ Request::is('admin/denda') ? 'active' : '' }}"><a class="nav-link" href="{{ route('denda')}} "><i class="fas fa-calendar-times"></i> <span>Denda</span></a></li>       
        <li class="nav-item {{ Request::is('admin/laporan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('peminjaman.index')}} "><i class="fas fa-file-alt"></i> <span>Laporan</span></a></li>

      
        <div class="px-3 " style="margin-top: 230px">
          <form action="{{ url ('logout')}}" method="POST">
          @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm btn-block ">
              <i class="fas fa-sign-out-alt"></i> <span class="hide-sidebar-mini">Logout</span>
            </button>
          </form>
        </div>
      </ul>
  </aside>
</div>