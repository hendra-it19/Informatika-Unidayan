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
        Schema::create('kerja_prakteks', function (Blueprint $table) {
            $table->id();
            $table->string('mitra');
            $table->year('tahun');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('surat_pengantar')->nullable()->unique();
            $table->string('balasan_surat_pengantar')->nullable()->unique();
            $table->string('surat_penarikan')->nullable()->unique();
            $table->string('balasan_surat_penarikan')->nullable()->unique();
            $table->string('laporan_akhir')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerja_prakteks');
    }
};
