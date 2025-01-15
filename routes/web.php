<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';


route::get('products',[ProductController::class,'index'])->name('products.index');
route::get('products/create',[ProductController::class,'create'])->name('products.create');
route::post('products',[ProductController::class,'store'])->name('products.store');
route::put('products/{id}',[ProductController::class,'update'])->name('products.update');
route::delete('products/{id}',[ProductController::class,'delete'])->name('products.delete');
