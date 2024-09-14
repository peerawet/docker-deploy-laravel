@extends('front-end.layouts.main')
@section('title', 'Summary Report Of Receipts With VAT')
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
            var url = "{{ route('account.summary-receipts-with-vat', ['start' => ':start', 'end' => ':end']) }}";
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
                    <strong class="font" style="font-size: 20px;">ใบเสร็จมี Vat</strong>
                </div>
                <div>
                    <strong class="font">Invoice Date: {{ $start }} - {{ $end }}</strong>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-bordered table-striped table-hover" style="text-align: center;" class="font">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">Receipt No.</th>
                            <th class="whitespace-nowrap">Receipt Date</th>
                            <th class="whitespace-nowrap">Invoice No.</th>
                            <th class="whitespace-nowrap">Invoice Date</th>
                            <th class="whitespace-nowrap">Shipper Name</th>
                            <th class="whitespace-nowrap">Feeder</th>




                            <th class="whitespace-nowrap">Booking No.</th>
                            <th class="whitespace-nowrap">จำนวนเงิน</th>
                            <th class="whitespace-nowrap">ภาษี 7 %</th>
                            <th class="whitespace-nowrap">วันที่</th>
                            <th class="whitespace-nowrap">รายละเอียดเช็ค</th>
                            <th class="whitespace-nowrap">เงินสด/โอน/เช็ค</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $amt = 0;
                            $vat = 0;
                            $item_count = 0;
                        @endphp

                        @foreach ($receipts as $receipt)
                            <tr class="text-center">
                                <td>{{ $receipt->receipt_no }}</td>
                                <td>{{ $receipt->receipt_date ? \Carbon\Carbon::parse($receipt->receipt_date)->format('d/m/Y') : '' }}
                                </td>
                                <td>{{ $receipt->invoice_no }}</td>
                                <td>{{ optional($receipt->invoice)->invoice_date ? \Carbon\Carbon::parse(optional($receipt->invoice)->invoice_date)->format('d/m/Y') : '' }}
                                </td>
                                <td>{{ optional(optional(optional(optional($receipt->invoice)->job)->draft)->shipper)->name }}
                                </td>
                                <td>{{ optional(optional(optional(optional($receipt->invoice)->job)->draft)->feeder)->name }}
                                </td>
                                <td>{{ optional(optional(optional($receipt->invoice)->job)->draft)->booking_no }}</td>
                                <td>{{ optional(optional($receipt->invoice)->job)->sell_sub_total }}</td>
                                <td>{{ optional(optional($receipt->invoice)->job)->sell_total_vat }}</td>
                                <td>{{ $receipt->transaction_date ? \Carbon\Carbon::parse($receipt->transaction_date)->format('d/m/Y') : '' }}
                                </td>

                                <td>
                                    @if ($receipt->payment_method == 'check')
                                        ธนาคาร : {{ $receipt->bank }} <br>
                                        สาขา : {{ $receipt->branch }} <br>
                                        เลขที่ {{ $receipt->bank_number }}
                                    @endif
                                </td>

                                <td>
                                    <input type="checkbox" class="form-check-input border"
                                        {{ $receipt->payment_method == 'cash' ? 'checked' : '' }} disabled>
                                    <input type="checkbox" class="form-check-input border"
                                        {{ $receipt->payment_method == 'transfer' ? 'checked' : '' }} disabled>
                                    <input type="checkbox" class="form-check-input border"
                                        {{ $receipt->payment_method == 'check' ? 'checked' : '' }} disabled>
                                </td>
                            </tr>

                            @php
                                $amt += optional(optional($receipt->invoice)->job)->sell_sub_total ?? 0;
                                $vat += optional(optional($receipt->invoice)->job)->sell_total_vat ?? 0;
                                $item_count++;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="no-border"><strong>{{ $item_count }} รายการ</strong></td>
                            <td>{{ number_format($amt, 2) }}</td>
                            <td>{{ number_format($vat, 2) }}</td>
                            <td colspan="2"><strong>ยอดรวมทั้งหมด</strong></td>
                            <td>{{ number_format($amt - $vat, 2) }}</td>
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
