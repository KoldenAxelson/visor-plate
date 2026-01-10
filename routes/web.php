<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ContactForm;

Route::get("/", function () {
    return view("home");
});

Route::get("/shop", function () {
    return view("shop");
})->name("shop");

Route::get("/design", function () {
    return view("design");
})->name("design");

Route::get("/contact", ContactForm::class)->name("contact");
Route::get("/wholesale", ContactForm::class)->name("wholesale");
