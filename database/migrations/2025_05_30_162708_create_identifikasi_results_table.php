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
        Schema::create('identifikasi_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User yang melakukan identifikasi
            $table->string('plant_name'); // Nama tanaman dari Plant.id
            $table->decimal('probability', 5, 2); // Probabilitas kecocokan
            $table->string('uploaded_image_path')->nullable(); // Path gambar yang diunggah user
            $table->json('api_response_details')->nullable(); // Detail JSON lengkap dari API (opsional, bisa simpan sebagian)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identifikasi_results');
    }
};
