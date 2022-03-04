<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_saldos', function (Blueprint $table) {
            $table->bigIncrements('id_saldo');
            $table->unsignedBigInteger("kasmasuk_id");
            $table->string("saldo");
            $table->timestamps();

            $table->foreign('kasmasuk_id')->references('kasmasuk_id')->on('tbl_kasmasuk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('total_saldos');
    }
}
