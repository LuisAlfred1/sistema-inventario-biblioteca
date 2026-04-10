@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <header class="flex items-center justify-between mb-6">
            <section class="flex items-start gap-6">
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
            </section>

            <section class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <form action="{{ route('books.index') }}" method="GET" class="relative w-full md:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="search-input" name="search" value="{{ request('search') }}"
                            placeholder="Buscar libro..."
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:ring focus:ring-gray-300 outline-none text-sm">

                        @if (request('search'))
                            <a href="{{ route('books.index') }}"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        @endif
                    </form>
                </div>
                <a href="{{ route('books.create') }}"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium
                  bg-sky-600 hover:bg-sky-700 text-white transition">
                    <i class="bi bi-plus-lg text-[13px]"></i>
                    Crear libro
                </a>
            </section>

        </header>
        {{-- Cards --}}
        @if ($libros->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <i class="bi bi-journals text-4xl block mb-3"></i>
                <p class="text-sm">No hay libros registrados aún.</p>
            </div>
        @else
            <div class="overflow-y-auto pr-1" style="max-height: calc(100vh - 185px);">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="cards-grid">
                    @foreach ($libros as $libro)
                        <x-book-card :libro="$libro" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
<script>
    const input = document.getElementById('search-input');
    const grid = document.getElementById('cards-grid');
    let debounce;

    input.addEventListener('input', () => {
        clearTimeout(debounce);
        debounce = setTimeout(async () => {
            const search = input.value.trim();

            if (search.length === 0) {
                location.reload();
                return;
            }

            // Spinner
            grid.innerHTML = `
                <div class="col-span-3 py-10 text-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin mx-auto h-8 w-8 text-sky-700" viewBox="0 0 24 24"><defs><linearGradient id="gradient" x1="0%" x2="100%" y1="0%" y2="100%"><stop offset="0%" stop-color="currentColor" stop-opacity=".1"/><stop offset="100%" stop-color="currentColor" stop-opacity=".3"/></linearGradient></defs><circle cx="12" cy="12" r="10" fill="none" stroke="url(#gradient)" stroke-width="3"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="3" d="M12 2a10 10 0 0 1 10 10"/></svg>
                    Buscando...
                </div>`;

            const res = await fetch(`{{ route('books.search') }}?search=${encodeURIComponent(search)}`);
            const libros = await res.json();

            if (libros.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-3 py-16 text-center text-gray-400">
                        <i class="bi bi-journals text-4xl block mb-3"></i>
                        <p class="text-sm">No se encontraron libros.</p>
                    </div>`;
                return;
            }

            grid.innerHTML = libros.map(libro => `
                <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4 hover:shadow-sm transition">
                    <div class="flex-shrink-0 w-14 h-20 bg-gray-100 rounded-md overflow-hidden">
                        <img src="{{ asset('images/bookGradient.png') }}" alt="Libro" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-medium text-gray-800 text-sm leading-snug truncate">${libro.titulo}</h3>
                            <span class="flex-shrink-0 px-2.5 py-0.5 rounded-full text-xs font-medium ${libro.stock > 0 ? 'bg-sky-50 text-sky-700' : 'bg-red-50 text-red-600'}">
                                ${libro.stock} en stock
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                            <i class="bi bi-person"></i> ${libro.autor.nombre}
                        </p>
                        ${libro.anio_publicacion ? `
                        <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                            <i class="bi bi-calendar3"></i> ${libro.anio_publicacion}
                        </p>` : ''}
                    </div>
                    <div class="flex-shrink-0">
                        <form action="/books/${libro.id}" method="POST" class="inline">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                class="text-gray-300 hover:text-red-500 transition cursor-pointer"
                                onclick="return confirm('¿Eliminar este libro?')">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            `).join('');

        }, 350);
    });
</script>
@endpush