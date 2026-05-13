@if ($paginator->hasPages())

<ul class="pagination">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <li class="disabled">Prev</li>
    @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}">Prev</a>
        </li>
    @endif


    {{-- Pages --}}
    @foreach ($elements as $element)

        @if (is_array($element))

            @foreach ($element as $page => $url)

                <li class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}">{{ $page }}</a>
                </li>

            @endforeach

        @endif

    @endforeach


    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}">Next</a>
        </li>
    @else
        <li class="disabled">Next</li>
    @endif

</ul>

@endif