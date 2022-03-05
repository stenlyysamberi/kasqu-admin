<?php

namespace App\Http\Controllers;

// use App\KasPemasukan;

use App\KasPemasukan as AppKasPemasukan;
use App\ModelHistory;
use App\ModelMitra;
use App\User;
use App\UserMan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ControllerPemasukan extends Controller{

    //BLOK API
    public function bayar(Request $req){
        $simpan = $req->validate([
            'user_id'  => 'required',
            'mitra_id' => 'required',
            'jumlah_pemasukan' => 'required',
            'tanggal_masuk' => 'required'
        ]);

       AppKasPemasukan::create($simpan);
        return response()->json([
            'result'   => 'berhasil',
            'message'  => '0'
        ]);
    }
    //END 



    public function index(){
        return view('pemasukan',[
            "menu1" => "Beranda",
            "menu2" => "Pemasukan",
            "title" => "Pemasukan",
            "sumber" => ModelMitra::all(),
            "userman"  => User::all(),
            'mitra'    => AppKasPemasukan::mitras()->get()
        ]);
    }

    public function store(Request $req){
        
        $simpan = $req->validate([
            'user_id' => 'required',
            'mitra_id' => 'required',
            'jumlah_pemasukan' => 'required',
            'tanggal_masuk' => 'required'
        ]);

       AppKasPemasukan::create($simpan);
       $req->session()->flash('kasmasuk', ',has been a created');
       return redirect('/masuk');
    }


    public function edit(Request $req){
         $req->validate([
            'user_id' => 'required',
            'mitra_id' => 'required',
            'jumlah_pemasukan' => 'required',
            'tanggal_masuk' => 'required'
        ]);

        AppKasPemasukan::find($req->kasmasuk_id)->update($req->all());
        return redirect('/masuk')->with('masuk','updated has been successfully!');
    }

    public function hapus(Request $req){
        AppKasPemasukan::find($req->id)->delete();
        return redirect('/masuk')->with('masuk','kasmasuk has been deleted!');
    }

    public function report_masuk(Request $req){

        if(request()->from || request()->to){
            $start_date = Carbon::parse(request()->from)->toDateTimeString();
            $end_date = Carbon::parse(request()->to)->toDateTimeString();
            // $data = AppKasPemasukan::whereBetween('created_at',[$start_date,$end_date])->get();
            $data = AppKasPemasukan::relation($start_date,$end_date);
        }else{
            $data = AppKasPemasukan::mitras()->get();
        }
    
        return view('report_masuk',[
            "menu1" => "Beranda",
            "menu2" => "Content",
            "menu3" => "Dana Keluar",
            "title" => "Dana Masuk",
            "dana"  => $data
        ]);
        
      }

      
}
