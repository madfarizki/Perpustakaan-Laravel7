@extends('layouts.master')
@section('title', 'Laporan')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan</h1>
    </div>
    <!-- <div class="row">
      <div class="col">
        <form action="/admin/search/peminjaman" method="GET" class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Cari Peminjaman" aria-label="Search" name="search" data-width="250">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
      </div>
    </div> -->
  
    <a href="{{ route('laporan.generate.pdf') . '?borrow_date=' . request('borrow_date') }}" target="_blank" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-file-pdf"></i>Export PDF</a>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            
              <label>Cari berdasarkan Tanggal Pinjam :</label>
              <div class="row input-daterange">
                <div class="col-md-4">
                    <input type="text" name="date" id="date" class="form-control" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="order_table" class="table table-bordered" width="100%" collspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Piminjaman</th>
                  <th>Nama Siswa</th>
                  <th>Nama Buku</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                </tr>
              </thead>

            
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@push('addon-script')
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
      $(function() {
        
      $('input[name="date"]').daterangepicker({
        opens: 'bottom',
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        $('#order_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url:'{{ route("report.order") }}',
          data:{start:start, end:end},
        },
        columns: [
          
          {data: 'borrow_code', name: 'borrow_code' },
          {data: 'student.name', name: 'name' },
          {data: 'book.name', name: 'name' },
          {data: 'borrow_date', name: 'borrow_date' },
          {data: 'return_date', name: 'return_date' },
          
        ]
        });
      });

    });
    $('#date').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
      start_date=picker.startDate.format('DD/MM/YYYY');
      end_date=picker.endDate.format('DD/MM/YYYY');
      $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
      $dTable.draw();
    });

    $('#date').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      start_date='';
      end_date='';
      $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
      $dTable.draw();
    });

</script>
@endpush