<nav class="bg-white border-b border-gray-200 fixed z-20 left-0 right-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <a href="{{ route('books.index') }}" class="flex items-center gap-2 text-lg">
                <div class="text-sky-600 rounded-lg flex items-center justify-center">
                    <i class="bi bi-stack"></i>
                </div>
                <span class="font-medium text-gray-800">
                    Sistema de <span class="text-sky-600">Inventario</span>
                </span>
            </a>

            {{-- Desktop nav --}}
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('books.index') }}"
                    class="flex items-center gap-1.5 px-4 py-1 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('books.index')
                              ? 'bg-sky-50 text-sky-600'
                              : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                    <i class="bi bi-journals text-[20px]"></i>
                    Libros
                </a>

                <a href="{{ route('autors.index') }}"
                    class="flex items-center gap-1.5 px-4 py-1 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('autors.index')
                              ? 'bg-sky-50 text-sky-600'
                              : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                    <i class="bi bi-people text-[20px]"></i>
                    Autores
                </a>
            </div>

            {{-- Hamburger (mobile) --}}
            <button type="button" id="nav-toggle"
                class="md:hidden flex flex-col gap-1.25 p-2 rounded-lg border border-gray-200
                           hover:bg-gray-50 transition">
                <span class="block w-4.5 h-[1.5px] bg-gray-500 rounded"></span>
                <span class="block w-4.5 h-[1.5px] bg-gray-500 rounded"></span>
                <span class="block w-4.5 h-[1.5px] bg-gray-500 rounded"></span>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 px-4 py-3 flex flex-col gap-1">
        <a href="{{ route('books.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium
                  {{ request()->routeIs('books.index')
                      ? 'bg-sky-50 text-sky-600'
                      : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
            <i class="bi bi-journals"></i>
            Libros
        </a>
        <a href="{{ route('autors.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium
                  {{ request()->routeIs('autors.index')
                      ? 'bg-sky-50 text-sky-600'
                      : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
            <i class="bi bi-people"></i>
            Autores
        </a>
    </div>
</nav>
</div>
</nav>

@push('scripts')
    <script>
        document.getElementById('nav-toggle').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
@endpush
