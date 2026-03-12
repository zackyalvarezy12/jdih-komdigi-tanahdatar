<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * data base aslinya 2026_02_25_011456_add_final_columns_to_perbup
     */
    public function up()
    {
        Schema::table('perbupatis', function (Blueprint $table) {
            // Daftar kolom borongan agar tidak error satu-satu lagi
            $kolom_lengkap = [
                'nomor', 'judul', 'tahun', 'status', 'keterangan', 
                'tempat_penetapan', 'tanggal', 'sumber', 'subjek', 
                'bahasa', 'lokasi', 'bidang_hukum', 'file_pdf'
            ];

            foreach ($kolom_lengkap as $k) {
                // Cek jika kolom belum ada, baru tambahkan
                if (!Schema::hasColumn('perbupatis', $k)) {
                    if ($k == 'keterangan') {
                        $table->text($k)->nullable();
                    } elseif ($k == 'tanggal') {
                        // Gunakan dateTime karena di log error Anda ada format jam: 2026-02-13 00:00:00
                        $table->dateTime($k)->nullable(); 
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
