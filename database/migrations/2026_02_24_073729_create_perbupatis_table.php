<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perbupatis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->nullable();
            $table->string('judul')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('tahun')->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('tempat_penetapan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('sumber')->nullable();
            $table->string('subjek')->nullable();
            $table->string('bidang_hukum')->nullable();
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perbupatis');
    }
};