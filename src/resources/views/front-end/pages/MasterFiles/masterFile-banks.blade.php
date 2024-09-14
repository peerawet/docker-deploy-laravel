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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Receipt Description
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.bank') }}"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
                                Banks
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </head>

        <div class="box p-5">
            <div class="mb-5 text-right">
                <button type="button" id="addBankButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-bank-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Bank
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <div class="form-inline col-span-4">
                        <label for="bank-search" class="form-label">Search</label>
                        <input id="bank-search" type="text" class="form-control" placeholder="Type to search">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <!-- Bank Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">ID</th>
                            <th class="whitespace-nowrap">Bank Name</th>
                            <th class="whitespace-nowrap">Note</th>
                            <th class="whitespace-nowrap">Edit by</th>
                            <th class="whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through allBanks and generate table rows -->
                        @foreach ($allBanks as $bank)
                            <tr class="text-center">
                                <td>{{ $bank->id }}</td>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->note }}</td>
                                <td>{{ $bank->edit_by }} <br> {{ $bank->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-bank-btn" title="Edit"
                                        data-bank-id="{{ $bank->id }}" data-bank-name="{{ $bank->name }}"
                                        data-bank-note="{{ $bank->note }}" data-tw-target="#edit-bank-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="tooltip btn btn-danger delete-bank-btn" title="Delete"
                                        data-bank-id="{{ $bank->id }}" data-bank-name="{{ $bank->name }}"
                                        data-tw-target="#delete-bank-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allBanks->links() }}
                </div>
            </div>


            <!-- Add New Bank Modal -->
            <div id="add-bank-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Bank</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Bank form -->
                            <form id="add-bank-form" method="POST" action="{{ route('add.bank') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-bank-name">Bank Name</label>
                                    <input type="text" class="form-control" id="add-bank-name" name="name"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-bank-note">Note</label>
                                    <input type="text" class="form-control" id="add-bank-note" name="note"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add Bank</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Add New Bank Modal -->

            <!-- Delete Confirmation Modal -->
            <div id="delete-bank-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
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
                                <div class="text-slate-500 mt-2" id="bank-name-placeholder"></div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <form id="delete-bank-form" method="POST"
                                    action="{{ route('delete.bank', ['id' => '__BANK_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="bank_id" id="bank-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Bank Modal -->
            <div id="edit-bank-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Bank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Bank form -->
                            <form id="edit-bank-form" method="POST"
                                action="{{ route('edit.bank', ['id' => '__BANK_ID__']) }}">
                                @csrf
                                <input type="hidden" name="id" id="edit-bank-id" value="">
                                <div class="form-group">
                                    <label for="edit-bank-name">Bank Name</label>
                                    <input type="text" class="form-control" id="edit-bank-name" name="name"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-bank-note">Note</label>
                                    <input type="text" class="form-control" id="edit-bank-note" name="note"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Edit Bank Modal -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Bank script --}}
    <script>
        jQuery(document).ready(function() {
            // Delete Bank modal
            jQuery('.delete-bank-btn').on('click', function() {
                // Get the Bank ID and name from the clicked button's data attributes
                var bankIdToDelete = $(this).data('bank-id');
                var bankName = $(this).data('bank-name');

                // Set the value of the hidden input field in the form
                $('#bank-id-to-delete').val(bankIdToDelete);

                // Replace the placeholder in the form action with the actual Bank ID
                var formAction = "{{ route('delete.bank', ['id' => '__BANK_ID__']) }}";
                formAction = formAction.replace('__BANK_ID__', bankIdToDelete);
                $('#delete-bank-form').attr('action', formAction);

                // Update the Bank name placeholder in the modal
                $('#bank-name-placeholder').text('Do you want to delete Bank ' +
                    bankName + '?');
            });
        });

        jQuery(document).ready(function() {
            // Edit Bank modal
            jQuery('.edit-bank-btn').on('click', function() {
                // Get the Bank ID and name from the clicked button's data attributes
                var bankIdToEdit = $(this).data('bank-id');
                var bankName = $(this).data('bank-name');
                var bankNote = $(this).data('bank-note'); // Assuming you have a data attribute for note

                // Set the form action dynamically
                var formAction = "{{ route('edit.bank', ['id' => '__BANK_ID__']) }}";
                formAction = formAction.replace('__BANK_ID__', bankIdToEdit);
                $('#edit-bank-form').attr('action', formAction);

                // Populate the edit modal fields with the Bank data
                $('#edit-bank-id').val(bankIdToEdit);
                $('#edit-bank-name').val(bankName);
                $('#edit-bank-note').val(bankNote); // Populate the note field
            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>



@endsection
