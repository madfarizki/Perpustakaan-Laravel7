@extends('layouts.master')
@section('title', 'Data Siswa')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Siswa</h1>
    </div>
    <a href="{{ route('peminjaman.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('peminjaman.update', $borrowing->id)  }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">      
                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input
                        type="date"
                        name="return_date"
                        class="form-control"
                        value="{{ $borrowing->return_date ?? old('return_date') }}"
                        required
                    />
                </div>
            <button type="submit" class="btn btn-icon icon-left btn-primary">
              Update
          </button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection