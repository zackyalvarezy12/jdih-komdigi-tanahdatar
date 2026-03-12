<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('infografis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');                      // ← judul untuk generate slug
            $table->string('slug')->unique()->nullable(); // ← slug unik
            $table->string('file_infografis');
            $table->integer('views')->default(0);         // ← counter views
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('infografis');
    }
};