<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("social_interest_logs", function (Blueprint $table) {
            $table->id();
            $table->string("platform"); // facebook, twitter, instagram
            $table->string("ip_hash", 64); // SHA-256 hash of IP for privacy
            $table->string("user_agent")->nullable(); // Browser/device info
            $table->string("referrer")->nullable(); // Where they came from
            $table->timestamps();

            // Index for quick lookups
            $table->index("ip_hash");
            $table->index("platform");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("social_interest_logs");
    }
};
