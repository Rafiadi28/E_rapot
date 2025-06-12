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
            $table->decimal('nilai_formatif', 5, 2)->nullable();
            $table->text('deskripsi_formatif')->nullable();
            $table->decimal('nilai_sumatif', 5, 2)->nullable();
            $table->text('deskripsi_sumatif')->nullable();
            $table->decimal('nilai_akhir_semester', 5, 2)->nullable();
            $table->text('deskripsi_akhir_semester')->nullable();
            $table->text('capaian_kompetensi')->nullable();
            $table->integer('semester');
            $table->string('tahun_ajaran');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};