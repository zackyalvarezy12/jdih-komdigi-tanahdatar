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
        Schema::create('naskah_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('type_dokumen');
            $table->text('judul');
            $table->string('slug')->unique()->nullable(); // ← Kolom slug unik
            $table->string('teu_pengarang');
            $table->year('tahun');
            $table->string('file_pdf');
            $table->integer('views')->default(0);         // ← Counter views
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naskah_akademiks');
    }
};