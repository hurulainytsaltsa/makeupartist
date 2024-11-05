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
        Schema::create('detail_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Paket A, Paket B
            $table->enum('type', ['package', 'addon', 'service']); // Type of detail (package, addon, or service)
            $table->text('description')->nullable(); // Additional details, if any
            $table->decimal('price', 10, 2); // Price of the package or add-on
            $table->string('bonus')->nullable(); // Bonus description, if applicable
            // Foreign key constraint
            $table->foreignId('package_makeup_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_packages');
    }
};
