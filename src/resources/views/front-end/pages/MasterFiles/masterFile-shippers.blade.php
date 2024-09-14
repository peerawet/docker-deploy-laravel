@extends('front-end.layouts.main')
@section('title', 'Master Files')
@section('content')

    <div id="shipper">

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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
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
                <button type="button" id="addShipperButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-shipper-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Shipper
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4" action="{{ route('masterFiles.index.shipper') }}"
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
                <!-- Shipper Setting Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'name',
                                        'sort_order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Shipper Name {!! $sortField == 'name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'contact',
                                        'sort_order' => $sortField == 'contact' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Contact Name {!! $sortField == 'contact' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'tel',
                                        'sort_order' => $sortField == 'tel' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Tel. {!! $sortField == 'tel' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'address',
                                        'sort_order' => $sortField == 'address' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Address {!! $sortField == 'address' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
                                        'sort_field' => 'sale_id',
                                        'sort_order' => $sortField == 'sale_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Sale{!! $sortField == 'sale_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.shipper', [
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
                        <!-- Loop through allShippers and generate table rows -->
                        @foreach ($allShippers as $shipper)
                            <tr class="text-center">
                                <td>{{ $shipper->id }}</td>
                                <td>{{ $shipper->name }}</td>
                                <td>{{ $shipper->contact }}</td>
                                <td>{{ $shipper->tel }}</td>
                                <td>{{ $shipper->address }}</td>
                                <td>{{ $shipper->note }}</td>
                                <td>{{ optional($shipper->sale)->name }}</td>
                                <td>{{ $shipper->edit_by }} <br> {{ $shipper->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-shipper-btn"
                                        title="Edit" data-shipper-id="{{ $shipper->id }}"
                                        data-shipper-name="{{ $shipper->name }}"
                                        data-shipper-contact="{{ $shipper->contact }}"
                                        data-shipper-tel="{{ $shipper->tel }}"
                                        data-shipper-address="{{ $shipper->address }}"
                                        data-shipper-note="{{ $shipper->note }}"
                                        data-sale-id="{{ optional($shipper->sale)->id }}"
                                        data-tw-target="#edit-shipper-modal" data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>


                                    <button type="button" class="tooltip btn btn-danger delete-shipper-btn"
                                        title="ลบข้อมูล" data-shipper-id="{{ $shipper->id }}"
                                        data-shipper-name="{{ $shipper->name }}" data-tw-target="#delete-shipper-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allShippers->links() }}
                </div>
            </div>
            <!-- Add New Shipper Modal -->
            <div id="add-shipper-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Shipper</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Shipper form -->
                            <form id="add-shipper-form" method="POST" action="{{ route('add.shipper') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-shipper-name">Shipper Name</label>
                                    <input type="text" class="form-control" id="add-shipper-name" name="name"
                                        value="">
                                </div>
                                <!-- Additional fields -->
                                <div class="form-group mt-3">
                                    <label for="add-shipper-contact">Contact Name</label>
                                    <input type="text" class="form-control" id="add-shipper-contact" name="contact"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-shipper-tel">Telephone</label>
                                    <input type="text" class="form-control" id="add-shipper-tel" name="tel"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-shipper-address">Address</label>
                                    <input type="text" class="form-control" id="add-address-tel" name="address"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-shipper-note">Note</label>
                                    <input type="text" class="form-control" id="add-note-tel" name="note"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-shipper-sale">Sale</label>
                                    <select class="form-select" id="add-shipper-sale" name="sale_id">
                                        @foreach ($masterFileSales as $sale)
                                            <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Add more fields as needed with mt-3 for top margin -->
                                <button type="submit" class="btn btn-primary mt-3">Add Shipper</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Shipper Modal -->


            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-shipper-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
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
                                <div class="text-slate-500 mt-2" id="shipper-name-placeholder"></div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <!-- Replace the button with a form -->
                                <form id="delete-shipper-form" method="POST"
                                    action="{{ route('delete.shipper', ['id' => '__SHIPPER_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="shipper_id" id="shipper-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Shipper Modal -->
            <div id="edit-shipper-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Shipper</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Shipper form -->
                            <form id="edit-shipper-form" method="POST"
                                action="{{ route('edit.shipper', ['id' => '__SHIPPER_ID__']) }}">
                                @csrf
                                <input type="hidden" name="id" id="edit-shipper-id" value="">
                                <div class="form-group">
                                    <label for="edit-shipper-name">Shipper Name</label>
                                    <input type="text" class="form-control" id="edit-shipper-name" name="name"
                                        value="">
                                </div>
                                <!-- Additional fields -->
                                <div class="form-group mt-3">
                                    <label for="edit-shipper-contact">Contact Name</label>
                                    <input type="text" class="form-control" id="edit-shipper-contact" name="contact"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-shipper-tel">Telephone</label>
                                    <input type="text" class="form-control" id="edit-shipper-tel" name="tel"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-shipper-address">Address</label>
                                    <input type="text" class="form-control" id="edit-shipper-address" name="address"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-shipper-note">Note</label>
                                    <input type="text" class="form-control" id="edit-shipper-note" name="note"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-shipper-sale">Sale</label>
                                    <select class="form-select" id="edit-shipper-sale" name="sale_id">
                                        @foreach ($masterFileSales as $sale)
                                            <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Add more fields as needed with mt-3 for top margin -->
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Shipper Modal -->

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Shipper script --}}
    <script>
        jQuery(document).ready(function() {
            jQuery('.delete-shipper-btn').on('click', function() {
                // Get the Shipper ID, name, and sale_id from the clicked button's data attributes
                var shipperIdToDelete = $(this).data('shipper-id');
                var shipperName = $(this).data('shipper-name');
                var saleId = $(this).data('sale-id'); // Assuming you have data attribute 'data-sale-id'

                // Set the value of the hidden input fields in the form
                $('#shipper-id-to-delete').val(shipperIdToDelete);
                $('#sale-id-to-delete').val(saleId);

                // Replace the placeholder in the form action with the actual Shipper ID
                var formAction = "{{ route('delete.shipper', ['id' => '__SHIPPER_ID__']) }}";
                formAction = formAction.replace('__SHIPPER_ID__', shipperIdToDelete);
                $('#delete-shipper-form').attr('action', formAction);

                // Update the Shipper name and sale_id placeholders in the modal
                $('#shipper-name-placeholder').text('Do you want to delete Shipper ' + shipperName + '?');
                $('#sale-id-placeholder').text('Sale ID: ' + saleId);
            });

            // Edit Shipper modal
            jQuery('.edit-shipper-btn').on('click', function() {
                // Get the Shipper ID, name, contact, tel, address, note, and sale_id from the clicked button's data attributes
                var shipperIdToEdit = $(this).data('shipper-id');
                var shipperName = $(this).data('shipper-name');
                var shipperContact = $(this).data('shipper-contact');
                var shipperTel = $(this).data('shipper-tel');
                var shipperAddress = $(this).data('shipper-address');
                var shipperNote = $(this).data('shipper-note');
                var saleId = $(this).data('sale-id'); // Assuming you have data attribute 'data-sale-id'

                // Set the form action dynamically
                var formAction = "{{ route('edit.shipper', ['id' => '__SHIPPER_ID__']) }}";
                formAction = formAction.replace('__SHIPPER_ID__', shipperIdToEdit);
                $('#edit-shipper-form').attr('action', formAction);

                // Populate the edit modal fields with the Shipper data
                $('#edit-shipper-id').val(shipperIdToEdit);
                $('#edit-shipper-name').val(shipperName);
                $('#edit-shipper-contact').val(shipperContact);
                $('#edit-shipper-tel').val(shipperTel);
                $('#edit-shipper-address').val(shipperAddress);
                $('#edit-shipper-note').val(shipperNote);
                $('#edit-shipper-sale').val(saleId);
                // Assuming you have an input field with id 'edit-shipper-sale-id'
            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>


@endsection
