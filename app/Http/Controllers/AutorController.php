<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::withCount('libros')->orderBy('nombre')->get();
        return view('pages.autors.index', compact('autores'));
    }

    public function create()
    {
        return view('pages.autors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
        ]);

        Autor::create($request->only(['nombre', 'nacionalidad']));

        return redirect()->route('autors.index')
            ->with('success', 'Autor creado exitosamente.');
    }
}
