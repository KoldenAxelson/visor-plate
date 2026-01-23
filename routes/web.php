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

Route::get("/faq", function () {
    return view("faq");
})->name("faq");

// Contact Routes
Route::get("/contact", ContactForm::class)->name("contact");
Route::get("/wholesale", function () {
    return redirect()->route("contact", ["mode" => "wholesale"]);
})->name("wholesale");
Route::get("/return", function () {
    return redirect()->route("contact", ["mode" => "return"]);
})->name("return");
Route::get("/review", function () {
    return redirect()->route("contact", ["mode" => "review"]);
})->name("review");

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
Route::post("/stripe/webhook", [CheckoutController::class, "webhook"])
    ->name("stripe.webhook")
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

// Social Interest Tracking
Route::get("/social-interest", [
    \App\Http\Controllers\SocialInterestController::class,
    "track",
])->name("social.interest");

Route::post("/social-interest/swap", [
    \App\Http\Controllers\SocialInterestController::class,
    "swap",
])->name("social.swap");
