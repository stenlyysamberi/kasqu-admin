<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\ModelPengeluaran;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ControllerPengeluaran extends Controller{

   public function index(){
        return view('pengeluaran',[
            "menu1" => "Beranda",
            "menu2" => "Pemasukan",
            "title" => "Pemasukan",
            'keluar'=> ModelPengeluaran::mitras()->get()
        ]);
   }

   public function tambakas(Request $ree){
        $simpan = $ree->validate([
            'jumlah_keluar' => 'required',
            'catatan' => 'required',
            'user_id' => 'required'
        ]);

        ModelPengeluaran::create($simpan);
        $ree->session()->flash('masuk', ',has been a created');
        return redirect('/keluar');
   }

   public function hapus(Request $req){
        // dd(request()->all());
        ModelPengeluaran::find($req->id)->delete();
        return redirect('/keluar')->with('masuk','data has been deleted!');
   }

   public function edit(Request $req){
   
    $edit = $req->validate([
        'pengeluaran_id' => 'required',
        'jumlah_keluar'  => 'required',
        'catatan'        => 'required'
    ]);

    ModelPengeluaran::find($req->pengeluaran_id)->update($req->all());
    return redirect('/keluar')->with('masuk','updated has been successfully!');
   }


   public function report_keluar(Request $req){
    if(request()->from || request()->to){
        $start_date = Carbon::parse(request()->from)->toDateTimeString();
        $end_date = Carbon::parse(request()->to)->toDateTimeString();
        // $data = AppKasPemasukan::whereBetween('created_at',[$start_date,$end_date])->get();
        $data = ModelPengeluaran::relation($start_date,$end_date);
    }else{
        $data = ModelPengeluaran::mitras()->get();
    }

    return view('report_keluar',[
        "menu1" => "Beranda",
        "menu2" => "Content",
        "menu3" => "Dana Keluar",
        "title" => "Dana Masuk",
        "dana"  => $data
    ]);
   }


}
