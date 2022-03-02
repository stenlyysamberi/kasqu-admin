<?php

namespace App\Http\Controllers;

use App\KasPemasukan;
use App\ModelMitra;
use App\ModelPengeluaran;
use App\User;
use Illuminate\Http\Request;

class ControllerMitra extends Controller
{
    public function index(){
        return view('sumber_pemasukan',[
            "menu1" => "Beranda",
            "menu2" => "Contents",
            "menu3" => "Sumber Pemasukan",
            "title" => "Sumber Pemasukan",
            "userman" => User::all(),
            'mitra' => ModelMitra::mitras()->get()
        ]);
    }

    public function save(Request $request){
        $req = $request->validate([
            'nama_usaha' => 'required',
            'user_id'    => 'required'
        ]);

        ModelMitra::create($req);
        $request->session()->flash('mitra', 'Created successfully!');
        return redirect('/sumber_pemasukan');
    }

    public function hapus(Request $req){
        ModelMitra::find($req->id)->delete();
        return redirect('/sumber_pemasukan')->with('mitra','mitra has been deleted!');
    }


    public function edit(Request $request){
        $request->validate([
            'user_id' => 'required',
            'nama_usaha' => 'required',
            'mitra_id' => 'required'
        ]);

        // return(
        //     $request
        // );

      ModelMitra::find($request->mitra_id)->update($request->all());
      $request->session()->flash("user", "update has been created!");
      return redirect('/sumber_pemasukan');
    }



    // request API
    public function beranda(Request $req){
        return response()->json ([
            [
            'mitra'  =>  ModelMitra::mitras()->get(),
            'income' =>  KasPemasukan::mitras()->get(),
            'spent'  =>  ModelPengeluaran::mitras()->get(),
            'mutasi_user' => KasPemasukan::mutasi_user($req->user_id)
           
            ]
        ]);
          
        
    }
}
