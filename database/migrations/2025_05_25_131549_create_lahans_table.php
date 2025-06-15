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
        Schema::create('lahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke tabel users
            $table->string('nama_lahan');
            $table->decimal('ph_tanah', 3, 1);
            $table->enum('intensitas_sinar_matahari', ['rendah', 'sedang', 'tinggi']);
            $table->enum('kelembaban_tanah', ['rendah', 'sedang', 'tinggi']);
            $table->enum('drainase_tanah', ['baik', 'sedang', 'buruk']);
            $table->string('jenis_tanah');
            $table->decimal('luas_lahan', 10, 2)->nullable(); // Bisa null jika tidak selalu diisi
            $table->integer('ketinggian_mdpl')->nullable(); // Bisa null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahans');
    }
};
