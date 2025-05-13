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
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisasi_id')->references('id')->on('organisasi')->cascadeOnDelete();
            $table->date('awal_jabatan');
            $table->date('akhir_jabatan');
            $table->text('sk')->unique();
            $table->string('ketua');
            $table->string('wakil');
            $table->string('sekretaris');
            $table->string('bendahara');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi');
    }
};
