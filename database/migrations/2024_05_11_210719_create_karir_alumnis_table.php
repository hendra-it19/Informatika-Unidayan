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
        Schema::create('karir_alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->references('id')->on('alumni')->cascadeOnDelete();
            $table->string('mitra', 100);
            $table->string('pekerjaan', 100);
            $table->date('batas_penerimaan');
            $table->text('deskripsi');
            $table->string('foto')->unique()->nullable();
            $table->enum('status', ['pengajuan', 'konfirmasi', 'tolak'])->default('pengajuan');
            $table->string('pesan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karir_alumni');
    }
};
