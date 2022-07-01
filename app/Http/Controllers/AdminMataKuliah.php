<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;

class AdminMataKuliah extends Controller

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
        $matkul = Matkul::orderBy('created_at', 'desc')->get();
        return view('admin.MataKuliah', compact(
            'matkul',
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
            'mata_kuliah' => 'required',
        ]);
        try {
            Matkul::create([
                'mata_kuliah' => $request->mata_kuliah,
            ]);
            return redirect()->back()->with('success', "Berhasil Menambahkan Data");
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
        $request->validate([
            'mata_kuliah' => 'required',
        ]);
        try {
            Matkul::where('id', $id)->update([
                'mata_kuliah' => $request->mata_kuliah,
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
            Matkul::where('id', $id)->delete();
            return redirect()->back()->with('success', "Berhasil Menghapus Data");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->message);
        }
    }
}
