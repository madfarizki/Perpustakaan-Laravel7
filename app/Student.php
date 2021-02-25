<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'nis', 'name', 'gender', 'class'
    ];

    // gender accessor
    public function getFilterGenderAttribute()
    {
        return $this->gender == 0 ? 'Laki - Laki' : 'Perempuan';
    }
}
