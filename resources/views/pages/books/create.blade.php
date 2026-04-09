@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-6">
            <a href="{{ route('books.index') }}"
                class="flex items-center gap-1 text-sm text-gray-500 hover:text-sky-600 transition mb-3">
                <i class="bi bi-arrow-left"></i>
                Volver a libros
            </a>
            <h1 class="text-xl font-medium text-gray-800">Crear libro</h1>
            <p class="text-sm text-gray-500 mt-0.5">Completa los campos para registrar un nuevo libro.</p>
        </div>

        {{-- Form --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <form action="{{ route('books.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf

                {{-- Título --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Título <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}" placeholder="Ej. Cien años de soledad"
                        class="w-full px-3.5 py-2 rounded-lg border text-sm
                              {{ $errors->has('titulo') ? 'border-red-400' : 'border-gray-200' }}
                              focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                    @error('titulo')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Autor --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Autor <span class="text-red-500">*</span>
                    </label>
                    <select name="autor_id"
                        class="w-full px-3.5 py-2 rounded-lg border text-sm
                               {{ $errors->has('autor_id') ? 'border-red-400' : 'border-gray-200' }}
                               focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                        <option value="">Selecciona un autor</option>
                        @foreach ($autores as $autor)
                            <option value="{{ $autor->id }}" {{ old('autor_id') == $autor->id ? 'selected' : '' }}>
                                {{ $autor->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('autor_id')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Año de publicación y stock --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Año de publicación</label>
                        <input type="number" name="anio_publicacion" value="{{ old('anio_publicacion') }}"
                            placeholder="Ej. 1967"
                            class="w-full px-3.5 py-2 rounded-lg border text-sm
                                  {{ $errors->has('anio_publicacion') ? 'border-red-400' : 'border-gray-200' }}
                                  focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                        @error('anio_publicacion')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                            class="w-full px-3.5 py-2 rounded-lg border text-sm
                              {{ $errors->has('stock') ? 'border-red-400' : 'border-gray-200' }}
                              focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                        @error('stock')
                            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- Botones --}}
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                    <a href="{{ route('books.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600
                          hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                               bg-sky-600 hover:bg-sky-700 text-white transition">
                        <i class="bi bi-check-lg"></i>
                        Guardar libro
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
