@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-start gap-6">
                <div>
                    <h1 class="text-xl font-medium text-gray-800">Autores</h1>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $autores->count() }} autores registrados</p>
                </div>
                {{-- Alerta --}}
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
            </div>
            <a href="{{ route('autors.create') }}"
                class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                  bg-sky-600 hover:bg-sky-700 text-white transition">
                <i class="bi bi-plus-lg text-[13px]"></i>
                Crear autor
            </a>
        </div>


        {{-- Tabla --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 font-medium">
                        <th class="text-left px-5 py-3">#</th>
                        <th class="text-left px-5 py-3">Nombre</th>
                        <th class="text-left px-5 py-3">Nacionalidad</th>
                        <th class="text-left px-5 py-3">Libros</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($autores as $autor)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium text-gray-800">{{ $autor->nombre }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $autor->nacionalidad ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-50 text-sky-700">
                                    {{ $autor->libros_count }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-gray-400">
                                <i class="bi bi-people text-2xl block mb-2"></i>
                                No hay autores registrados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
