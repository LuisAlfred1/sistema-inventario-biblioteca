@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-start gap-6">
                <div>
                    <h1 class="text-xl font-medium text-gray-800">Libros</h1>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $libros->count() }} libros registrados</p>
                </div>
                {{-- Alerta --}}
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
            </div>
            <a href="{{ route('books.create') }}"
                class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                  bg-sky-600 hover:bg-sky-700 text-white transition">
                <i class="bi bi-plus-lg text-[13px]"></i>
                Crear libro
            </a>
        </div>
        {{-- Tabla --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 font-medium">
                        <th class="text-left px-5 py-3">#</th>
                        <th class="text-left px-5 py-3">Título</th>
                        <th class="text-left px-5 py-3">Autor</th>
                        <th class="text-left px-5 py-3">Año</th>
                        <th class="text-left px-5 py-3">Stock</th>
                        <th class="text-left px-5 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($libros as $libro)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium text-gray-800">{{ $libro->titulo }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $libro->autor->nombre }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $libro->anio_publicacion ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $libro->stock > 0 ? 'bg-sky-50 text-sky-700' : 'bg-red-50 text-red-600' }}">
                                    {{ $libro->stock }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <form action="{{ route('books.destroy', $libro) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition cursor-pointer"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este libro?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-gray-400">
                                <i class="bi bi-journals text-2xl block mb-2"></i>
                                No hay libros registrados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
