<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Datatables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        
        return view('pages.admin.buku.index', [
            'books' => $books
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        $books = Book::where('name', 'LIKE', '%'. $search. '%')->orWhere('author', 'LIKE', '%'. $search. '%')->get();

        // $books = Book::whereLike(['name', 'author'], '%'. $search. '%')->get();

        return view('pages.admin.buku.index', [
            'books' => $books
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $number = Book::count();

        // $book = Book::all();
        if($number > 0) {
            $number = Book::max('book_code');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if(strlen($strnum) == 3) {
                $kode = 'BK' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'BK' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'BK' . "00". $strnum;
            }
        } else {
            $kode = 'BK' . "001";
        }

        return view('pages.admin.buku.create', [
            'kode' => $kode
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
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/cover', 'public'
        );

        Book::create($data);
        Alert::success('Berhasil', ' Buku Baru Berhasil ditambahkan');
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Book::findOrFail($id);

        return view('pages.admin.buku.detail', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Book::findOrFail($id);

        return view('pages.admin.buku.edit', [
            'book' => $data
        ]);
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

        $request->validate([
            'image' => 'required'
        ]);

        $data = $request->all();

        $data['image'] = $request->file('image')->store(
            'assets/cover', 'public'
        ); 

        $book = Book::findOrFail($id);

        $book->update($data);

        Alert::success('Berhasil', ' Buku Berhasil diperbarui');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Book::findOrFail($id);

        $data->delete();

        Alert::success('Berhasil', ' Buku Berhasil dihapus');
        return back();
    }
}
