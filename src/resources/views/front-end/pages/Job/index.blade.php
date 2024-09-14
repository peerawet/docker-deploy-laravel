@extends('front-end.layouts.main')
@section('title', 'รายการ Jobs ทั้งหมด')
@section('content')
    <div class="intro-y box p-5">
        <div class="mb-5 text-right">
            <livewire:components.assets.button color="primary" title="New Job" icon="file-text" route="job.create"
                action="" />

            {{-- <button type="button" id="deleteSelectedButton"
                class="btn btn-outline-danger btn-rounded w-36 mr-2 mb-2 delete-selected-jobs-btn"
                data-tw-target="#delete-selected-confirmation-modal" data-tw-toggle="modal">
                <i data-lucide="minus" class="w-4 h-4 mr-2"></i>
                Delete Selected
            </button> --}}
            <button type="button" id="printSelectedButton"
                class="btn btn-outline-success btn-rounded w-36 mr-2 mb-2 print-selected-job-btn"
                data-tw-target="#print-selected-confirmation-modal" data-tw-toggle="modal">
                <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                Print Selected
            </button>

            <!-- BEGIN: Print selected Confirmation Modal -->
            <div id="print-selected-confirmation-modal" class="modal" tabindex="-1"
                aria-labelledby="modal-title-print-selected" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title-print-selected">Print Selected Jobs</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-5 text-center">
                                <i data-lucide="printer" class="w-16 h-16 text-primary mx-auto mt-3"></i>
                                <div class="text-3xl mt-5" id="print-selected-topic">Action required</div>
                                <div class="text-slate-500 mt-2" id="job-print-selected-placeholder">
                                    Please select jobs to print.
                                </div>
                            </div>

                            <div class="px-5 pb-8 text-center">
                                <form id="" method="POST" name="ids" method="POST"
                                    action="{{ route('pdf.selected.job') }}">
                                    @csrf
                                    <input type="hidden" id="job-id-to-print-selected" name="ids">
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


            {{-- print selected --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var selectedJobIds = []; // Correct variable name

                    // Listen for checkbox changes
                    var checkboxes = document.querySelectorAll('.job-checkbox');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            var jobId = this.value;
                            if (this.checked) {
                                // Add the job ID to the array if checkbox is checked
                                selectedJobIds.push(jobId);
                            } else {
                                // Remove the job ID from the array if checkbox is unchecked
                                var index = selectedJobIds.indexOf(jobId);
                                if (index !== -1) {
                                    selectedJobIds.splice(index, 1);
                                }
                            }
                        });
                    });

                    // Add click event listener to the print selected button
                    jQuery(document).ready(function() {
                        jQuery('.print-selected-job-btn').on('click', function() {
                            // Show the print confirmation modal
                            if (selectedJobIds.length === 0) {
                                // If no jobs are selected, display a message
                                jQuery('#print-selected-confirmation-modal').modal('show');
                                jQuery('#print-selected-topic').text('Action required');
                                jQuery('#job-print-selected-placeholder').text(
                                    'Please select jobs to print.');
                                jQuery('#btn-print-selected').css('display', 'none');
                            } else {
                                // If jobs are selected, populate the modal and display it
                                jQuery('#print-selected-topic').text('Do you want to print?');
                                jQuery('#print-selected-confirmation-modal').modal('show');
                                var jobNo = selectedJobIds.join(', ');
                                jQuery('#job-print-selected-placeholder').text('Print jobs No. ' + jobNo +
                                    '?');
                                jQuery('#btn-print-selected').css('display', 'inline-flex');
                                jQuery('#job-id-to-print-selected').val(JSON.stringify(selectedJobIds));
                            }
                        });
                    });
                });
            </script>





        </div>

        <div class="mb-5">
            <div class="grid grid-cols-12 gap-2">
                <form id="search-form" class="form-inline col-span-4" action="{{ route('job.index') }}" method="GET">
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
                        <tr class="text-center">
                            <th class="whitespace-nowrap">เลือก</th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('job.index', [
                                        'sort_field' => 'job_no',
                                        'sort_order' => $sortField == 'job_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Job No. {!! $sortField == 'job_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('job.index', [
                                        'sort_field' => 'job_date',
                                        'sort_order' => $sortField == 'job_date' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Job Date {!! $sortField == 'job_date' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('job.index', [
                                        'sort_field' => 'draft_no',
                                        'sort_order' => $sortField == 'draft_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Draft No. {!! $sortField == 'draft_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('job.index', [
                                        'sort_field' => 'booking_no',
                                        'sort_order' => $sortField == 'booking_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Booking No. {!! $sortField == 'booking_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('job.index', [
                                        'sort_field' => 'shipper_name',
                                        'sort_order' => $sortField == 'shipper_name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Shipper Name {!! $sortField == 'shipper_name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">
                                <a
                                    href="{{ route('job.index', [
                                        'sort_field' => 'agent_name',
                                        'sort_order' => $sortField == 'agent_name' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search_value' => $searchValue,
                                    ]) }}">
                                    Agent Name {!! $sortField == 'agent_name' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <style>
                        .no-invoice {
                            color: blue;
                        }
                    </style>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td class="text-center select-data">
                                    <input type="checkbox" class="form-check-input job-checkbox"
                                        value="{{ $job->job_no }}">
                                </td>
                                <td @if (!$job->invoice) class="no-invoice" @endif>{{ $job->job_no }}</td>
                                <td @if (!$job->invoice) class="no-invoice" @endif>
                                    {{ date('d/m/Y', strtotime($job->job_date)) }}</td>
                                <td @if (!$job->invoice) class="no-invoice" @endif>{{ $job->draft_no }}</td>
                                <td @if (!$job->invoice) class="no-invoice" @endif>
                                    {{ optional($job->draft)->booking_no }}</td>
                                <td @if (!$job->invoice) class="no-invoice" @endif>
                                    {{ optional(optional($job->draft)->shipper)->name }}</td>
                                <td @if (!$job->invoice) class="no-invoice" @endif>
                                    {{ optional(optional($job->draft)->agent)->name }}</td>
                                <td>
                                    <!-- Buttons for actions -->
                                    <button type="button"
                                        onclick="window.location.href='{{ route('job.edit', ['jobId' => $job->job_no]) }}'"
                                        class="tooltip btn btn-warning" title="แก้ไขข้อมูล">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        onclick="window.location.href='{{ route('job.print', ['jobId' => $job->job_no]) }}'"
                                        type="button" id="print-btn" class="tooltip btn btn-success" title="Print">
                                        <i data-lucide="printer" class="w-4 h-4"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-dark view-details-btn" title="ดูข้อมูล">
                                    <i data-lucide="contact" class="w-4 h-4"></i>
                                </button> --}}
                                </td>
                            </tr>
                            <!-- Corresponding detail row -->
                            <tr class="detail-row hidden" data-job-no="{{ $job->job_no }}">
                                <td colspan="8">
                                    Detail Content for Job No. {{ $job->job_no }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>


                    {{-- To hidden and show fields in table --}}



                </table>
                {{-- display job detail --}}
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        document.querySelectorAll('.view-details-btn').forEach(btn => {
                            btn.addEventListener('click', () => {
                                // Find the closest main-row element
                                const row = btn.closest('.main-row');
                                if (row) {
                                    const jobNo = row.getAttribute('data-job-no');
                                    const detailRow = document.querySelector(
                                        `.detail-row[data-job-no="${jobNo}"]`);
                                    if (detailRow) {
                                        detailRow.classList.toggle('hidden');
                                    }
                                }
                            });
                        });
                    });
                </script>
                <!-- Pagination links -->

            </div>
            <div class="flex justify-center mt-4">

                {{ $jobs->links() }} <!-- Render pagination links -->
            </div>



            <!-- BEGIN: Delete Confirmation Modal -->
            {{-- <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">Are you sure?</div>
                                <div class="text-slate-500 mt-2" id="job-name-placeholder">
                                    Do you want to delete this job?
                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <!-- Replace the button with a form -->
                                <form id="delete-job-form" action="{{ route('job.destroy', ['id' => '__JOB_ID__']) }}"
                                    method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" id="job-id-to-delete" name="job_id">
                                    <button type="button" class="btn btn-outline-secondary w-24 mr-1"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger w-24">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- END: Delete Confirmation Modal -->

            <!-- BEGIN: Delete Selected Confirmation Modal -->
            {{-- <div id="delete-selected-confirmation-modal" class="modal" tabindex="-1" aria-labelledby="modal-title"
                role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title-selected-delete">Confirmation</h5>
                            <button type="button" class="btn-close" data-tw-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                <div class="text-3xl mt-5" id="delete-selected-topic">Action required</div>
                                <div class="text-slate-500 mt-2" id="job-delete-selected-placeholder">
                                    Please select jobs to delete.
                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <form id="delete-selected-jobs-form" action="{{ route('job.deleteSelected') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" id="job-id-to-delete-selected" name="ids">
                                    <button type="button" data-tw-dismiss="modal"
                                        class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <button type="submit" class="btn btn-danger w-24" style="display: none;"
                                        id="btn-delete-selected-jobs">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- END: Delete Selected Confirmation Modal -->



            {{-- delete single and generate single pdf --}}
            {{-- <script>
                jQuery(document).ready(function() {
                    jQuery('.delete-job-btn').on('click', function() {
                        // Get the job ID from the clicked button's data attribute
                        var jobIdToDelete = $(this).data('job-id');

                        // Set the value of the hidden input field in the form
                        jQuery('#job-id-to-delete').val(jobIdToDelete);

                        // Replace the placeholder in the form action with the actual job ID
                        var formAction = "{{ route('job.destroy', ['id' => '__JOB_ID__']) }}";
                        formAction = formAction.replace('__JOB_ID__', jobIdToDelete);
                        $('#delete-job-form').attr('action', formAction); // Update the form action

                        // Optionally, update the job name placeholder in the modal
                        var jobNo = $(this).data('job-no');
                        $('#job-name-placeholder').text('Do you want to delete job ' + jobNo + '?');

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
            </script> --}}

            {{-- delete selected --}}
            {{-- <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var selectedJobIds = [];

                    // Listen for checkbox changes
                    var checkboxes = document.querySelectorAll('.job-checkbox');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            var jobId = this.value;
                            if (this.checked) {
                                // Add the job ID to the array if checkbox is checked
                                selectedJobIds.push(jobId);
                            } else {
                                // Remove the job ID from the array if checkbox is unchecked
                                var index = selectedJobIds.indexOf(jobId);
                                if (index !== -1) {
                                    selectedJobIds.splice(index, 1);
                                }
                            }
                        });
                    });

                    // Add click event listener to the delete selected button
                    jQuery(document).ready(function() {
                        jQuery('.delete-selected-jobs-btn').on('click', function() {
                            // Show the delete confirmation modal
                            if (selectedJobIds.length === 0) {
                                jQuery('#delete-selected-confirmation-modal').modal('show');

                                $('#delete-selected-topic').text('Action Required');
                                $('#job-delete-selected-placeholder').text('Please select jobs to delete');
                                $('#btn-delete-selected-jobs').css('display', 'none');
                            } else if (selectedJobIds.length > 0) {
                                jQuery('#delete-selected-confirmation-modal').modal('show');

                                $('#delete-selected-topic').text('Are you sure?');
                                // Set job numbers in the modal
                                var jobNos = selectedJobIds.join(', ');
                                $('#job-delete-selected-placeholder').text(
                                    'Do you want to delete jobs No. ' + jobNos + '?');

                                $('#btn-delete-selected-jobs').css('display', 'inline-flex');
                                // Set selected job IDs in the hidden input field of the form
                                $('#job-id-to-delete-selected').val(JSON.stringify(selectedJobIds));
                            }
                        });
                    });
                });
            </script> --}}






        </div>
    </div>

    <script></script>

@endsection
