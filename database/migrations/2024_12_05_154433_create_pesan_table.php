<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTable extends Migration
{
    public function up()
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id('id_pesan');
            $table->unsignedBigInteger('id_pengirim');
            $table->unsignedBigInteger('id_penerima');
            $table->text('pesan');
            $table->timestamp('waktu_kirim')->useCurrent();
            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('id_pengirim')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_penerima')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesan');
    }
}
