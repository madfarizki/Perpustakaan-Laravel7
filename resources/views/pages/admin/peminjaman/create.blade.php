@extends('layouts.master')
@section('title', 'Peminjaman Buku')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Buku</h1>
    </div>
    <a href="{{ route('peminjaman.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Kode Pinjam</label>
                <input type="text" name="borrow_code" class="form-control" readonly value="{{ $kode }}" required>
              </div>
              {{-- <div class="form-group">
                <label>Barcode Buku</label>
                <input type="text" name="book_id" class="form-control" required>
              </div> --}}
              <div class="form-group">
                <label>Nama Siswa</label>
                <select
                  class="form-control"
                  name="student_id" required
                >
                  <option disabled selected>Pilih Nama Siswa</option>
                  @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Nama Siswa</label>
                <select
                  class="form-control"
                  name="book_id" required
                >
                  <option disabled selected>Pilih Nama Siswa</option>
                  @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="borrow_date" class="form-control" value="{{ old('borrow_date') }}" required>
              </div>
              <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="return_date" class="form-control" value="{{ old('return_date') }}" required>
              </div>
              <button type="submit" class="btn btn-icon icon-left btn-primary">
                Simpan
            </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">           
          
          </div>
        </div>
      </div>
    </div>
    
  </section>
</div>
@endsection
@push('new')

@endpush