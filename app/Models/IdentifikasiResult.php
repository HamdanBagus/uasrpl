<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentifikasiResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plant_name',
        'probability',
        'uploaded_image_path',
        'api_response_details',
    ];

    // Cast 'api_response_details' ke array/json agar Laravel otomatis mengonversi saat mengambil dari DB
    protected $casts = [
        'api_response_details' => 'array',
    ];

    /**
     * Relasi: Satu hasil identifikasi dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}