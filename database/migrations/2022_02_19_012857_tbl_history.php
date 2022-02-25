<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_history', function (Blueprint $table) {
            $table->bigIncrements('history_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kasmasuk_id');
            $table->unsignedBigInteger('kaskeluar_id');
            $table->timestamps();

            // $table->foreign('user_id')->references('user_id')->on('tbl_user')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('kasmasuk_id')->references('kasmasuk_id')->on('tbl_kasmasuk')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('kaskeluar_id')->references('kaskeluar_id')->on('tbl_kaskeluar')->onUpdate('cascade')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('tbl_history');
    }
}
