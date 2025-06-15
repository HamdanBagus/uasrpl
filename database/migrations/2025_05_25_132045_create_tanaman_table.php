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
        Schema::create('tanaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('cara_tanam');
            $table->string('gambar')->nullable();
            $table->decimal('ph_min', 3, 1);
            $table->decimal('ph_max', 3, 1);
            $table->enum('intensitas_sinar_matahari', ['rendah', 'sedang', 'tinggi', 'rendah_sedang', 'sedang_tinggi', 'semua']);
            $table->enum('kelembaban_tanah', ['rendah', 'sedang', 'tinggi', 'rendah_sedang', 'sedang_tinggi', 'semua']);
            $table->enum('drainase_tanah', ['baik', 'sedang', 'buruk', 'baik_sedang', 'semua']);
            $table->string('jenis_tanah'); // Bisa lebih dari satu, pisahkan dengan koma di aplikasi
            $table->integer('ketinggian_mdpl_min')->nullable();
            $table->integer('ketinggian_mdpl_max')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman');
    }
};
