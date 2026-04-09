<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Rutas para libros y autores, se utiliza resource para generar automáticamente las rutas RESTful y simplificar el código. Esto incluye rutas para index, create, store y destroy.
Route::resource('books', BookController::class);

//Ruta para la búsqueda en tiempo real de autores, se define una ruta GET que apunta al método search del AutorController. Esta ruta se utiliza para manejar las solicitudes AJAX desde el frontend y devolver los resultados de búsqueda en formato JSON.
Route::get('/autors/search', [AutorController::class, 'search'])->name('autors.search');

Route::resource('autors', AutorController::class);
