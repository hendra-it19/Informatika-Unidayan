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
        Schema::create('kerja_praktek_laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->references('id')->on('mahasiswa');
            $table->foreignId('kerja_praktek_id')->references('id')->on('kerja_prakteks');
            $table->date('tanggal')->nullable();
            $table->enum('jenis_laporan', ['harian', 'mingguan'])->default('harian');
            $table->enum('kehadiran', ['hadir', 'sakit', 'izin', 'alpa', 'libur'])->default('hadir');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerja_praktek_laporans');
    }
};
