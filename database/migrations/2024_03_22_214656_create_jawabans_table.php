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
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->text('jawaban');
            $table->string('gambar')->nullable();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaans');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawabans');
    }
};
