<?php

use App\Http\Controllers\Crud;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserdbController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //----------start crud routes
    Route::get("/add", [Crud::class, "addstd"]);
    Route::post("/add", [Crud::class, "insertStd"]);
    Route::get("/show", [Crud::class, "showStd"]);
    Route::get("/delete", [Crud::class, "deleteStd"]);
    //----------end crud routes
});

require __DIR__ . '/auth.php';



Route::get("/users", [UserdbController::class, "index"]);



Route::get("/contact", [EmailController::class, "contactForm"]);
Route::post("/contact", [EmailController::class, "sendContactEmail"]);



