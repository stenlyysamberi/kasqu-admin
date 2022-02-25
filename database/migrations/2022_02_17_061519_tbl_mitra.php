<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblMitra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tbl_mitra_kampus', function (Blueprint $table) {
           $table->bigIncrements('mitra_id');
           $table->integer('user_id')->nullable();
           $table->string('nama_usaha',50)->nullable();
           $table->date('updated_at');
           $table->date('created_at');
           //$table->foreign('user_id')->references('user_id')->on('tbl_user')->onDelete('cascade')->onUpdate('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
