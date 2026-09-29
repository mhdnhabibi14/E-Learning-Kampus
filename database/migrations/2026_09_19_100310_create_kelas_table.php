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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('kode_kelas', 20);
            $table->string('nama_kelas', 100);
            $table->unsignedInteger('kouta');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['draft', 'aktif', 'selesai', 'nonaktif',])->default('draft');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['mata_kuliah_id', 'tahun_akademik_id', 'kode_kelas',]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
