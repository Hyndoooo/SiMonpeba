<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perkembangan_siswa', function (Blueprint $table) {
            $table->id('id_perkembangan'); // Primary Key
            $table->integer('nis'); // Foreign Key ke tabel data_siswa
            $table->string('nama');
            $table->string('jadwal_pelajaran');
            $table->string('penjelasan_perkembangan');
            $table->string('catatan');
            $table->string('bukti_media')->nullable();
            $table->date('waktu');
            $table->timestamps();

            // Foreign key ke tabel data_siswa
            $table->foreign('nis')->references('nis')->on('data_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangan_siswa');
    }
};
