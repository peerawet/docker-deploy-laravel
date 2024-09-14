@extends('front-end.layouts.main')
@section('title', 'Master Files')
@section('content')

    <div id="vessels">

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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
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
                <button type="button" id="addDeliveryPortButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-delivery-port-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Delivery Location
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4"
                        action="{{ route('masterFiles.index.delivery-location') }}" method="GET">
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
                <!-- Delivery Port Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.delivery-location', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.delivery-location', [
                                        'sort_field' => 'name',
                                        'sort_order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Delivery Location Name {!! $sortField == 'name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.delivery-location', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.delivery-location', [
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
                        <!-- Loop through allDeliveryPorts and generate table rows -->
                        @foreach ($allDeliveryLocations as $deliveryPort)
                            <tr class="text-center">
                                <td>{{ $deliveryPort->id }}</td>
                                <td>{{ $deliveryPort->name }}</td>
                                <td>{{ $deliveryPort->note }}</td>
                                <td>{{ $deliveryPort->edit_by }} <br> {{ $deliveryPort->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-delivery-port-btn"
                                        title="Edit" data-delivery-port-id="{{ $deliveryPort->id }}"
                                        data-delivery-port-name="{{ $deliveryPort->name }}"
                                        data-delivery-port-note="{{ $deliveryPort->note }}"
                                        data-tw-target="#edit-delivery-port-modal" data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="tooltip btn btn-danger delete-delivery-port-btn"
                                        title="Delete" data-delivery-port-id="{{ $deliveryPort->id }}"
                                        data-delivery-port-name="{{ $deliveryPort->name }}"
                                        data-tw-target="#delete-delivery-port-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allDeliveryLocations->links() }}
                </div>
            </div>


            <!-- Add New Delivery Port Modal -->
            <div id="add-delivery-port-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Delivery Location</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Delivery Port form -->
                            <form id="add-delivery-port-form" method="POST" action="{{ route('add.delivery-port') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-delivery-port-name">Delivery Location Name</label>
                                    <input type="text" class="form-control" id="add-delivery-port-name"
                                        name="name" value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-delivery-port-note">Note</label>
                                    <input type="text" class="form-control" id="add-delivery-port-note"
                                        name="note" value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add Delivery Location</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Delivery Port Modal -->

            <!-- Delete Confirmation Modal -->
            <div id="delete-delivery-port-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
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
                                <div class="text-slate-500 mt-2" id="delivery-port-name-placeholder"></div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <form id="delete-delivery-port-form" method="POST"
                                    action="{{ route('delete.delivery-port', ['id' => '__DELIVERY_PORT_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="delivery_port_id" id="delivery-port-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Delivery Port Modal -->
            <div id="edit-delivery-port-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Delivery Location</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Delivery Port form -->
                            <form id="edit-delivery-port-form" method="POST"
                                action="{{ route('edit.delivery-port', ['id' => '__DELIVERY_PORT_ID__']) }}">
                                @csrf
                                <input type="hidden" name="id" id="edit-delivery-port-id" value="">
                                <div class="form-group">
                                    <label for="edit-delivery-port-name">Delivery Location Name</label>
                                    <input type="text" class="form-control" id="edit-delivery-port-name"
                                        name="name" value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-delivery-port-note">Note</label>
                                    <input type="text" class="form-control" id="edit-delivery-port-note"
                                        name="note" value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Delivery Port Modal -->

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Vessel script --}}
    <script>
        jQuery(document).ready(function() {
            // Delete Delivery Port modal
            jQuery('.delete-delivery-port-btn').on('click', function() {
                // Get the Delivery Port ID and name from the clicked button's data attributes
                var deliveryPortIdToDelete = $(this).data('delivery-port-id');
                var deliveryPortName = $(this).data('delivery-port-name');

                // Set the value of the hidden input field in the form
                $('#delivery-port-id-to-delete').val(deliveryPortIdToDelete);

                // Replace the placeholder in the form action with the actual Delivery Port ID
                var formAction = "{{ route('delete.delivery-port', ['id' => '__DELIVERY_PORT_ID__']) }}";
                formAction = formAction.replace('__DELIVERY_PORT_ID__', deliveryPortIdToDelete);
                $('#delete-delivery-port-form').attr('action', formAction);

                // Update the Delivery Port name placeholder in the modal
                $('#delivery-port-name-placeholder').text('Do you want to delete Delivery Location ' +
                    deliveryPortName + '?');
            });
        });

        jQuery(document).ready(function() {
            // Edit Delivery Port modal
            jQuery('.edit-delivery-port-btn').on('click', function() {
                // Get the Delivery Port ID and name from the clicked button's data attributes
                var deliveryPortIdToEdit = $(this).data('delivery-port-id');
                var deliveryPortName = $(this).data('delivery-port-name');
                var deliveryPortNote = $(this).data(
                    'delivery-port-note'); // Assuming you have a data attribute for note

                // Set the form action dynamically
                var formAction = "{{ route('edit.delivery-port', ['id' => '__DELIVERY_PORT_ID__']) }}";
                formAction = formAction.replace('__DELIVERY_PORT_ID__', deliveryPortIdToEdit);
                $('#edit-delivery-port-form').attr('action', formAction);

                // Populate the edit modal fields with the Delivery Port data
                $('#edit-delivery-port-id').val(deliveryPortIdToEdit);
                $('#edit-delivery-port-name').val(deliveryPortName);
                $('#edit-delivery-port-note').val(deliveryPortNote); // Populate the note field
            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>




@endsection
