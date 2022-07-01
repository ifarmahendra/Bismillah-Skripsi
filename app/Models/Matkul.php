<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $fillable = [
        'mata_kuliah',
    ];


    public function learningjurnal()
    {
        return $this->hasMany('App\Models\LearningJurnal');
    }
}
