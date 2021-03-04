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
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row input-daterange">
              <div class="col-md-4">
                <label>Cari berdasarkan Tanggal Pinjam :</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-calendar-alt fa-2x"></i>
                    </div>
                  </div>
                  <input
                      type="text"
                      name="date"
                      id="datesearch"
                      class="form-control datesearchbox"
                      placeholder="01/03/2021 - 03/03/2021" readonly
                  />
                </div>
              </div>
              <div class="col-md-4">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body table-responsive-sm">
            <table id="tableData" class="table table-bordered tableData" width="100%" collspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Piminjaman</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Nama Buku</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;?>
              @foreach($orders as $or)
                <tr>
                  <td>{{ ++$no . "." }} </td>
                  <td>{{ $or->borrow_code }} </td>
                  <td>{{ $or->student->name }} </td>
                  <td>{{ $or->student->class }} </td>
                  <td>{{ $or->book->name }} </td>
                  <td>{{ \Carbon\Carbon::parse($or->borrow_date)->format('d/m/Y') }} </td>
                  <td>{{ \Carbon\Carbon::parse($or->return_date)->format('d/m/Y') }} </td>
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
@push('addon-script')
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- button export -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<script type="text/javascript">
  var start_date;
  var end_date;
  var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
    var dateStart = parseDateValue(start_date);
    var dateEnd = parseDateValue(end_date);
    
    var evalDate= parseDateValue(aData[5]);
      if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
           ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
           ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
           ( dateStart <= evalDate && evalDate <= dateEnd ) )
      {
          return true;
      }
      return false;
});

function parseDateValue(rawDate) {
    var dateArray= rawDate.split("/");
    var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11   
    return parsedDate;
}    

$( document ).ready(function() {
 var $dTable = $('#tableData').DataTable({
  dom: "Bfrtip" ,
    buttons : [
      'pdfHtml5',
      'excelHtml5',
      'csvHtml5',
      ],

  
 });

 $(".datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Cari berdasarkan tanggal"> </div>');

 $('#datesearch').daterangepicker({
    autoUpdateInput: false
  });

  $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
     $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
     start_date=picker.startDate.format('DD/MM/YYYY');
     end_date=picker.endDate.format('DD/MM/YYYY');
     $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
     $dTable.draw();
  });

  $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    start_date='';
    end_date='';
    $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
    $dTable.draw();
  });
});
</script>
@endpush