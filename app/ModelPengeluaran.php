<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ModelPengeluaran extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_kaskeluar';
    protected $primaryKey = 'pengeluaran_id';
    // public $timestamps = false;

    static function mitras(){
        $mitra = DB::table('tbl_kaskeluar')
        ->join('tbl_user','tbl_kaskeluar.user_id','=','tbl_user.user_id');
        return $mitra;
    }

    static function relation(string $from, string $to){
        $data = DB::table('tbl_kaskeluar')
        ->join('tbl_user','tbl_kaskeluar.user_id','=','tbl_user.user_id')
        ->whereBetween('tbl_kaskeluar.created_at',[$from,$to])->get();
        return $data;
    }

    
}
