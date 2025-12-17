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
        Schema::create('riwayat_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')
                  ->constrained('pasien')
                  ->onDelete('cascade');

            $table->foreignId('dokter_id')
                  ->constrained('dokter')
                  ->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->text('keluhan');
            $table->text('diagnosis')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('resep')->nullable(); // teks, tidak terhubung ke tabel obat
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
