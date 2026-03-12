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
            // Daftar semua kolom yang dibutuhkan sistem
            $columns = [
                'nomor', 'judul', 'tahun', 'status', 'keterangan', 
                'tempat_penetapan', 'tanggal', 'sumber', 'subjek', 
                'bidang_hukum', 'file_pdf'
            ];

            foreach ($columns as $column) {
                // Cek jika kolom belum ada, maka tambahkan
                if (!Schema::hasColumn('perbupatis', $column)) {
                    // Khusus keterangan pakai text, sisanya string
                    if ($column == 'keterangan') {
                        $table->text($column)->nullable();
                    } elseif ($column == 'tanggal') {
                        $table->date($column)->nullable();
                    } else {
                        $table->string($column)->nullable();
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
