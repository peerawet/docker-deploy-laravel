@extends('front-end.layouts.main')
@section('title', 'Master Files')
@section('content')

    <div id="depot">

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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
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
                <button type="button" id="addDepotButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-depot-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Depot
                </button>

            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4" action="{{ route('masterFiles.index.depot') }}"
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
                <!-- Depot Setting Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.depot', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.depot', [
                                        'sort_field' => 'name',
                                        'sort_order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Depot Name {!! $sortField == 'name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.depot', [
                                        'sort_field' => 'contact',
                                        'sort_order' => $sortField == 'contact' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Contact Name {!! $sortField == 'contact' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.depot', [
                                        'sort_field' => 'tel',
                                        'sort_order' => $sortField == 'tel' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Tel. {!! $sortField == 'tel' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.depot', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.depot', [
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
                        @foreach ($allDepot as $depot)
                            <tr class="text-center">
                                <td>{{ $depot->id }}</td>
                                <td>{{ $depot->name }}</td>
                                <td>{{ $depot->contact }}</td>
                                <td>{{ $depot->tel }}</td>
                                <td>{{ $depot->note }}</td>
                                <td>{{ $depot->edit_by }} <br> {{ $depot->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-depot-btn"
                                        title="แก้ไขข้อมูล" data-depot-id="{{ $depot->id }}"
                                        data-depot-name="{{ $depot->name }}" data-depot-contact="{{ $depot->contact }}"
                                        data-depot-tel="{{ $depot->tel }}" data-depot-note="{{ $depot->note }}"
                                        data-tw-target="#edit-depot-modal" data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>

                                    <button type="button" class="tooltip btn btn-danger delete-depot-btn"
                                        title="ลบข้อมูล" data-depot-id="{{ $depot->id }}"
                                        data-depot-name="{{ $depot->name }}" data-tw-target="#delete-depot-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allDepot->links() }}
                </div>
            </div>
            <!-- Add New Depot Modal -->
            <div id="add-depot-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Depot</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Depot form -->
                            <form id="add-depot-form" method="POST" action="{{ route('add.depot') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-depot-name">Depot Name</label>
                                    <input type="text" class="form-control" id="add-depot-name" name="name"
                                        value="">
                                </div>
                                <!-- Additional fields -->
                                <div class="form-group mt-3">
                                    <label for="add-depot-contact">Contact Name</label>
                                    <input type="text" class="form-control" id="add-depot-contact" name="contact"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-depot-tel">Telephone</label>
                                    <input type="text" class="form-control" id="add-depot-tel" name="tel"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-depot-tel">Note</label>
                                    <input type="text" class="form-control" id="add-depot-note" name="note"
                                        value="">
                                </div>
                                <!-- Add more fields as needed with mt-3 for top margin -->
                                <button type="submit" class="btn btn-primary mt-3">Add Depot</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Depot Modal -->

            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-depot-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
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
                                <div class="text-slate-500 mt-2" id="depot-name-placeholder">

                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <!-- Replace the button with a form -->
                                <form id="delete-depot-form" method="POST"
                                    action="{{ route('delete.depot', ['id' => '__CY_FROM_ID__']) }}">
                                    @csrf

                                    <input type="hidden" name="cy_from_id" id="depot-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Depot Modal -->
            <div id="edit-depot-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Depot</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Depot form -->
                            <form id="edit-depot-form" method="POST"
                                action="{{ route('edit.depot', ['id' => '__CY_FROM_ID__']) }}">
                                @csrf
                                @isset($depot)
                                    <input type="hidden" name="id" id="edit-depot-id" value="{{ $depot->id }}">
                                    <div class="form-group">
                                        <label for="edit-depot-name">Depot Name</label>
                                        <input type="text" class="form-control" id="edit-depot-name" name="name"
                                            value="{{ $depot->name }}">
                                    </div>
                                    <!-- Additional fields -->
                                    <div class="form-group mt-3">
                                        <label for="edit-depot-contact">Contact Name</label>
                                        <input type="text" class="form-control" id="edit-depot-contact" name="contact"
                                            value="{{ $depot->contact }}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-depot-tel">Telephone</label>
                                        <input type="text" class="form-control" id="edit-depot-tel" name="tel"
                                            value="{{ $depot->tel }}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-depot-tel">Note</label>
                                        <input type="text" class="form-control" id="edit-depot-note" name="note"
                                            value="{{ $depot->note }}">
                                    </div>
                                @else
                                    <p>No data available for Depot.</p>
                                @endisset

                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Depot Modal -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Depot script --}}
    <script>
        jQuery(document).ready(function() {
            jQuery('.delete-depot-btn').on('click', function() {
                // Get the Depot ID and name from the clicked button's data attributes
                var depotIdToDelete = $(this).data('depot-id');
                var depotName = $(this).data('depot-name');

                // Set the value of the hidden input field in the form
                $('#depot-id-to-delete').val(depotIdToDelete);

                // Replace the placeholder in the form action with the actual Depot ID
                var formAction = "{{ route('delete.depot', ['id' => '__depot_ID__']) }}";
                formAction = formAction.replace('__depot_ID__', depotIdToDelete);
                $('#delete-depot-form').attr('action', formAction);

                // Update the Depot name placeholder in the modal
                $('#depot-name-placeholder').text('Do you want to delete Depot ' + depotName + '?');


            });
        });

        jQuery(document).ready(function() {
            // Edit Depot modal
            jQuery('.edit-depot-btn').on('click', function() {
                // Get the Depot ID, name, contact, and tel from the clicked button's data attributes
                var depotIdToEdit = $(this).data('depot-id');
                var depotName = $(this).data('depot-name');
                var depotContact = $(this).data('depot-contact');
                var depotTel = $(this).data('depot-tel');
                var depotNote = $(this).data('depot-note');

                // Set the form action dynamically
                var formAction = "{{ route('edit.depot', ['id' => '__CY_FROM_ID__']) }}";
                formAction = formAction.replace('__CY_FROM_ID__', depotIdToEdit);
                $('#edit-depot-form').attr('action', formAction);

                // Populate the edit modal fields with the Depot data
                $('#edit-depot-id').val(depotIdToEdit);
                $('#edit-depot-name').val(depotName);
                $('#edit-depot-contact').val(depotContact);
                $('#edit-depot-tel').val(depotTel);
                $('#edit-depot-note').val(depotNote);


            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>


@endsection
