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
        Schema::create('kampus_merdekas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('dosen_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->string('mitra');
            $table->enum('mobilitas', ['online', 'onsite']);
            $table->enum('jenis', ['study', 'internship']);
            $table->string('bukti_penerimaan')->unique();
            $table->string('persetujuan_kampus')->nullable()->unique();
            $table->string('laporan_akhir')->nullable()->unique();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampus_merdekas');
    }
};
