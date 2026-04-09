<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index()
    {
        $libros = Libro::with('autor')->get();
        return view('pages.books.index', compact('libros'));
    }

    public function create()
    {
        //Aqui se esta obteniendo la lista de autores para mostrarla en el formulario de creacion de libros. Se ordenan por nombre para que sea mas facil encontrar el autor deseado.
        $autores = Autor::orderBy('nombre')->get();
        //Si el autor esta vacio, se redirige a la pagina de libros con un mensaje de error, indicando que no hay autores disponibles y que se debe crear un autor antes de crear un libro
        if ($autores->isEmpty()) {
            return redirect()->route('books.index')->with('error', 'No hay autores disponibles. Por favor, crea un autor antes de crear un libro.');
        }
        return view('pages.books.create', compact('autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'           => 'required|string|max:255',
            //.date('Y') se utiliza para obtener el año actual, y se establece como el valor máximo permitido para el campo 'anio_publicacion', lo que significa que el usuario no podrá ingresar un año de publicación que sea mayor al año actual.
            'anio_publicacion' => 'nullable|integer|min:1000|max:' . date('Y'),
            'stock'            => 'required|integer|min:0',
            'autor_id'         => 'required|exists:autors,id',
        ]);

        Libro::create($request->only(['titulo', 'anio_publicacion', 'stock', 'autor_id']));

        return redirect()->route('books.index')->with('success', 'Libro creado exitosamente.');
    }

    public function destroy(Libro $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Libro eliminado exitosamente.');
    }
}
