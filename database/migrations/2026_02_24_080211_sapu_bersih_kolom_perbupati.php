<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * data base aslinya 2026_02_25_011456_add_final_columns_to_perbupatis
     */
    public function up()
    {
        Schema::table('perbupatis', function (Blueprint $table) {
            $kolom = [
                'nomor', 'judul', 'tahun', 'status', 'keterangan', 
                'tempat_penetapan', 'tanggal', 'sumber', 'subjek', 
                'bidang_hukum', 'file_pdf'
            ];

            foreach ($kolom as $k) {
                if (!Schema::hasColumn('perbupatis', $k)) {
                    // Tentukan tipe data yang sesuai
                    if ($k == 'keterangan') {
                        $table->text($k)->nullable();
                    } elseif ($k == 'tanggal') {
                        $table->date($k)->nullable();
                    } else {
                        $table->string($k)->nullable();
                    }
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
