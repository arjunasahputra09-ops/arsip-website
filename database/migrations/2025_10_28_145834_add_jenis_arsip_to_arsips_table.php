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
        Schema::table('arsips', function (Blueprint $table) {
            // INI KODE UNTUK MENAMBAH KOLOM BARU
            $table->string('jenis_arsip')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            // INI KODE UNTUK MENGHAPUS KOLOM JIKA DI-ROLLBACK
            $table->dropColumn('jenis_arsip');
        });
    }
};
