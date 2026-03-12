<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peraturan_terjemahs', function (Blueprint $table) {
            $table->id();
            $table->string('type_dokumen');
            $table->text('judul');
            $table->string('slug')->unique()->nullable();
            $table->string('teu_pengarang');
            $table->year('tahun');
            $table->string('file_pdf')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peraturan_terjemahs');
    }
};