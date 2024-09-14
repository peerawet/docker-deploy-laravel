@extends('front-end.layouts.main')
@section('title', 'รายการ Receipts ไม่มี vat ทั้งหมด')
@section('content')
    <div class="intro-y box p-5">
        <div class="mb-5 text-right">
            <livewire:components.assets.button color="primary" title="New Receipt" icon="file-text" route="receipt.vat.create"
                action="" />


        </div>
        <div class="mb-5">
            <div class="grid grid-cols-12 gap-2">
                <form id="search-form" class="form-inline col-span-4" action="{{ route('receipt.no-vat.index') }}"
                    method="GET">
                    <label for="search-input" class="form-label">ค้นหา</label>
                    <input id="search-input" name="search_value" type="text" class="form-control"
                        placeholder="พิมพ์รายการที่ต้องการค้นหา">
                    <input type="hidden" name="sort_order" value="{{ $sortOrder ?? '' }}">
                    <input type="hidden" name="sort_field" value="{{ $sortField ?? '' }}">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                    {{-- pre-fill input  --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Get the search input element
                            var searchInput = document.getElementById('search-input');

                            // Get the search value from the query parameter
                            var searchValue = new URLSearchParams(window.location.search).get('search_value');

                            // Get the sort field and sort order from the query parameters
                            var sortField = new URLSearchParams(window.location.search).get('sort_field');
                            var sortOrder = new URLSearchParams(window.location.search).get('sort_order');

                            // Set the value of the search input field to the search value
                            if (searchValue !== null) {
                                searchInput.value = searchValue;
                            }

                            // Update the values of hidden input fields for sort order and sort field
                            document.querySelector('input[name="sort_order"]').value = sortOrder;
                            document.querySelector('input[name="sort_field"]').value = sortField;
                        });
                    </script>
                </form>

            </div>
        </div>
        <div class="overflow-x-auto">
            <div style="max-height: 600px; overflow-y: auto;">
                <style>
                    /* Optional: Adjust table styles for full width */
                    .table.table-striped.table-hover.table-bordered.text-center {
                        width: 100%;
                        /* Set table width to 100% of the viewport */
                        margin: 0;
                        /* Remove any default margins */
                        border-spacing: 0;
                        /* Remove default spacing between table cells */
                        border-collapse: collapse;
                        /* Collapse table borders */
                    }

                    .table.table-striped.table-hover.table-bordered.text-center th,
                    .table.table-striped.table-hover.table-bordered.text-center td {
                        padding: 5px !important;
                        /* Adjust cell padding */
                        margin: 0 !important;
                        /* Remove any margins */
                        width: auto !important;
                        /* Allow content to dictate width */
                        white-space: nowrap;
                        /* Prevent wrapping */
                        overflow: hidden;
                        /* Hide overflowing content */
                        text-overflow: ellipsis;
                        /* Show ellipsis for overflow */
                        max-width: 200px;
                        /* Limit maximum width to 200px */
                    }
                </style>
                <table class="table table-striped table-hover text-center table-bordered" style="text-align: center; ">
                    <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="whitespace-nowrap">เลือก</th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'receipt_no',
                                        'sort_order' => $sortField == 'receipt_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Receipt No. {!! $sortField == 'receipt_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'receipt_date',
                                        'sort_order' => $sortField == 'receipt_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Receipt Date {!! $sortField == 'receipt_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'invoices.invoice_no',
                                        'sort_order' => $sortField == 'invoices.invoice_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Invoice No. {!! $sortField == 'invoices.invoice_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">Bill Vat</th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'sell_sub_total',
                                        'sort_order' => $sortField == 'sell_sub_total' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Sub Total {!! $sortField == 'sell_sub_total' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'sell_vat_value',
                                        'sort_order' => $sortField == 'sell_vat_value' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Vat Per {!! $sortField == 'sell_vat_value' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'sell_total_vat',
                                        'sort_order' => $sortField == 'sell_total_vat' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Vat Amount {!! $sortField == 'sell_total_vat' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'sell_grand_total',
                                        'sort_order' => $sortField == 'sell_grand_total' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Total Amount {!! $sortField == 'sell_grand_total' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'payment_method',
                                        'sort_order' => $sortField == 'payment_method' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Payment Method {!! $sortField == 'payment_method' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'bank',
                                        'sort_order' => $sortField == 'bank' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Bank Name {!! $sortField == 'bank' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'branch',
                                        'sort_order' => $sortField == 'branch' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Branch {!! $sortField == 'branch' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('receipt.no-vat.index', [
                                        'sort_field' => 'bank_number',
                                        'sort_order' => $sortField == 'bank_number' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Cheq No. {!! $sortField == 'bank_number' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>

                            <th class="whitespace-nowrap">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                            <tr class="text-center">
                                <td><input type="checkbox" class="form-check-input" wire:model="selectedReceipts"
                                        value="{{ $receipt->id }}"></td>
                                <td>{{ $receipt->receipt_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d/m/Y') }}</td>
                                <td>{{ $receipt->invoice_no }}</td>
                                <td><input type="checkbox" class="form-check-input border"
                                        {{ $receipt->is_vat ? 'checked' : '' }} disabled></td>
                                <td>{{ optional(optional(optional($receipt)->invoice)->job)->sell_sub_total }}</td>
                                <td>{{ optional(optional(optional($receipt)->invoice)->job)->sell_vat_value }}</td>
                                <td>{{ optional(optional(optional($receipt)->invoice)->job)->sell_total_vat }}</td>
                                <td>{{ optional(optional(optional($receipt)->invoice)->job)->sell_grand_total }}</td>
                                <td>{{ $receipt->payment_method ?? 'Draft Receipt' }}</td>
                                <td>{{ $receipt->bank }}</td>
                                <td>{{ $receipt->branch }}</td>
                                <td>{{ $receipt->bank_number }}</td>
                                <td>
                                    <button type="button"
                                        onclick="window.location.href='{{ route('receipt.edit', ['receiptId' => $receipt->receipt_no]) }}'"
                                        class="tooltip btn btn-warning" title="แก้ไขข้อมูล">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mt-4">
                {{ $receipts->links() }}
            </div>
        </div>

    </div>

    <script></script>

@endsection
