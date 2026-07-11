@if ($paginator->hasPages())
<nav class="dosen-pagination-nav" aria-label="Navigasi halaman">
    <ul class="dosen-pagination">
        @if ($paginator->onFirstPage())
            <li class="dosen-page-item disabled" aria-disabled="true">
                <span class="dosen-page-link">&lsaquo;</span>
            </li>
        @else
            <li class="dosen-page-item">
                <a class="dosen-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="dosen-page-item disabled"><span class="dosen-page-link">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="dosen-page-item active" aria-current="page">
                            <span class="dosen-page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="dosen-page-item">
                            <a class="dosen-page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="dosen-page-item">
                <a class="dosen-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
            </li>
        @else
            <li class="dosen-page-item disabled" aria-disabled="true">
                <span class="dosen-page-link">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>
@endif
