<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'jawaban',
        'gambar',
        'pertanyaan_id',
        'user_id',
    ];

    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }




}
