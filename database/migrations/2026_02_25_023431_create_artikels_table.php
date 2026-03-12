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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            // Kolom Utama
            $table->string('judul');
            $table->string('slug')->unique(); // Penting untuk URL
            $table->text('konten');
            $table->string('gambar')->nullable();

            // Kolom Meta Data (Sesuai form di image_a7b7a7.png)
            $table->string('jenis_artikel')->nullable();
            $table->string('tempat_terbit')->nullable();
            $table->string('tahun')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('sumber')->nullable();
            $table->string('bidang_hukum')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('teu')->nullable();
            $table->string('subjek')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
