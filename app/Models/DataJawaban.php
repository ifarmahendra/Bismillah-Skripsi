<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJawaban extends Model
{
    use HasFactory;


    public function learningjurnal()
{
    return $this->belongsTo('App\Models\LearningJurnal');
}


}

