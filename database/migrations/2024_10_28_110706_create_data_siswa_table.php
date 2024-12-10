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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->integer('nis')->primary(); // Primary Key
            $table->unsignedBigInteger('id'); // Foreign Key ke tabel users, pastikan menggunakan unsignedBigInteger
            $table->string('nama');
            $table->date('ttl');
            $table->string('agama');
            $table->string('alamat');
            $table->string('orangtua_wali');
            $table->string('no_telepon');
            $table->string('foto_profil')->nullable(); // Kolom untuk foto profil, opsional
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};
