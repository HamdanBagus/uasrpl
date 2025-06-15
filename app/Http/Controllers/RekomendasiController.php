<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Tanaman;
use App\Models\Rekomendasi; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    /**
     * Menampilkan rekomendasi tanaman berdasarkan data lahan.
     */
    public function show(Lahan $lahan)
    {
        // Pastikan user hanya bisa mendapatkan rekomendasi untuk lahannya sendiri
        if ($lahan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke lahan ini.');
        }

        // Inisialisasi array untuk menampung tanaman yang direkomendasikan
        $recommendedTanaman = collect();

        // Ambil semua tanaman dari database
        $allTanaman = Tanaman::all();

        foreach ($allTanaman as $tanaman) {
            $score = 0; // Skor kecocokan untuk setiap tanaman
            $matchDetails = []; // Detail alasan kecocokan

            // 1. Kecocokan pH Tanah
            if ($lahan->ph_tanah >= $tanaman->ph_min && $lahan->ph_tanah <= $tanaman->ph_max) {
                $score += 1;
                $matchDetails[] = 'pH tanah (' . $lahan->ph_tanah . ') cocok dengan rentang ideal tanaman (' . $tanaman->ph_min . '-' . $tanaman->ph_max . ').';
            } else {
                $matchDetails[] = 'pH tanah (' . $lahan->ph_tanah . ') TIDAK cocok dengan rentang ideal tanaman (' . $tanaman->ph_min . '-' . $tanaman->ph_max . ').';
            }

            // 2. Kecocokan Intensitas Sinar Matahari
            $sinarMatahariLahan = $lahan->intensitas_sinar_matahari;
            $sinarMatahariTanaman = $tanaman->intensitas_sinar_matahari;

            if ($sinarMatahariTanaman === 'semua' || $sinarMatahariTanaman === $sinarMatahariLahan) {
                $score += 1;
                $matchDetails[] = 'Intensitas sinar matahari (' . $sinarMatahariLahan . ') cocok.';
            } elseif ($sinarMatahariTanaman === 'rendah_sedang' && ($sinarMatahariLahan === 'rendah' || $sinarMatahariLahan === 'sedang')) {
                $score += 1;
                $matchDetails[] = 'Intensitas sinar matahari (' . $sinarMatahariLahan . ') cocok dengan rentang rendah-sedang.';
            } elseif ($sinarMatahariTanaman === 'sedang_tinggi' && ($sinarMatahariLahan === 'sedang' || $sinarMatahariLahan === 'tinggi')) {
                $score += 1;
                $matchDetails[] = 'Intensitas sinar matahari (' . $sinarMatahariLahan . ') cocok dengan rentang sedang-tinggi.';
            } else {
                $matchDetails[] = 'Intensitas sinar matahari (' . $sinarMatahariLahan . ') TIDAK cocok (' . $sinarMatahariTanaman . ' dibutuhkan).';
            }

            // 3. Kecocokan Kelembaban Tanah
            $kelembabanLahan = $lahan->kelembaban_tanah;
            $kelembabanTanaman = $tanaman->kelembaban_tanah;

            if ($kelembabanTanaman === 'semua' || $kelembabanTanaman === $kelembabanLahan) {
                $score += 1;
                $matchDetails[] = 'Kelembaban tanah (' . $kelembabanLahan . ') cocok.';
            } elseif ($kelembabanTanaman === 'rendah_sedang' && ($kelembabanLahan === 'rendah' || $kelembabanLahan === 'sedang')) {
                $score += 1;
                $matchDetails[] = 'Kelembaban tanah (' . $kelembabanLahan . ') cocok dengan rentang rendah-sedang.';
            } elseif ($kelembabanTanaman === 'sedang_tinggi' && ($kelembabanLahan === 'sedang' || $kelembabanLahan === 'tinggi')) {
                $score += 1;
                $matchDetails[] = 'Kelembaban tanah (' . $kelembabanLahan . ') cocok dengan rentang sedang-tinggi.';
            } else {
                $matchDetails[] = 'Kelembaban tanah (' . $kelembabanLahan . ') TIDAK cocok (' . $kelembabanTanaman . ' dibutuhkan).';
            }

            // 4. Kecocokan Drainase Tanah
            $drainaseLahan = $lahan->drainase_tanah;
            $drainaseTanaman = $tanaman->drainase_tanah;

            if ($drainaseTanaman === 'semua' || $drainaseTanaman === $drainaseLahan) {
                $score += 1;
                $matchDetails[] = 'Drainase tanah (' . $drainaseLahan . ') cocok.';
            } elseif ($drainaseTanaman === 'baik_sedang' && ($drainaseLahan === 'baik' || $drainaseLahan === 'sedang')) {
                $score += 1;
                $matchDetails[] = 'Drainase tanah (' . $drainaseLahan . ') cocok dengan rentang baik-sedang.';
            } else {
                $matchDetails[] = 'Drainase tanah (' . $drainaseLahan . ') TIDAK cocok (' . $drainaseTanaman . ' dibutuhkan).';
            }

            // 5. Kecocokan Jenis Tanah
            $jenisTanahLahan = strtolower($lahan->jenis_tanah);
            $jenisTanahTanamanArray = array_map('trim', explode(',', strtolower($tanaman->jenis_tanah))); // Pisahkan jika ada koma

            if (in_array($jenisTanahLahan, $jenisTanahTanamanArray)) {
                $score += 1;
                $matchDetails[] = 'Jenis tanah (' . $jenisTanahLahan . ') cocok.';
            } else {
                $matchDetails[] = 'Jenis tanah (' . $jenisTanahLahan . ') TIDAK cocok (butuh: ' . $tanaman->jenis_tanah . ').';
            }

            // 6. Kecocokan Ketinggian MDPL
            if ($lahan->ketinggian_mdpl !== null && $tanaman->ketinggian_mdpl_min !== null && $tanaman->ketinggian_mdpl_max !== null) {
                if ($lahan->ketinggian_mdpl >= $tanaman->ketinggian_mdpl_min && $lahan->ketinggian_mdpl <= $tanaman->ketinggian_mdpl_max) {
                    $score += 1;
                    $matchDetails[] = 'Ketinggian MDPL (' . $lahan->ketinggian_mdpl . ') cocok dengan rentang ideal (' . $tanaman->ketinggian_mdpl_min . '-' . $tanaman->ketinggian_mdpl_max . ').';
                } else {
                    $matchDetails[] = 'Ketinggian MDPL (' . $lahan->ketinggian_mdpl . ') TIDAK cocok dengan rentang ideal (' . $tanaman->ketinggian_mdpl_min . '-' . $tanaman->ketinggian_mdpl_max . ').';
                }
            } elseif ($lahan->ketinggian_mdpl !== null && $tanaman->ketinggian_mdpl_min === null && $tanaman->ketinggian_mdpl_max === null) {
                 // Jika data lahan ada tapi tanaman tidak punya preferensi MDPL, anggap cocok
                 $score += 1;
                 $matchDetails[] = 'Ketinggian MDPL (' . $lahan->ketinggian_mdpl . ') tidak ada preferensi spesifik dari tanaman, dianggap cocok.';
            } else {
                $matchDetails[] = 'Data ketinggian MDPL tidak lengkap untuk evaluasi.';
            }


            // Hanya rekomendasikan tanaman jika skor kecocokan di atas ambang batas tertentu
            // Anda bisa menyesuaikan ambang batas ini
            $minScoreForRecommendation = 4; // Contoh: minimal 4 kriteria cocok dari 6

            if ($score >= $minScoreForRecommendation) {
                $tanaman->score_kecocokan = ($score / 6) * 100; // Hitung persentase kecocokan
                $tanaman->match_details = $matchDetails; // Simpan detail kecocokan
                $recommendedTanaman->push($tanaman);

                // Simpan rekomendasi ke tabel 'rekomendasis' (opsional, tergantung kebutuhan)
                // Pastikan tidak ada duplikasi jika rekomendasi disimpan berulang
                Rekomendasi::firstOrCreate(
                    [
                        'lahan_id' => $lahan->id,
                        'tanaman_id' => $tanaman->id,
                    ],
                    [
                        'score_kecocokan' => $tanaman->score_kecocokan,
                        'catatan' => implode("\n", $matchDetails),
                    ]
                );
            }
        }

        // Urutkan tanaman yang direkomendasikan berdasarkan skor kecocokan (tertinggi di atas)
        $recommendedTanaman = $recommendedTanaman->sortByDesc('score_kecocokan');

        return view('rekomendasi.show', compact('lahan', 'recommendedTanaman'));
    }
}