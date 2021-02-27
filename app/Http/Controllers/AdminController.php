<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Student;
use App\Borrowing;



class AdminController extends Controller
{
    public function index() {

        
        return view('pages.dashboard', [
            'book' => Book::count(),
            'student' => Student::count(),
            'borrowing' => Borrowing::count(),
            'petugas' => User::where('role', '=', 'petugas')->count(),
        ]);

    }
}
