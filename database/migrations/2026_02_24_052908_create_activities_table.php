<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            // Menyimpan ID user yang melakukan aktivitas agar data benar-benar akurat
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menyimpan deskripsi aktivitas (contoh: "Menambahkan buku baru")
            $table->string('description');
            // Menyimpan kategori aktivitas (info, success, warning) untuk styling icon nantinya
            $table->string('type')->default('info');
            $table->timestamps(); // Ini otomatis mencatat waktu "2 menit yang lalu"
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};