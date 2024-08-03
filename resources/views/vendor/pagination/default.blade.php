@if ($paginator->hasPages())
    <nav aria-label="page-navigation">
        <ul class="flex list-style-none">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a href="#" class="relative block pointer-events-none px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Previous</a>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="relative block px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <a href="#" class="relative block px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item">
                                <a href="{{ $url }}" class="relative block px-3 py-1.5 mr-3 text-base text-gray-100 bg-blue-400 transition-all duration-300 rounded-md">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="relative block px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="relative block px-3 py-1.5 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a href="#" class="relative block pointer-events-none px-3 py-1.5 text-base text-gray-700 transition-all duration-300 rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Next</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
