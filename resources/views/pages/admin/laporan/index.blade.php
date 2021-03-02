@extends('layouts.master')
@section('title', 'Laporan')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan</h1>
    </div>
    <!-- <div class="row">
      <div class="col">
        <form action="/admin/search/peminjaman" method="GET" class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Cari Peminjaman" aria-label="Search" name="search" data-width="250">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
      </div>
    </div> -->
  
    <a href="{{ route('laporan.generate.pdf') . '?borrow_date=' . request('borrow_date') }}" target="_blank" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-file-pdf"></i>Export PDF</a>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.laporan.search') }}" method="get" enctype="multipart/form-data">
              <label>Cari berdasarkan Tanggal Pinjam :</label>
              <div class="input-group">
                <input type="date" name="borrow_date" autofocus id="barcode" class="form-control " onfocus="this.value"=""
                  required />
                  <button type="submit" class="btn btn-primary ml-3" id="btn">
                    Cari
                  </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="book-table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Piminjaman</th>
                  <th>Nama Siswa</th>
                  <th>Nama Buku</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                </tr>
              </thead>
              @if(request('borrow_date'))
              @forelse($borrowings as $borrow)
              <tbody>
                <tr>
                  <td>{{ $autoNum++ . "." }} </td>
                  <td>{{ $borrow->borrow_code }}</td>
                  <td>{{ $borrow->student->name }}</td>
                  <td>{{ $borrow->book->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($borrow->return_date)->format('d-m-Y') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center">
                    Laporan Peminjaman Pada <b>{{ request('borrow_date') }} Tidak Ada! </b>
                  </td>
                </tr>

              </tbody>
              @endforelse
              @else
              <tr>
                <td colspan="7" class="text-center">
                  Silahkan cari laporan berdasarkan tanggal Peminjaman
                </td>
              </tr>
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection