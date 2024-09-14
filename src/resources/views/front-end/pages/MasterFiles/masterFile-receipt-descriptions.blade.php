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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
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
                <button type="button" id="addReceiptDescriptionButton"
                    class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-receipt-description-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Receipt Description
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4"
                        action="{{ route('masterFiles.index.receiptDescription') }}" method="GET">
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
                <!-- Receipt Description Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.receiptDescription', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.receiptDescription', [
                                        'sort_field' => 'description',
                                        'sort_order' => $sortField == 'description' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Description {!! $sortField == 'description' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.receiptDescription', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.receiptDescription', [
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
                        <!-- Loop through allDescriptions and generate table rows -->
                        @foreach ($allDescriptions as $description)
                            <tr class="text-center">
                                <td>{{ $description->id }}</td>
                                <td>{{ $description->description }}</td>
                                <td>{{ $description->note }}</td>
                                <td>{{ $description->edit_by }} <br> {{ $description->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-receipt-description-btn"
                                        title="Edit" data-description-id="{{ $description->id }}"
                                        data-description="{{ $description->description }}"
                                        data-note="{{ $description->note }}"
                                        data-tw-target="#edit-receipt-description-modal" data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="tooltip btn btn-danger delete-receipt-description-btn"
                                        title="Delete" data-description-id="{{ $description->id }}"
                                        data-description="{{ $description->description }}"
                                        data-tw-target="#delete-receipt-description-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allDescriptions->links() }}
                </div>
            </div>

            <!-- Add New Receipt Description Modal -->
            <div id="add-receipt-description-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Receipt Description</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Receipt Description form -->
                            <form id="add-receipt-description-form" method="POST"
                                action="{{ route('add.receiptDescription') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-receipt-description">Receipt Description</label>
                                    <input type="text" class="form-control" id="add-receipt-description"
                                        name="description" value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-receipt-note">Note</label>
                                    <input type="text" class="form-control" id="add-receipt-note" name="note"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add Receipt Description</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Receipt Description Modal -->

            <!-- Delete Confirmation Modal -->
            <div id="delete-receipt-description-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
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
                                <div class="text-slate-500 mt-2" id="receipt-description-placeholder"></div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <form id="delete-receipt-description-form" method="POST"
                                    action="{{ route('delete.receiptDescription', ['id' => '__DESCRIPTION_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="description_id" id="receipt-description-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Receipt Description Modal -->
            <div id="edit-receipt-description-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Receipt Description</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Receipt Description form -->
                            <form id="edit-receipt-description-form" method="POST"
                                action="{{ route('edit.receiptDescription', ['id' => '__DESCRIPTION_ID__']) }}">
                                @csrf
                                <input type="hidden" name="id" id="edit-receipt-description-id" value="">
                                <div class="form-group">
                                    <label for="edit-receipt-description">Receipt Description</label>
                                    <input type="text" class="form-control" id="edit-receipt-description"
                                        name="description" value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-receipt-note">Note</label>
                                    <input type="text" class="form-control" id="edit-receipt-note" name="note"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Receipt Description Modal -->

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Receipt Description script --}}
    <script>
        jQuery(document).ready(function() {
            // Delete Receipt Description modal
            jQuery('.delete-receipt-description-btn').on('click', function() {
                // Get the Receipt Description ID and description from the clicked button's data attributes
                var descriptionIdToDelete = $(this).data('description-id');
                var description = $(this).data('description');

                // Set the value of the hidden input field in the form
                $('#description-id-to-delete').val(descriptionIdToDelete);

                // Replace the placeholder in the form action with the actual Description ID
                var formAction =
                    "{{ route('delete.receiptDescription', ['id' => '__DESCRIPTION_ID__']) }}";
                formAction = formAction.replace('__DESCRIPTION_ID__', descriptionIdToDelete);
                $('#delete-receipt-description-form').attr('action', formAction);

                // Update the Description placeholder in the modal
                $('#receipt-description-placeholder').text('Do you want to delete Description ' +
                    description + '?');
            });
        });

        jQuery(document).ready(function() {
            // Edit Receipt Description modal
            jQuery('.edit-receipt-description-btn').on('click', function() {
                // Get the Receipt Description ID, description, and note from the clicked button's data attributes
                var descriptionIdToEdit = $(this).data('description-id');
                var description = $(this).data('description');
                var note = $(this).data('note'); // Assuming you have a data attribute for note

                console.log("Description ID:", descriptionIdToEdit);
                console.log("Description:", description);
                console.log("Note:", note);

                // Set the form action dynamically
                var formAction = "{{ route('edit.receiptDescription', ['id' => '__DESCRIPTION_ID__']) }}";
                formAction = formAction.replace('__DESCRIPTION_ID__', descriptionIdToEdit);
                $('#edit-receipt-description-form').attr('action', formAction);

                // Populate the edit modal fields with the Receipt Description data
                $('#edit-receipt-description-id').val(descriptionIdToEdit);
                $('#edit-receipt-description').val(description);
                $('#edit-receipt-note').val(note); // Populate the note field
            });
        });
    </script>



@endsection
