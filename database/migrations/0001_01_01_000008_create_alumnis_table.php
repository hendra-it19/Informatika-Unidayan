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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->string('nama', 150);
            $table->string('nim', 10);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->year('tahun_masuk')->nullable();
            $table->enum('status_masuk', ['maba', 'pindahan'])->default('maba');
            $table->year('tahun_lulus')->nullable();
            $table->string('ipk', 5)->nullable();
            $table->string('foto', 100)->nullable()->unique();
            $table->string('hp', 20)->unique()->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('alamat')->nullable();
            $table->enum('status', ['belum bekerja', 'kerja', 'lanjut pendidikan'])->default('belum bekerja');
            $table->text('detail_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
