@extends('layouts.master')
@section('title', 'Data Petugas')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data Petugas</h1>
    </div>
    <a href="{{ route('petugas.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">      
            <div class="form-group">
              <label>Nama Petugas</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@gmail.com" required>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select
                class="form-control"
                name="role" required>
                <option disabled selected>Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            </div>
            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input id="password-confirm" type="password" class="form-control " name="password_confirmation" required autocomplete="new-password">
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