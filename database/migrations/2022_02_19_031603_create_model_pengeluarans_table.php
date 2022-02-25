<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kaskeluar', function (Blueprint $table) {
            $table->bigIncrements('pengeluaran_id');
            $table->unsignedBigInteger('user_id');
            $table->string('jumlah_keluar');
            $table->string('catatan');
            $table->timestamps();

            // $table->foreign('user_id')->references('user_id')->on('tbl_user')->onDelete('CASCADE')->onUpdate('CASCADE');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kaskeluar');
    }
}
