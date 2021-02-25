@extends('layouts.master')
@section('title', 'Data Buku')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Buku</h1>
    </div>
    <div class="row">
      <div class="col">

        <a href="{{ route('buku.create')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-plus"></i>Tambah Buku</a>
      </div>
      <div class="col">
        <form action="/admin/search" method="GET">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
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
                      <th>Kode Buku</th>
                      <th>Judul Buku</th>
                      <th>Cover</th>
                      <th>ISBN</th>
                      <th>Stok</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($books as $bk)
                <tr>
                <td>{{ $bk->book_code }}</td>
                <td>{{ $bk->name }}</td>
                <td><img src="{{ Storage::url($bk->image) }} " alt="" style="width: 100px" class="img-thumbnail"/></td>
                <td>{{ $bk->isbn }}</td>
                <td>{{ $bk->stock }}</td>
                <td>
                  <a href="{{ route('buku.show', $bk->id) }} " class="btn btn-sm btn-info">
                    <i class="fas fa-eye" ></i>
                  </a>
                  <a href="{{ route('buku.edit', $bk->id) }} " class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil-alt" ></i>
                  </a>
                  <form action="{{ route('buku.destroy', $bk->id)}} " method="POST">
                  @csrf
                  @method('delete')
                  <button class="mt-2 btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                  </form>
                
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection