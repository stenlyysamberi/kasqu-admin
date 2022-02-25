<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string("nama",50)->nullable();
            $table->string('phone',12)->unique();
            $table->text('alamat');
            $table->string('nip',50)->nullable();
            $table->string('jenis_kelamin',10)->nullable();
            $table->text('password')->nullable();
            $table->string("level",20)->nullable();
            $table->text("gambar")->nullable();
            
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
