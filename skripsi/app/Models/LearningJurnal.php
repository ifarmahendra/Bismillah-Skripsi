<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningJurnal extends Model
{
    use HasFactory;
    protected $fillable = [
        'soal',
        'kunci_jawaban',
        'matkul_Id',
        'start_date',
        'end_date',
    ];

    public function matkul()
    {
        return $this->belongsTo('App\Models\Matkul');
    }

    public function datajawaban()
    {
        return $this->hasMany('App\Models\DataJawaban');
    }
}
