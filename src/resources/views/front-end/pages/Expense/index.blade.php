@extends('front-end.layouts.main')
@section('title', 'รายการ Receipts มี vat ทั้งหมด')
@section('content')
    <div class="intro-y box p-5">
        <div class="mb-5 text-right">
            <livewire:components.assets.button color="primary" title="New Expense" icon="file-text"
                route="expense.create-update" action="" />


        </div>
        <div class="mb-5">
            <div class="grid grid-cols-12 gap-2">
                <form id="search-form" class="form-inline col-span-4" action="{{ route('expense.index') }}" method="GET">
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

                <table class="table table-striped table-hover text-center table-bordered" style="text-align: center;">
                    <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('expense.index', [
                                        'sort_field' => 'pv_no',
                                        'sort_order' => $sortField == 'pv_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    PV No. {!! $sortField == 'pv_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('expense.index', [
                                        'sort_field' => 'payee',
                                        'sort_order' => $sortField == 'payee' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Payee {!! $sortField == 'payee' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('expense.index', [
                                        'sort_field' => 'category',
                                        'sort_order' => $sortField == 'category' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Category {!! $sortField == 'category' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('expense.index', [
                                        'sort_field' => 'pv_issue_date',
                                        'sort_order' => $sortField == 'pv_issue_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Expense Date {!! $sortField == 'pv_issue_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('expense.index', [
                                        'sort_field' => 'payment_date',
                                        'sort_order' => $sortField == 'payment_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Payment Date {!! $sortField == 'payment_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('expense.index', [
                                        'sort_field' => 'payment_method',
                                        'sort_order' => $sortField == 'payment_method' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Payment Method {!! $sortField == 'payment_method' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>

                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr class="text-center">
                                <td>{{ $expense->pv_no }}</td>
                                <td>{{ optional($expense->payee)->payee }}</td>
                                <td>{{ optional($expense->category)->category }}</td>
                                <td>{{ date('d/m/Y', strtotime($expense->pv_issue_date)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($expense->payment_date)) }}</td>
                                <td>{{ $expense->payment_method }}</td>

                                <td>
                                    <button type="button"
                                        onclick="window.location.href='{{ route('expense.create-update', ['id' => $expense->pv_no]) }}'"
                                        class="tooltip btn btn-warning" title="แก้ไขข้อมูล">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="tooltip btn btn-danger delete-expense-btn" title="Delete"
                                        data-expense-id="{{ $expense->pv_no }}" data-expense-name="{{ $expense->pv_no }}"
                                        data-tw-target="#delete-expense-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Delete Confirmation Modal -->
                <div id="delete-expense-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Confirmation</h5>
                                <button type="button" class="btn-close" data-tw-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="p-5 text-center">
                                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                    <div class="text-3xl mt-5">Are you sure?</div>
                                    <div class="text-slate-500 mt-2" id="expense-name-placeholder"></div>
                                </div>
                                <div class="px-5 pb-8 text-center">
                                    <form id="delete-expense-form" method="POST"
                                        action="{{ route('delete.expense', ['id' => '__EXPENSE_ID__']) }}">
                                        @csrf
                                        <input type="hidden" name="expense_id" id="expense-id-to-delete">
                                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->

                <script>
                    jQuery(document).ready(function() {
                        // Delete Expense modal
                        jQuery('.delete-expense-btn').on('click', function() {
                            // Get the Expense ID and name from the clicked button's data attributes
                            var expenseIdToDelete = $(this).data('expense-id');
                            var expenseName = $(this).data('expense-name');

                            // Set the value of the hidden input field in the form
                            $('#expense-id-to-delete').val(expenseIdToDelete);

                            // Replace the placeholder in the form action with the actual Expense ID
                            var formAction = "{{ route('delete.expense', ['id' => '__EXPENSE_ID__']) }}";
                            formAction = formAction.replace('__EXPENSE_ID__', expenseIdToDelete);
                            $('#delete-expense-form').attr('action', formAction);

                            // Update the Expense name placeholder in the modal
                            $('#expense-name-placeholder').text('Do you want to delete Expense ' + expenseName + '?');
                        });
                    });
                </script>

            </div>

            <script>
                // Log all expenses to the console
                console.log(@json($expenses));
            </script>

            <div class="flex justify-center mt-4">
                {{ $expenses->links() }}
            </div>
        </div>

    </div>

    <script></script>

@endsection
