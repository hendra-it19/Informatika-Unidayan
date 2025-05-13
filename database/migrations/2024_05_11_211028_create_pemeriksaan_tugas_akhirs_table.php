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
        Schema::create('pemeriksaan_tugas_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_tugas_akhir_id')->references('id')->on('pengajuan_tugas_akhir')->cascadeOnDelete();
            $table->foreignId('verifikator')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('status1', ['terima', 'tolak', 'revisi']);
            $table->text('pesan1')->nullable();
            $table->enum('status2', ['terima', 'tolak', 'revisi']);
            $table->text('pesan2')->nullable();
            $table->enum('status3', ['terima', 'tolak', 'revisi']);
            $table->text('pesan3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_tugas_akhir');
    }
};
