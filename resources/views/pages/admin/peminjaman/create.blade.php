@extends('layouts.master') @section('title', 'Peminjaman Buku')
@section('content')
<!-- Main Content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Peminjaman Buku</h1>
        </div>
        <a
            href="{{ route('peminjaman.index') }}"
            class="btn btn-icon icon-left btn-primary mb-4"
            ><i class="fas fa-arrow-left"></i>Kembali</a
        >

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <!-- barcode -->
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <form action="">
                                <label>Scan Barcode Buku</label>
                                <input
                                    type="text"
                                    name="barcode"
                                    autofocus
                                    id="barcode"
                                    class="form-control"
                                    onfocus="this.value"
                                    =""
                                    required
                                />
                                <button
                                    type="submit"
                                    class="btn btn-primary d-none"
                                    id="btn"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                        <form class="form-shopping-cart form-product">
                            <div class="table-responsive">
                                <table
                                    id="book-table"
                                    class="table table-bordered"
                                    width="100%"
                                    collspacing="0"
                                >
                                    <thead>
                                        <tr>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Penulis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                        <td> <input type="text" class="form-control border-0 border-0" name="name" id="name" readonly="true"/></td>
                        <td> <input type="text" class="form-control border-0 border-0" name="cover" id="cover" readonly="true"/></td>
                      </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                    <!-- Proses Transaksi -->
                    <!-- <div class="card-body">
                <div class="row">
                <div class="col-md-8">
                    <div id="show-pay" style="background: #d71149; color:#ffffff; font-size:80px;
                    text-align: center; height: 100px"></div>
                    <div id="show-spelling" style="background: #ffffff; color: #d71149; font-weight:bold; border:5px solid #d71149; padding: 10px"></div>
                </div>
                <div class="col-md-4">
                    <form class="form form-horizontal form-purchase" method="POST" action="">
                        {{csrf_field()}}
                        <input type="hidden" name="purchase_id" value="">
                        <input type="hidden" name="total" id="total">
                        <input type="hidden" name="total_item" id="total_item">
                        <input type="hidden" name="pay" id="pay">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <div class="section-title">Total</div>
                                <input type="text" class="form-control" id="total_rp" readonly>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <div class="section-title">Diskon</div>
                                <input type="number" class="form-control" id="discount" name="discount" value="0">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <div class="section-title">Bayar</div>
                                <input type="text" class="form-control" id="pay_rp" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary save">SIMPAN TRANSAKSI</button>
                        </div>
                    </form>
                </div>
                </div>
            </div> -->
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <!-- tanggal pinjam -->
                <div class="card">
                    <form
                        action="{{ route('peminjaman.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <!-- <input type="hidden" name="book_id" value=""> -->
                                <label>Kode Pinjam</label>
                                <input
                                    type="sub"
                                    name="borrow_code"
                                    class="form-control"
                                    readonly
                                    value="{{ $kode }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label>Nama Siswa</label>

                                <select
                                    class="form-control"
                                    name="student_id"
                                    required
                                >
                                    <option disabled selected>
                                        Pilih Nama Siswa
                                    </option>
                                    @foreach ($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="form-group">
                  <label>Nama Buku</label>
                  <select
                    class="form-control"
                    name="book_id" required>
                    <option disabled selected>Pilih Buku</option>
                    @foreach ($books as $book)
                      <option value="{{ $book->id }}">{{ $book->name }}</option>
                    @endforeach
                  </select>
                </div> -->

                            <div class="form-group">
                                <label>Tanggal Pinjam</label>
                                <input
                                    type="date"
                                    name="borrow_date"
                                    class="form-control"
                                    value="{{ old('borrow_date') }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kembali</label>
                                <input
                                    type="date"
                                    name="return_date"
                                    class="form-control"
                                    value="{{ old('return_date') }}"
                                    required
                                />
                            </div>
                            <button
                                type="submit"
                                class="btn btn-icon icon-left btn-primary"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            // $(document).ready(function(){

            // $('#barcode').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
            // var npmfromfield = $('#barcode').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
            // $.ajax({        // Memulai ajax
            //   method: "GET",
            //   url: "{{ route('find.barcode') }}",    // file PHP yang akan merespon ajax
            //   data: { npm: npmfromfield}   // data POST yang akan dikirim
            // })
            //   .done(function( hasilajax ) {   // KETIKA PROSES Ajax Request Selesai
            //       $('#name').val(hasilajax);  // Isikan hasil dari ajak ke field 'nama'
            //   });
            // })
            // });

            var delay = (function () {
                var timer = 0;
                return function (callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();
            $(function () {
                $(":input:first").focus();
            });

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Content-Type": "multipart/form-data",
                },
            });

            //  new

            $(document).ready(function () {
                $("#btn").click(function (e) {
                    e.preventDefault();
                    var barcode = $("#barcode").val();
                    $.ajax({
                        url: "{{ route('find.barcode') }}",
                        method: "GET",
                        data: "barcode=" + barcode,
                    }).done(function (data) {
                        var json = data,
                            obj = JSON.parse(json);

                        //  $('#cover').attr('src', "{{ Storage::url('public/') }}" + obj.cover);

                        $(".form-group").append(
                            '<input type="hidden" name="book_id" value="' +
                                obj.id +
                                '" />'
                        );
                        $("tbody").append(
                            "<tr>" +
                                "<td>" +
                                obj.book_code +
                                "</td>" +
                                "<td>" +
                                obj.name +
                                "</td>" +
                                "<td>" +
                                obj.author +
                                "</td>" +
                                "</tr>"
                        );
                    });
                });
            });

            // old
            //  $("#barcode").keyup(function () {
            //      delay(function () {
            //          var barcode = $("#barcode").val();
            //          $.ajax({
            //              url: "{{ route('find.barcode') }}",
            //              method:'GET',
            //              data:"barcode="+barcode ,
            //          }).done(function (data) {
            //              var json = data,
            //              obj = JSON.parse(json);

            //             //  $('#cover').attr('src', "{{ Storage::url('public/') }}" + obj.cover);

            //               $('.form-group').append('<input type="hidden" name="book_id" value="' + obj.id + '" />');
            //              $('tbody').append(

            //              "<tr>"+

            //               "<td>" + obj.book_code + "</td>"+
            //               "<td>" + obj.name + "</td>"+
            //               "<td>" + obj.author + "</td>"+
            //               "<td>" + obj.isbn + "</td>"+

            //               "</tr>");
            //          });
            //      }, 1000);
            //  });
        </script>
    </section>
</div>
@endsection @push('new') @endpush
