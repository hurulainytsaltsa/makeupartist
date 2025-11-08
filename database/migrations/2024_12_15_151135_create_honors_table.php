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
        Schema::create('honors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penugasan_id')->constrained('penugasans'); // Relasi ke tabel penugasans
            $table->foreignId('mua_id')->constrained('mua_profiles'); // Relasi ke tabel mua_profiles
            $table->decimal('gaji_kotor', 10, 2); // Field untuk gaji kotor
            $table->decimal('gaji_bersih', 10, 2); // Field untuk gaji bersih
            $table->string('status'); // Field untuk status
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honors');
    }
};
