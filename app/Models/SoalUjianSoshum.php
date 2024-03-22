<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalUjianSoshum extends Model
{
    use HasFactory;

    protected $fillable = [
        'soal',
        'soal_gambar',
        'soal_audio',
        'jawaban_a',
        'jawaban_a_gambar',
        'jawaban_b',
        'jawaban_b_gambar',
        'jawaban_c',
        'jawaban_c_gambar',
        'jawaban_d',
        'jawaban_d_gambar',
        'jawaban_e',
        'jawaban_e_gambar',
        'kunci_jawaban',
        'point_soal',
        'konten_bacaan_teks',
        'konten_bacaan_gambar',
        'paket_soal_ujian_id',
        'kategori_soal_id',
        'kategori_utbk_id',
    ];

    public function KategoriUtbk(): BelongsTo
    {
        return $this->belongsTo(KategoriUtbk::class);
    }

    public function PaketSoal(): BelongsTo
    {
        return $this->belongsTo(PaketSoalUjianSoshum::class);
    }

    public function KategoriSoal(): BelongsTo
    {
        return $this->belongsTo(KategoriSoalSoshum::class);
    }
}
