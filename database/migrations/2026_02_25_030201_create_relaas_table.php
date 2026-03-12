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
        Schema::create('relaas', function (Blueprint $table) {
            $table->id();
            // Data Utama
            $table->string('nomor');
            $table->string("slug")->unique()->nullable();
            $table->date('tanggal');
            $table->text('pengumuman');
            $table->string('file_pdf')->nullable();

            
            $table->string('jenis_putusan')->nullable();
            $table->string('jenis_peradilan')->nullable();
            $table->string('singkatan_jenis_peradilan')->nullable();
            $table->string('status_putusan')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('sumber')->nullable();
            $table->string('bidang_hukum')->nullable();
            $table->string('tempat_peradilan')->nullable();
            $table->string('amar')->nullable();
            $table->date('tanggal_dibacakan')->nullable();
            $table->string('teu_badan')->nullable();
            $table->string('subjek')->nullable();
            $table->string('lampiran')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relaas');
    }
};
