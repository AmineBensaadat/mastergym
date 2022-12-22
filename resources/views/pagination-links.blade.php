@if ($paginator->hasPages())
<div class="row g-0 justify-content-end mb-4" id="pagination-element">
    <div class="col-sm-6">
        <div class="pagination-block pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
            @if ($paginator->onFirstPage())
                <div class="page-item disabled">
                    <a href="#" class="page-link" id="page-prev">Previous</a>
                </div>
            @else
                <div class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" id="page-prev">Previous</a>
                </div>
            @endif
        
            @foreach ($elements as $element)
                @if (is_string($element))
                    <div class="page-item active"><a class="page-link clickPageNumber" href="javascript:void(0);">{{ $element }}</a></div>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div class="page-item active">
                                <a class="page-link clickPageNumber" href="javascript:void(0);">{{ $page }}</a>
                            </div>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            @if ($paginator->hasMorePages())
                <div class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                </div>
            @else
                <div class="page-item">
                    <a href="#" class="page-link" id="page-next">Next</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endif