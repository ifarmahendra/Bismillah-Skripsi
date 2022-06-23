<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $fillable = [
        'formjawaban_id',
        'learningjurnal_id',
        'nama_mahasiswa',
        'golongan',
        'hasil_processing',
        'nilai_cosine',
    ];

    public function filterjawaban()
    {
        return $this->belongsTo('App\Models\FilterJawaban');
    }

    public function formjawaban()
    {
        return $this->belongsTo('App\Models\FormJawaban');
    }
}
