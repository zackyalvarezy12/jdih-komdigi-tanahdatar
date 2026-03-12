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
        Schema::create('peraturans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique()->nullable();
            $table->string('nomor');
            $table->year('tahun');
            $table->enum('status', ['Berlaku', 'Tidak Berlaku']);
            $table->string('file_pdf');
            $table->string('jenis_peraturan'); // Contoh: Perda, Perbup, dll.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peraturans');
    }
};
