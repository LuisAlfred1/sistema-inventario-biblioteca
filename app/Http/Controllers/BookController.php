<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index()
    {
        //Aqui esta retornando la vista de los libros, pero no se esta pasando ningun dato, por lo que no se mostrara nada en la vista
        return view('pages.books.index');
    }

    public function create()
    {
        //Aqui esta retornando la vista para crear un nuevo libro
        return view('pages.books.create');
    }
}
