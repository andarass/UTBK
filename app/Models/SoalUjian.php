<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalUjian extends Model
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
        'konten_bacaan_teks',
        'konten_bacaan_gambar',
        'kunci_jawaban',
        'point_soal',
        'paket_soal_id',
        'kategori_id',
    ];

    public function PaketSoal(): BelongsTo
    {
        return $this->belongsTo(PaketSoalUjian::class);
    }

    public function Kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
