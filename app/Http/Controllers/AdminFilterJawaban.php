<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FilterJawaban;
use App\Models\FormJawaban;
use App\Models\Hasil;
use App\Models\Matkul;
use PDF;

class AdminFilterJawaban extends Controller
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
        $data = FilterJawaban::orderBy('created_at', 'desc')->get();
        $hasil = Hasil::all();
        return view('admin.FilterJawaban', compact(
            'data',
            'hasil',
            'matkul'
        ));
    }

    public function cetak_pdf()
    {
        $form = FormJawaban::orderBy('created_at', 'desc')->get();
        $new = new Hasil;
    	$pdf = PDF::loadview('admin.cetak_pdf',['form'=>$form],['new'=>$new]);
    	return $pdf->download('laporannilai.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $filter = FormJawaban::whereDate('tanggal', date("Y-m-d\TH:i", strtotime($request->tanggal)))
                    ->where('matkul_id', $request->matkul)
                    ->get();
        $new = new Hasil;
        $matkul = Matkul::all();
        // ketika tanpa foreach, hasil mirip spt ini => [{"id":8},{"id":9},{"id":10}]
        // return $filter;
        // jika filter tidak ada datanya
        // $proccessToAPI = "";
        // foreach($filter as $filterId){
        //     $proccessToAPI .= $filterId->id.";";
        // }
        // ketika dilakukan foreach menjadi seperti ini => 8;9;10;
        // return $proccessToAPI;
        // jika ada data
        // $jawabanMhs = substr($proccessToAPI, 0, -1);
        // $result = file_get_contents(env('APP_URL').':8001/job?id='.$jawabanMhs); // request ke API
        // if (json_decode($result, true)['status'] == 'success') {
        //     return view('admin.TampilJawaban', compact('filter', 'new','matkul'));
        // }else {
        //     return "ERROR";
        // }
        // return view('admin.tampiljawaban', compact(
        //     'filter',
        // ));
        return view('admin.TampilJawaban', compact('filter', 'new','matkul'));

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $jawabanMhs = substr($id, 0, -1);
        $result = file_get_contents(env('APP_URL').':8001/job?id='.$jawabanMhs); // request ke API
        if (json_decode($result, true)['status'] == 'success') {
            return json_decode($result, true)['message'];
        }else {
            return "ERROR";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filter = FormJawaban::where('id', $id)->first();
        $new = new Hasil;
        return view('admin.DetailJawaban', compact('filter','new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'kunci_jawaban' => 'required',
        ]);
        try {
            FormJawaban::create([
                'kunci_jawaban' => $request->kunci_jawaban,
            ]);
            return redirect()->back()->with('success', "Berhasil Menambahkan Data");
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
        //
    }
}
