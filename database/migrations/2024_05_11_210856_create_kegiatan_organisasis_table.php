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
        Schema::create('kegiatan_organisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisasi_id')->references('id')->on('organisasi')->cascadeOnDelete();
            $table->string('judul');
            $table->string('slug');
            $table->string('excerpt')->nullable();
            $table->text('deskripsi');
            $table->string('foto')->nullable()->unique();
            $table->text('hashtag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_organisasi');
    }
};
