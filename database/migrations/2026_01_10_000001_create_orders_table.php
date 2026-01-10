<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table->string("stripe_checkout_session_id")->unique();
            $table->string("stripe_payment_intent_id")->nullable();
            $table->string("email");
            $table->string("name");
            $table->integer("quantity")->default(1);
            $table->integer("amount_cents"); // Store in cents (e.g., 3500 for $35)
            $table->string("status")->default("pending"); // pending, completed, failed
            $table->json("shipping_address")->nullable(); // Store full address as JSON
            $table->timestamp("completed_at")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("orders");
    }
};
