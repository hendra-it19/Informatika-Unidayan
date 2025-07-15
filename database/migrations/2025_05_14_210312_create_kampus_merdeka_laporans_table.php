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
        Schema::create('kampus_merdeka_laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampus_merdeka_id')->constrained('kampus_merdekas', 'id')->cascadeOnDelete();
            $table->date('tanggal')->nullable();
            $table->enum('jenis_laporan', ['harian', 'mingguan'])->default('harian');
            $table->enum('kehadiran', ['hadir', 'sakit', 'izin', 'alpa', 'libur'])->default('hadir');
            $table->text('deskripsi');
            $table->string('file')->nullable()->unique();
            $table->dateTime('review_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampus_merdeka_laporans');
    }
};
