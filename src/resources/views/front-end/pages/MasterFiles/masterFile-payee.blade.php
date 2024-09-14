@extends('front-end.layouts.main')
@section('title', 'Master Files')
@section('content')


    <div id="sales">

        <head>
            <style>
                .border-blue-500 {
                    border-color: #3b82f6 !important;
                }

                .text-blue-500 {
                    color: #3b82f6 !important;
                }
            </style>

            <div class="mb-5">
                <div class="overflow-x-auto">
                    <ul class="flex justify-between border-b">
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.depot') }}" id="depot-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Depots
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.gate-in-depot') }}" id="gate-in-depot-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Gate-In Depots
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.shipper') }}" id="shipper-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Shippers
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.agent') }}" id="agent-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Agents
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.container-type') }}" id="container-type-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Container Types
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.sale') }}" id="sales-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
                                Sales
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.vessel') }}" id="vessels-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Vessels
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.feeder') }}" id="feeders-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Feeders
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.destination-port') }}" id="destination-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Ports of Destination
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.transhipment-port') }}" id="transhipment-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Transhipment Ports
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.loading-port') }}" id="loading-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Loading Ports
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.loading-location') }}" id="loading-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Loading Location
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.delivery-location') }}" id="loading-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Delivery Location
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.description') }}"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Job Description

                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.receiptDescription') }}"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Receipt Description
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.bank') }}"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Banks
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </head>

        <div class="box p-5">
            <div class="mb-5 text-right">
                <button type="button" id="addPayeeButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-payee-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Payee
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4" action="{{ route('masterFiles.index.payee') }}"
                        method="GET">
                        <label for="search-input" class="form-label">Search</label>
                        <input id="search-input" name="search_value" type="text" class="form-control"
                            placeholder="Type the payee name or ID to search">
                        <input type="hidden" name="sort_order" value="{{ $sortOrder ?? '' }}">
                        <input type="hidden" name="sort_field" value="{{ $sortField ?? '' }}">
                        <button type="submit" class="btn btn-primary ml-2">Search</button>
                        {{-- Pre-fill input fields with search and sort parameters --}}
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var searchInput = document.getElementById('search-input');
                                var searchValue = new URLSearchParams(window.location.search).get('search_value');
                                var sortField = new URLSearchParams(window.location.search).get('sort_field');
                                var sortOrder = new URLSearchParams(window.location.search).get('sort_order');

                                if (searchValue !== null) {
                                    searchInput.value = searchValue;
                                }

                                document.querySelector('input[name="sort_order"]').value = sortOrder;
                                document.querySelector('input[name="sort_field"]').value = sortField;
                            });
                        </script>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <!-- Payee Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.payee', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.payee', [
                                        'sort_field' => 'payee',
                                        'sort_order' => $sortField == 'payee' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Payee {!! $sortField == 'payee' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.payee', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.payee', [
                                        'sort_field' => 'edit_by',
                                        'sort_order' => $sortField == 'edit_by' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Edit by {!! $sortField == 'edit_by' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allPayees as $payee)
                            <tr class="text-center">
                                <td>{{ $payee->id }}</td>
                                <td>{{ $payee->payee }}</td>
                                <td>{{ $payee->note }}</td>
                                <td>{{ $payee->edit_by }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-payee-btn" title="Edit"
                                        data-payee-id="{{ $payee->id }}" data-payee-name="{{ $payee->payee }}"
                                        data-payee-note="{{ $payee->note }}" data-tw-target="#edit-payee-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="tooltip btn btn-danger delete-payee-btn" title="Delete"
                                        data-payee-id="{{ $payee->id }}" data-payee-name="{{ $payee->payee }}"
                                        data-tw-target="#delete-payee-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="flex justify-center mt-4">
                    {{ $allPayees->links() }}
                </div>
            </div>


            <!-- Add New Payee Modal -->
            <div id="add-payee-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Payee</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Payee form -->
                            <form id="add-payee-form" method="POST" action="{{ route('add.payee') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-payee-name">Payee Name</label>
                                    <input type="text" class="form-control" id="add-payee-name" name="payee"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-payee-note">Note</label>
                                    <input type="text" class="form-control" id="add-payee-note" name="note"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add Payee</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Payee Modal -->

            <!-- Delete Confirmation Modal -->
            <div id="delete-payee-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
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
                                <div class="text-slate-500 mt-2" id="payee-name-placeholder"></div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <form id="delete-payee-form" method="POST"
                                    action="{{ route('delete.payee', ['id' => '__PAYEE_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="payee_id" id="payee-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Payee Modal -->
            <div id="edit-payee-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Payee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Payee form -->
                            <form id="edit-payee-form" method="POST"
                                action="{{ route('edit.payee', ['id' => '__PAYEE_ID__']) }}">
                                @csrf
                                <input type="hidden" name="id" id="edit-payee-id" value="">
                                <div class="form-group">
                                    <label for="edit-payee-name">Payee Name</label>
                                    <input type="text" class="form-control" id="edit-payee-name" name="payee"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-payee-note">Note</label>
                                    <input type="text" class="form-control" id="edit-payee-note" name="note"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Payee Modal -->

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Payee script --}}
    <script>
        jQuery(document).ready(function() {
            // Delete Payee modal
            jQuery('.delete-payee-btn').on('click', function() {
                // Get the Payee ID and name from the clicked button's data attributes
                var payeeIdToDelete = $(this).data('payee-id');
                var payeeName = $(this).data('payee-name');

                // Set the value of the hidden input field in the form
                $('#payee-id-to-delete').val(payeeIdToDelete);

                // Replace the placeholder in the form action with the actual Payee ID
                var formAction = "{{ route('delete.payee', ['id' => '__PAYEE_ID__']) }}";
                formAction = formAction.replace('__PAYEE_ID__', payeeIdToDelete);
                $('#delete-payee-form').attr('action', formAction);

                // Update the Payee name placeholder in the modal
                $('#payee-name-placeholder').text('Do you want to delete Payee ' +
                    payeeName + '?');
            });
        });

        jQuery(document).ready(function() {
            // Edit Payee modal
            jQuery('.edit-payee-btn').on('click', function() {
                // Get the Payee ID and name from the clicked button's data attributes
                var payeeIdToEdit = $(this).data('payee-id');
                var payeeName = $(this).data('payee-name');
                var payeeNote = $(this).data('payee-note'); // Assuming you have a data attribute for note

                // Set the form action dynamically
                var formAction = "{{ route('edit.payee', ['id' => '__PAYEE_ID__']) }}";
                formAction = formAction.replace('__PAYEE_ID__', payeeIdToEdit);
                $('#edit-payee-form').attr('action', formAction);

                // Populate the edit modal fields with the Payee data
                $('#edit-payee-id').val(payeeIdToEdit);
                $('#edit-payee-name').val(payeeName);
                $('#edit-payee-note').val(payeeNote); // Populate the note field
            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>



@endsection
