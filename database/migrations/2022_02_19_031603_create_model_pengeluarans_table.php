<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        });


        DB::unprepared('
            CREATE TRIGGER tr_del_saldo AFTER INSERT ON tbl_kaskeluar FOR EACH ROW
            BEGIN
                UPDATE total_saldos SET saldo = saldo - NEW.jumlah_keluar 
                WHERE id_saldo = 1;
            END
        ');
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
