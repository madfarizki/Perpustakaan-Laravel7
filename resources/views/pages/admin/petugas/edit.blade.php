@extends('layouts.master')
@section('title', 'Data Petugas')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Petugas</h1>
    </div>
    <a href="{{ route('petugas.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('petugas.update', $user->id)  }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">      
            
            <div class="form-group">
              <label>Nama Petugas</label>
              <input type="text" name="name" class="form-control" value="{{ $user->name ?? old('name') }}" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="{{ $user->email ?? old('email') }}" placeholder="10-RPL-1" required>
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