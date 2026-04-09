@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="mb-6">
            <a href="{{ route('autors.index') }}"
                class="flex items-center gap-1 text-sm text-gray-500 hover:text-sky-600 transition mb-3">
                <i class="bi bi-arrow-left"></i>
                Volver a autores
            </a>
            <h1 class="text-xl font-medium text-gray-800">Crear autor</h1>
            <p class="text-sm text-gray-500 mt-0.5">Completa los campos para registrar un nuevo autor.</p>
        </div>

        {{-- Form --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <form action="{{ route('autors.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf

                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nombre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ej. Gabriel García Márquez"
                        class="w-full px-3.5 py-2 rounded-lg border text-sm
                              {{ $errors->has('nombre') ? 'border-red-400' : 'border-gray-200' }}
                              focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                    @error('nombre')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nacionalidad --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nacionalidad</label>
                    <input type="text" name="nacionalidad" value="{{ old('nacionalidad') }}" placeholder="Ej. Colombiana"
                        class="w-full px-3.5 py-2 rounded-lg border text-sm
                              {{ $errors->has('nacionalidad') ? 'border-red-400' : 'border-gray-200' }}
                              focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                    @error('nacionalidad')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                    <a href="{{ route('autors.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600
                          hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                               bg-sky-600 hover:bg-sky-700 text-white transition">
                        <i class="bi bi-check-lg"></i>
                        Guardar autor
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
