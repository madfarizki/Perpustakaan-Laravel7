<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'borrow_code', 'student_id', 'book_id', 'borrow_date', 'return_date'
    ];

    protected $with = ['student', 'book'];

    // One borrowing have one student
    public function student() {
        return $this->belongsTo(Student::class);
    }

    // One borrowing have one book
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
