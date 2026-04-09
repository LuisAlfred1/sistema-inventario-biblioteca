<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Rutas para libros y autores, se utiliza resource para generar automáticamente las rutas RESTful y simplificar el código. Esto incluye rutas para index, create, store y destroy.
Route::resource('books', BookController::class);
Route::resource('autors', AutorController::class);
