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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->enum('no_rekening', ['56792372343 - Bank BRI', '98765482637 - Bank BCA', '7432109876 9- Bank BNI']);
            $table->string('bukti_pembayaran');
            $table->enum('status_pembayaran', ['Payment Approved', 'Waiting for Approval'])->nullable();
            $table->foreignId('booking_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
