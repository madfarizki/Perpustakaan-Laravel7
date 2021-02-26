@extends('layouts.master')
@section('title', 'Peminjaman Buku')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Peminjaman Buku</h1>
    </div>
    <a href="{{ route('peminjaman.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah Peminjaman</a>
  
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="book-table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                  <tr>
                      <th>Kode Peminjaman</th>
                      <th>Nama Siswa</th>
                      <th>Judul Buku</th>
                      <th>Tanggal Pinjam</th>
                      <th>Tanggal Kembali</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection