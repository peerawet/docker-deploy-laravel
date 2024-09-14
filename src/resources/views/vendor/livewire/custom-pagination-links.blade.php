<div class="mb-5">
    @if ($paginator->hasPages())
        {{-- ข้อความแสดงจำนวนข้อมูล --}}
        <div class="text-center mb-4">
            มีข้อมูลแสดงที่หน้านี้ทั้งหมด {{ $paginator->count() }} ข้อมูล จากทั้งหมด {{ $paginator->total() }} ข้อมูล
        </div>

        <nav>
            <ul class="pagination justify-content-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <button class="page-link" wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                            aria-label="@lang('pagination.previous')">&lsaquo;</button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link"
                                        style="background-color: black; border-color: black; color: white;">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item"><button class="page-link"
                                        wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button class="page-link" wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                            aria-label="@lang('pagination.next')">&rsaquo;</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
