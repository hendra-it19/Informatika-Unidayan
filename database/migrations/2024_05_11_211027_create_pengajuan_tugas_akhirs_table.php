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
        Schema::create('pengajuan_tugas_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('judul1')->nullable();
            $table->text('abstrak1')->nullable();
            $table->string('judul2')->nullable();
            $table->text('abstrak2')->nullable();
            $table->string('judul3')->nullable();
            $table->text('abstrak3')->nullable();
            $table->integer('step')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_tugas_akhir');
    }
};
