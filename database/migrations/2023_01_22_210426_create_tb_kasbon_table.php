<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kasbon', function (Blueprint $table) {
            $table->integer('id_kasbon', true);
            $table->integer('id_karyawan');
            $table->integer('jumlah');
            $table->string('ket', 100)->nullable();
            $table->date('tgl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kasbon');
    }
};
