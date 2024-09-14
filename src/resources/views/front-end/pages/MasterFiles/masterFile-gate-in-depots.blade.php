@extends('front-end.layouts.main')
@section('title', 'Master Files')
@section('content')

    <div id="gate-in-depot">


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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
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
                <button type="button" id="addGateInDepotButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-gate-in-depot-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Gate In Depot
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4"
                        action="{{ route('masterFiles.index.gate-in-depot') }}" method="GET">
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
                <!-- Gate In Depot Setting Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.gate-in-depot', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.gate-in-depot', [
                                        'sort_field' => 'name',
                                        'sort_order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Gate In Depot Name {!! $sortField == 'name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.gate-in-depot', [
                                        'sort_field' => 'contact',
                                        'sort_order' => $sortField == 'contact' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Contact Name {!! $sortField == 'contact' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.gate-in-depot', [
                                        'sort_field' => 'tel',
                                        'sort_order' => $sortField == 'tel' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Tel. {!! $sortField == 'tel' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">Paper Less</th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.gate-in-depot', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.gate-in-depot', [
                                        'sort_field' => 'edit_by',
                                        'sort_order' => $sortField == 'edit_by' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Edit by {!! $sortField == 'edit_by' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($allGateInDepot as $gateInDepot)
                            <tr class="text-center">
                                <td>{{ $gateInDepot->id }}</td>
                                <td>{{ $gateInDepot->name }}</td>
                                <td>{{ $gateInDepot->contact }}</td>
                                <td>{{ $gateInDepot->tel }}</td>
                                <td>{{ $gateInDepot->paper_less }}</td>
                                <td>{{ $gateInDepot->note }}</td>
                                <td>{{ $gateInDepot->edit_by }} <br> {{ $gateInDepot->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-gate-in-depot-btn"
                                        title="แก้ไขข้อมูล" data-gate-in-depot-id="{{ $gateInDepot->id }}"
                                        data-gate-in-depot-name="{{ $gateInDepot->name }}"
                                        data-gate-in-depot-contact="{{ $gateInDepot->contact }}"
                                        data-gate-in-depot-tel="{{ $gateInDepot->tel }}"
                                        data-gate-in-depot-note="{{ $gateInDepot->note }}"
                                        data-tw-target="#edit-gate-in-depot-modal" data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>

                                    <button type="button" class="tooltip btn btn-danger delete-gate-in-depot-btn"
                                        title="ลบข้อมูล" data-gate-in-depot-id="{{ $gateInDepot->id }}"
                                        data-gate-in-depot-name="{{ $gateInDepot->name }}"
                                        data-tw-target="#delete-gate-in-depot-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allGateInDepot->links() }}
                </div>
            </div>

            <!-- Add New Gate In Depot Modal -->
            <div id="add-gate-in-depot-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Gate In Depot</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Gate In Depot form -->
                            <form id="add-gate-in-depot-form" method="POST" action="{{ route('add.gate-in-depot') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-gate-in-depot-name">Gate In Depot Name</label>
                                    <input type="text" class="form-control" id="add-gate-in-depot-name"
                                        name="name" value="">
                                </div>
                                <!-- Additional fields -->
                                <div class="form-group mt-3">
                                    <label for="add-gate-in-depot-contact">Contact Name</label>
                                    <input type="text" class="form-control" id="add-gate-in-depot-contact"
                                        name="contact" value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-gate-in-depot-tel">Telephone</label>
                                    <input type="text" class="form-control" id="add-gate-in-depot-tel" name="tel"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-gate-in-depot-paper-less">Paper Less</label>
                                    <input type="text" class="form-control" id="add-gate-in-depot-paper-less"
                                        name="paper_less" value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-gate-in-depot-note">Note</label>
                                    <input type="text" class="form-control" id="add-gate-in-depot-note"
                                        name="note" value="">
                                </div>
                                <!-- Add more fields as needed with mt-3 for top margin -->
                                <button type="submit" class="btn btn-primary mt-3">Add Gate In Depot</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Gate In Depot Modal -->

            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-gate-in-depot-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
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
                                <div class="text-slate-500 mt-2" id="gate-in-depot-name-placeholder">

                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <!-- Replace the button with a form -->
                                <form id="delete-gate-in-depot-form" method="POST"
                                    action="{{ route('delete.gate-in-depot', ['id' => '__GATE_IN_DEPOT_ID__']) }}">
                                    @csrf

                                    <input type="hidden" name="gate_in_depot_id" id="gate-in-depot-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Gate In Depot Modal -->
            <div id="edit-gate-in-depot-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Gate In Depot</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Gate In Depot form -->
                            <form id="edit-gate-in-depot-form" method="POST"
                                action="{{ route('edit.gate-in-depot', ['id' => '__GATE_IN_DEPOT_ID__']) }}">
                                @csrf
                                @isset($gateInDepot)
                                    <input type="hidden" name="id" id="edit-gate-in-depot-id"
                                        value="{{ $gateInDepot->id }}">
                                    <div class="form-group">
                                        <label for="edit-gate-in-depot-name">Gate In Depot Name</label>
                                        <input type="text" class="form-control" id="edit-gate-in-depot-name"
                                            name="name" value="{{ $gateInDepot->name }}">
                                    </div>
                                    <!-- Additional fields -->
                                    <div class="form-group mt-3">
                                        <label for="edit-gate-in-depot-contact">Contact Name</label>
                                        <input type="text" class="form-control" id="edit-gate-in-depot-contact"
                                            name="contact" value="{{ $gateInDepot->contact }}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-gate-in-depot-tel">Telephone</label>
                                        <input type="text" class="form-control" id="edit-gate-in-depot-tel"
                                            name="tel" value="{{ $gateInDepot->tel }}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-gate-in-depot-paper-less">Paper Less</label>
                                        <input type="text" class="form-control" id="edit-gate-in-depot-paper-less"
                                            name="paper_less" value="{{ $gateInDepot->paper_less }}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-gate-in-depot-note">Note</label>
                                        <input type="text" class="form-control" id="edit-gate-in-depot-note"
                                            name="note" value="{{ $gateInDepot->note }}">
                                    </div>
                                @else
                                    <p>No data available for Gate In Depot.</p>
                                @endisset

                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Gate In Depot Modal -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Gate In Depot script --}}
    <script>
        jQuery(document).ready(function() {
            // Delete Depot modal
            jQuery('.delete-gate-in-depot-btn').on('click', function() {
                // Get the Gate In Depot ID and name from the clicked button's data attributes
                var gateInDepotIdToDelete = $(this).data('gate-in-depot-id');
                var gateInDepotName = $(this).data('gate-in-depot-name');

                // Set the value of the hidden input field in the form
                $('#gate-in-depot-id-to-delete').val(gateInDepotIdToDelete);

                // Replace the placeholder in the form action with the actual Gate In Depot ID
                var formAction = "{{ route('delete.gate-in-depot', ['id' => '__gate_in_depot_ID__']) }}";
                formAction = formAction.replace('__gate_in_depot_ID__', gateInDepotIdToDelete);
                $('#delete-gate-in-depot-form').attr('action', formAction);

                // Update the Gate In Depot name placeholder in the modal
                $('#gate-in-depot-name-placeholder').text('Do you want to delete Gate In Depot ' +
                    gateInDepotName + '?');
            });

            // Edit Gate In Depot modal
            jQuery('.edit-gate-in-depot-btn').on('click', function() {
                // Get the Gate In Depot ID, name, contact, tel, and note from the clicked button's data attributes
                var gateInDepotIdToEdit = $(this).data('gate-in-depot-id');
                var gateInDepotName = $(this).data('gate-in-depot-name');
                var gateInDepotContact = $(this).data('gate-in-depot-contact');
                var gateInDepotTel = $(this).data('gate-in-depot-tel');
                var gateInDepotNote = $(this).data('gate-in-depot-note');
                var gateInDepotPaperLess = $(this).data('gate-in-depot-paper-less');

                // Set the form action dynamically
                var formAction = "{{ route('edit.gate-in-depot', ['id' => '__GATE_IN_DEPOT_ID__']) }}";
                formAction = formAction.replace('__GATE_IN_DEPOT_ID__', gateInDepotIdToEdit);
                $('#edit-gate-in-depot-form').attr('action', formAction);

                // Populate the edit modal fields with the Gate In Depot data
                $('#edit-gate-in-depot-id').val(gateInDepotIdToEdit);
                $('#edit-gate-in-depot-name').val(gateInDepotName);
                $('#edit-gate-in-depot-contact').val(gateInDepotContact);
                $('#edit-gate-in-depot-tel').val(gateInDepotTel);
                $('#edit-gate-in-depot-note').val(gateInDepotNote);
                $('#edit-gate-in-depot-paper-less').val(
                    gateInDepotPaperLess
                ); // Assuming you have an input field with id 'edit-gate-in-depot-paper-less'
            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>


@endsection
