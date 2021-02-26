<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrowing;
use App\Student;
use App\Book;


class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.peminjaman.index');
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
            'books' => Book::where('stock', '>=', '1')->orderBy('book_code', 'ASC')->get()
        ]);
    }

    public function loadData(Request $request)
    {
    	if ($request->has('q')) {
    		$cari = $request->q;
    		$data = DB::table('books')->select('id', 'barcode')->where('barcode', 'LIKE', '%$cari%')->get();
    		return response()->json($data);
    	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
