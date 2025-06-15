<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasis'; // Opsional

    protected $fillable = [
        'lahan_id',
        'tanaman_id',
        'score_kecocokan',
        'catatan',
    ];

    /**
     * Relasi: Satu Rekomendasi dimiliki oleh satu Lahan.
     */
    public function lahan()
    {
        return $this->belongsTo(Lahan::class);
    }

    /**
     * Relasi: Satu Rekomendasi terkait dengan satu Tanaman.
     */
    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}