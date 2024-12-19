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
        Schema::table('penugasans', function (Blueprint $table) {
            $table->unsignedBigInteger('mua_id')->nullable()->after('nama_mua'); // Tambahkan kolom MUA ID
            $table->foreign('mua_id')->references('id')->on('mua_profiles')->onDelete('set null'); // Foreign key ke tabel mua_profiles
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penugasans', function (Blueprint $table) {
            //
        });
    }
};
