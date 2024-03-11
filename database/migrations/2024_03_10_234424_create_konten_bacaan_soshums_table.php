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
        Schema::create('konten_bacaan_soshums', function (Blueprint $table) {
            $table->id();
            $table->text('konten_bacaan');
            $table->foreignId('paket_soal_id')->constrained('paket_soals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_bacaan_soshums');
    }
};
