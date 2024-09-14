@extends('front-end.layouts.main')
@section('title', 'รายการ Invoices ทั้งหมด')
@section('content')
    <div class="intro-y box p-5">
        <div class="mb-5 text-right">
            <livewire:components.assets.button color="primary" title="New Invoice" icon="file-text" route="invoice.create"
                action="" />


        </div>
        <div class="mb-5">
            <div class="grid grid-cols-12 gap-2">
                <form id="search-form" class="form-inline col-span-4" action="{{ route('invoice.index') }}" method="GET">
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
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'invoice_no',
                                        'sort_order' => $sortField == 'invoice_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Invoice No. {!! $sortField == 'invoice_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'job_no',
                                        'sort_order' => $sortField == 'job_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Job No. {!! $sortField == 'job_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'draft_no',
                                        'sort_order' => $sortField == 'draft_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Draft No. {!! $sortField == 'draft_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'status',
                                        'sort_order' => $sortField == 'status' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Status {!! $sortField == 'status' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'due_date',
                                        'sort_order' => $sortField == 'due_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Due Date {!! $sortField == 'due_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'shipper_name',
                                        'sort_order' => $sortField == 'shipper_name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Shipper Name {!! $sortField == 'shipper_name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'agent_name',
                                        'sort_order' => $sortField == 'agent_name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Agent Name {!! $sortField == 'agent_name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'booking_no',
                                        'sort_order' => $sortField == 'booking_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Booking No. {!! $sortField == 'booking_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            {{-- <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'bl_no',
                                        'sort_order' => $sortField == 'bl_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    B/L No. {!! $sortField == 'bl_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th> --}}
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'ref_no',
                                        'sort_order' => $sortField == 'ref_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Ref No. {!! $sortField == 'ref_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            {{-- <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('invoice.index', [
                                        'sort_field' => 'attn',
                                        'sort_order' => $sortField == 'attn' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Attn {!! $sortField == 'attn' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th> --}}
                            <th class="whitespace-nowrap">จัดการ</th>
                        </tr>
                    </thead>
                    <style>
                        .no-receipt {
                            color: blue;
                        }
                    </style>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input" wire:model="ids"
                                        value="{{ $invoice->id }}">
                                </td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>{{ $invoice->invoice_no }}
                                </td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>
                                    {{ optional($invoice->job)->job_no }}</td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>
                                    {{ optional(optional($invoice->job)->draft)->draft_no }}</td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>{{ $invoice->status }}</td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>{{ $invoice->due_date }}
                                </td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>
                                    {{ optional(optional(optional($invoice->job)->draft)->shipper)->name }}</td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>
                                    {{ optional(optional(optional($invoice->job)->draft)->agent)->name }}</td>
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>
                                    {{ optional(optional($invoice->job)->draft)->booking_no }}</td>

                                {{-- <td @if (!$invoice->receipt) class="no-receipt" @endif>{{ $invoice->bl_no }}</td> --}}
                                <td @if (!$invoice->receipt) class="no-receipt" @endif>{{ $invoice->ref_no }}</td>
                                {{-- <td @if (!$invoice->receipt) class="no-receipt" @endif>{{ $invoice->attn }}</td> --}}

                                <td>
                                    <button type="button"
                                        onclick="window.location.href='{{ route('invoice.edit', ['invoiceId' => $invoice->invoice_no]) }}'"
                                        class="tooltip btn btn-warning" title="แก้ไขข้อมูล">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        onclick="window.location.href='{{ route('invoice.print', ['invoiceId' => $invoice->invoice_no]) }}'"
                                        type="button" id="print-btn" class="tooltip btn btn-success" title="Print">
                                        <i data-lucide="printer" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="flex justify-center mt-4">
                {{ $invoices->links() }}
            </div>
        </div>

    </div>

    <script></script>

@endsection
