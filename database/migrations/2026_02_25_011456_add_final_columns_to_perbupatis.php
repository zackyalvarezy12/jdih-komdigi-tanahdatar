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
        Schema::table('perbupatis', function (Blueprint $table) {
            // Daftar kolom yang terdeteksi di error image_4fe1f8.png
            $kolom = ['bahasa', 'lokasi', 'sumber', 'subjek', 'bidang_hukum', 'tempat_penetapan', 'status'];

            foreach ($kolom as $k) {
                if (!Schema::hasColumn('perbupatis', $k)) {
                    $table->string($k)->nullable();
                    $table->string('slug')->unique()->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perbupatis', function (Blueprint $table) {
            //
        });
    }
};
