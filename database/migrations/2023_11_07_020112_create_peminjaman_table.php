<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman');
            $table->integer('id_anggota');
            $table->integer('id_buku');
            $table->string('status');
            $table->string('tanggal_peminjaman');
            $table->integer('lama_peminjaman');
            $table->string('tanggal_harus_dikembalikan');
            $table->string('tanggal_kembali');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
