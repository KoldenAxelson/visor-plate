<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("newsletter_signups", function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->string("source")->nullable(); // e.g., 'social-interest-instagram', 'footer', etc.
            $table->string("ip_hash", 64)->nullable(); // SHA-256 hash for duplicate detection
            $table->timestamps();

            $table->index("email");
            $table->index("source");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("newsletter_signups");
    }
};
