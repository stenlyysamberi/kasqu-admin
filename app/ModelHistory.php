<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelHistory extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_history';
    protected $primaryKey = 'history_id';
    // public $timestamps = false;
}
