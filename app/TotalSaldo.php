<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalSaldo extends Model
{
    protected $guarded = [];
    protected $table = 'total_saldos';
    protected $primaryKey = 'id_saldo';


    static function  saldo(){
        $mitra = TotalSaldo::where('id_saldo', 1)
                            ->select('saldo');
        return $mitra;              
    }
}
