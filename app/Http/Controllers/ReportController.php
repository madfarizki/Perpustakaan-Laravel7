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
    public $autoNumber = 1;

    public function borrowingReport(Request $request) {
        $start = $request->get('startDate');
        $end = $request->get('endDate');

        // $start = date('2021-02-28');
        // $end = date('2021-03-1');

        if($request->ajax()) {
            $data = '';
            $qry = Borrowing::whereBetween('borrow_date',[$start,$end])->with('book', 'student')->get();
            foreach ($qry as $pgw) {
                $data = array(
                    'borrow_code'  =>  $pgw->borrow_code,
                    'book_name'  =>  $pgw->book->name,
                    'student_name'  =>  $pgw->student->name,
                    'borrow_date'  =>  $pgw->borrow_date,
                    'return_date'  =>  $pgw->return_date,
                    );
            }
            echo json_encode($data);
        }       

        $orders = Borrowing::whereBetween('borrow_date', [$start, $end])->get();

        return view('pages.admin.laporan.index', [
            'orders' => $orders
        ]);
    }

    public function borrowingReportSearch() {

        $search = request('borrow_date');
        return view('pages.admin.laporan.index', [
            'autoNum' => $this->autoNumber,
            'borrowings' => Borrowing::with(
                'student', 
                'book'
            )
            ->orderBy('borrow_code', 'ASC')
            ->where('borrow_date', $search)
            ->get()
        ]);
    }

    public function generateReportPdf() {

        $search = request('borrow_date');
        $borrowings = Borrowing::with(
            'student',
            'book'
        )
        ->orderBy('borrow_code', 'ASC')
        ->where('borrow_date', $search)
        ->get();

        $pdf = PDF::loadview('pages.admin.laporan.generate-pdf', [
            'autoNum' => $this->autoNumber,
            'borrowings' => $borrowings
        ]);

        return $pdf->stream('Laporan Peminjaman.pdf');
    }

    public function orderReport(Request $request) {

        // $start = date('2021-02-27');
        // $end = date('2021-03-02');

        $start = $request->get('startDate');
        $end = $request->get('endDate');


        if($request->ajax()) {
            $data = '';
            $qry = Borrowing::whereBetween('borrow_date',[$start,$end])->with('book', 'student')->get();
            foreach ($qry as $pgw) {
                $data = array(
                    'borrow_code'  =>  $pgw->borrow_code,
                    'book_name'  =>  $pgw->book->name,
                    'student_name'  =>  $pgw->student->name,
                    'borrow_date'  =>  $pgw->borrow_date,
                    'return_date'  =>  $pgw->return_date,
                    );
            }
            echo json_encode($data);
        }
        
        return $data->toArray();
        // $report = Borrowing::whereDate('borrow_date','>=',$start)->whereDate('borrow_date','<=',$end)->get();
    }
}