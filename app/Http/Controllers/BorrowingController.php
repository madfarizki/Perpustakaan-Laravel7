<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrowing;
use App\Student;
use App\Book;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $borrowing = Borrowing::all();

        return view('pages.admin.peminjaman.index',[
            'borrowings' => Borrowing::orderBy('borrow_code', 'ASC')->paginate(5)
        ]);
    }

    public function barcode(Request $request)
    {
        $barcode = $request->get('barcode');
        if($request->ajax()) {
            $data = '';
            $qry = DB::select("SELECT * FROM books where barcode='$barcode'");
            foreach ($qry as $pgw) {
                $data = array(
                    'book_code'  =>  $pgw->book_code,
                    'name'  =>  $pgw->name,
                    // 'cover'  =>  $pgw->image,
                    'author' =>  $pgw->author,
                    'isbn' =>  $pgw->isbn,
                    'id' =>  $pgw->id,
                    );
            }
            echo json_encode($data);
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $number = Borrowing::count();

        if($number > 0) {
            $number = Borrowing::max('borrow_code');
            $strnum = substr($number, 3, 3);
            $strnum = $strnum + 1;
            if(strlen($strnum) == 3) {
                $kode = 'PNJ' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PNJ' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PNJ' . "00". $strnum;
            }
        } else {
            $kode = 'PNJ' . "001";
        }


        return view('pages.admin.peminjaman.create', [
            'kode' => $kode,
            'students' => Student::orderBy('name', 'ASC')->get(),
            'books' => Book::where('stock', '>=', '1')->orderBy('book_code', 'ASC')->get(),
        ]);
    }

    public function loadData(Request $request)
    {
    	// if ($request->has('q')) {
    	// 	$cari = $request->q;
    	// 	$data = DB::table('books')->select('id', 'barcode')->where('barcode', 'LIKE', '%$cari%')->get();
    	// 	return response()->json($data);
    	// }

        $search = $request->get('search');

        $books = Book::where('name', 'LIKE', '%'. $search. '%')->orWhere('author', 'LIKE', '%'. $search. '%')->get();

        return view('pages.admin.peminjaman.create', [
            'books' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // $data = Book::where('id', $request->book_id)
        // ->update([
        //     'stock' => ($request->stock - 1),
        // ]);
        $book = DB::table('books')->where('id', $request->book_id)->get();
        
        $sum = Book::findOrFail($request->book_id);
        Book::where('id', $request->book_id)->update([
            'stock' => $sum->stock - 1
        ]);

       

        $data = $request->all();
        $data['book_id'] = $request->book_id;
        
      
        // Borrowing::create($request->all());
        Borrowing::create($data);
        Alert::success('Berhasil', ' Buku berhasil dipinjam');
        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Borrowing::findOrFail($id);
        $sum = Book::findOrFail($data->book_id);
        Book::where('id', $data->book_id)->update([
            'stock' => $sum->stock + 1
        ]);
        $data->delete();
        
        Alert::success('Berhasil', ' Buku Berhasil dikembalikan');
        return back();
    }
}
