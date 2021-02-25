@extends('layouts.master')
@section('title', 'Data Buku')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Buku</h1>
    </div>
    <a href="{{ route('buku.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('buku.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Kode Buku</label>
              <input type="text" name="book_code" class="form-control" readonly value="{{ $book->book_code }}" required>
            </div>            
            <div class="form-group">
              <label>Barcode</label>
              <input type="text" name="barcode" class="form-control" value="{{ $book->barcode ?? old('barcode') }}" required>
            </div>
            <div class="form-group">
              <label>Judul Buku</label>
              <input type="text" name="name" class="form-control" value="{{ $book->name ?? old('name') }}" required>
            </div>
            <div class="form-group">
              <label>Cover Buku</label>
              <input type="file" name="image" class="form-control" value="{{ old('image') }}" required>
            </div>
            <div class="form-group">
              <label>Penulis Buku</label>
              <input type="text" name="author" class="form-control" value="{{ $book->author ?? old('author') }}" required>
            </div>
            <div class="form-group">
              <label>Penerbit</label>
              <input type="text" name="publisher" class="form-control" value="{{ $book->publisher ?? old('publisher') }}" required>
            </div>
            <div class="form-group">
              <label>Tahun Terbit</label>
              <input type="year" name="publication_year" class="form-control" maxlength="4" value="{{ $book->publication_year ?? old('publication_year') }}" required>
            </div>
            <div class="form-group">
              <label>ISBN</label>
              <input type="text" name="isbn" class="form-control" value="{{ $book->isbn ?? old('isbn') }}" required>
            </div>
            <div class="form-group">
              <label>Stok Buku</label>
              <input type="number" name="stock" class="form-control" value="{{ $book->stock ?? old('stock') }}" required>
            </div>
            <button type="submit" class="btn btn-icon icon-left btn-primary">
              Simpan
          </button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection