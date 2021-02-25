@extends('layouts.master')
@section('title', 'Data Siswa')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data Siswa</h1>
    </div>
    <a href="{{ route('siswa.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">      
            <div class="form-group">
              <label>NIS</label>
              <input type="text" name="nis" class="form-control" value="{{ old('nis') }}" placeholder="11901214" required>
            </div>
            <div class="form-group">
              <label>Nama Siswa</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select
                class="form-control"
                name="gender" required>
                <option disabled selected>Pilih Jenis Kelamin</option>
                <option value="0">Laki - Laki</option>
                <option value="1">Perempuan</option>
            </select>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <input type="text" name="class" class="form-control" value="{{ old('class') }}" placeholder="10-RPL-1" required>
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