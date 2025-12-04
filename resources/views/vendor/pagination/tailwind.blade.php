@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center mt-6">
        <ul class="inline-flex items-center space-x-1">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1.5 bg-gray-200 text-gray-500 rounded-lg cursor-default">
                        ← Prev
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        ← Prev
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-1.5 bg-gray-200 text-gray-600 rounded-lg cursor-default">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-3 py-1.5 bg-blue-600 text-white font-semibold rounded-lg">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Next →
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1.5 bg-gray-200 text-gray-500 rounded-lg cursor-default">
                        Next →
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
