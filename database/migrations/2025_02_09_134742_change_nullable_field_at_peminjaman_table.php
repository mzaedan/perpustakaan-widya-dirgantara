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
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('kode_peminjaman')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('tanggal_peminjaman')->nullable()->change();
            $table->integer('lama_peminjaman')->nullable()->change();
            $table->string('tanggal_harus_dikembalikan')->nullable()->change();
            $table->string('tanggal_kembali')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('kode_peminjaman')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->string('tanggal_peminjaman')->nullable(false)->change();
            $table->integer('lama_peminjaman')->nullable(false)->change();
            $table->string('tanggal_harus_dikembalikan')->nullable(false)->change();
            $table->string('tanggal_kembali')->nullable(false)->change();
        });
    }
};
