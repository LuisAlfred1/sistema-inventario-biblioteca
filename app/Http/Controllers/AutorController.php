<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $autores = Autor::withCount('libros')
            ->when($search, function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->orderBy('nombre')
            ->paginate(6);

        return view('pages.autors.index', compact('autores', 'search'));
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

    public function destroy(Autor $autor)
    {
        if ($autor->libros()->count() > 0) {
            return redirect()->route('autors.index')
                ->with('error', 'No se puede eliminar el autor porque tiene libros asociados.');
        }

        $autor->delete();
        return redirect()->route('autors.index')
            ->with('success', 'Autor eliminado exitosamente.');
    }
}
