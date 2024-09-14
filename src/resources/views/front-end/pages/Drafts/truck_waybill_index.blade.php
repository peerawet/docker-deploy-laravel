@extends('front-end.layouts.main')
@section('title', 'รายการ TRUCK WAYBILL ทั้งหมด')
@section('content')
    <div class="intro-y box p-5">
        <div class="mb-5 text-right">
            <livewire:components.assets.button color="primary" title="New TRUCK WAYBILL" icon="file-text"
                route="drafts.truckWaybill" action="" />

            {{-- <button type="button" id="printSelectedButton"
                class="btn btn-outline-success btn-rounded w-36 mr-2 mb-2 print-selected-draft-btn"
                data-tw-target="#print-selected-confirmation-modal" data-tw-toggle="modal">
                <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                Print Selected
            </button> --}}

            <!-- BEGIN: Print selected Confirmation Modal -->
            {{-- <div id="print-selected-confirmation-modal" class="modal" tabindex="-1"
                aria-labelledby="modal-title-print-selected" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title-print-selected">Print Selected Drafts</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal" aria-label="Close"></button>
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
                                <form id="" action="{{ route('pdf.selected.truckWaybill') }}" method="POST">
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
            </div> --}}

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var selectedDraftIds = [];

                    // Listen for checkbox changes
                    var checkboxes = document.querySelectorAll('.waybill-checkbox');
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


        </div>
        <div class="mb-5">
            <div class="grid grid-cols-12 gap-2">
                <form id="search-form" class="form-inline col-span-4" action="{{ route('drafts.truckWaybill.index') }}"
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
            <div style="max-height: 600px; overflow-y: auto;">
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
                <table class="table table-striped table-hover text-center table-bordered" style="text-align: center; ">
                    <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="whitespace-nowrap">เลือก</th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'invoice_no',
                                        'sort_order' => $sortField == 'invoice_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Invoice No. {!! $sortField == 'invoice_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'truck_waybill_no',
                                        'sort_order' => $sortField == 'truck_waybill_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Waybill No. {!! $sortField == 'truck_waybill_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'date_of_receipt',
                                        'sort_order' => $sortField == 'date_of_receipt' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Date of Receipt {!! $sortField == 'date_of_receipt' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'consignor_shipper',
                                        'sort_order' => $sortField == 'consignor_shipper' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Consignor/Shipper {!! $sortField == 'consignor_shipper' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'place_of_loading',
                                        'sort_order' => $sortField == 'place_of_loading' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Place of Loading {!! $sortField == 'place_of_loading' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'consignee',
                                        'sort_order' => $sortField == 'consignee' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Consignee {!! $sortField == 'consignee' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('drafts.truckWaybill.index', [
                                        'sort_field' => 'final_destination',
                                        'sort_order' => $sortField == 'final_destination' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Final destination {!! $sortField == 'final_destination' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($truckWaybills as $waybill)
                            <tr class="main-row" data-waybill-no="{{ $waybill->truck_waybill_no }}">
                                <td class="text-center select-data">
                                    <input type="checkbox" class="form-check-input waybill-checkbox"
                                        value="{{ $waybill->invoice_no }}">
                                </td>
                                <td>{{ $waybill->invoice_no }}</td>
                                <td>{{ $waybill->truck_waybill_no }}</td>
                                <td>{{ date('d/m/Y', strtotime($waybill->date_of_receipt)) }}</td>
                                <td>
                                    @php
                                        $content = $waybill->consignor_shipper;
                                        $pos = strpos($content, '<br>');
                                        if ($pos !== false) {
                                            $content = substr($content, 0, $pos);
                                        }
                                        echo nl2br(e($content));
                                    @endphp
                                </td>
                                

                                <td>{{ $waybill->place_of_loading }}</td>
                                <td>
                                    @php
                                        $content = $waybill->consignee;
                                        $pos = strpos($content, '<br>');
                                        if ($pos !== false) {
                                            $content = substr($content, 0, $pos);
                                        }
                                        echo nl2br(e($content));
                                    @endphp
                                </td>
                                
                                <td>{{ $waybill->final_destination }}</td>
                                <td>
                                    <!-- Buttons for actions -->
                                    <!-- Clone Button -->
                                    <button type="button"
                                        onclick="window.location.href='{{ route('drafts.truckWaybill') }}?id={{ $waybill->invoice_no }}'"
                                        class="tooltip btn btn-primary" title="Clone">
                                        <i data-lucide="files" class="w-4 h-4"></i>
                                    </button>

                                    <!-- Edit Button -->
                                    <button type="button"
                                        onclick="window.location.href='{{ route('drafts.truckWaybill', ['id' => $waybill->invoice_no]) }}'"
                                        class="tooltip btn btn-warning" title="แก้ไขข้อมูล">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>



                                    {{-- <button type="button" class="btn btn-dark view-details-btn" title="ดูข้อมูล">
                                        <i data-lucide="contact" class="w-4 h-4"></i>
                                    </button> --}}
                                </td>
                            </tr>
                            <!-- Corresponding detail row -->
                            <tr class="detail-row hidden" data-waybill-no="{{ $waybill->truck_waybill_no }}">
                                <td colspan="8">
                                    Detail Content for Waybill No. {{ $waybill->truck_waybill_no }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>

                    <!-- Detail view script -->
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            document.querySelectorAll('.view-details-btn').forEach(btn => {
                                btn.addEventListener('click', () => {
                                    const row = btn.closest('.main-row');
                                    if (row) {
                                        const waybillNo = row.getAttribute('data-waybill-no');
                                        const detailRow = document.querySelector(
                                            `.detail-row[data-waybill-no="${waybillNo}"]`);
                                        if (detailRow) {
                                            detailRow.classList.toggle('hidden');
                                        }
                                    }
                                });
                            });
                        });
                    </script>

                    <!-- Pagination links -->
                    <div class="flex justify-center mt-4">
                        {{ $truckWaybills->links() }} <!-- Render pagination links -->
                    </div>
                </div>

            </div>

            <script></script>

        @endsection
