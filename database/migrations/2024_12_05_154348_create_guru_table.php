<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->string('nip')->primary(); // Primary Key
            $table->unsignedBigInteger('id'); // Foreign Key ke tabel users
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Hapus otomatis jika user dihapus
        });
    }

    public function down()
    {
        Schema::dropIfExists('guru');
    }
}
