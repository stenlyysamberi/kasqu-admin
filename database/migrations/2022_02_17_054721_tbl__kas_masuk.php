<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TblKasMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kasmasuk', function (Blueprint $table) {
            $table->bigIncrements('kasmasuk_id')->unsigned();
            $table->integer('mitra_id')->unsigned()->nullable();
            $table->text('tanggal_masuk',30)->nullable();
            $table->string('jumlah_pemasukan',12);
            $table->integer('user_id');
            $table->date('updated_at');
            $table->date('created_at');
        });


        DB::unprepared('
            CREATE TRIGGER tr_add_saldo AFTER INSERT ON tbl_kasmasuk FOR EACH ROW
            BEGIN
                UPDATE total_saldos SET saldo = saldo + NEW.jumlah_pemasukan 
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
        //
    }
}
