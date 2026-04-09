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
        {{-- Cards --}}
        @if ($libros->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <i class="bi bi-journals text-4xl block mb-3"></i>
                <p class="text-sm">No hay libros registrados aún.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($libros as $libro)
                    <x-book-card :libro="$libro" />
                @endforeach
            </div>
        @endif

    </div>
@endsection
