<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'nis', 'name', 'gender', 'class'
    ];

    // Gender accessor
    public function getFilterGenderAttribute()
    {
        return $this->gender == 0 ? 'Laki - Laki' : 'Perempuan';
    }

    // One student have one borrowing
    public function borrowing() {
        return $this->hasOne(Borrowing::class);
    }
}
