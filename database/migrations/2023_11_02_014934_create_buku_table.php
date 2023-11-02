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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('id_kategori');
            $table->integer('id_rak');
            $table->string('sampul');
            $table->string('isbn');
            $table->string('lampiran');
            $table->string('penerbit');
            $table->string('pengarang');
            $table->string('tahun_buku');
            $table->text('isi');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
