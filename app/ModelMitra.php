<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelMitra extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_mitra_kampus';
    protected $primaryKey = 'mitra_id';
    // public $timestamps = false;

  
    // static function mitras(){
    //     $mitra = DB::table('tbl_mitra_kampus')
    //     ->join('tbl_user','tbl_mitra_kampus.user_id','=','tbl_user.user_id');
    //     return $mitra;
    // }
}
