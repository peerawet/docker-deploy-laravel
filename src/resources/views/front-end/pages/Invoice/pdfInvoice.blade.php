@extends('front-end.layouts.main')
@section('title', 'จัดการ PDF Job')
@section('content')
    <html lang="en">

    <head>
        <!-- Other meta tags and stylesheets -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <div>
        <div class="text-right mb-5">
            @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้ารายการ Draft', 'icon' => 'corner-up-left', 'route' => 'drafts.index', 'action' => ''])

        </div>
        <div class="intro-y box p-5 hidden flex flex-col justify-center items-center w-full lg:flex">
            <div
                style="border: 1px solid rgb(117, 117, 117); width:900px; height: 1200px; display:flex; justify-content:center; padding-top:50px; background: rgb(255, 255, 255);">

                <div id="content-to-be-converted" style="position: relative; width:800px;  height: 1000px;">
                    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap"
                        rel="stylesheet">


                    <div
                        style="font-size: 12px; position:absolute; top:80px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ $invoice->invoice_no }}
                    </div>

                    @php
                        use Carbon\Carbon;
                    @endphp

                    <div
                        style="font-size: 12px; position:absolute; top:105px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:140px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional(optional($invoice->job)->draft)->shipper)->name }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:165px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional(optional($invoice->job)->draft)->shipper)->address }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:230px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional($invoice->job)->draft)->booking_no }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:255px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ $invoice->bl_no }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:280px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional($invoice->job)->draft)->customer_ref }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:305px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ $invoice->container_no }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:230px; left:600px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional(optional($invoice->job)->draft)->feeder)->name }},
                        {{ optional(optional($invoice->job)->draft)->voy_feeder }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:255px; left:600px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional($invoice->job)->draft)->ETD_date ? \Carbon\Carbon::parse(optional(optional($invoice->job)->draft)->ETD_date)->format('d/m/Y') : '' }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:280px; left:600px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ optional(optional(optional($invoice->job)->draft)->destinationPort)->name }}
                    </div>

                    @php
                        $topPositionFirst = 340; // Initial top position
                    @endphp

                    @foreach (optional($invoice->job)->sells as $sell)
                        <div
                            style="font-size: 12px; position:absolute; top:{{ $topPositionFirst }}px; left:20px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                            {{ optional($sell->description)->invoice_description }}
                        </div>
                        @php
                            $topPositionFirst += 25; // Increment top position by 25px for the next item
                        @endphp
                    @endforeach

                    @php
                        $topPositionSec = 340; // Initial top position
                    @endphp

                    @foreach ($invoice_informations as $information)
                        <div
                            style="font-size: 12px; position:absolute; top:{{ $topPositionSec }}px; left:300px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                            {{ $information->information }}
                        </div>
                        @php
                            $topPositionSec += 25; // Increment top position by 25px for the next item
                        @endphp
                    @endforeach

                    @php
                        $topPositionThird = 340; // Initial top position
                    @endphp

                    @foreach (optional($invoice->job)->sells as $sell)
                        <div
                            style="font-size: 12px; position:absolute; top:{{ $topPositionThird }}px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                            @if ($sell->rate == 1)
                                {{ number_format($sell->value * optional($invoice->job)->sell_rate_value, 2) }}
                            @else
                                {{ number_format($sell->value, 2) }}
                            @endif
                        </div>
                        @php
                            $topPositionThird += 25; // Increment top position by 25px for the next item
                        @endphp
                    @endforeach

                    <div
                        style="font-size: 12px; position:absolute; top:620px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_total_without_vat, 2) }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:645px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_total_with_vat, 2) }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:670px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_total_vat, 2) }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:695px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_grand_total, 2) }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:730px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_tax_1, 2) }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:755px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_tax_3, 2) }}
                    </div>

                    @php
                        const BAHT_TEXT_NUMBERS = [
                            'ศูนย์',
                            'หนึ่ง',
                            'สอง',
                            'สาม',
                            'สี่',
                            'ห้า',
                            'หก',
                            'เจ็ด',
                            'แปด',
                            'เก้า',
                        ];
                        const BAHT_TEXT_UNITS = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
                        const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
                        const BAHT_TEXT_TWENTY = 'ยี่';
                        const BAHT_TEXT_INTEGER = 'ถ้วน';
                        const BAHT_TEXT_BAHT = 'บาท';
                        const BAHT_TEXT_SATANG = 'สตางค์';
                        const BAHT_TEXT_POINT = 'จุด';

                        /**
                         * Convert baht number to Thai text
                         * @param double|int $number
                         * @param bool $include_unit
                         * @param bool $display_zero
                         * @return string|null
                         */
                        function baht_text($number, $include_unit = true, $display_zero = true)
                        {
                            if (!is_numeric($number)) {
                                return null;
                            }

                            $log = floor(log($number, 10));
                            if ($log > 5) {
                                $millions = floor($log / 6);
                                $million_value = pow(1000000, $millions);
                                $normalised_million = floor($number / $million_value);
                                $rest = $number - $normalised_million * $million_value;
                                $millions_text = '';
                                for ($i = 0; $i < $millions; $i++) {
                                    $millions_text .= BAHT_TEXT_UNITS[6];
                                }
                                return baht_text($normalised_million, false) .
                                    $millions_text .
                                    baht_text($rest, true, false);
                            }

                            $number_str = (string) floor($number);
                            $text = '';
                            $unit = 0;

                            if ($display_zero && $number_str == '0') {
                                $text = BAHT_TEXT_NUMBERS[0];
                            } else {
                                for ($i = strlen($number_str) - 1; $i > -1; $i--) {
                                    $current_number = (int) $number_str[$i];

                                    $unit_text = '';
                                    if ($unit == 0 && $i > 0) {
                                        $previous_number = isset($number_str[$i - 1]) ? (int) $number_str[$i - 1] : 0;
                                        if ($current_number == 1 && $previous_number > 0) {
                                            $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
                                        } elseif ($current_number > 0) {
                                            $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
                                        }
                                    } elseif ($unit == 1 && $current_number == 2) {
                                        $unit_text .= BAHT_TEXT_TWENTY;
                                    } elseif ($current_number > 0 && ($unit != 1 || $current_number != 1)) {
                                        $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
                                    }

                                    if ($current_number > 0) {
                                        $unit_text .= BAHT_TEXT_UNITS[$unit];
                                    }

                                    $text = $unit_text . $text;
                                    $unit++;
                                }
                            }

                            if ($include_unit) {
                                $text .= BAHT_TEXT_BAHT;

                                $satang = explode('.', number_format($number, 2, '.', ''))[1];
                                $text .=
                                    $satang == 0 ? BAHT_TEXT_INTEGER : baht_text($satang, false) . BAHT_TEXT_SATANG;
                            } else {
                                $exploded = explode('.', $number);
                                if (isset($exploded[1])) {
                                    $text .= BAHT_TEXT_POINT;
                                    $decimal = (string) $exploded[1];
                                    for ($i = 0; $i < strlen($decimal); $i++) {
                                        $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
                                    }
                                }
                            }

                            return $text;
                        }
                    @endphp

                    <div
                        style="font-size: 12px; position:absolute; top:785px; left:700px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ number_format(optional($invoice->job)->sell_grand_total - optional($invoice->job)->sell_tax_3 - optional($invoice->job)->sell_tax_1, 2) }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:785px; left:300px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        ({{ baht_text(optional($invoice->job)->sell_grand_total - optional($invoice->job)->sell_tax_3 - optional($invoice->job)->sell_tax_1) }})
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:815px; left:550px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') : '' }} (Credit
                        Term: 30 Days)
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:860px; left:20px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        Agent: {{ optional(optional(optional($invoice->job)->draft)->agent)->name }}
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:885px; left:20px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        Exchange Rate: 1 USD = {{ optional($invoice->job)->sell_rate_value }} THB
                    </div>

                    <div
                        style="font-size: 12px; position:absolute; top:910px; left:20px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top;">
                        Remark
                    </div>

                    <div
                        style="font-size: 12px; line-height: 0.5; position:absolute; top:900px; left:100px; font-family: 'Noto Sans Thai', sans-serif; vertical-align: top; white-space: pre-line;">
                        {!! nl2br(e($invoice->remark)) !!}
                    </div>

                </div>


            </div>


        </div>

        <!-- Print button -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="generate-pdf-btn" class="btn btn-primary">Generate PDF</button>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- pdf generate --}}
    <script>
        document.getElementById('generate-pdf-btn').addEventListener('click', function() {
            // Get the HTML content of the element with ID 'content-to-be-converted'
            var htmlContent = document.getElementById('content-to-be-converted').innerHTML;

            // Create a new form element to submit HTML content to the server
            var form = document.createElement('form');
            form.action = '{{ route('pdf.single.invoice') }}'; // Route for PDF generation
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
