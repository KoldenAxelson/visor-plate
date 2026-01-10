<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ContactForm;
use App\Http\Controllers\CheckoutController;

Route::get("/", function () {
    return view("home");
})->name("home");

Route::get("/shop", function () {
    return view("shop");
})->name("shop");

Route::get("/design", function () {
    return view("design");
})->name("design");

Route::get("/contact", ContactForm::class)->name("contact");
Route::get("/wholesale", ContactForm::class)->name("wholesale");

// Checkout Routes
Route::post("/checkout/create", [
    CheckoutController::class,
    "createCheckoutSession",
])->name("checkout.create");
Route::get("/checkout/success", [CheckoutController::class, "success"])->name(
    "checkout.success",
);
Route::get("/checkout/cancel", [CheckoutController::class, "cancel"])->name(
    "checkout.cancel",
);

// Stripe Webhook
Route::post("/stripe/webhook", [CheckoutController::class, "webhook"])->name(
    "stripe.webhook",
);
