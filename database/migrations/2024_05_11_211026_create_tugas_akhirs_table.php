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
        Schema::create('tugas_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('pembimbing_utama_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('pembimbing_pendamping_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->string('judul');
            $table->text('abstrak');
            $table->enum('tahap_bimbingan', ['proposal', 'hasil', 'tutup'])->default('proposal');
            $table->string('sk_pembimbing')->nullable()->unique();
            $table->string('sk_penguji')->nullable()->unique();
            $table->string('file')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhir');
    }
};
