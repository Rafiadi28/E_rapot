<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            
            // Capaian Kompetensi
            $table->text('capaian_kompetensi')->nullable();
            
            // Nilai Formatif
            $table->integer('nilai_formatif')->nullable();
            $table->text('deskripsi_formatif')->nullable();
            
            // Nilai Sumatif
            $table->integer('nilai_sumatif')->nullable();
            $table->text('deskripsi_sumatif')->nullable();
            
            // Nilai Akhir Semester
            $table->integer('nilai_akhir_semester')->nullable();
            $table->text('deskripsi_akhir_semester')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};