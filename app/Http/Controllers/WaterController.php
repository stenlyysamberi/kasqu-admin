<?php

namespace App\Http\Controllers;

use App\Water;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Water::all();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $this ->validate($request,[
            'tinggi_air' => 'required',
            'keterangan' => 'required'
        ]);
        Water::create($data);
        return response()->json([
            'message' => 'success'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function show(Water $water)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function edit(Water $water)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $cek = Water::find($id);
        if ($cek == null) {
            return response()->json("Data ID Tidak Terdaftar");
        }else{
            Water::where('id_water',2)->update($request->all());
            return response()->json("date has been updated");
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Water  $water
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
       $cek = Water::find($id);
       if ($cek == null) {
            return response()->json("Data ID tidak terdaftar!");
       }else{
            Water::where('id_water', $id)->delete();
            return response()->json("Data ID Berhasil Hapus");
       }
    }
}
