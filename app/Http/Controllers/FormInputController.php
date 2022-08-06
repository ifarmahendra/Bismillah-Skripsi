<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormJawaban;
use App\Models\LearningJurnal;
use App\Models\Matkul;

class FormInputController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learningclass = new Matkul;
        // $learning = LearningJurnal::all();
        $learning = LearningJurnal::where('start_date', '<=', date('Y-m-d\TH:i'))->where('end_date', '>=', date('Y-m-d\TH:i'))->get();
        $jawaban = FormJawaban::orderBy('created_at', 'desc')->get();
        return view('forminput', compact(
            'jawaban',
            'learning',
            'learningclass',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'nama'=>'required',
            'nim' => 'required',
            'golongan' => 'required',
            'matkul_id' => 'required',
            'tanggal' => 'required',
            'soal_id' => 'required',
            'jawaban' => 'required',
        ]);
        try {
            FormJawaban::create([
                'email' => $request->email,
                'nama'=>$request->nama,
                'nim' => $request->nim,
                'golongan' => $request->golongan,
                'matkul_id' => $request->matkul_id,
                'tanggal' => $request->tanggal,
                'soal_id' => $request->soal_id,
                'jawaban' => str_replace(";","",$request->jawaban), // hapus tanda ;
            ]);
            return redirect()->route('index')->with('success', "Data Jawaban Anda Berhasil Terkirim");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
