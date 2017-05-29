@if ($paginator->hasPages())
    <div class="large ui blue icon buttons">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="ui hidden"></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="ui labled icon button"><i class="angle left icon"></i> Anterior</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="ui hidden">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="ui button active">{{ $page }}</buttom>
                    @else
                        <a class="ui button" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="ui labled icon button">Próximo <i class="angle right icon"></i></a>
        @else
            <a class="ui hidden"></a>
        @endif
    </div>
@endif
