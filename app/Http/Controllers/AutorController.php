<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda desde la solicitud
        $search = $request->input('search');

        // Utilizar el método when para aplicar el filtro de búsqueda solo si se proporciona un término de búsqueda
        $autores = Autor::withCount('libros')
            ->when($search, function ($query) use ($search) {
                // Filtrar por nombre utilizando el término de búsqueda
                $query->where('nombre', 'like', '%' . $search . '%');
            })
            // Ordenar por nombre y paginar los resultados con 7 autores por página
            ->orderBy('nombre')
            ->paginate(7);

        // Devolver la vista con los autores y el término de búsqueda para mantenerlo en el formulario
        return view('pages.autors.index', compact('autores', 'search'));
    }

    // Método para la búsqueda en tiempo real
    public function search(Request $request)
    {
        // Validar que el término de búsqueda sea una cadena, es decir, un texto
        $autores = Autor::withCount('libros')
            // Filtrar por nombre utilizando el término de búsqueda
            ->where('nombre', 'like', '%' . $request->input('search') . '%')
            // Ordenar por nombre
            ->orderBy('nombre')
            // Obtener los resultados
            ->get();
        // Devolver los resultados como JSON
        return response()->json($autores);
    }

    public function create()
    {
        return view('pages.autors.create');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada para crear un nuevo autor
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
        ]);

        // Crear un nuevo autor utilizando los datos validados
        Autor::create($request->only(['nombre', 'nacionalidad']));

        // Redirigir a la página de autores con un mensaje de éxito
        return redirect()->route('autors.index')
            ->with('success', 'Autor creado exitosamente.');
    }

    public function destroy(Autor $autor)
    {
        // Verificar si el autor tiene libros asociados antes de eliminarlo
        if ($autor->libros()->count() > 0) {
            // Si el autor tiene libros asociados, redirigir a la página de autores con un mensaje de error
            return redirect()->route('autors.index')
                ->with('error', 'No se puede eliminar el autor porque tiene libros asociados.');
        }

        // Si el autor no tiene libros asociados, se elimina y se redirige a la página de autores con un mensaje de éxito
        $autor->delete();
        return redirect()->route('autors.index')
            ->with('success', 'Autor eliminado exitosamente.');
    }
}
