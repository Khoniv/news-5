@if ($paginator->hasPages())
    <nav class="d-flex flex-column flex-md-row align-items-center justify-content-between w-100 py-3 gap-3">
        <!-- Minimalist Editorial Showing Counter -->
        <div class="editorial-page-counter">
            <span class="counter-dot"></span>
            Showing <strong class="text-dark">{{ $paginator->firstItem() }}</strong> &ndash; <strong class="text-dark">{{ $paginator->lastItem() }}</strong> of <strong class="text-dark">{{ $paginator->total() }}</strong> stories
        </div>

        <!-- Sleek Editorial Pagination Buttons -->
        <div>
            <ul class="pagination editorial-pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&larr; Prev</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&larr; Prev</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link dots">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next &rarr;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Next &rarr;</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
