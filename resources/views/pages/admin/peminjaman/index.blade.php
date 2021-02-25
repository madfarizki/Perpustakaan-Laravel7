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
  
  </section>
</div>
@endsection