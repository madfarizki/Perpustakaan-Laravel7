<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrowing;
use PDF;

class ReportController extends Controller
{
    public $autoNumber = 1;

    public function borrowingReport() {
        return view('pages.admin.laporan.index');
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
}
