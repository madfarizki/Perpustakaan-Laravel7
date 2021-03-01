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
        <form action="/admin/search" method="GET" class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Cari Buku" aria-label="Search" name="search" data-width="250">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
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
                     <th>No</th>
                      <th>Kode Buku</th>
                      <th>Judul Buku</th>
                      <th>Cover</th>
                      <th>ISBN</th>
                      <th>Stok</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($books as $bk)
                <tr>
                <td>{{ ++$no }} </td>
                <td>{{ $bk->book_code }}</td>
                <td>{{ $bk->name }}</td>
                <td><img src="{{ Storage::url($bk->image) }} " alt="" style="width: 100px" class="img-thumbnail"/></td>
                <td>{{ $bk->isbn }}</td>
                <td>{{ $bk->stock }}</td>
                <td>
                  <a href="{{ route('buku.show', $bk->id) }} " class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Detail">
                    <i class="fas fa-eye" ></i>
                  </a>
                  <a href="{{ route('buku.edit', $bk->id) }} " class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil-alt" ></i>
                  </a>
                  <form action="{{ route('buku.destroy', $bk->id)}} " method="POST" >
                  @csrf
                  @method('delete')
                  <button class="mt-2 btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                  </form>
                
                </td>
                </tr>
                @empty
                  <tr>
                      <td colspan="7" class="text-center">
                          Data Kosong
                      </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection