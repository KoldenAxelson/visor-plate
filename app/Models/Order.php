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
        "tracking_number",
        "shipped_at",
    ];

    protected $casts = [
        "shipping_address" => "array",
        "completed_at" => "datetime",
        "shipped_at" => "datetime",
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
     * Mark order as shipped with tracking number
     *
     * @param string $trackingNumber
     * @return void
     */
    public function markAsShipped(string $trackingNumber): void
    {
        $this->update([
            "status" => "shipped",
            "tracking_number" => $trackingNumber,
            "shipped_at" => now(),
        ]);
    }

    /**
     * Check if order has been shipped
     *
     * @return bool
     */
    public function isShipped(): bool
    {
        return !is_null($this->shipped_at) && !is_null($this->tracking_number);
    }

    /**
     * Check if order is pending shipment
     *
     * @return bool
     */
    public function isPendingShipment(): bool
    {
        return in_array($this->status, ["pending", "completed"]) &&
            is_null($this->shipped_at);
    }

    /**
     * Scope for completed orders
     */
    public function scopeCompleted($query)
    {
        return $query->where("status", "completed");
    }

    /**
     * Scope for shipped orders
     */
    public function scopeShipped($query)
    {
        return $query->where("status", "shipped")->whereNotNull("shipped_at");
    }

    /**
     * Scope for orders pending shipment
     */
    public function scopePendingShipment($query)
    {
        return $query
            ->whereIn("status", ["pending", "completed"])
            ->whereNull("shipped_at");
    }
}
