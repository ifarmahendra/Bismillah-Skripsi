<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterJawaban extends Model
{
    use HasFactory;



    public function formjawaban()
    {
        return $this->hasMany('App\Models\FormJawaban');
    }

    public function hasil()
    {
        return $this->hasMany('App\Models\Hasil');
    }
}
