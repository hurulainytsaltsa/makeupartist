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
        Schema::create('mua_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('pengalaman');
            $table->string('lokasi');
            $table->string('profile_photo'); // Path atau URL foto
            $table->string('portfolio_link'); // Link ke portofolio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mua_profiles');
    }
};
