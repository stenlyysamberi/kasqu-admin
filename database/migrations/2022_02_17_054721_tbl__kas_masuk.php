<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('mitra_id');
            $table->text('tanggal_masuk',30)->nullable();
            $table->string('jumlah_pemasukan',12);
            $table->integer('user_id');
            $table->date('updated_at');
            $table->date('created_at');
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
