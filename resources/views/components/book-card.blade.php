@props(['libro'])

<div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4 hover:shadow-sm transition">

    {{-- Imagen --}}
    {{-- Imagen --}}
    <div class="w-14 h-18 overflow-hidden shrink-0">
        <img src="{{ asset('images/bookGradient.png') }}" alt="Libro" class="w-full h-full object-cover">
    </div>
    {{-- Info --}}
    <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between gap-2">
            <h3 class="font-medium text-gray-800 text-sm leading-snug truncate">
                {{ $libro->titulo }}
            </h3>
            <span
                class="shrink-0 px-2.5 py-0.5 rounded-full text-xs font-medium
                {{ $libro->stock > 0 ? 'bg-sky-50 text-sky-700' : 'bg-red-50 text-red-600' }}">
                {{ $libro->stock }} en stock
            </span>
        </div>

        <p class="text-sm text-gray-500 mt-1 flex items-center gap-1">
            <i class="bi bi-person"></i>
            {{ $libro->autor->nombre }}
        </p>

        @if ($libro->anio_publicacion)
            <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                <i class="bi bi-calendar4-event"></i>
                {{ $libro->anio_publicacion }}
            </p>
        @endif
    </div>

    {{-- Eliminar --}}
    <div class="shrink-0">
        <form action="{{ route('books.destroy', $libro) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Eliminar este libro?')"
                class="text-gray-300 hover:text-red-500 transition cursor-pointer">
                <i class="bi bi-trash text-sm"></i>
            </button>
        </form>
    </div>

</div>
