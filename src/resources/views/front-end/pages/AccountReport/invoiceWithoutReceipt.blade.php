@extends('front-end.layouts.main')
@section('title', 'Invoice ที่ยังไม่ออก Receipt')
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
            var url = "{{ route('account.invoices-without-receipt', ['start' => ':start', 'end' => ':end']) }}";
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
                    border: none;
                    text-align: right;
                }

                .font {
                    font-family: 'Noto Sans Thai', sans-serif;
                }
            </style>

            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;" class="font">
                <div style="flex: 1; text-align: center;">
                    <strong class="font" style="font-size: 20px;">Invoice ที่ไม่ออก Receipt (ลูกหนี้ทั้งหมด)</strong>
                </div>
                <div>
                    <strong class="font">Invoice Date: {{ $start }} - {{ $end }}</strong>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-bordered table-striped table-hover" style="text-align: center;" class="font">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">Job No.</th>
                            <th class="whitespace-nowrap">Invoice Date</th>
                            <th class="whitespace-nowrap">Shipper Name</th>
                            <th class="whitespace-nowrap">Feeder</th>
                            <th class="whitespace-nowrap">BL</th>





                            <th class="whitespace-nowrap">Booking No.</th>
                            <th class="whitespace-nowrap">Vat</th>
                            <th class="whitespace-nowrap">Grand Total</th>
                            <th class="whitespace-nowrap">ยอดเก็บจริง</th>
                            <th class="whitespace-nowrap">DUE</th>
                            <th class="whitespace-nowrap">ETD Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_vat = 0;
                            $total_grand_total = 0;
                            $real_sell = 0;
                            $item_count = 0;
                        @endphp
                        @foreach ($invoices as $invoice)
                            <tr class="main-row" data-invoice-no="{{ $invoice->invoice_no }}">
                                <td>{{ optional($invoice->job)->job_no }}</td>
                                <td>{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</td>
                                <td>{{ optional(optional(optional($invoice->job)->draft)->shipper)->name }}</td>
                                <td>{{ optional(optional(optional($invoice->job)->draft)->feeder)->name }}</td>
                                <td>{{ $invoice->bl_no }}</td>
                                <td>{{ optional(optional($invoice->job)->draft)->booking_no }}</td>
                                <td>{{ number_format(optional($invoice->job)->sell_total_vat, 2) }}</td>
                                <td>{{ number_format(optional($invoice->job)->sell_grand_total, 2) }}</td>
                                <td>{{ number_format(optional($invoice->job)->sell_grand_total - optional($invoice->job)->sell_tax_amt, 2) }}
                                </td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ optional(optional($invoice->job)->draft)->ETD_date ? date('d/m/Y', strtotime(optional(optional($invoice->job)->draft)->ETD_date)) : '' }}
                                </td>
                            </tr>
                            @php
                                $total_vat += optional($invoice->job)->sell_total_vat;
                                $total_grand_total += optional($invoice->job)->sell_grand_total;
                                $real_sell +=
                                    optional($invoice->job)->sell_grand_total - optional($invoice->job)->sell_tax_amt;
                                $item_count++;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="no-border"><strong>{{ $item_count }} รายการ</strong></td>
                            <td>{{ number_format($total_vat, 2) }}</td>
                            <td>{{ number_format($total_grand_total, 2) }}</td>
                            <td>{{ number_format($real_sell, 2) }}</td>
                        </tr>
                    </tfoot>

                </table>
            </div>
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
