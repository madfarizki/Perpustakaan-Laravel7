@extends('layouts.master')
@section('title', 'Dashboard')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jumlah Buku</h4>
            </div>
            <div class="card-body">
              {{ $book }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-book-reader"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jumlah Pinjaman</h4>
            </div>
            <div class="card-body">
              {{ $borrowing }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jumlah Siswa</h4>
            </div>
            <div class="card-body">
              {{ $student }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-user-cog"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Jumlah Petugas</h4>
            </div>
            <div class="card-body">
              {{ $petugas }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Buku Paling Banyak dipinjam</h4>
          </div>
          <div class="card-body">
            <div class="row">
              @forelse($trendings as $trending)
                
              <div class="col text-center">
                <img src="{{ Storage::url($trending->book->image) }}" class="" width="80" alt="">
                <h6 class="mt-2 font-weight-bold">{{$trending->book->name}}</h6>
                <div class="text-muted text-small"><span class="text-primary"></span> {{$trending->book->author}}</div>
              </div>
              @empty
              <div class="col text-center">
                <p class=" text-muted">Data Kosong</p>
              </div>
              @endforelse
            </div>
          </div>
        </div>
          <div class="card">
            <div class="card-header">
              <h4>Buku Terbaru</h4>
              <div class="card-header-action">
                <a href="{{ route('buku.index')}} " class="btn btn-primary">Lihat Semua</a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table mb-0 ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Penulis</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0;?>
                    @foreach($new_book as $new)
                      
                    <tr>
                      <td>{{ ++$no}} </td>
                      <td>
                        {{ $new->name}}
                      </td>
                      <td>{{ $new->author}}</td>
                      <td>
                        <a href="{{ route('buku.show', $new->id) }} " class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="right" title="Lihat Detail">
                          <i class="fas fa-eye" ></i>
                        </a>                      
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Petugas dan Admin</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
              @foreach($users as $us)
              <li class="media">
                <div class="col-6 col-sm-3 col-lg-4">
                  <div class="avatar-item mb-0">
                    <img alt="image" src="{{ asset('../assets/img/avatar/avatar-1.png')}} " class="img-fluid">
                    <div class="avatar-badge" title="Admin" data-toggle="tooltip"><i class="fas fa-cog"></i></div>
                  </div>
                </div>
                <div class="media-body m-auto">
                  <div class="media-title">{{ $us->name}}</div>
                  <div class="text-muted">{{ $us->email}}</div>
                  
                </div>
              </li>
              @endforeach
            </ul>
            
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Siswa</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
              @foreach($students as $student)
              <li class="media">
                <div class="col-6 col-sm-3 col-lg-4">
                  <div class="avatar-item mb-0">
                    <img alt="image" src="{{ asset('../assets/img/avatar/avatar-2.png')}} " class="img-fluid">
                    
                  </div>
                </div>
                <div class="media-body m-auto">
                  <div class="media-title">{{ $student->name}}</div>
                  <div class="text-muted">{{ $student->class}}</div>
                  
                </div>
              </li>
              @endforeach
            </ul>
            
          </div>
        </div>
        
      </div>
    </div>
  
  </section>
</div>
@endsection