<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    
  </form>
  <ul class="navbar-nav navbar-right">
      <div class="d-sm-none d-lg-inline-block text-white">Hi, {{ Auth::user()->name}} </div></a>
  </ul>
</nav>