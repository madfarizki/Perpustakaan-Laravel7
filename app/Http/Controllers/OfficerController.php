<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use RealRashid\SweetAlert\Facades\Alert;



class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('pages.admin.petugas.index', [
            'users' => $users
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        $users = User::where('name', 'LIKE', '%'. $search. '%')->orWhere('role', 'LIKE', '%'. $search. '%')->get();

        // $books = Book::whereLike(['name', 'author'], '%'. $search. '%')->get();

        return view('pages.admin.petugas.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        
        ]);

        $user = $request->all();

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->password),
        
        ]);


        Alert::success('Berhasil', ' Petugas Baru Berhasil ditambahkan');
        return redirect()->route('petugas.index');
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
        $user = User::findOrFail($id);
        
        return view('pages.admin.petugas.edit', [
            'user' => $user
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
        $data = $request->all();

        $user = User::findOrFail($id);

        $user->update($data);
        Alert::success('Berhasil', ' Petugas Berhasil diperbarui');
        return redirect()->route('petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        
        $data->delete();
        Alert::success('Berhasil', ' Petugas Berhasil dihapus');
        return back();
    }
}
