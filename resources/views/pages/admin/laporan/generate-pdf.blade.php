<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <center>
        <h1>Perpustakaan SMKN 1 SUBANG</h1>
        <h2>Laporan Peminjaman Buku</h2>
        <em>Pada Tanggal : {{ request('borrow_date') }}</em>
        <hr style="width: 30%; margin-bottom: 15px;">
        <table border="1" cellspacing="0" cellpading="5" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Siswa</th>
                    <th>Nama Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
                @if(request('borrow_date'))
                    @forelse ($borrowings as $borrow)
                        <tr>
                            <th>{{ $autoNum++ . "." }}</th>
                            <td>{{ $borrow->borrow_code }}</td>
                            <td>{{ $borrow->student->name }}</td>
                            <td>{{ $borrow->book->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($borrow->return_date)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 15px;"><p style="color: red;">Laporan Peminjaman pada <b>{{ request('borrow_date') }}</b> Kosong!</p></td>
                        </tr>
                    @endforelse
                @else
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 15px;"><p style="color: red;">Laporan Peminjaman Kosong!</p></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </center>
</body>
</html>
