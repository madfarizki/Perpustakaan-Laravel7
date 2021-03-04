<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrowing;
use App\Book;
use PDF;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function borrowingReport(Request $request) {       

        $orders = Borrowing::with('book', 'student')->get();

        return view('pages.admin.laporan.index', [
            'orders' => $orders
        ]);
    }

}