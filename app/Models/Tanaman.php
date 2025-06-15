<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    protected $table = 'tanaman'; // Opsional, karena Laravel otomatis mencari 'tanamen' (ini yang ingin dihindari)

    protected $fillable = [
        'nama',
        'deskripsi',
        'cara_tanam',
        'gambar',
        'ph_min',
        'ph_max',
        'intensitas_sinar_matahari',
        'kelembaban_tanah',
        'drainase_tanah',
        'jenis_tanah',
        'ketinggian_mdpl_min',
        'ketinggian_mdpl_max',
    ];

    /**
     * Relasi: Satu Tanaman bisa muncul di banyak Rekomendasi.
     */
    public function rekomendasis()
    {
        return $this->hasMany(Rekomendasi::class);
    }
}