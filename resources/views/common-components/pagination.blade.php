@if ($paginator->hasPages())
    <div class="row mt-3">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" role="status" aria-live="polite">
                Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} entries
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers float-right">
                <ul class="pagination pagination-rounded mb-0">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="paginate_button page-item previous disabled">
                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="paginate_button page-item previous">
                            <a href="{{ $paginator->appends(request()->query())->previousPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $start = max($paginator->currentPage() - 2, 1);
                        $end = min($start + 4, $paginator->lastPage());
                        $start = max($end - 4, 1);
                    @endphp

                    @if($start > 1)
                        <li class="paginate_button page-item">
                            <a href="{{ $paginator->appends(request()->query())->url(1) }}" class="page-link">1</a>
                        </li>
                        @if($start > 2)
                            <li class="paginate_button page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif

                    @for($page = $start; $page <= $end; $page++)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="paginate_button page-item">
                                <a href="{{ $paginator->appends(request()->query())->url($page) }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    @if($end < $paginator->lastPage())
                        @if($end < $paginator->lastPage() - 1)
                            <li class="paginate_button page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        <li class="paginate_button page-item">
                            <a href="{{ $paginator->appends(request()->query())->url($paginator->lastPage()) }}" class="page-link">{{ $paginator->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="paginate_button page-item next">
                            <a href="{{ $paginator->appends(request()->query())->nextPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    @else
                        <li class="paginate_button page-item next disabled">
                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
