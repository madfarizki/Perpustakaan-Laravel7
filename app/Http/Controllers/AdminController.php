<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Student;
use App\Borrowing;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index() {

        $trendings = Borrowing::select('book_id')
        ->groupBy('book_id')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(3)
        ->get();

        return view('pages.dashboard', [
            'book' => Book::count(),
            'student' => Student::count(),
            'students' => Student::get(),
            'borrowing' => Borrowing::count(),
            'denda' => Borrowing::where('return_date', '<', Carbon::now())->orderBy('borrow_code', 'ASC')->count(),
            'users'=> User::get(),
            'trendings' => $trendings,
            'new_book' => Book::orderBy('created_at', 'desc')->limit(5)->get(),
        ]);

    }
}
