@extends('front-end.layouts.main')
@section('title', 'Expense Report')
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
            var url = "{{ route('manager.expense-report', ['start' => ':start', 'end' => ':end']) }}";
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
            </style>



            <div style="width: 100%; margin-bottom: 20px;" class="font">
                <div style="width: 100%; text-align: center;">
                    <strong class="font" style="font-size: 20px;">Expense Report</strong>
                </div>
                <div style="width: 100%; text-align: right;">
                    <strong class="font">PV Issue Date: {{ $start }} - {{ $end }}</strong>
                </div>
            </div>



            <div class="overflow-x-auto">
                <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap" rowspan="2">
                                <a
                                    href="{{ route('manager.expense-report', [
                                        'sort_field' => 'pv_no',
                                        'sort_order' => $sortField == 'pv_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                    
                                        'start' => $start,
                                        'end' => $end,
                                    ]) }}">
                                    PV No {!! $sortField == 'pv_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap" rowspan="2">
                                <a
                                    href="{{ route('manager.expense-report', [
                                        'sort_field' => 'category',
                                        'sort_order' => $sortField == 'category' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                    
                                        'start' => $start,
                                        'end' => $end,
                                    ]) }}">
                                    Category {!! $sortField == 'category' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>


                            <th class="whitespace-nowrap">Payment Date</th>
                            <th class="whitespace-nowrap">Payee</th>
                            <th class="whitespace-nowrap">Description</th>
                            <th class="whitespace-nowrap">Remark</th>
                            <th class="whitespace-nowrap">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_thb = 0;
                            $item_count = 0;
                        @endphp

                        @foreach ($expenses as $expense)
                            <tr class="main-row">
                                <td>{{ $expense->pv_no }}</td>
                                <td>{{ optional($expense->category)->category }}</td>
                                <td>{{ $expense->payment_date ? date('d/m/Y', strtotime($expense->payment_date)) : '' }}
                                </td>
                                <td>{{ optional($expense->payee)->payee }}</td>
                                <td>
                                    @if ($expense->description_1)
                                        {{ $expense->description_1 }} <br>
                                    @endif
                                    @if ($expense->description_2)
                                        {{ $expense->description_2 }}<br>
                                    @endif
                                    @if ($expense->description_3)
                                        {{ $expense->description_3 }}<br>
                                    @endif
                                    @if ($expense->description_4)
                                        {{ $expense->description_4 }}<br>
                                    @endif
                                    @if ($expense->description_5)
                                        {{ $expense->description_5 }}
                                    @endif
                                </td>
                                <td>{{ $expense->remark }}</td>
                                <td>{{ number_format($expense->amount_1 + $expense->amount_2 + $expense->amount_3 + $expense->amount_4 + $expense->amount_5, 2) }}
                                </td>
                            </tr>
                            @php
                                // Accumulate totals
                                $total_thb +=
                                    $expense->amount_1 +
                                    $expense->amount_2 +
                                    $expense->amount_3 +
                                    $expense->amount_4 +
                                    $expense->amount_5;
                                $item_count++;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="no-border"><strong>{{ $item_count }} รายการ ยอดรวม</strong></td>
                            <td>{{ number_format($total_thb, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>








        </div>
    </div>





    <div class="modal-footer">
        <button type="button" id="generate-pdf-btn" class="btn btn-primary">Generate PDF</button>
    </div>

    <script>
        // Log all expenses to the console
        console.log(@json($expenses));
    </script>


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
