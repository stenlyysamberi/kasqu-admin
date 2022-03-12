<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\String_;

class KasPemasukan extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_kasmasuk';
    protected $primaryKey = 'kasmasuk_id';
    // public $timestamps = false;


    /**
     * Get the user that owns the KasPemasukan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    static function mitras(){
        $mitra = DB::table('tbl_kasmasuk')
        ->join('tbl_user','tbl_kasmasuk.user_id','=','tbl_user.user_id')
        ->join('tbl_mitra_kampus','tbl_kasmasuk.mitra_id','=','tbl_mitra_kampus.mitra_id');
        return $mitra;
    }

    static function relation(string $from, string $to){
        $data = DB::table('tbl_kasmasuk')
        ->join('tbl_user','tbl_kasmasuk.user_id','=','tbl_user.user_id')
        ->join('tbl_mitra_kampus','tbl_kasmasuk.mitra_id','=','tbl_mitra_kampus.mitra_id')
        ->whereBetween('tbl_kasmasuk.created_at',[$from,$to])->get();
        return $data;
    }

    static function mutasi_user(string $user_id){
        // $data = DB::table('tbl_kasmasuk')
        // ->join('tbl_user','tbl_kasmasuk.user_id','=','tbl_user.user_id')
        // ->where('tbl_kasmasuk.user_id', $user_id)
        // ->select('tbl_user.nama')->get();
        // return $data;

        $users = DB::table('tbl_kasmasuk')
            ->join('tbl_user','tbl_kasmasuk.user_id','=','tbl_user.user_id')
            ->join('tbl_mitra_kampus','tbl_kasmasuk.mitra_id','=','tbl_mitra_kampus.mitra_id')
            ->where('tbl_kasmasuk.user_id', $user_id)
            ->select('tbl_mitra_kampus.nama_usaha','tbl_user.nama','tbl_kasmasuk.jumlah_pemasukan','tbl_kasmasuk.created_at as tgl')
            ->get();
        return $users;
    }   
}
