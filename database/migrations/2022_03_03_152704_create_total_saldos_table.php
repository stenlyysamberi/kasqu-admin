<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('saldo');
           
        });

        DB::table('total_saldos')->insert([
            'saldo' => 0
	       
        ]);

        
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
