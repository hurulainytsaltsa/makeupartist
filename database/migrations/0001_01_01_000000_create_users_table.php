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
        // Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name');
            $table->string('username')->unique(); // Username field ditambahkan
            $table->string('email')->unique();
            $table->string('alamat'); // Alamat pengguna
            $table->string('no_telp', 15); // Nomor telepon dengan panjang maksimal 15
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); // created_at & updated_at
        });

        // Tabel Password Reset Tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email sebagai primary key
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel Sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID session sebagai primary key
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Foreign key ke users
            $table->string('ip_address', 45)->nullable(); // IPv4 atau IPv6
            $table->text('user_agent')->nullable(); // Informasi browser/user agent
            $table->longText('payload'); // Data session
            $table->integer('last_activity')->index(); // Timestamp aktivitas terakhir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
