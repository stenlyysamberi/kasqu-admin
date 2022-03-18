<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $guarded = [];
    protected $table = 'waters';
    protected $primaryKey = 'id_water';
    // public $timestamps = false;
}
