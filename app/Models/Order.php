<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "stripe_checkout_session_id",
        "stripe_payment_intent_id",
        "email",
        "name",
        "quantity",
        "amount_cents",
        "status",
        "shipping_address",
        "completed_at",
    ];

    protected $casts = [
        "shipping_address" => "array",
        "completed_at" => "datetime",
    ];

    /**
     * Get the total price in dollars
     */
    public function getTotalAttribute(): float
    {
        return $this->amount_cents / 100;
    }

    /**
     * Mark order as completed
     */
    public function markAsCompleted(): void
    {
        $this->update([
            "status" => "completed",
            "completed_at" => now(),
        ]);
    }

    /**
     * Scope for completed orders
     */
    public function scopeCompleted($query)
    {
        return $query->where("status", "completed");
    }
}
