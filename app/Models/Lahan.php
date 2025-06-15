<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;

    // Definisikan nama tabel jika tidak mengikuti konvensi Laravel (plural dari nama model)
    protected $table = 'lahans'; // Opsional, karena Laravel otomatis mencari 'lahans'

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'nama_lahan',
        'ph_tanah',
        'intensitas_sinar_matahari',
        'kelembaban_tanah',
        'drainase_tanah',
        'jenis_tanah',
        'luas_lahan',
        'ketinggian_mdpl',
    ];

    /**
     * Relasi: Satu Lahan dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu Lahan bisa memiliki banyak Rekomendasi.
     */
    public function rekomendasis()
    {
        return $this->hasMany(Rekomendasi::class);
    }
}