@extends('front-end.layouts.main')
@section('title', 'Full Report')
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
            var url = "{{ route('manager.full-report', ['start' => ':start', 'end' => ':end']) }}";
            url = url.replace(':start', startDate);
            url = url.replace(':end', endDate);

            // Navigate to the constructed URL
            window.location.href = url;
        });
    </script>


    <div class="overflow-x-auto">
        <div style="max-height: 800px; overflow-y: auto;">
            <div id="content-to-be-converted">

                <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap"
                    rel="stylesheet">

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

                    .main-row {
                        page-break-after: avoid;
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

                <div style="margin-bottom: 5px; width: 100%;" class="font">
                    <div style="display: table; width: 100%;">
                        <div style="display: table-row;">
                            <div style="display: table-cell; width: 50%; text-align: center;">
                                <strong class="font" style="font-size: 20px;">Full Report</strong>
                            </div>
                            <div style="display: table-cell; width: 50%; text-align: right;">
                                <strong class="font">ETD Date: {{ $start }} - {{ $end }}</strong>
                            </div>
                        </div>
                    </div>
                </div>






                <table class="table table-striped font" style="text-align: center;">
                    <thead class="table-dark">
                        <tr>

                        <tr>
                            <th class="whitespace-nowrap" rowspan="2">
                                <a
                                    href="{{ route('manager.full-report', [
                                        'sort_field' => 'job_no',
                                        'sort_order' => $sortField == 'job_no' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                    
                                        'start' => $start,
                                        'end' => $end,
                                    ]) }}">
                                    Job No {!! $sortField == 'job_no' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>
                            <th class="whitespace-nowrap" rowspan="2">
                                <a
                                    href="{{ route('manager.full-report', [
                                        'sort_field' => 'sale',
                                        'sort_order' => $sortField == 'sale' && $sortOrder == 'asc' ? 'desc' : 'asc',
                                    
                                        'start' => $start,
                                        'end' => $end,
                                    ]) }}">
                                    Sale {!! $sortField == 'sale' ? ($sortOrder == 'asc' ? '▲' : '▼') : '' !!}
                                </a>
                            </th>

                            <th class="whitespace-nowrap" rowspan="2">Draft No</th>
                            <th class="whitespace-nowrap" rowspan="2">Shipper</th>
                            <th class="whitespace-nowrap" rowspan="2">Agent</th>
                            <th class="whitespace-nowrap" rowspan="2">Feeder</th>
                            <th class="whitespace-nowrap" rowspan="2">Dest.Port</th>
                            <th class="whitespace-nowrap" rowspan="2">Booking No.</th>
                            <th class="whitespace-nowrap" rowspan="2">ETD</th>
                            <th class="whitespace-nowrap" rowspan="2">Vol.</th>
                            <th class="whitespace-nowrap" rowspan="2">Rate</th>
                            <th class="whitespace-nowrap">SELL</th>
                            <th class="whitespace-nowrap">COST</th>
                            <th class="whitespace-nowrap" colspan="2">KB</th>
                            <th class="whitespace-nowrap">Tran+Gate</th>
                            <th class="whitespace-nowrap">Other Cost</th>
                            <th class="whitespace-nowrap">Vat SELL</th>
                            <th class="whitespace-nowrap">Tax 1% </th>
                            <th class="whitespace-nowrap" rowspan="2">Profit</th>
                        </tr>
                        <tr>
                            <!-- Empty cells for the columns that don't need a second row -->
                            <th class="whitespace-nowrap">USD/THB</th>
                            <th class="whitespace-nowrap">USD/THB</th>
                            <th class="whitespace-nowrap">A</th>
                            <th class="whitespace-nowrap">C</th>
                            <th class="whitespace-nowrap">SELL / COST</th>
                            <th class="whitespace-nowrap">Insurance</th>
                            <th class="whitespace-nowrap">Vat COST</th>
                            <th class="whitespace-nowrap">Tax 3%</th>



                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_thb_sell = 0;
                            $total_thb_cost = 0;
                            $total_usd_sell = 0;
                            $total_usd_cost = 0;
                            $total_thb_kb_a = 0;
                            $total_thb_kb_c = 0;
                            $total_usd_kb_a = 0;
                            $total_usd_kb_c = 0;
                            $total_thb_tran_gate = 0;
                            $total_usd_tran_gate = 0;
                            $total_thb_other_cost = 0;
                            $total_usd_other_cost = 0;
                            $total_vat_sell = 0;
                            $total_vat_cost = 0;
                            $total_tax_1 = 0;
                            $total_tax_3 = 0;
                            $total_profit = 0;
                            $item_count = 0;
                        @endphp
                        @foreach ($jobs as $job)
                            <tr class="main-row" data-job-no="{{ $job->job_no }}">
                                <td rowspan="2">
                                    {{ $job->job_no }}</td>
                                <td rowspan="2">{{ optional(optional($job->draft)->sale)->name }}</td>
                                <td rowspan="2">{{ optional($job->draft)->draft_no }}</td>

                                <td rowspan="2">{{ optional(optional($job->draft)->shipper)->name }}</td>
                                <td rowspan="2">{{ optional(optional($job->draft)->agent)->name }}</td>
                                <td rowspan="2">{{ optional(optional($job->draft)->feeder)->name }}</td>
                                <td rowspan="2">{{ optional(optional($job->draft)->destinationPort)->name }}</td>
                                <td rowspan="2">{{ optional($job->draft)->booking_no }}</td>
                                <td rowspan="2">
                                    {{ optional($job->draft)->ETD_date ? date('d/m/Y', strtotime(optional($job->draft)->ETD_date)) : '' }}
                                </td>
                                <td rowspan="2">
                                    @if (optional($job->draft)->qty && optional(optional($job->draft)->containerType)->size)
                                        {{ optional($job->draft)->qty }} X
                                        {{ optional(optional($job->draft)->containerType)->size }}
                                    @endif
                                </td>
                                <td rowspan="2">{{ $job->cost_rate_value }}</td>

                                @php
                                    $foundSellFreight = false;
                                    $sellUSD = 0;
                                @endphp

                                @foreach ($job->sells as $sell)
                                    @if ($sell->description && $sell->description->description === 'FREIGHT')
                                        @php
                                            $valueSellAfterRate =
                                                $job->sell_rate_value != 0 ? $sell->value / $job->sell_rate_value : '';
                                            $sellUSD = $valueSellAfterRate;
                                        @endphp
                                        <td>{{ is_numeric($valueSellAfterRate) ? number_format((float) $valueSellAfterRate, 2) : '' }}
                                        </td>
                                        @php
                                            $foundSellFreight = true;
                                        @endphp
                                    @endif
                                @endforeach

                                @if (!$foundSellFreight)
                                    <td>0</td>
                                @endif

                                @php
                                    $foundCostFreight = false;
                                    $costUSD = 0;
                                @endphp

                                @foreach ($job->costs as $cost)
                                    @if ($cost->description && $cost->description->description === 'FREIGHT')
                                        @php
                                            $valueCostAfterRate =
                                                $job->cost_rate_value != 0 ? $cost->value / $job->cost_rate_value : '';
                                            $costUSD = $valueCostAfterRate;
                                        @endphp
                                        <td>{{ is_numeric($valueCostAfterRate) ? number_format((float) $valueCostAfterRate, 2) : '' }}
                                        </td>
                                        @php
                                            $foundCostFreight = true;
                                        @endphp
                                    @endif
                                @endforeach

                                @if (!$foundCostFreight)
                                    <td>0</td>
                                @endif



                                <td>{{ $job->cost_rate_value != 0 ? number_format($job->cost_kba_thb / $job->cost_rate_value, 2) : 0 }}
                                </td>
                                <td>{{ $job->cost_rate_value != 0 ? number_format($job->cost_kbc_thb / $job->cost_rate_value, 2) : 0 }}
                                </td>
                                <td>{{ $job->cost_rate_value != 0 ? number_format($job->cost_transport / $job->cost_rate_value, 2) : 0 }}
                                </td>

                                <td>
                                    {{ $job->cost_rate_value != 0 ? number_format(($job->cost_first_other_value + $job->cost_second_other_value) / $job->cost_rate_value, 2) : 0 }}
                                </td>

                                <td>{{ $job->sell_total_vat }}</td>

                                <td>
                                    {{ $job->sell_tax_1 }}
                                </td>

                                <td rowspan="2">{{ $job->profit }}</td>
                            </tr>

                            <tr>
                                @php
                                    $foundSellFreight = false;
                                    $sellTHB = 0;
                                @endphp
                                @foreach ($job->sells as $sell)
                                    @if ($sell->description && $sell->description->description === 'FREIGHT')
                                        @php
                                            $sellTHB = $sell->value;
                                        @endphp
                                        <td>{{ number_format($sell->value, 2) }}</td>
                                        @php
                                            $foundSellFreight = true;
                                        @endphp
                                    @endif
                                @endforeach
                                @if (!$foundSellFreight)
                                    <td>0</td>
                                @endif

                                @php
                                    $foundCostFreight = false;
                                    $costTHB = 0;
                                @endphp
                                @foreach ($job->costs as $cost)
                                    @if ($cost->description && $cost->description->description === 'FREIGHT')
                                        @php
                                            $costTHB = $cost->value;
                                        @endphp
                                        <td>{{ number_format($cost->value, 2) }}</td>
                                        @php
                                            $foundCostFreight = true;
                                        @endphp
                                    @endif
                                @endforeach
                                @if (!$foundCostFreight)
                                    <td>0</td>
                                @endif



                                <td>{{ $job->cost_kba_thb ? number_format($job->cost_kba_thb, 2) : 0 }}</td>
                                <td>{{ $job->cost_kbc_thb ? number_format($job->cost_kbc_thb, 2) : 0 }}</td>
                                <td>{{ $job->cost_transport ? number_format($job->cost_transport, 2) : 0 }}</td>
                                <td>{{ $job->cost_second_other_value || $job->cost_first_other_value ? number_format($job->cost_first_other_value + $job->cost_second_other_value, 2) : 0 }}
                                </td>


                                <td>{{ $job->cost_total_vat }}</td>

                                <td>
                                    {{ $job->sell_tax_3 }}
                                </td>

                            </tr>
                            @php
                                // Accumulate totals only if cost_rate_value is not zero
                                if ($job->cost_rate_value != 0) {
                                    $total_usd_sell += $sellUSD;
                                    $total_usd_cost += $costUSD;
                                    $total_usd_kb_a += $job->cost_kba_thb / $job->cost_rate_value;
                                    $total_usd_kb_c += $job->cost_kbc_thb / $job->cost_rate_value;
                                    $total_usd_tran_gate += $job->cost_transport / $job->cost_rate_value;
                                    $total_usd_other_cost +=
                                        ($job->cost_first_other_value + $job->cost_second_other_value) /
                                        $job->cost_rate_value;
                                }

                                // Accumulate totals in THB (assuming the values are already in THB)
                                $total_thb_sell += $sellTHB;
                                $total_thb_cost += $costTHB;
                                $total_thb_kb_a += $job->cost_kba_thb;
                                $total_thb_kb_c += $job->cost_kbc_thb;
                                $total_thb_tran_gate += $job->cost_transport;
                                $total_thb_other_cost += $job->cost_first_other_value + $job->cost_second_other_value;
                                $total_vat_sell += $job->sell_total_vat;
                                $total_vat_cost += $job->cost_total_vat;
                                $total_tax_1 += $job->sell_tax_1;
                                $total_tax_3 += $job->sell_tax_3;
                                $total_profit += $job->profit;

                                // Increment item count
                                $item_count++;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11" rowspan="2" class="no-border"><strong>{{ $item_count }} รายการ
                                    ยอดรวม</strong></td>
                            <td>{{ number_format($total_usd_sell, 2) }}</td>
                            <td>{{ number_format($total_usd_cost, 2) }}</td>
                            <td>{{ number_format($total_usd_kb_a, 2) }}</td>
                            <td>{{ number_format($total_usd_kb_c, 2) }}</td>
                            <td>{{ number_format($total_usd_tran_gate, 2) }}</td>
                            <td>{{ number_format($total_usd_other_cost, 2) }}</td>
                            <td>{{ number_format($total_vat_sell, 2) }}</td>
                            <td>{{ number_format($total_tax_1, 2) }}</td>
                            <td rowspan="2">{{ number_format($total_profit, 2) }}</td>
                        </tr>
                        <tr>
                            <td>{{ number_format($total_thb_sell, 2) }}</td>
                            <td>{{ number_format($total_thb_cost, 2) }}</td>
                            <td>{{ number_format($total_thb_kb_a, 2) }}</td>
                            <td>{{ number_format($total_thb_kb_c, 2) }}</td>
                            <td>{{ number_format($total_thb_tran_gate, 2) }}</td>
                            <td>{{ number_format($total_thb_other_cost, 2) }}</td>
                            <td>{{ number_format($total_vat_cost, 2) }}</td>
                            <td>{{ number_format($total_tax_1, 2) }}</td>
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
