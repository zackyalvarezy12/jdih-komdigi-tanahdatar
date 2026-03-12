<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('rak')->nullable();
            $table->string('baris')->nullable();
            $table->string('penulis')->nullable();
            $table->string('cover')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('edisi')->nullable();
            $table->string('bidang_hukum')->nullable();
            $table->string('isbn')->nullable();
            $table->string('tahun_terbit')->nullable();
            $table->string('deskripsi_fisik')->nullable();
            $table->string('jenis_monografi')->nullable();
            $table->string('nomor_panggil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
