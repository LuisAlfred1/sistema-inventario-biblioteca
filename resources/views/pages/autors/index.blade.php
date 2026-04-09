@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <header class="flex items-center justify-between mb-6">
            <section class="flex items-start gap-6">
                <div>
                    <h1 class="text-xl font-medium text-gray-800">Autores</h1>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $autores->count() }} autores registrados</p>
                </div>
                {{-- Alerta --}}
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
            </section>

            <section class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <form action="{{ route('autors.index') }}" method="GET" class="relative w-full md:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar autor..."
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:ring focus:ring-gray-300 outline-none text-sm">

                        @if (request('search'))
                            <a href="{{ route('autors.index') }}"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        @endif
                    </form>
                </div>
                <a href="{{ route('autors.create') }}"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                  bg-sky-600 hover:bg-sky-700 text-white transition">
                    <i class="bi bi-plus-lg text-[13px]"></i>
                    Crear autor
                </a>
            </section>
        </header>


        <div class="overflow-hidden bg-white rounded-xl  border border-gray-200 flex flex-col">
            <div class="grow">
                <div class="bg-white rounded-xl border border-gray-200 flex flex-col" style="min-height: 390px;">
                    {{-- Tabla --}}
                    <div class="flex-1">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 font-medium">
                                    <th class="text-left px-5 py-3">#</th>
                                    <th class="text-left px-5 py-3">Nombre</th>
                                    <th class="text-left px-5 py-3">Nacionalidad</th>
                                    <th class="text-left px-5 py-3">Libros</th>
                                    <th class="text-left px-5 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($autores as $autor)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-5 py-3 text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="px-5 py-3 font-medium text-gray-800">{{ $autor->nombre }}</td>
                                        <td class="px-5 py-3 text-gray-500">{{ $autor->nacionalidad ?? '—' }}</td>
                                        <td class="px-5 py-3">
                                            <span
                                                class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-50 text-sky-700">
                                                {{ $autor->libros_count }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3">
                                            <form action="{{ route('autors.destroy', $autor) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 transition cursor-pointer"
                                                    onclick="return confirm('¿Eliminar este autor?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">
                                            <i class="bi bi-people text-2xl block mb-2"></i>
                                            No hay autores registrados aún.
                                        </td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación siempre al fondo --}}
                    <div class="px-6 py-3 border-t border-gray-200 text-gray-500 mt-auto">
                        {{ $autores->appends(['search' => request('search')])->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
