<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("home");
});

Route::get("/shop", function () {
    return view("shop");
})->name("shop");

Route::get("/design", function () {
    return view("design");
})->name("design");
