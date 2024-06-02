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
        Schema::create('latihan_soals', function (Blueprint $table) {
            $table->id();
            $table->text('soal')->nullable();
            $table->string('soal_gambar')->nullable();
            $table->string('soal_audio')->nullable();
            $table->text('jawaban_a')->nullable();
            $table->string('jawaban_a_gambar')->nullable();
            $table->text('jawaban_b')->nullable();
            $table->string('jawaban_b_gambar')->nullable();
            $table->text('jawaban_c')->nullable();
            $table->string('jawaban_c_gambar')->nullable();
            $table->text('jawaban_d')->nullable();
            $table->string('jawaban_d_gambar')->nullable();
            $table->text('jawaban_e')->nullable();
            $table->string('jawaban_e_gambar')->nullable();
            $table->text('konten_bacaan_teks')->nullable();
            $table->text('konten_bacaan_gambar')->nullable();
            $table->string('kunci_jawaban');
            $table->string('point_soal');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan_soals');
    }
};
