<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormJawaban extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'nama',
        'nim',
        'golongan',
        'matkul_id',
        'tanggal',
        'soal_id',
        'jawaban',
    ];

    public function learningjurnal()
    {
        return $this->belongsTo('App\Models\LearningJurnal');
    }

    public function filterjawaban()
    {
        return $this->belongsTo('App\Models\FilterJawaban');
    }

    public function hasil()
    {
        return $this->hasMany('App\Models\Hasil');
    }

    public function filter()
    {
        return $this->hasMany('App\Models\FilterJawaban');
    }
}
