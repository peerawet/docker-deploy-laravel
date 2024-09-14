@extends('front-end.layouts.main')
@section('title', 'KBC Report')
@section('content')

    <head>
        <!-- Other meta tags and stylesheets -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <div style="display: flex; flex-wrap: wrap; margin-bottom: 30px; width: 50%; align-items: flex-end;">
        <div style="flex: 1; margin-right: 10px;">
            <label for="start-date-picker" style="margin-bottom: 5px; display: block;">เริ่มต้น</label>
            <input id="start-date-picker" type="date" class="form-control" value="{{ $start ? $start : '' }}">
        </div>
        <div style="flex: 1; margin-left: 10px;">
            <label for="end-date-picker" style="margin-bottom: 5px; display: block;">สิ้นสุด</label>
            <input id="end-date-picker" type="date" class="form-control" value="{{ $end ? $end : '' }}">
        </div>
        <button type="button" id="customTable" class="btn btn-primary btn-rounded" style="margin-left: 10px;">
            เรียกดูข้อมูล
        </button>
    </div>

    <script>
        // JavaScript to handle button click event
        document.getElementById('customTable').addEventListener('click', function() {
            var startDate = document.getElementById('start-date-picker').value;
            var endDate = document.getElementById('end-date-picker').value;

            // Construct the URL with selected dates
            var url = "{{ route('manager.kbc', ['start' => ':start', 'end' => ':end']) }}";
            url = url.replace(':start', startDate);
            url = url.replace(':end', endDate);

            // Navigate to the constructed URL
            window.location.href = url;
        });
    </script>



    <div style="max-height: 800px; overflow-y: auto;">
        <div id="content-to-be-converted">

            <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">

            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                    font-size: 9px;
                }

                th,
                td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: center;
                    vertical-align: middle;
                    font-family: 'Noto Sans Thai', sans-serif;
                }

                .header,
                .section-header {
                    font-weight: bold;
                }

                .no-border {
                    border-left: none;
                    border-right: none;
                    border-bottom: none;
                    text-align: right;
                }

                .font {
                    font-family: 'Noto Sans Thai', sans-serif;
                }

                .page-break {
                    page-break-before: always;
                }
            </style>



            <div style="width: 100%; margin-bottom: 20px;" class="font">
                <div style="width: 100%; text-align: center;">
                    <strong class="font" style="font-size: 20px;">KBC Report</strong>
                </div>
                <div style="width: 100%; text-align: right;">
                    <strong class="font">ETD Date: {{ $start }} - {{ $end }}</strong>
                </div>
            </div>

            @php
                $isFirstShipper = true;
            @endphp


            @foreach ($shippers as $shipper)
                @if (!$isFirstShipper)
                    <div class="page-break"></div>
                @endif
                <div style="width: 100%; margin-bottom: 5px;" class="font">
                    <table style="width: 100%; border-collapse: collapse; border: none;">
                        <tr>
                            <td style="text-align: left; border: none;">
                                <strong class="font">SHIPPER : {{ $shipper->name }}</strong>
                            </td>
                            <td style="text-align: right; border: none;">
                                <strong class="font">Contact : {{ $shipper->contact }}</strong>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="overflow-x-auto">
                    <table class="table table-bordered table-striped table-hover" style="text-align: center;"
                        class="font">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap">Job No</th>
                                <th class="whitespace-nowrap">Booking No.</th>
                                <th class="whitespace-nowrap">ETD Date</th>
                                <th class="whitespace-nowrap">Destination Port</th>
                                <th class="whitespace-nowrap">Vol.</th>
                                <th class="whitespace-nowrap">Ex-Rate</th>
                                <th class="whitespace-nowrap">USD</th>
                                <th class="whitespace-nowrap">THB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_usd = 0;
                                $total_thb = 0;
                                $item_count = 0;
                            @endphp
                            @foreach ($jobs as $job)
                                @if ($job->draft && $job->draft->shipper_id == $shipper->id)
                                    <tr class="main-row" data-job-no="{{ $job->job_no }}">
                                        <td>{{ $job->job_no }}</td>
                                        <td>{{ optional($job->draft)->booking_no }}</td>
                                        <td>{{ optional($job->draft)->ETD_date ? date('d/m/Y', strtotime(optional($job->draft)->ETD_date)) : '' }}
                                        </td>
                                        <td>{{ optional(optional($job->draft)->destinationPort)->name }}</td>
                                        <td>
                                            @if (optional($job->draft)->qty && optional(optional($job->draft)->containerType)->size)
                                                {{ optional($job->draft)->qty }} X
                                                {{ optional(optional($job->draft)->containerType)->size }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($job->cost_rate_value, 2) }}</td>
                                        <td>
                                            @if ($job->cost_rate_value != 0)
                                                {{ number_format($job->cost_kbc_thb / $job->cost_rate_value, 2) }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($job->cost_kbc_thb, 2) }}</td>
                                    </tr>
                                    @php
                                        // Accumulate totals only if cost_rate_value is not zero
                                        if ($job->cost_rate_value != 0) {
                                            $total_usd += $job->cost_kbc_thb / $job->cost_rate_value;
                                        }
                                        $total_thb += $job->cost_kbc_thb;
                                        $item_count++;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="no-border"><strong>{{ $item_count }} รายการ ยอดรวม</strong>
                                </td>
                                <td>{{ number_format($total_usd, 2) }}</td>
                                <td>{{ number_format($total_thb, 2) }}</td>
                            </tr>
                        </tfoot>

                    </table>
                </div>


                @php
                    $isFirstShipper = false;
                @endphp
            @endforeach


        </div>
    </div>





    <div class="modal-footer">
        <button type="button" id="generate-pdf-btn" class="btn btn-primary">Generate PDF</button>
    </div>

    {{-- pdf generate --}}
    <script>
        document.getElementById('generate-pdf-btn').addEventListener('click', function() {
            // Get the HTML content of the element with ID 'content-to-be-converted'
            var htmlContent = document.getElementById('content-to-be-converted').innerHTML;

            // Create a new form element to submit HTML content to the server
            var form = document.createElement('form');
            form.action = '{{ route('pdf.single.legal') }}'; // Route for PDF generation
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
@endsection
