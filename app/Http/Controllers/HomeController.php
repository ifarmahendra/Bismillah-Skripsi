<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\LearningJurnal;
use App\Models\FormJawaban;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jawaban = FormJawaban::orderBy('created_at', 'desc')->get();
        $learning = LearningJurnal::orderBy('created_at', 'desc')->get();
        $matkul = Matkul::orderBy('created_at', 'desc')->get();
        return view('home', compact(
            'matkul',
            'jawaban',
            'learning'
        ));
    }
}
