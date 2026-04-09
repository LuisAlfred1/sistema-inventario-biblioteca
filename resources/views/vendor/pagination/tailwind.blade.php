@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        {{-- Mobile --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-lg">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-lg">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between">

            <p class="text-sm text-gray-500">
                Mostrando
                @if ($paginator->firstItem())
                    <span class="font-medium text-gray-700">{{ $paginator->firstItem() }}</span>
                    al
                    <span class="font-medium text-gray-700">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                de
                <span class="font-medium text-gray-700">{{ $paginator->total() }}</span>
                resultados
            </p>

            <div class="flex items-center gap-1">

                {{-- Anterior --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center px-2.5 py-1.5 text-sm text-gray-300 bg-white border border-gray-200 cursor-not-allowed rounded-lg">
                        <i class="bi bi-caret-left-fill"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       class="inline-flex items-center px-2.5 py-1.5 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <i class="bi bi-caret-left-fill"></i>
                    </a>
                @endif

                {{-- Números --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center px-3 py-1.5 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-default">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-sky-600 border border-sky-600 rounded-lg cursor-default">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="inline-flex items-center px-3 py-1.5 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-sky-50 hover:text-sky-600 hover:border-sky-200 transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Siguiente --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       class="inline-flex items-center px-2.5 py-1.5 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <i class="bi bi-caret-right-fill"></i>
                    </a>
                @else
                    <span class="inline-flex items-center px-2.5 py-1.5 text-sm text-gray-300 bg-white border border-gray-200 cursor-not-allowed rounded-lg">
                        <i class="bi bi-caret-right-fill"></i>
                    </span>
                @endif

            </div>
        </div>
    </nav>
@endif