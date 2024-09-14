@extends('front-end.layouts.main')
@section('title', 'Master Files')
@section('content')



    <div id="agent">

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
                                class="font-medium py-2 px-4 text-center block border-b-2 border-blue-500 text-blue-500 hover:border-blue-500 hover:text-blue-500 focus:outline-none">
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
                            <a href="{{ route('masterFiles.index.loading-location') }}" id="loading-location-tab"
                                class="font-medium py-2 px-4 text-center block border-b-2 border-transparent text-gray-500 hover:border-gray-500 hover:text-gray-500 focus:outline-none">
                                Loading Location
                            </a>
                        </li>
                        <li class="mr-1 whitespace-nowrap">
                            <a href="{{ route('masterFiles.index.delivery-location') }}" id="delivery-location-tab"
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
                <button type="button" id="addAgentButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-agent-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Agent
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4" action="{{ route('masterFiles.index.agent') }}"
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
                <!-- Agent Setting Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'id', 'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'name', 'sort_order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    Agent Name {!! $sortField == 'name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'contact', 'sort_order' => $sortField == 'contact' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    Contact Name {!! $sortField == 'contact' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'tel', 'sort_order' => $sortField == 'tel' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    Tel. {!! $sortField == 'tel' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'agent_id', 'sort_order' => $sortField == 'agent_id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    Agent ID {!! $sortField == 'agent_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'note', 'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.agent', ['sort_field' => 'edit_by', 'sort_order' => $sortField == 'edit_by' && $sortOrder == 'asc' ? 'desc' : 'asc', 'search_value' => $searchValue]) }}">
                                    Edit by {!! $sortField == 'edit_by' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">จัดการ</th>
                        </tr>


                    </thead>
                    <tbody>
                        <!-- Loop through allAgents and generate table rows -->
                        @foreach ($allAgents as $agent)
                            <tr class="text-center">
                                <td>{{ $agent->id }}</td>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->contact }}</td>
                                <td>{{ $agent->tel }}</td>
                                <td>{{ $agent->agent_id }}</td>
                                <td>{{ $agent->note }}</td>
                                <td>{{ $agent->edit_by }} <br> {{ $agent->edit_date }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-agent-btn"
                                        title="แก้ไขข้อมูล" data-agent-id="{{ $agent->id }}"
                                        data-agent-name="{{ $agent->name }}" data-agent-contact="{{ $agent->contact }}"
                                        data-agent-tel="{{ $agent->tel }}"
                                        data-agent-specific-id="{{ $agent->agent_id }}"
                                        data-agent-note="{{ $agent->note }}" data-tw-target="#edit-agent-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>

                                    <button type="button" class="tooltip btn btn-danger delete-agent-btn"
                                        title="ลบข้อมูล" data-agent-id="{{ $agent->id }}"
                                        data-agent-name="{{ $agent->name }}" data-tw-target="#delete-agent-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $allAgents->links() }}
                </div>

                <!-- Add New Agent Modal -->
                <div id="add-agent-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Add New Agent</h5>
                                <button type="button" class="btn-close" data-tw-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add New Agent form -->
                                <form id="add-agent-form" method="POST" action="{{ route('add.agent') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="add-agent-name">Agent Name</label>
                                        <input type="text" class="form-control" id="add-agent-name" name="name"
                                            value="">
                                    </div>
                                    <!-- Additional fields -->
                                    <div class="form-group mt-3">
                                        <label for="add-agent-contact">Contact Name</label>
                                        <input type="text" class="form-control" id="add-agent-contact" name="contact"
                                            value="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="add-agent-tel">Telephone</label>
                                        <input type="text" class="form-control" id="add-agent-tel" name="tel"
                                            value="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="add-agent-agent_id">Agent ID</label>
                                        <input type="text" class="form-control" id="add-agent-agent_id"
                                            name="agent_id" value="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="add-agent-note">Note</label>
                                        <input type="text" class="form-control" id="add-agent-note" name="note"
                                            value="">
                                    </div>
                                    <!-- Add more fields as needed with mt-3 for top margin -->
                                    <button type="submit" class="btn btn-primary mt-3">Add Agent</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Add New Agent Modal -->

                <!-- Delete Confirmation Modal -->
                <div id="delete-agent-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
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
                                    <div class="text-slate-500 mt-2" id="agent-name-placeholder"></div>
                                </div>
                                <div class="px-5 pb-8 text-center">
                                    <form id="delete-agent-form" method="POST"
                                        action="{{ route('delete.agent', ['id' => '__AGENT_ID__']) }}">
                                        @csrf
                                        <input type="hidden" name="agent_id" id="agent-id-to-delete">
                                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->

                <!-- Edit Agent Modal -->
                <div id="edit-agent-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Edit Agent</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Edit Agent form -->
                                <form id="edit-agent-form" method="POST"
                                    action="{{ route('edit.agent', ['id' => '__AGENT_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="id" id="edit-agent-id" value="">
                                    <div class="form-group">
                                        <label for="edit-agent-name">Agent Name</label>
                                        <input type="text" class="form-control" id="edit-agent-name" name="name"
                                            value="">
                                    </div>
                                    <!-- Additional fields -->
                                    <div class="form-group mt-3">
                                        <label for="edit-agent-contact">Contact Name</label>
                                        <input type="text" class="form-control" id="edit-agent-contact"
                                            name="contact" value="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-agent-tel">Telephone</label>
                                        <input type="text" class="form-control" id="edit-agent-tel" name="tel"
                                            value="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-agent-agent_id">Agent ID</label>
                                        <input type="text" class="form-control" id="edit-agent-agent_id"
                                            name="agent_id" value="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="edit-agent-note">Note</label>
                                        <input type="text" class="form-control" id="edit-agent-note" name="note"
                                            value="">
                                    </div>
                                    <!-- Add more fields as needed with mt-3 for top margin -->
                                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Edit Agent Modal -->
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- Agent script --}}
        <script>
            jQuery(document).ready(function() {
                jQuery('.delete-agent-btn').on('click', function() {
                    // Get the Agent ID and name from the clicked button's data attributes
                    var agentIdToDelete = $(this).data('agent-id');
                    var agentName = $(this).data('agent-name');

                    // Set the value of the hidden input field in the form
                    $('#agent-id-to-delete').val(agentIdToDelete);

                    // Replace the placeholder in the form action with the actual Agent ID
                    var formAction = "{{ route('delete.agent', ['id' => '__AGENT_ID__']) }}";
                    formAction = formAction.replace('__AGENT_ID__', agentIdToDelete);
                    $('#delete-agent-form').attr('action', formAction);

                    // Update the Agent name placeholder in the modal
                    $('#agent-name-placeholder').text('Do you want to delete Agent ' + agentName + '?');
                });
            });

            jQuery(document).ready(function() {
                // Edit Agent modal
                jQuery('.edit-agent-btn').on('click', function() {
                    // Get the Agent ID, name, contact, tel, agent_id, and note from the clicked button's data attributes
                    var agentIdToEdit = $(this).data('agent-id');
                    var agentName = $(this).data('agent-name');
                    var agentContact = $(this).data('agent-contact');
                    var agentTel = $(this).data('agent-tel');
                    var agentAgentId = $(this).data('agent-specific-id');
                    var agentNote = $(this).data('agent-note');


                    // Set the form action dynamically
                    var formAction = "{{ route('edit.agent', ['id' => '__AGENT_ID__']) }}";
                    formAction = formAction.replace('__AGENT_ID__', agentIdToEdit);
                    $('#edit-agent-form').attr('action', formAction);

                    // Populate the edit modal fields with the Agent data
                    $('#edit-agent-id').val(agentIdToEdit);
                    $('#edit-agent-name').val(agentName);
                    $('#edit-agent-contact').val(agentContact);
                    $('#edit-agent-tel').val(agentTel);
                    $('#edit-agent-agent_id').val(
                        agentAgentId); // Assuming you have an input field with id 'edit-agent-agent-id'
                    $('#edit-agent-note').val(
                        agentNote); // Assuming you have an input field with id 'edit-agent-note'
                });

                // Add additional code here to handle form submission, validation, etc.
            });
        </script>

    </div>



@endsection
