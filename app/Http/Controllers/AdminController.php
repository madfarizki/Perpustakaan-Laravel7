<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Student;



class AdminController extends Controller
{
    public function index() {

        
        return view('pages.dashboard', [
            'book' => Book::count(),
            'student' => Student::count()
        ]);

    }
}
