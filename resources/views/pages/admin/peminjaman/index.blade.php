@extends('layouts.master')
@section('title', 'Peminjaman Buku')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Peminjaman Buku</h1>
    </div>
    <div class="row">
      <div class="col">

        <a href="{{ route('peminjaman.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah Peminjaman</a>
      </div>
      <div class="col">
        
        <form action="/admin/search/peminjaman" method="GET" class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Cari Peminjaman" aria-label="Search" name="search" data-width="250">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>

      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="book-table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Kode Peminjaman</th>
                      <th>Nama Siswa</th>
                      <th>Judul Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($borrowings as $borrow)
                <tr>
                  <td>{{ ++$no . "." }} </td>
                  <td>{{ $borrow->borrow_code }}</td>
                  <td>{{ $borrow->student->name }}</td>
                  <td>{{ $borrow->book->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($borrow->return_date)->format('d-m-Y') }}</td>
                  <td>
                    <a href="{{ route('peminjaman.edit', $borrow->id) }} " class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="right" title="Perpanjang">
                      <i class="far fa-calendar-plus" ></i>
                    </a>
                    <form action="{{ route('peminjaman.destroy', $borrow->id)}} " method="POST">
                    @csrf
                    @method('delete')
                    <button class="mt-2 btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Kembalikan" onclick="return confirm('Apakah anda yakin ingin mengembalikan buku yang dipilih?');">
                      <i class="fas fa-undo"></i>
                    </button>
                    </form>
                  
                  </td>
                @empty
                <tr>
                  <td colspan="7" class="text-center">
                      Data Kosong
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection