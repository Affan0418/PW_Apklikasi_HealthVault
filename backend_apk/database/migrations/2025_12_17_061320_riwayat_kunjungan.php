<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_kunjungan', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel pasien dan dokter
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokter')->onDelete('cascade');
            
            // Kolom sesuai tabel yang diminta
            $table->date('tanggal_kunjungan');
            $table->text('keluhan_pasien');
            $table->text('diagnosis')->nullable();
            $table->text('tindakan_medis')->nullable();
            $table->text('obat_diberikan')->nullable();
            $table->text('catatan_tambahan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_kunjungan');
    }
};