@extends('front-end.layouts.main')
@section('title', 'รายงาน Drafts ทั้งหมด')
@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Other meta tags and stylesheets -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Other meta tags and stylesheets -->

    </head>

    <body>
        <script>
            console.log(@json($drafts));
        </script>

        <div class="intro-y box p-5">
            <div class="mb-5 text-right">
                <livewire:components.assets.button color="primary" title="New Draft" icon="file-text" route="drafts.create"
                    action="" />


                <button type="button" id="printSelectedButton"
                    class="btn btn-outline-success btn-rounded w-36 mr-2 mb-2 print-selected-draft-btn"
                    data-tw-target="#print-selected-confirmation-modal" data-tw-toggle="modal">
                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                    Print Selected
                </button>

                <button type="button" id="customTable"
                    class="col-span-12 lg:col-span-2 btn btn-outline-warning btn-rounded"
                    data-tw-target="#customize-table-modal" data-tw-toggle="modal">
                    <i data-lucide="wrench" class="w-4 h-4 mr-2"></i>
                    Custom Table
                </button>

            </div>

            <div class="mb-5">
                <div class="grid grid-cols-12">
                    <div class="form-inline col-span-6 lg:col-span-2">
                        <label for="search-field-select" class="form-label">ค้นหา</label>
                        <select id="search-field-select" class="form-select">
                            <option value="all" selected>Search All</option>
                            <!-- Other options will be dynamically added here -->
                        </select>
                    </div>

                    <div class="form-inline col-span-6 lg:col-span-3">
                        <label for="search-field-input" class="form-label"></label>
                        <input id="search-field-input" type="text" class="form-control"
                            placeholder="พิมพ์รายการที่ต้องการค้นหา" value="{{ $searchValue }}">
                        <input id="date-picker-input" type="date" class="form-control" style="display: none;">
                        <button id="toggle-date-picker" class="btn btn-outline-secondary" type="button">&#128197;</button>
                        <!-- Unicode for a calendar icon -->
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const searchFieldInput = document.getElementById('search-field-input');
                            const toggleDatePickerButton = document.getElementById('toggle-date-picker');
                            const datePickerInput = document.getElementById('date-picker-input');

                            toggleDatePickerButton.addEventListener('click', function() {
                                if (searchFieldInput.style.display === 'none') {
                                    searchFieldInput.style.display = 'block';
                                    datePickerInput.style.display = 'none';
                                    toggleDatePickerButton.innerHTML = '&#128240;'; // Unicode for a calendar icon
                                } else {
                                    searchFieldInput.style.display = 'none';
                                    datePickerInput.style.display = 'block';
                                    toggleDatePickerButton.innerHTML = '&#128197;'; // Unicode for a calendar icon
                                }
                            });

                            datePickerInput.addEventListener('change', function(event) {
                                const selectedDate = event.target.value;

                                searchFieldInput.value = selectedDate;
                            });


                        });
                    </script>


                    <div class="form-inline col-span-6 lg:col-span-2 ml-8">
                        <select id="search-field-new-select" class="form-select">
                            <option value="all" selected>Search All</option>
                            <!-- Options will be dynamically added here -->
                        </select>
                    </div>
                    <div class="form-inline col-span-6 lg:col-span-3">
                        <label for="search-field-new-input" class="form-label"> </label> <!-- Empty label for spacing -->
                        <input id="search-field-new-input" type="text" class="form-control"
                            placeholder="พิมพ์รายการที่ต้องการค้นหา" value="{{ $searchValueNew }}">
                        <input id="new-date-picker-input" type="date" class="form-control" style="display: none;">
                        <button id="toggle-new-date-picker" class="btn btn-outline-secondary"
                            type="button">&#128197;</button>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const newSearchFieldInput = document.getElementById('search-field-new-input');
                            const newToggleDatePickerButton = document.getElementById('toggle-new-date-picker');
                            const newDatePickerInput = document.getElementById('new-date-picker-input');

                            newToggleDatePickerButton.addEventListener('click', function() {
                                if (newSearchFieldInput.style.display === 'none') {
                                    newSearchFieldInput.style.display = 'block';
                                    newDatePickerInput.style.display = 'none';
                                    newToggleDatePickerButton.innerHTML = '&#128240;'; // Unicode for a calendar icon
                                } else {
                                    newSearchFieldInput.style.display = 'none';
                                    newDatePickerInput.style.display = 'block';
                                    newToggleDatePickerButton.innerHTML = '&#128197;'; // Unicode for a calendar icon
                                }
                            });

                            newDatePickerInput.addEventListener('change', function(event) {
                                const selectedDate = event.target.value;
                                newSearchFieldInput.value = selectedDate;
                            });
                        });
                    </script>


                    <div class="form-inline col-span-6 lg:col-span-2 ml-8">
                        <button id="search-button" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>

            <!-- BEGIN: Customize Table Modal -->
            <div id="customize-table-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title-customize-table">Customize Table</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body-custom-fields">
                            <div class="p-5 text-center">

                                <div class="text-3xl mt-2">Select Fields to Display</div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 px-5 pb-8">
                                <!-- Add checkboxes for each field -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxSelect" checked>
                                    <label class="form-check-label" for="checkboxSelect">
                                        Select
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxDraftNo" checked>
                                    <label class="form-check-label" for="checkboxDraftNo">
                                        Draft No.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxStatus" checked>
                                    <label class="form-check-label" for="checkboxStatus">
                                        Status
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxDraftDate" checked>
                                    <label class="form-check-label" for="checkboxDraftDate">
                                        Draft Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxShipperName" checked>
                                    <label class="form-check-label" for="checkboxShipperName">
                                        Shipper Name
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxAgentName" checked>
                                    <label class="form-check-label" for="checkboxAgentName">
                                        Agent Name
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxBookingNo" checked>
                                    <label class="form-check-label" for="checkboxBookingNo">
                                        Booking No.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxCustomerRef">
                                    <label class="form-check-label" for="checkboxCustomerRef">
                                        Customer Reference
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxTranshipmentPort">
                                    <label class="form-check-label" for="checkboxTranshipmentPort">
                                        Transhipment Port
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxContainerType">
                                    <label class="form-check-label" for="checkboxContainerType">
                                        Container Type
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxLoadingDate">
                                    <label class="form-check-label" for="checkboxLoadingDate">
                                        Loading Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxLoadingTime">
                                    <label class="form-check-label" for="checkboxLoadingTime">
                                        Loading Time
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxFeeder">
                                    <label class="form-check-label" for="checkboxFeeder">
                                        Feeder
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxVessel">
                                    <label class="form-check-label" for="checkboxVessel">
                                        Vessel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxVoyageFeeder">
                                    <label class="form-check-label" for="checkboxVoyageFeeder">
                                        Voyage Feeder
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxVoyageVessel">
                                    <label class="form-check-label" for="checkboxVoyageVessel">
                                        Voyage Vessel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxEtdDate">
                                    <label class="form-check-label" for="checkboxEtdDate">
                                        ETD Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxEtaDate">
                                    <label class="form-check-label" for="checkboxEtaDate">
                                        ETA Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxClosingDate">
                                    <label class="form-check-label" for="checkboxClosingDate">
                                        Closing Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxClosingTime">
                                    <label class="form-check-label" for="checkboxClosingTime">
                                        Closing Time
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxDepotName">
                                    <label class="form-check-label" for="checkboxDepotName">
                                        Depot Name
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxGateInDepotName">
                                    <label class="form-check-label" for="checkboxGateInDepotName">
                                        Gate-In Depot Name
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxDestinationPort">
                                    <label class="form-check-label" for="checkboxDestinationPort">
                                        Destination Port
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="checkboxFirstContainerReturnDate">
                                    <label class="form-check-label" for="checkboxFirstContainerReturnDate">
                                        First Container Return Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxLoadingPort">
                                    <label class="form-check-label" for="checkboxLoadingPort">
                                        Loading Port
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxPickupDate">
                                    <label class="form-check-label" for="checkboxPickupDate">
                                        Pickup Date
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxSiCutOff">
                                    <label class="form-check-label" for="checkboxSiCutOff">
                                        SI Cut Off
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxVgmCutOff">
                                    <label class="form-check-label" for="checkboxVgmCutOff">
                                        VGM Cut Off
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxRemark">
                                    <label class="form-check-label" for="checkboxRemark">
                                        Remark
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxSalseName">
                                    <label class="form-check-label" for="checkboxSalseName">
                                        Salse Name
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxPreparedBy">
                                    <label class="form-check-label" for="checkboxPreparedBy">
                                        Prepared by
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxEditBy">
                                    <label class="form-check-label" for="checkboxEditBy">
                                        Edit By
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxEditDate">
                                    <label class="form-check-label" for="checkboxEditDate">
                                        Edit Date
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxLoadingLocation">
                                    <label class="form-check-label" for="checkboxLoadingLocation">
                                        Loading Location
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxDeliveryLocation">
                                    <label class="form-check-label" for="checkboxDeliveryLocation">
                                        Delivery Location
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxCrossBorderDate">

                                    <label class="form-check-label" for="checkboxCrossBorderDate">
                                        Cross Border Date
                                    </label>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxType">
                                    <label class="form-check-label" for="checkboxType">
                                        Type
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkboxActions" checked>
                                    <label class="form-check-label" for="checkboxActions">
                                        Actions
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-tw-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="apply-customization"
                                data-tw-dismiss="modal">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Customize Table Modal -->
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

            <div class="overflow-x-auto">
                <div style="max-height: 600px; overflow-y: auto;">
                    <table class="table table-striped table-hover text-center table-bordered" style="text-align: center;">
                        <!-- Table headers -->

                        <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <!-- Table headers -->
                                <th class="whitespace-nowrap select">เลือก</th>
                                <th class="whitespace-nowrap draftNo">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'draft_no',
                                            'sort_order' => $sortField == 'draft_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField, // Append search field parameter
                                            'search_value' => $searchValue, // Append search value parameter
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Draft No. {!! $sortField == 'draft_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>
                                <th class="whitespace-nowrap status">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'status',
                                            'sort_order' => $sortField == 'status' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Status {!! $sortField == 'status' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap draftDate">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'draft_date',
                                            'sort_order' => $sortField == 'draft_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Draft Date {!! $sortField == 'draft_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap shipperName">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'shipper_id',
                                            'sort_order' => $sortField == 'shipper_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Shipper Name {!! $sortField == 'shipper_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap agentName">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'agent_id',
                                            'sort_order' => $sortField == 'agent_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Agent Name {!! $sortField == 'agent_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap bookingNo">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'booking_no',
                                            'sort_order' => $sortField == 'booking_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Booking No. {!! $sortField == 'booking_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap customerRef" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'customer_ref',
                                            'sort_order' => $sortField == 'customer_ref' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Customer Reference {!! $sortField == 'customer_ref' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap transhipmentPort" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'transhipment_port',
                                            'sort_order' => $sortField == 'transhipment_port' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Transhipment Port {!! $sortField == 'transhipment_port' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap containerType" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'container_type_id',
                                            'sort_order' => $sortField == 'container_type_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Container Type {!! $sortField == 'container_type_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap loadingDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'loading_date',
                                            'sort_order' => $sortField == 'loading_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Loading Date {!! $sortField == 'loading_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap loadingTime" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'loading_time',
                                            'sort_order' => $sortField == 'loading_time' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Loading Time {!! $sortField == 'loading_time' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap feeder" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'feeder_id',
                                            'sort_order' => $sortField == 'feeder_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Feeder {!! $sortField == 'feeder_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap vessel" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'vessel_id',
                                            'sort_order' => $sortField == 'vessel_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Vessel {!! $sortField == 'vessel_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap voyageFeeder" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'voyage_feeder',
                                            'sort_order' => $sortField == 'voyage_feeder' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Voyage Feeder {!! $sortField == 'voyage_feeder' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap voyageVessel" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'voyage_vessel',
                                            'sort_order' => $sortField == 'voyage_vessel' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Voyage Vessel {!! $sortField == 'voyage_vessel' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap etdDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'etd_date',
                                            'sort_order' => $sortField == 'etd_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        ETD Date {!! $sortField == 'etd_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap etaDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'eta_date',
                                            'sort_order' => $sortField == 'eta_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        ETA Date {!! $sortField == 'eta_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap closingDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'closing_date',
                                            'sort_order' => $sortField == 'closing_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Closing Date {!! $sortField == 'closing_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap closingTime" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'closing_time',
                                            'sort_order' => $sortField == 'closing_time' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Closing Time {!! $sortField == 'closing_time' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap depotName" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'depot_id',
                                            'sort_order' => $sortField == 'depot_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Depot Name {!! $sortField == 'depot_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap gateInDepotName" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'gate_in_depot_id',
                                            'sort_order' => $sortField == 'gate_in_depot_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Gate-In Depot Name {!! $sortField == 'gate_in_depot_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap destinationPort" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'destination_port',
                                            'sort_order' => $sortField == 'destination_port' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Destination Port {!! $sortField == 'destination_port' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap firstContainerReturnDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'first_container_return_date',
                                            'sort_order' => $sortField == 'first_container_return_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        First Container Return Date {!! $sortField == 'first_container_return_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap loadingPort" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'loading_port',
                                            'sort_order' => $sortField == 'loading_port' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Loading Port {!! $sortField == 'loading_port' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap pickupDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'pickup_date',
                                            'sort_order' => $sortField == 'pickup_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Pickup Date {!! $sortField == 'pickup_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap siCutOff" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'si_cut_off',
                                            'sort_order' => $sortField == 'si_cut_off' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        SI Cut Off {!! $sortField == 'si_cut_off' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap vgmCutOff" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'vgm_cut_off',
                                            'sort_order' => $sortField == 'vgm_cut_off' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        VGM Cut Off {!! $sortField == 'vgm_cut_off' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap remark" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'remark',
                                            'sort_order' => $sortField == 'remark' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Remark {!! $sortField == 'remark' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap salseName" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'sale_id',
                                            'sort_order' => $sortField == 'sale_id' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Sale Name {!! $sortField == 'sale_id' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap preparedBy" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'prepared_by',
                                            'sort_order' => $sortField == 'prepared_by' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Prepared by {!! $sortField == 'prepared_by' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap editBy" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'edit_by',
                                            'sort_order' => $sortField == 'edit_by' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Edit By {!! $sortField == 'edit_by' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap editDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'edit_date',
                                            'sort_order' => $sortField == 'edit_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Edit Date {!! $sortField == 'edit_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap loadingLocation" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'loading_location',
                                            'sort_order' => $sortField == 'loading_location' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Loading Location {!! $sortField == 'loading_location' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap deliveryLocation" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'delivery_location',
                                            'sort_order' => $sortField == 'delivery_location' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Delivery Location {!! $sortField == 'delivery_location' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <th class="whitespace-nowrap crossBorderDate" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'cross_border_date',
                                            'sort_order' => $sortField == 'cross_border_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Cross Border Date {!! $sortField == 'cross_border_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>


                                <th class="whitespace-nowrap type" style="display: none">
                                    <a
                                        href="{{ route('drafts.index', [
                                            'sort_field' => 'type',
                                            'sort_order' => $sortField == 'type' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                            'search_field' => $searchField,
                                            'search_value' => $searchValue,
                                            'search_field_new' => $searchFieldNew,
                                            'search_value_new' => $searchValueNew,
                                        ]) }}">
                                        Type {!! $sortField == 'type' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                    </a>
                                </th>

                                <style>
                                    .status-cancel {
                                        color: red;
                                    }

                                    .status-prepare {
                                        color: blue;
                                    }
                                </style>
                                <th class="whitespace-nowrap actions" ">จัดการ</th>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </thead>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                           @foreach ($drafts as $draft)
                            <tr class="main-row" data-draft-no="{{ $draft->draft_no }}">
                                <td class="text-center select-data">
                                    <input type="checkbox" class="form-check-input draft-checkbox"
                                        value="{{ $draft->draft_no }}">
                                </td>
                                <td
                                    class="draftNo  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif">
                                    {{ $draft->draft_no }}
                                </td>
                                <td
                                    class="status 
        @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif">
                                    {{ $draft->status }}
                                </td>
                                <td
                                    class="draftDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif">
                                    @if ($draft->draft_date)
                                        {{ date('d/m/Y', strtotime($draft->draft_date)) }}
                                    @endif
                                </td>
                                <td
                                    class="shipperName  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif">
                                    {{ optional($draft->shipper)->name }}</td>
                                <td
                                    class="agentName  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif">
                                    {{ optional($draft->agent)->name }}</td>

                                <td
                                    class="bookingNo  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif">
                                    {{ $draft->booking_no }}</td>
                                <td class="customerRef  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">{{ $draft->customer_ref }}</td>
                                <td class="transhipmentPort  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    {{ optional($draft->transhipmentPort)->name }}</td>
                                <td class="containerType  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->containerType && $draft->qty && $draft->temp)
                                        {{ $draft->qty }} X {{ $draft->containerType->size }} X
                                        {{ $draft->temp }}
                                    @endif
                                </td>


                                <td class="loadingDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->loading_date)
                                        {{ date('d/m/Y', strtotime($draft->loading_date)) }}
                                    @endif
                                </td>
                                <td class="loadingTime  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->loading_time)
                                        {{ date('H:i:s', strtotime($draft->loading_time)) }}
                                    @endif
                                </td>
                                <td class="feeder  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    {{ optional($draft->feeder)->name }}</td>
                                <td class="vessel  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    {{ optional($draft->vessel)->name }}</td>
                                <td class="voyageFeeder  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">{{ $draft->voy_feeder }}</td>
                                <td class="voyageVessel  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">{{ $draft->voy_vessel }}</td>
                                <td class="etdDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->ETD_date)
                                        {{ date('d-m-Y', strtotime($draft->ETD_date)) }}
                                    @endif
                                </td>

                                <td class="etaDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->ETA_date)
                                        {{ date('d-m-Y', strtotime($draft->ETA_date)) }}
                                    @endif
                                </td>

                                <td class="closingDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->closing_date)
                                        {{ date('d-m-Y', strtotime($draft->closing_date)) }}
                                    @endif
                                </td>

                                <td class="closingTime  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->closing_time)
                                        {{ date('H:i:s', strtotime($draft->closing_time)) }}
                                    @endif
                                </td>


                                <td class="depotName  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    {{ optional($draft->depot)->name }}
                                </td>

                                <td class="gateInDepotName  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    {{ optional($draft->gateInDepot)->name }}
                                </td>

                                <td class="destinationPort  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    {{ optional($draft->destinationPort)->name }}</td>

                                <td class="firstContainerReturnDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->first_container_return_date)
                                        {{ date('d-m-Y', strtotime($draft->first_container_return_date)) }}
                                    @endif
                                </td>


                                <td class="loadingPort  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">{{ optional($draft->loadingPort)->name }}</td>

                                <td class="pickupDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->pick_up_date)
                                        {{ date('d-m-Y', strtotime($draft->pick_up_date)) }}
                                    @endif
                                </td>


                                <td class="siCutOff  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->SI_date && $draft->SI_time)
                                        {{ date('d-m-Y', strtotime($draft->SI_date)) }}<br>
                                        {{ date('H:i', strtotime($draft->SI_time)) }}
                                    @endif
                                </td>

                                <td class="vgmCutOff  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->VGM_date && $draft->VGM_time)
                                        {{ date('d-m-Y', strtotime($draft->VGM_date)) }}<br>
                                        {{ date('H:i', strtotime($draft->VGM_time)) }}
                                    @endif
                                </td>


                                <td class="remark  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">{{ $draft->remark }}</td>
                                <td class="salseName" style="display: none">
                                    @if ($draft->sale)
                                        {{ $draft->sale->name }}
                                    @endif
                                </td>
                                <td class="preparedBy  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">
                                    @if ($draft->preparedBy)
                                        {{ $draft->preparedBy->name }}
                                    @endif
                                </td>

                                <td class="editBy  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">

                                    @if ($draft->edit_by)
                                        {{ $draft->editedBy->name }}
                                    @endif
                                </td>

                                <td class="editDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">

                                    @if ($draft->edit_date)
                                        {{ $draft->edit_date }}
                                    @endif
                                </td>

                                <td class="loadingLocation  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">

                                    @if ($draft->loadingLocation)
                                        {{ $draft->loadingLocation->name }}
                                    @endif
                                </td>

                                <td class="deliveryLocation  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">

                                    @if ($draft->deliveryLocation)
                                        {{ $draft->deliveryLocation->name }}
                                    @endif
                                </td>

                                <td class="crossBorderDate  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">

                                    @if ($draft->cross_border_date)
                                        {{ $draft->cross_border_date }}
                                    @endif
                                </td>

                                <td class="type  @if ($draft->status == 'Cancel') status-cancel 
        @elseif ($draft->status == 'Prepare') status-prepare @endif"
                                    style="display: none">

                                    @if ($draft->type)
                                        {{ $draft->type }}
                                    @endif
                                </td>

                                <td class="actions">
                                    <!-- Buttons for actions -->
                                    <button type="button"
                                        onclick="window.location.href='{{ route('drafts.create', ['draftId' => $draft->draft_no, 'tab' => $draft->type]) }}'"
                                        class="tooltip btn btn-primary" title="Clone">
                                        <i data-lucide="files" class="w-4 h-4"></i>
                                    </button>


                                    <button type="button"
                                        onclick="window.location.href='{{ route('drafts.edit', ['draftId' => $draft->draft_no, 'tab' => $draft->type]) }}'"
                                        class="tooltip btn btn-warning" title="แก้ไขข้อมูล">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        onclick="window.location.href='{{ route('drafts.print', ['draftId' => $draft->draft_no]) }}'"
                                        type="button" id="print-btn" class="tooltip btn btn-success" title="Print">
                                        <i data-lucide="printer" class="w-4 h-4"></i>
                                    </button>

                                    {{-- <button type="button" class="btn btn-dark view-details-btn" title="ดูข้อมูล">
                                        <i data-lucide="contact" class="w-4 h-4"></i>
                                    </button> --}}
                                    @if ($draft->incident_id)
                                        <button
                                            onclick="window.location.href='{{ route('drafts.report.accident', ['draftId' => $draft->draft_no]) }}'"
                                            type="button" id="print-btn" class="tooltip btn btn-danger"
                                            title="INCIDENT Report">
                                            <i data-lucide="flame" class="w-4 h-4"></i>
                                        </button>
                                    @endif
                                    @if ($draft->type == 'Truck')
                                        <button
                                            onclick="window.location.href='{{ route('drafts.truckWaybill', ['id' => $draft->booking_no]) }}'"
                                            type="button" id="print-btn" class="tooltip btn btn-light"
                                            title="TRUCK WAYBILL">
                                            <i data-lucide="truck" class="w-4 h-4"></i>
                                        </button>
                                    @endif



                                </td>
                            </tr>
                            <!-- Detail row (hidden by default) -->
                            <tr class="detail-row hidden" data-draft-no="{{ $draft->draft_no }}">
                                <td colspan="31">
                                    <!-- Add your detail content here -->
                                    Detail Content for Draft No. {{ $draft->draft_no }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <script>
                                document.querySelectorAll('.view-details-btn').forEach(btn => {
                                    btn.addEventListener('click', () => {
                                        // Find the closest main-row element
                                        const row = btn.closest('.main-row');
                                        if (row) {
                                            const draftNo = row.getAttribute('data-draft-no');
                                            const detailRow = document.querySelector(`.detail-row[data-draft-no="${draftNo}"]`);
                                            if (detailRow) {
                                                detailRow.classList.toggle('hidden');
                                            }
                                        }
                                    });
                                });
                            </script>


                    </table>
                </div>


                <div class="flex justify-center mt-4">
                    {{ $drafts->links() }}
                    {{-- {{ $drafts->links() }} <!-- Render pagination links --> --}}
                </div>
            </div>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            {{-- To hidden and show fields in table --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Function to toggle column visibility
                    function toggleColumn(columnClass, isVisible) {
                        document.querySelectorAll(`.${columnClass}`).forEach(th => {
                            th.style.display = isVisible ? '' : 'none';
                        });
                        document.querySelectorAll(`.${columnClass}-data`).forEach(td => {
                            td.style.display = isVisible ? '' : 'none';
                        });
                    }

                    // Add event listener to Apply button in Customize Table modal
                    document.getElementById('apply-customization').addEventListener('click', function() {
                        // Get the state of each checkbox and toggle column visibility accordingly
                        toggleColumn('select', document.getElementById('checkboxSelect').checked);
                        toggleColumn('draftNo', document.getElementById('checkboxDraftNo').checked);
                        toggleColumn('status', document.getElementById('checkboxStatus').checked);
                        toggleColumn('draftDate', document.getElementById('checkboxDraftDate').checked);
                        toggleColumn('shipperName', document.getElementById('checkboxShipperName').checked);
                        toggleColumn('agentName', document.getElementById('checkboxAgentName').checked);
                        toggleColumn('bookingNo', document.getElementById('checkboxBookingNo').checked);
                        toggleColumn('customerRef', document.getElementById('checkboxCustomerRef').checked);
                        toggleColumn('transhipmentPort', document.getElementById('checkboxTranshipmentPort')
                            .checked);
                        toggleColumn('containerType', document.getElementById('checkboxContainerType').checked);
                        toggleColumn('loadingDate', document.getElementById('checkboxLoadingDate').checked);
                        toggleColumn('loadingTime', document.getElementById('checkboxLoadingTime').checked);
                        toggleColumn('feeder', document.getElementById('checkboxFeeder').checked);
                        toggleColumn('vessel', document.getElementById('checkboxVessel').checked);

                        toggleColumn('voyageFeeder', document.getElementById('checkboxVoyageFeeder').checked);
                        toggleColumn('voyageVessel', document.getElementById('checkboxVoyageVessel').checked);
                        toggleColumn('etdDate', document.getElementById('checkboxEtdDate').checked);
                        toggleColumn('etaDate', document.getElementById('checkboxEtaDate').checked);
                        toggleColumn('closingDate', document.getElementById('checkboxClosingDate').checked);
                        toggleColumn('closingTime', document.getElementById('checkboxClosingTime').checked);
                        toggleColumn('depotName', document.getElementById('checkboxDepotName').checked);
                        toggleColumn('gateInDepotName', document.getElementById('checkboxGateInDepotName').checked);
                        toggleColumn('destinationPort', document.getElementById('checkboxDestinationPort').checked);
                        toggleColumn('firstContainerReturnDate', document.getElementById(
                            'checkboxFirstContainerReturnDate').checked);
                        toggleColumn('loadingPort', document.getElementById('checkboxLoadingPort').checked);
                        toggleColumn('pickupDate', document.getElementById('checkboxPickupDate').checked);
                        toggleColumn('siCutOff', document.getElementById('checkboxSiCutOff').checked);
                        toggleColumn('vgmCutOff', document.getElementById('checkboxVgmCutOff').checked);
                        toggleColumn('remark', document.getElementById('checkboxRemark').checked);
                        toggleColumn('salseName', document.getElementById('checkboxSalseName').checked);
                        toggleColumn('preparedBy', document.getElementById('checkboxPreparedBy').checked);
                        toggleColumn('editBy', document.getElementById('checkboxEditBy').checked);
                        toggleColumn('editDate', document.getElementById('checkboxEditDate').checked);
                        toggleColumn('loadingLocation', document.getElementById('checkboxLoadingLocation').checked);
                        toggleColumn('deliveryLocation', document.getElementById('checkboxDeliveryLocation')
                            .checked);
                        toggleColumn('crossBorderDate', document.getElementById('checkboxCrossBorderDate').checked);

                        toggleColumn('type', document.getElementById('checkboxType').checked);
                        toggleColumn('actions', document.getElementById('checkboxActions').checked);


                    });
                });
            </script>

            {{-- Local storage save --}}
            <script>
                // Function to save customization data to localStorage
                function saveCustomizationToLocalStorage() {
                    // Create an object to store the state of each checkbox
                    const customizationData = {};

                    // Loop through each checkbox
                    document.querySelectorAll('.modal-body-custom-fields input[type="checkbox"]').forEach(checkbox => {
                        // Store the checkbox ID and its checked state
                        customizationData[checkbox.id] = checkbox.checked;
                    });

                    // Convert the object to JSON and save it in localStorage
                    localStorage.setItem('tableCustomization', JSON.stringify(customizationData));
                }

                // Function to apply customization based on localStorage data
                function applyCustomizationFromLocalStorage() {
                    const customizationData = localStorage.getItem('tableCustomization');
                    if (customizationData) {
                        const data = JSON.parse(customizationData);
                        // Loop through the stored data and update the checkboxes accordingly
                        Object.entries(data).forEach(([id, checked]) => {
                            const checkbox = document.getElementById(id);
                            if (checkbox) {
                                checkbox.checked = checked;
                                // Trigger change event to apply any necessary changes
                                checkbox.dispatchEvent(new Event('change'));
                            }
                        });

                        // Simulate a click on the "Apply" button after applying customization
                        const applyButton = document.getElementById('apply-customization');
                        applyButton.click();
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                    // Apply customization on page load
                    applyCustomizationFromLocalStorage();

                    // Add event listener to the Apply button in the modal
                    document.getElementById('apply-customization').addEventListener('click', function() {
                        // Save customization data to localStorage when Apply button is clicked
                        saveCustomizationToLocalStorage();

                        // Close the modal after applying customization
                        const modal = document.getElementById('customize-table-modal');
                        const modalComponent = modal._x_comp || modal.__x.$data;
                        modalComponent.show = false;
                    });
                });
            </script>

            {{-- Search box Add options --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Add options for checked checkboxes when the page loads
                    addOptionIfChecked('checkboxDraftNo', 'draft_no', 'Draft No.');
                    addOptionIfChecked('checkboxStatus', 'status', 'Status');
                    addOptionIfChecked('checkboxDraftDate', 'draft_date', 'Draft Date');
                    addOptionIfChecked('checkboxShipperName', 'shipper_name', 'Shipper Name');
                    addOptionIfChecked('checkboxAgentName', 'agent_name', 'Agent Name');
                    addOptionIfChecked('checkboxBookingNo', 'booking_no', 'Booking No.');
                    addOptionIfChecked('checkboxCustomerRef', 'customer_ref', 'Customer Reference');
                    addOptionIfChecked('checkboxTranshipmentPort', 'transhipment_port', 'Transhipment Port');
                    addOptionIfChecked('checkboxContainerType', 'container_type_id', 'Container Type');
                    addOptionIfChecked('checkboxLoadingDate', 'loading_date', 'Loading Date');
                    addOptionIfChecked('checkboxLoadingTime', 'loading_time', 'Loading Time');
                    addOptionIfChecked('checkboxFeeder', 'feeder', 'Feeder');
                    addOptionIfChecked('checkboxVessel', 'vessel', 'Vessel');
                    addOptionIfChecked('checkboxVoyageFeeder', 'voy_feeder', 'Voyage Feeder');
                    addOptionIfChecked('checkboxVoyageVessel', 'voy_vessel', 'Voyage Vessel');
                    addOptionIfChecked('checkboxEtdDate', 'ETD_date', 'ETD Date');
                    addOptionIfChecked('checkboxEtaDate', 'ETA_date', 'ETA Date');
                    addOptionIfChecked('checkboxClosingDate', 'closing_date', 'Closing Date');
                    addOptionIfChecked('checkboxClosingTime', 'closing_time', 'Closing Time');
                    addOptionIfChecked('checkboxDepotName', 'depot_name', 'Depot Name');
                    addOptionIfChecked('checkboxGateInDepotName', 'gate_in_depot_name', 'Gate-In Depot Name');
                    addOptionIfChecked('checkboxDestinationPort', 'destination_port', 'Destination Port');
                    addOptionIfChecked('checkboxFirstContainerReturnDate', 'first_container_return_date',
                        'First Container Return Date');
                    addOptionIfChecked('checkboxLoadingPort', 'loading_port', 'Loading Port');
                    addOptionIfChecked('checkboxPickupDate', 'pickup_date', 'Pickup Date');
                    addOptionIfChecked('checkboxSiCutOff', 'si_cut_off', 'SI Cut Off');
                    addOptionIfChecked('checkboxVgmCutOff', 'vgm_cut_off', 'VGM Cut Off');
                    addOptionIfChecked('checkboxRemark', 'remark', 'Remark');
                    addOptionIfChecked('checkboxSalseName', 'sale_name', 'Sale Name');
                    addOptionIfChecked('checkboxPreparedBy', 'prepared_by', 'Prepared by');
                    addOptionIfChecked('checkboxEditBy', 'edit_by', 'Edit By');
                    addOptionIfChecked('checkboxEditDate', 'edit_date', 'Edit Date');

                    addOptionIfChecked('checkboxLoadingLocation', 'loading_location', 'Loading Location');
                    addOptionIfChecked('checkboxDeliveryLocation', 'delivery_location', 'Delivery Location');

                    addOptionIfChecked('checkboxCrossBorderDate', 'cross_border_date', 'Cross Border Date');

                    addOptionIfChecked('checkboxType', 'type', 'Type');

                    // Set selected option based on query parameter for the original field
                    const searchField = '{{ $searchField }}'; // Assuming $searchField contains the query parameter value
                    const selectElement = document.getElementById('search-field-select');
                    const optionToSelect = selectElement.querySelector(`option[value='${searchField}']`);

                    if (optionToSelect) {
                        optionToSelect.selected = true;
                    }
                    // Add event listener to Apply button in Customize Table modal
                    document.getElementById('apply-customization').addEventListener('click', function() {
                        // Clear existing options
                        document.getElementById('search-field-select').innerHTML = '';

                        // Get the state of each checkbox and add the corresponding option
                        addOptionIfChecked('checkboxDraftNo', 'draft_no', 'Draft No.');
                        addOptionIfChecked('checkboxStatus', 'status', 'Status');
                        addOptionIfChecked('checkboxDraftDate', 'draft_date', 'Draft Date');
                        addOptionIfChecked('checkboxShipperName', 'shipper_name', 'Shipper Name');
                        addOptionIfChecked('checkboxAgentName', 'agent_name', 'Agent Name');
                        addOptionIfChecked('checkboxBookingNo', 'booking_no', 'Booking No.');
                        addOptionIfChecked('checkboxCustomerRef', 'customer_ref', 'Customer Reference');
                        addOptionIfChecked('checkboxTranshipmentPort', 'transhipment_port', 'Transhipment Port');
                        addOptionIfChecked('checkboxContainerType', 'container_type_id', 'Container Type');
                        addOptionIfChecked('checkboxLoadingDate', 'loading_date', 'Loading Date');
                        addOptionIfChecked('checkboxLoadingTime', 'loading_time', 'Loading Time');
                        addOptionIfChecked('checkboxFeeder', 'feeder', 'Feeder');
                        addOptionIfChecked('checkboxVessel', 'vessel', 'Vessel');
                        addOptionIfChecked('checkboxVoyageFeeder', 'voy_feeder', 'Voyage Feeder');
                        addOptionIfChecked('checkboxVoyageVessel', 'voy_vessel', 'Voyage Vessel');
                        addOptionIfChecked('checkboxEtdDate', 'ETD_date', 'ETD Date');
                        addOptionIfChecked('checkboxEtaDate', 'ETA_date', 'ETA Date');
                        addOptionIfChecked('checkboxClosingDate', 'closing_date', 'Closing Date');
                        addOptionIfChecked('checkboxClosingTime', 'closing_time', 'Closing Time');
                        addOptionIfChecked('checkboxDepotName', 'depot_name', 'Depot Name');
                        addOptionIfChecked('checkboxGateInDepotName', 'gate_in_depot_name', 'Gate-In Depot Name');
                        addOptionIfChecked('checkboxDestinationPort', 'destination_port', 'Destination Port');
                        addOptionIfChecked('checkboxFirstContainerReturnDate', 'first_container_return_date',
                            'First Container Return Date');
                        addOptionIfChecked('checkboxLoadingPort', 'loading_port', 'Loading Port');
                        addOptionIfChecked('checkboxPickupDate', 'pickup_date', 'Pickup Date');
                        addOptionIfChecked('checkboxSiCutOff', 'si_cut_off', 'SI Cut Off');
                        addOptionIfChecked('checkboxVgmCutOff', 'vgm_cut_off', 'VGM Cut Off');
                        addOptionIfChecked('checkboxRemark', 'remark', 'Remark');
                        addOptionIfChecked('checkboxSalseName', 'sale_name', 'Sale Name');
                        addOptionIfChecked('checkboxPreparedBy', 'prepared_by', 'Prepared by');
                        addOptionIfChecked('checkboxEditBy', 'edit_by', 'Edit By');
                        addOptionIfChecked('checkboxEditDate', 'edit_date', 'Edit Date');

                        addOptionIfChecked('checkboxLoadingLocation', 'loading_location', 'Loading Location');
                        addOptionIfChecked('checkboxDeliveryLocation', 'delivery_location', 'Delivery Location');

                        addOptionIfChecked('checkboxCrossBorderDate', 'cross_border_date', 'Cross Border Date');

                        addOptionIfChecked('checkboxType', 'type', 'Type');


                    });

                    // Set selected option based on query parameter for the new field
                    const searchFieldNew =
                        '{{ $searchFieldNew }}'; // Assuming $searchFieldNew contains the query parameter value
                    const selectElementNew = document.getElementById('search-field-new-select');
                    const optionToSelectNew = selectElementNew.querySelector(`option[value='${searchFieldNew}']`);

                    if (optionToSelectNew) {
                        optionToSelectNew.selected = true;
                    }
                    // Add event listener to Apply button in Customize Table modal
                    document.getElementById('apply-customization').addEventListener('click', function() {
                        // Clear existing options
                        document.getElementById('search-field-select').innerHTML = '';

                        // Get the state of each checkbox and add the corresponding option
                        addOptionIfChecked('checkboxDraftNo', 'draft_no', 'Draft No.');
                        addOptionIfChecked('checkboxStatus', 'status', 'Status');
                        addOptionIfChecked('checkboxDraftDate', 'draft_date', 'Draft Date');
                        addOptionIfChecked('checkboxShipperName', 'shipper_name', 'Shipper Name');
                        addOptionIfChecked('checkboxAgentName', 'agent_name', 'Agent Name');
                        addOptionIfChecked('checkboxBookingNo', 'booking_no', 'Booking No.');
                        addOptionIfChecked('checkboxCustomerRef', 'customer_ref', 'Customer Reference');
                        addOptionIfChecked('checkboxTranshipmentPort', 'transhipment_port', 'Transhipment Port');
                        addOptionIfChecked('checkboxContainerType', 'container_type_id', 'Container Type');
                        addOptionIfChecked('checkboxLoadingDate', 'loading_date', 'Loading Date');
                        addOptionIfChecked('checkboxLoadingTime', 'loading_time', 'Loading Time');
                        addOptionIfChecked('checkboxFeeder', 'feeder', 'Feeder');
                        addOptionIfChecked('checkboxVessel', 'vessel', 'Vessel');
                        addOptionIfChecked('checkboxVoyageFeeder', 'voy_feeder', 'Voyage Feeder');
                        addOptionIfChecked('checkboxVoyageVessel', 'voy_vessel', 'Voyage Vessel');
                        addOptionIfChecked('checkboxEtdDate', 'ETD_date', 'ETD Date');
                        addOptionIfChecked('checkboxEtaDate', 'ETA_date', 'ETA Date');
                        addOptionIfChecked('checkboxClosingDate', 'closing_date', 'Closing Date');
                        addOptionIfChecked('checkboxClosingTime', 'closing_time', 'Closing Time');
                        addOptionIfChecked('checkboxDepotName', 'depot_name', 'Depot Name');
                        addOptionIfChecked('checkboxGateInDepotName', 'gate_in_depot_name', 'Gate-In Depot Name');
                        addOptionIfChecked('checkboxDestinationPort', 'destination_port', 'Destination Port');
                        addOptionIfChecked('checkboxFirstContainerReturnDate', 'first_container_return_date',
                            'First Container Return Date');
                        addOptionIfChecked('checkboxLoadingPort', 'loading_port', 'Loading Port');
                        addOptionIfChecked('checkboxPickupDate', 'pickup_date', 'Pickup Date');
                        addOptionIfChecked('checkboxSiCutOff', 'si_cut_off', 'SI Cut Off');
                        addOptionIfChecked('checkboxVgmCutOff', 'vgm_cut_off', 'VGM Cut Off');
                        addOptionIfChecked('checkboxRemark', 'remark', 'Remark');
                        addOptionIfChecked('checkboxSalseName', 'sale_name', 'Sale Name');
                        addOptionIfChecked('checkboxPreparedBy', 'prepared_by', 'Prepared by');
                        addOptionIfChecked('checkboxEditBy', 'edit_by', 'Edit By');
                        addOptionIfChecked('checkboxEditDate', 'edit_date', 'Edit Date');

                        addOptionIfChecked('checkboxLoadingLocation', 'loading_location', 'Loading Location');
                        addOptionIfChecked('checkboxDeliveryLocation', 'delivery_location', 'Delivery Location');

                        addOptionIfChecked('checkboxCrossBorderDate', 'cross_border_date', 'Cross Border Date');

                        addOptionIfChecked('checkboxType', 'type', 'Type');


                    });


                    // Function to add option if the corresponding checkbox is checked
                    function addOptionIfChecked(checkboxId, optionValue, optionText) {
                        const checkbox = document.getElementById(checkboxId);
                        if (checkbox.checked) {
                            const option = document.createElement('option');
                            option.value = optionValue;
                            option.text = optionText;
                            document.getElementById('search-field-select').add(option);
                            document.getElementById('search-field-new-select').add(option.cloneNode(
                                true)); // Add to new select
                        }
                    }
                });
            </script>

            {{-- for search in selected fields --}}
            <script>
                jQuery(document).ready(function() {
                    jQuery('#search-button').on('click', function() {
                        const selectedField = jQuery('#search-field-select').val();
                        const searchText = jQuery('#search-field-input').val();
                        const selectedFieldNew = jQuery('#search-field-new-select').val(); // New selected field
                        const searchTextNew = jQuery('#search-field-new-input').val(); // New search text

                        // Get the current URL
                        let currentUrl = window.location.href;

                        // Parse the URL to extract query parameters
                        const urlParams = new URLSearchParams(window.location.search);

                        // Update or add the search parameters for the original fields
                        urlParams.set('search_field', selectedField);
                        urlParams.set('search_value', searchText);

                        // Update or add the search parameters for the new fields
                        urlParams.set('search_field_new', selectedFieldNew); // Add new search field parameter
                        urlParams.set('search_value_new', searchTextNew); // Add new search value parameter

                        // Generate the updated URL with the modified query parameters
                        const updatedUrl = `${window.location.pathname}?${urlParams.toString()}`;

                        // Redirect to the updated URL
                        window.location.href = updatedUrl;
                    });
                });
            </script>








            <!-- BEGIN: Print selected Confirmation Modal -->
            <div id="print-selected-confirmation-modal" class="modal" tabindex="-1"
                aria-labelledby="modal-title-print-selected" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title-print-selected">Print Selected Drafts</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-5 text-center">
                                <i data-lucide="printer" class="w-16 h-16 text-primary mx-auto mt-3"></i>
                                <div class="text-3xl mt-5" id="print-selected-topic">Action required</div>
                                <div class="text-slate-500 mt-2" id="draft-print-selected-placeholder">
                                    Please select drafts to print.
                                </div>
                            </div>

                            <div class="px-5 pb-8 text-center">
                                <form id="" action="{{ route('pdf.selected.draft') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="draft-id-to-print-selected" name="ids">
                                    <button type="button" data-tw-dismiss="modal"
                                        class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <button type="submit" class="btn btn-danger w-24" style="display: none;"
                                        id="btn-print-selected">Print</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <!-- jQuery handling -->


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        {{-- delete single and generate single pdf --}}
        <script>
            jQuery(document).ready(function() {
                jQuery('.delete-draft-btn').on('click', function() {
                    // Get the draft ID from the clicked button's data attribute
                    var draftIdToDelete = $(this).data('draft-id');

                    // Set the value of the hidden input field in the form
                    jQuery('#draft-id-to-delete').val(draftIdToDelete);

                    // Replace the placeholder in the form action with the actual draft ID
                    var formAction = "{{ route('drafts.deletePost', ['draftId' => '__DRAFT_ID__']) }}";
                    formAction = formAction.replace('__DRAFT_ID__', draftIdToDelete);
                    $('#delete-draft-form').attr('action', formAction); // Update the form ID

                    // Optionally, update the draft name placeholder in the modal
                    var draftNo = $(this).data('draft-no');
                    $('#draft-name-placeholder').text('Do you want to delete draft ' + draftNo + '?');

                    // Show the delete confirmation modal
                    $('#delete-confirmation-modal').modal('show');
                });
            });

            document.getElementById('generate-pdf-btn').addEventListener('click', function() {
                // Get the HTML content of the element with ID 'content-to-be-converted'
                var htmlContent = document.getElementById('content-to-be-converted').innerHTML;

                // Create a new form element to submit HTML content to the server
                var form = document.createElement('form');
                form.action = '/express/generate-pdf'; // Route for PDF generation
                form.method = 'POST'; // Use POST method
                form.style.display = 'none'; // Hide the form
                form.target = '_blank';

                // Create a hidden input field for CSRF token
                var csrfTokenInput = document.createElement('input');
                csrfTokenInput.type = 'hidden';
                csrfTokenInput.name = '_token'; // Laravel expects the CSRF token field to be named '_token'
                csrfTokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Append the CSRF token input field to the form
                form.appendChild(csrfTokenInput);

                // Create a textarea field to hold the HTML content
                var htmlInput = document.createElement('textarea');
                htmlInput.name = 'html_content'; // Name of the field
                htmlInput.value = htmlContent; // Set the value to the HTML content

                // Append the textarea field to the form
                form.appendChild(htmlInput);

                // Append the form to the document body
                document.body.appendChild(form);

                // Submit the form
                form.submit();
            });
        </script>



        {{-- print selected --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var selectedDraftIds = [];

                // Listen for checkbox changes
                var checkboxes = document.querySelectorAll('.draft-checkbox');
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        var draftId = this.value;
                        if (this.checked) {
                            // Add the draft ID to the array if checkbox is checked
                            selectedDraftIds.push(draftId);
                        } else {
                            // Remove the draft ID from the array if checkbox is unchecked
                            var index = selectedDraftIds.indexOf(draftId);
                            if (index !== -1) {
                                selectedDraftIds.splice(index, 1);
                            }
                        }
                    });
                });

                // Add click event listener to the print selected button
                jQuery(document).ready(function() {
                    jQuery('.print-selected-draft-btn').on('click', function() {

                        // Show the print confirmation modal
                        if (selectedDraftIds.length === 0) {
                            // If no drafts are selected, display a message
                            jQuery('#print-selected-confirmation-modal').modal('show');
                            $('#print-selected-topic').text('Action required');
                            $('#draft-print-selected-placeholder').text(
                                'Please select drafts to print.');
                            $('#btn-print-selected').css('display', 'none');
                        } else if (selectedDraftIds.length > 0) {
                            // If drafts are selected, populate the modal and display it
                            $('#print-selected-topic').text('Do you want to print?');
                            jQuery('#print-selected-confirmation-modal').modal('show');
                            var draftNo = selectedDraftIds.join(', ');
                            $('#draft-print-selected-placeholder').text('Print drafts No. ' + draftNo +
                                '?');
                            $('#btn-print-selected').css('display', 'inline-flex');
                            $('#draft-id-to-print-selected').val(JSON.stringify(selectedDraftIds));

                        }
                    });
                });
            });
        </script>

    </body>

    </html>



@endsection
