@extends('layouts.master')
@section('title', 'Data Buku')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Buku</h1>
    </div>
    <a href="{{ route('buku.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body align-items-center d-flex justify-content-center">
            <img src="{{ Storage::url($item->image) }}" alt="" style="width: 300px">
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h2 class="mb-4">{{ $item->name}}</h2>
            <h5 class="text-muted">Kode Buku: {{ $item->book_code}}</h5>
            <h5 class="text-muted">Barcode: {{ $item->barcode}}</h5>
            <h5 class="text-muted">Penulis: {{ $item->author}}</h5>
            <h5 class="text-muted">Penerbit: {{ $item->publisher}}</h5>
            <h5 class="text-muted">Tahun Terbit: {{ $item->publication_year}}</h5>
            <h5 class="text-muted">ISBN: {{ $item->isbn}}</h5>
            <h5 class="text-muted">Stok: {{ $item->stock}}</h5>
            

          </div>
        </div>
      </div>
    </div>
    
  </section>
</div>
@endsection