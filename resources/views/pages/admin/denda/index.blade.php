@extends('layouts.master')
@section('title', 'Denda')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Denda</h1>
    </div>
        
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="book-table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Denda Sebesar</th>
                      <th>Telat (Hari)</th>
                      <th>Kode Peminjaman</th>
                      <th>Nama Siswa</th>
                      <th>Judul Buku</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
                @forelse($borrowings as $borrow)
                <tr>
                <td>{{ ++$no . "." }} </td>
                @php
                $return = date_create($borrow['return_date']);
                $date = date_create(date('Y-m-d'));
                $late = date_diff($return, $date);
                $day = $late->format("%a");
                // fine calculate
                $fine = $day * 1000;
                @endphp
                  <td> {{ "Rp " . number_format($fine, 0,',','.') }}</td>
                  <td><p class="my-auto list-group-item-danger text-center rounded">{{ $day . " Hari" }}</p></td>
                  <td>{{ $borrow->borrow_code }}</td>
                  <td>{{ $borrow->student->name }}</td>
                  <td>{{ $borrow->book->name }}</td>
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