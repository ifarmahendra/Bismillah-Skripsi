<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningJurnal;
use App\Models\Matkul;

class AdminLearningJurnal extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkul = Matkul::all();
        $matkulClass = new Matkul;
        $learning = LearningJurnal::with('matkul')->orderBy('created_at', 'desc')->get();
        return view('admin.Learning', compact(
            'learning',
            'matkul',
            'matkulClass',
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
            'soal' => 'required',
            'kunci_jawaban' => 'required',
            'matkul_Id'=>'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        try {
            $learning = LearningJurnal::where('start_date', '<=', $request->start_date)->where('end_date', '>=', $request->end_date)->get();
            if ($learning == 0){
                LearningJurnal::create([
                    'soal' => $request->soal,
                    'kunci_jawaban' => $request->kunci_jawaban,
                    'matkul_Id'=>$request->matkul_Id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
                return redirect()->back()->with('success', "Berhasil Menambahkan Data");
            }else{
                return redirect()->back()->with('error', "Tidak Dapat Menambahkan Data");
            }

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
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
        $request->validate([
            'soal' => 'required',
            'kunci_jawaban' => 'required',
            'matkul_Id'=>'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        try {
            LearningJurnal::where('id', $id)->update([
                'soal' => $request->soal,
                'kunci_jawaban' => $request->kunci_jawaban,
                'matkul_Id'=>$request->matkul_Id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            return redirect()->back()->with('success', "Berhasil Update Data");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            LearningJurnal::where('id', $id)->delete();
            return redirect()->back()->with('success', "Berhasil Menghapus Data");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->message);
        }
    }
}
