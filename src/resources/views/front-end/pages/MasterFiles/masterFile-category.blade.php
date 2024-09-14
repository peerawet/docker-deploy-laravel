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
                <button type="button" id="addCategoryButton" class="btn btn-outline-primary btn-rounded w-36 mr-2 mb-2"
                    data-tw-target="#add-category-modal" data-tw-toggle="modal">
                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                    Add Category
                </button>
            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12 gap-2">
                    <form id="search-form" class="form-inline col-span-4"
                        action="{{ route('masterFiles.index.category') }}" method="GET">
                        <label for="search-input" class="form-label">Search</label>
                        <input id="search-input" name="search_value" type="text" class="form-control"
                            placeholder="Type the category name or ID to search">
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
                <!-- Category Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.category', [
                                        'sort_field' => 'id',
                                        'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    ID {!! $sortField == 'id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.category', [
                                        'sort_field' => 'category',
                                        'sort_order' => $sortField == 'category' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Category {!! $sortField == 'category' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.category', [
                                        'sort_field' => 'note',
                                        'sort_order' => $sortField == 'note' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Note {!! $sortField == 'note' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('masterFiles.index.category', [
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
                        @foreach ($allCategories as $category)
                            <tr class="text-center">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category }}</td>
                                <td>{{ $category->note }}</td>
                                <td>{{ $category->edit_by }}</td>
                                <td>
                                    <button type="button" class="tooltip btn btn-warning edit-category-btn"
                                        title="Edit" data-category-id="{{ $category->id }}"
                                        data-category-name="{{ $category->category }}"
                                        data-category-note="{{ $category->note }}" data-tw-target="#edit-category-modal"
                                        data-tw-toggle="modal">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="tooltip btn btn-danger delete-category-btn"
                                        title="Delete" data-category-id="{{ $category->id }}"
                                        data-category-name="{{ $category->category }}"
                                        data-tw-target="#delete-category-modal" data-tw-toggle="modal">
                                        <i data-lucide="delete" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="flex justify-center mt-4">
                    {{ $allCategories->links() }}
                </div>
            </div>


            <!-- Add New Category Modal -->
            <div id="add-category-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add New Category form -->
                            <form id="add-category-form" method="POST" action="{{ route('add.category') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="add-category-name">Category Name</label>
                                    <input type="text" class="form-control" id="add-category-name" name="category"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="add-category-description">Description</label>
                                    <input type="text" class="form-control" id="add-category-description"
                                        name="description" value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Add New Category Modal -->

            <!-- Delete Confirmation Modal -->
            <div id="delete-category-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">Are you sure?</div>
                                <div class="text-slate-500 mt-2" id="category-name-placeholder"></div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <form id="delete-category-form" method="POST"
                                    action="{{ route('delete.category', ['id' => '__CATEGORY_ID__']) }}">
                                    @csrf
                                    <input type="hidden" name="category_id" id="category-id-to-delete">
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->

            <!-- Edit Category Modal -->
            <div id="edit-category-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Category form -->
                            <form id="edit-category-form" method="POST"
                                action="{{ route('edit.category', ['id' => '__CATEGORY_ID__']) }}">
                                @csrf
                                <input type="hidden" name="id" id="edit-category-id" value="">
                                <div class="form-group">
                                    <label for="edit-category-name">Category Name</label>
                                    <input type="text" class="form-control" id="edit-category-name" name="category"
                                        value="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="edit-category-description">Description</label>
                                    <input type="text" class="form-control" id="edit-category-description"
                                        name="description" value="">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Edit Category Modal -->


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- {{-- Category script --}} -->
    <script>
        jQuery(document).ready(function() {
            // Delete Category modal
            jQuery('.delete-category-btn').on('click', function() {
                // Get the Category ID and name from the clicked button's data attributes
                var categoryIdToDelete = $(this).data('category-id');
                var categoryName = $(this).data('category-name');

                // Set the value of the hidden input field in the form
                $('#category-id-to-delete').val(categoryIdToDelete);

                // Replace the placeholder in the form action with the actual Category ID
                var formAction = "{{ route('delete.category', ['id' => '__CATEGORY_ID__']) }}";
                formAction = formAction.replace('__CATEGORY_ID__', categoryIdToDelete);
                $('#delete-category-form').attr('action', formAction);

                // Update the Category name placeholder in the modal
                $('#category-name-placeholder').text('Do you want to delete Category ' +
                    categoryName + '?');
            });

            // Edit Category modal
            jQuery('.edit-category-btn').on('click', function() {
                // Get the Category ID and name from the clicked button's data attributes
                var categoryIdToEdit = $(this).data('category-id');
                var categoryName = $(this).data('category-name');
                var categoryNote = $(this).data(
                    'category-note'); // Assuming you have a data attribute for note

                // Set the form action dynamically
                var formAction = "{{ route('edit.category', ['id' => '__CATEGORY_ID__']) }}";
                formAction = formAction.replace('__CATEGORY_ID__', categoryIdToEdit);
                $('#edit-category-form').attr('action', formAction);

                // Populate the edit modal fields with the Category data
                $('#edit-category-id').val(categoryIdToEdit);
                $('#edit-category-name').val(categoryName);
                $('#edit-category-note').val(categoryNote); // Populate the note field
            });

            // Add additional code here to handle form submission, validation, etc.
        });
    </script>




@endsection
