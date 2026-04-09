<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::get('/books',        [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books',       [BookController::class, 'store'])->name('books.store');

Route::get('/autors',        [AutorController::class, 'index'])->name('autors.index');
Route::get('/autors/create', [AutorController::class, 'create'])->name('autors.create');
Route::post('/autors',       [AutorController::class, 'store'])->name('autors.store');
