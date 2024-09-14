<style>
    .table td {
        border-bottom-width: 1px;
        padding: 0px;
    }

    .table th {
        border-bottom-width: 2px;
        font-weight: 500;
        padding: 0.2rem 0.2rem;
        text-align: center;
    }
</style>


<div>
    <div class="text-right mb-5">
        <a href="{{ route('job.index') }}" class="btn btn-outline-secondary btn-rounded w-36 mr-2 mb-2">
            <i class="fas fa-corner-up-left mr-2"></i> กลับสู่หน้ารายการ Jobs
        </a>
        <a href="{{ route('job.print', ['jobId' => $job->job_no]) }}"
            class="btn btn-outline-success btn-rounded w-36 mr-2 mb-2" target="_blank">
            <i class="fas fa-print mr-2"></i> Preview
        </a>

    </div>

    <form action="{{ route('job.store', ['id' => $job->job_no]) }}" method="POST">
        @csrf

        <div class="intro-y box p-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>1. Select Draft No.</b>
            </header>
            <div class="grid grid-cols-12 gap-6 mt-5">

                <div class="intro-y col-span-12 lg:col-span-4">
                    <div class="mt-2">
                        <div>
                            <style>
                                .custom-dropdown {
                                    position: absolute;
                                    background-color: white;
                                    border: 1px solid #ccc;
                                    max-height: 200px;
                                    overflow-y: auto;
                                    z-index: 1000;
                                }

                                .dropdown-item {
                                    padding: 8px 16px;
                                    cursor: pointer;
                                }

                                .dropdown-item:hover {
                                    background-color: #f1f1f1;
                                }
                            </style>

                            <div class="dropdown">
                                <label for="draft_no_input" class="form-label">Draft No.</label>
                                <input type="text" id="draft_no_input" name="draft_no" class="form-control"
                                    placeholder="Type to search draft" autocomplete="off" value="{{ $job->draft_no }}">
                                <div id="draft_no_dropdown" class="custom-dropdown" style="display: none;"></div>
                            </div>


                        </div>


                    </div>


                    <div class="mt-2">
                        <label for="col-form-label" class="form-label">Booking No.</label>
                        <input type="text" class="form-control w-full" id="booking_no" placeholder="Booking No."
                            disabled>
                    </div>

                </div>

                <div class="intro-y col-span-12 lg:col-span-4 ">


                    <div class="mt-2">
                        <label for="col-form-label" class="form-label">Shipper</label>
                        <input type="text" class="form-control w-full" id="shipper-name" placeholder="Shipper"
                            disabled>
                        <div class="mt-2" style="color: blue;">
                            <span class="shipper-contact" style="white-space: pre-line;"></span>
                            <span class="shipper-tel" style="white-space: pre-line;"></span>
                            <span class="shipper-address style="white-space: pre-line;"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="crud-form-1" class="form-label">Volume</label>
                        <input type="text" class="form-control w-full" placeholder="Volume" id="volume" disabled>
                    </div>
                </div>

                <div class="intro-y col-span-12 lg:col-span-4 ">

                    <div class="mt-2">
                        <label for="crud-form-1" class="form-label">Agent</label>
                        <input type="text" class="form-control w-full" placeholder="Agent" id="agent-name" disabled>
                        <div class="mt-2" style="color: blue;">
                            <span class="agent-contact" style="white-space: pre-line;"></span>
                            <span class="agent-tel" style="white-space: pre-line;"></span>
                            <span class="agent-id" style="white-space: pre-line;"></span>
                        </div>
                    </div>


                    <div class="mt-2">
                        <label for="ETD_date" class="form-label">ETD</label>
                        <input id="ETD_date" type="date" class="form-control w-full" placeholder="ETD date"
                            disabled>
                    </div>


                </div>
            </div>







        </div>

        <div class="intro-y box p-5 mt-5">

            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>2. Job Information</b>
            </header>
            <div class="grid grid-cols-12 mt-5 gap-5">

                {{-- cost --}}
                <div class="intro-y col-span-12 lg:col-span-6 ">

                    <header>
                        <b>COST</b>
                    </header>

                    <div class="grid grid-cols-12 gap-2">
                        <div class="flex flex-row items-center gap-2 col-span-12 lg:col-span-4 justify-center">
                            <label class="w" for="cost-vat">Vat</label>
                            <input type="number" step="any" id="cost-vat" placeholder="Vat" class="form-control"
                                style="width: calc(50% - 1rem);" value="{{ $job->cost_vat_value ?? '7' }}"
                                name="cost_vat_value">
                            <span>%</span>
                        </div>

                        <div class="flex flex-row items-center gap-2 col-span-12 lg:col-span-4 justify-center">
                            <label class="w" for="cost-rate">Cost Rate</label>
                            <input type="number" step="any" id="cost-rate" placeholder="Rate"
                                class="form-control" style="width: 50%;" name="cost_rate_value"
                                value="{{ $job->cost_rate_value ?? '0' }}" step="any">

                        </div>
                        <div class="flex gap-2 col-span-12 lg:col-span-4 justify-center">
                            <button id="addCostRowBtn" class="btn btn-primary rounded-full"
                                type="button">เพิ่ม</button>

                            <button id="deleteCostRowBtn" class="btn btn-danger rounded-full" type="button">ลบ
                            </button>
                        </div>
                    </div>

                    <div id="cost-table" class="table-responsive flex flex-col gap-4 mt-5">

                        <table id="costTable" class="table table-bordered table-hover " style="padding: 0;">

                            <thead class="table-dark">
                                <tr>
                                    <th style="width:100px">Description</th>
                                    <th style="width:60px">Value</th>
                                    <th style="width:30px">Rate</th>
                                    <th style="width:30px">Vat</th>
                                    <th style="width:60px">Tax</th>
                                    <th style="width:60px">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job->costs as $index => $cost)
                                    <tr>

                                        <td>
                                            <select class="type-to-search-dropdown"
                                                name="cost-description-{{ $index + 1 }}"
                                                style="width: 100%; font-size: 0.85rem;">
                                                <option value="">Select</option>
                                                @foreach ($masterFileDescriptions as $description)
                                                    <option value="{{ $description->id }}"
                                                        {{ $cost->description_id == $description->id ? 'selected' : '' }}>
                                                        {{ $description->description }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.type-to-search-dropdown').select2({
                                                        tags: true,
                                                        createTag: function(params) {
                                                            var term = $.trim(params.term);

                                                            if (term === '') {
                                                                return null;
                                                            }

                                                            return {
                                                                id: 'new=' + term,
                                                                text: term + ' (Create new)',
                                                                newTag: true // add additional parameters
                                                            };
                                                        }
                                                    });
                                                });
                                            </script>
                                        </td>

                                        <td>
                                            <input type="number" step="any" class="cost-value-cell"
                                                id="cost-value-{{ $index + 1 }}"
                                                name="cost-value-{{ $index + 1 }}" value="{{ $cost->value }}"
                                                style="width: 100%; font-size: 0.85rem;">
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="cost-rate-checkbox"
                                                id="cost-rate-{{ $index + 1 }}"
                                                name="cost-rate-{{ $index + 1 }}" value="true"
                                                {{ $cost->rate ? 'checked' : '' }}>
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="cost-vat-checkbox"
                                                id="cost-vat-{{ $index + 1 }}"
                                                name="cost-vat-{{ $index + 1 }}" value="true"
                                                {{ $cost->vat ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="number" step="any" class="cost-tax-cell"
                                                id="cost-tax-{{ $index + 1 }}"
                                                name="cost-tax-{{ $index + 1 }}" value="{{ $cost->tax }}"
                                                style="width: 100%; font-size: 0.85rem;">
                                        </td>
                                        <td class="amount-cell" style="font-size: 0.85rem; text-align: center;">

                                            @if ($cost->rate == 1)
                                                {{ $cost->value * $job->cost_rate_value }}
                                            @else
                                                {{ $cost->value }}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                        {{-- transport kba kbc and other --}}
                        <table class="table table-bordered mt-5" style="text-align: center; width: 100%;">

                            <tr>
                                <td colspan="2">
                                    <input type="text" value="Transport" disabled
                                        style="width: 100%; font-size: 0.85rem;" class="form-control">
                                </td>
                                <td colspan="2">
                                    <input type="number" step="any" style="width: 100%; font-size: 0.85rem;"
                                        class="form-control" name="cost_transport" id="cost_transport"
                                        value="{{ $job->cost_transport ?? '0' }}">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"><input type="text" value="KBA" disabled
                                        style="width: 100%; font-size: 0.85rem; " class="form-control"></td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            value="{{ $job->cost_kba_thb !== null && $job->cost_rate_value != 0 ? number_format($job->cost_kba_thb / $job->cost_rate_value, 2) : 0 }}"
                                            style="font-size: 0.85rem;" id="cost_kba_usd">


                                        <span class="input-group-text">USD</span>

                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            value="{{ $job->cost_kba_thb ?? '0' }}" style="font-size: 0.85rem;"
                                            id="cost_kba_thb" name="cost_kba_thb" step="any">
                                        <span class="input-group-text">THB</span>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text" value="KBC" disabled
                                        style="width: 100%; font-size: 0.85rem; " class="form-control"></td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            value="{{ $job->cost_kbc_thb !== null && $job->cost_rate_value != 0 ? number_format($job->cost_kbc_thb / $job->cost_rate_value, 2) : 0 }}"
                                            style="font-size: 0.85rem;" id="cost_kbc_usd">


                                        <span class="input-group-text">USD</span>

                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            value="{{ $job->cost_kbc_thb ?? '0' }}" style="font-size: 0.85rem;"
                                            id="cost_kbc_thb" name="cost_kbc_thb">

                                        <span class="input-group-text">THB</span>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text"
                                        value="{{ $job->cost_first_other_name ?? '' }}"
                                        style="font-size: 0.85rem;  width: 100%;" placeholder="กรอกข้อมูล"
                                        class="form-control" id="cost_first_other_name" name="cost_first_other_name">
                                </td>
                                <td colspan="2"><input type="number" step="any"
                                        value="{{ $job->cost_first_other_value ?? '0' }}"
                                        style="font-size: 0.85rem;  width: 100%;" placeholder="กรอกข้อมูล"
                                        class="form-control" id="cost_first_other_value"
                                        name="cost_first_other_value"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text"
                                        value="{{ $job->cost_second_other_name ?? '' }}"
                                        style="font-size: 0.85rem;  width: 100%;" placeholder="กรอกข้อมูล"
                                        class="form-control" id="cost_second_other_name"
                                        name="cost_second_other_name"></td>
                                <td colspan="2"><input type="number" step="any"
                                        value="{{ $job->cost_second_other_value ?? '0' }}"
                                        style="font-size: 0.85rem;  width: 100%;" placeholder="กรอกข้อมูล"
                                        class="form-control" id="cost_second_other_value"
                                        name="cost_second_other_value"></td>
                            </tr>
                        </table>

                        <ul class="nav nav-tabs" id="COST" role="tablist">
                            <li class="nav-item mt-2" role="presentation">
                                <button class="nav-link active" id="COST-total-tab" data-bs-toggle="tab"
                                    data-bs-target="#COST-total" type="button" role="tab"
                                    aria-controls="nav-COST" aria-selected="true">ยอดรวม</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link mt-2" id="nav-COST-description-tab" data-bs-toggle="tab"
                                    data-bs-target="#COST-description" type="button" role="tab"
                                    aria-controls="COST-description" aria-selected="false">หมายเหตุ</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="COSTContent">
                            <div class="tab-pane fade show active" id="COST-total" role="tabpanel"
                                aria-labelledby="COST-total-tab">
                                <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                                    <div class="grid grid-cols-12 gap-4">


                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="cost-sub-total" class="form-label flex-2">Sub Total :</label>
                                            <input id="cost-sub-total" type="text" name="cost_sub_total"
                                                class="form-control flex-1" placeholder="Sub Total" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-vat" class="form-label flex-2">VAT :</label>
                                            <input id="displayed-cost-vat" type="text" name="cost_total_vat"
                                                class="form-control flex-1" placeholder="VAT" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-tax-1" class="form-label flex-2">Tax 1%
                                                :</label>
                                            <input id="displayed-cost-tax-1" type="text" name="cost_tax_only_1"
                                                class="form-control flex-1" placeholder="Tax 1%" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-tax-3" class="form-label flex-2">Tax 3%
                                                :</label>
                                            <input id="displayed-cost-tax-3" type="text" name="cost_tax_only_3"
                                                class="form-control flex-1" placeholder="Tax 3%" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-tax" class="form-label flex-2">Tax Amt
                                                :</label>
                                            <input id="displayed-cost-tax" type="text" name="cost_tax_amt"
                                                class="form-control flex-1" placeholder="Tax Amt" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-included-vat"
                                                class="form-label flex-2">จำนวนเงินที่คิด VAT :</label>
                                            <input id="displayed-cost-included-vat" type="text"
                                                name="cost_total_with_vat" class="form-control flex-1"
                                                placeholder="VAT" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-not-included-vat"
                                                class="form-label flex-2">จำนวนเงินที่ไม่คิด VAT :</label>
                                            <input id="displayed-cost-not-included-vat" type="text"
                                                name="cost_total_without_vat" class="form-control flex-1"
                                                placeholder="VAT" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="cost-total" class="form-label flex-2">Grand Total :</label>
                                            <input id="cost-total" type="text" name="cost_grand_total"
                                                class="form-control flex-1" placeholder="Total Cost" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-cost-price" class="form-label flex-2">ต้องจ่ายเช็ค
                                                :</label>
                                            <input id="displayed-cost-price" type="text" name="spend"
                                                class="form-control flex-1" placeholder="ต้องจ่ายเช็ค" readonly>
                                        </div>



                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane fade mt-5" id="COST-description" role="tabpanel"
                                aria-labelledby="COST-description-tab">
                                <textarea rows="5" class="form-control w-full" placeholder="หมายเหตุ" name="cost_remark">{{ $job->cost_remark ?? '' }}</textarea>
                            </div>

                        </div>

                    </div>

                    {{-- calculate --}}
                    <script>
                        // Function to calculate amount based on value and rate for the COST section
                        function calculateCostAmount(row) {
                            var value = parseFloat(row.querySelector('.cost-value-cell').value);
                            var rateInput = row.querySelector('.cost-rate-checkbox');
                            var rate = rateInput.checked ? parseFloat(document.getElementById('cost-rate').value) : 1;
                            var amount = value * rate;
                            row.querySelector('.amount-cell').innerText = amount.toFixed(2);
                            updateCostAmounts(); // Update total amounts for COST section
                        }

                        // Function to attach event listeners to value, rate, VAT, and tax input fields for the COST section
                        function attachCostEventListeners(row) {
                            var valueInput = row.querySelector('.cost-value-cell');
                            var rateInput = row.querySelector('.cost-rate-checkbox');
                            var vatInput = row.querySelector('.cost-vat-checkbox');
                            var taxInput = row.querySelector('.cost-tax-cell'); // Corrected class name
                            var vatValue = document.querySelector('#cost-vat');

                            vatValue.addEventListener('change', function() {
                                updateCostAmounts();
                            });

                            // Update amount when value changes
                            valueInput.addEventListener('input', function() {
                                calculateCostAmount(row);
                            });

                            // Update amount when rate changes
                            rateInput.addEventListener('input', function() {
                                calculateCostAmount(row);
                                updateCostAmounts(); // Update total amounts immediately when rate changes
                            });

                            // Update amounts when VAT checkbox is changed
                            vatInput.addEventListener('input', function() {
                                updateCostAmounts();
                            });

                            // Update amounts when tax changes
                            taxInput.addEventListener('input', function() {
                                updateCostAmounts();
                            });


                        }

                        // Function to update KBA THB value
                        function updateKbaThb() {
                            var kbaUsd = parseFloat(document.getElementById('cost_kba_usd').value) || 0;
                            var rate = parseFloat(document.getElementById('cost-rate').value) || 0;
                            var kbaThb = kbaUsd * rate;
                            document.getElementById('cost_kba_thb').value = kbaThb.toFixed(2);
                            updateCostAmounts(); // Update total amounts when KBA THB changes
                        }

                        document.getElementById('cost_kba_usd').addEventListener('input', function() {
                            updateKbaThb();
                        });

                        document.getElementById('cost-rate').addEventListener('input', function() {
                            updateKbaThb();
                        });

                        function updateKbcThb() {
                            var kbcUsd = parseFloat(document.getElementById('cost_kbc_usd').value) || 0;
                            var rate = parseFloat(document.getElementById('cost-rate').value) || 0;
                            var kbcThb = kbcUsd * rate;
                            document.getElementById('cost_kbc_thb').value = kbcThb.toFixed(2);
                            updateCostAmounts(); // Update total amounts when KBc THB changes
                        }

                        document.getElementById('cost_kbc_usd').addEventListener('input', function() {
                            updateKbcThb();
                        });

                        document.getElementById('cost-rate').addEventListener('input', function() {
                            updateKbcThb();
                        });

                        // Function to update total amounts for the COST section
                        function updateCostAmounts() {
                            var total = 0;
                            var vat = 0;
                            var tax = 0;
                            var tax1 = 0; // Initialize tax1 variable for tax rate 1%
                            var tax3 = 0; // Initialize tax3 variable for tax rate 3%
                            var includedVat = 0;
                            var notIncludedVat = 0;
                            var profit = 0;

                            var rows = document.querySelectorAll('#costTable tbody tr');
                            rows.forEach(function(row) {
                                var amount = parseFloat(row.querySelector('.amount-cell').innerText);
                                total += amount;

                                var vatCheckbox = row.querySelector('.cost-vat-checkbox');
                                if (vatCheckbox.checked) {
                                    vat += amount * (parseFloat(document.getElementById('cost-vat').value) / 100);
                                }

                                var taxRate = parseFloat(row.querySelector('.cost-tax-cell').value);
                                tax += (amount * taxRate) / 100;

                                // Update tax1 if taxRate is 1%
                                if (taxRate === 1) {
                                    tax1 += (amount * taxRate) / 100;
                                }

                                // Update tax3 if taxRate is 3%
                                if (taxRate === 3) {
                                    tax3 += (amount * taxRate) / 100;
                                }

                                // Update includedVat and notIncludedVat based on VAT checkbox
                                if (vatCheckbox.checked) {
                                    includedVat += amount;
                                } else {
                                    notIncludedVat += amount;
                                }
                            });

                            document.getElementById('cost-sub-total').value = total.toFixed(2);
                            document.getElementById('cost-total').value = (total + vat).toFixed(2);
                            document.getElementById('displayed-cost-vat').value = vat.toFixed(2);
                            document.getElementById('displayed-cost-tax').value = tax.toFixed(2);
                            document.getElementById('displayed-cost-tax-1').value = tax1.toFixed(2); // Update displayed tax 1%
                            document.getElementById('displayed-cost-tax-3').value = tax3.toFixed(2); // Update displayed tax 3%
                            document.getElementById('displayed-cost-included-vat').value = includedVat.toFixed(2);
                            document.getElementById('displayed-cost-not-included-vat').value = notIncludedVat.toFixed(2);

                            // Calculate actual payment ("จ่ายจริง")
                            var actualPayment = total + vat - tax;
                            document.getElementById('displayed-cost-price').value = actualPayment.toFixed(2);

                            var totalSell = parseFloat(document.getElementById('sell-total').value); // Total sell amount
                            var taxSell = parseFloat(document.getElementById('displayed-sell-tax').value); // Tax amount for sell
                            var actualCost = parseFloat(document.getElementById('displayed-cost-price').value); // Actual cost

                            // Get cost_transport value
                            var costTransport = parseFloat(document.getElementById('cost_transport').value) || 0;

                            var costKba = parseFloat(document.getElementById('cost_kba_thb').value) || 0;
                            var costKbc = parseFloat(document.getElementById('cost_kbc_thb').value) || 0;
                            var costFirstOther = parseFloat(document.getElementById('cost_first_other_value').value) || 0;
                            var costSecondOther = parseFloat(document.getElementById('cost_second_other_value').value) || 0;

                            document.getElementById('cost_kba_thb').addEventListener('input', function() {
                                updateCostAmounts(); // Update total amounts when cost-transport changes
                            });

                            var subTotalSell = parseFloat(document.getElementById('sell-sub-total').value);
                            var subTotalCost = parseFloat(document.getElementById('cost-sub-total').value);


                            // Calculate profit
                            var profit = subTotalSell - subTotalCost - costTransport - costKba - costKbc - costFirstOther -
                                costSecondOther;

                            console.log(document.getElementById('cost-sub-total'));

                            // Update profit input field
                            document.getElementById('profit').value = profit.toFixed(2);
                        }



                        // Attach event listeners to existing rows for the COST section
                        var existingCostRows = document.querySelectorAll('#costTable tbody tr');
                        existingCostRows.forEach(function(row) {
                            attachCostEventListeners(row);
                        });

                        // Define a variable to keep track of the row count
                        var rowCountCost = 4;

                        document.getElementById('addCostRowBtn').addEventListener('click', function() {
                         
                            var tableBody = document.querySelector('#costTable tbody');
                            var newRow = document.createElement('tr');

                            // Increment the counter for each new row
                            rowCountCost++;

                            newRow.innerHTML = `
                        <td style="width:100px;">
                            <select class="type-to-search-dropdown" name="cost-description-${rowCountCost}" style="width: 100%; font-size: 0.85rem;">
                                <option value="">Select</option>
                                @foreach ($masterFileDescriptions as $description)
                                    <option value="{{ $description->id }}">{{ $description->description }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width:60px;"><input type="number" step="any" class="cost-value-cell" name="cost-value-${rowCountCost}" value="0" style="width: 100%; font-size: 0.85rem;  border: 1px solid #dee2e6; border-radius: .25rem; padding: .375rem .75rem;"></td>
                        <td style="width:30px; text-align: center;"><input type="checkbox" class="cost-rate-checkbox" name="cost-rate-${rowCountCost}" value="true"></td>
                        <td style="width:30px; text-align: center;"><input type="checkbox" class="cost-vat-checkbox" name="cost-vat-${rowCountCost}" value="true"></td>
                        <td style="width:60px;"><input type="number" step="any" class="cost-tax-cell" name="cost-tax-${rowCountCost}" value="0.00" style="width: 100%; font-size: 0.85rem;  border: 1px solid #dee2e6; border-radius: .25rem; padding: .375rem .75rem;"></td>
                        <td class="amount-cell" style="font-size: 0.85rem; text-align: center;">0</td>
                    `;
                            tableBody.appendChild(newRow);
                            attachCostEventListeners(newRow);
                            updateCostAmounts();

                            // Initialize Select2 for all dropdowns including the newly added one
                            // Initialize Select2 for the new dropdown
                            jQuery(newRow).find('.type-to-search-dropdown').select2({
                                tags: true, // Allow users to create new tags
                                createTag: function(params) {
                                    var term = jQuery.trim(params.term);

                                    if (term === '') {
                                        return null;
                                    }

                                    return {
                                        id: 'new=' + term,
                                        text: term + ' (Create new)',
                                        newTag: true // Additional parameters for new tag
                                    };
                                }
                            });
                        });





                        // Event listener for deleting a row for the COST section

                        document.getElementById('deleteCostRowBtn').addEventListener('click', function() {
                         
                            var tableRows = document.querySelectorAll('#costTable tbody tr');
                            var lastRow = tableRows[tableRows.length - 1];
                            if (lastRow) {
                                lastRow.remove();
                                updateCostAmounts();
                            }
                        });

                        // Event listener for rate input field for the COST section
                        document.getElementById('cost-rate').addEventListener('input', function() {
                            // Recalculate amounts and update totals when rate changes
                            var rows = document.querySelectorAll('#costTable tbody tr');
                            rows.forEach(function(row) {
                                calculateCostAmount(row);
                            });
                            updateCostAmounts();
                        });




                        // Event listener for tax input field for the COST section
                        document.getElementById('displayed-cost-tax').addEventListener('input', function() {
                            // Update total amounts based on the percentage tax input by the user
                            updateCostAmounts();
                        });

                        // Event listener for the cost_transport field
                        document.getElementById('cost_transport').addEventListener('input', function() {
                            updateCostAmounts(); // Update total amounts when cost_transport changes
                        });


                        document.getElementById('cost_kba_thb').addEventListener('input', function() {
                            updateCostAmounts(); // Update total amounts when cost-transport changes
                        });

                        document.getElementById('cost_kbc_thb').addEventListener('input', function() {
                            updateCostAmounts();
                        });

                        document.getElementById('cost_first_other_value').addEventListener('input', function() {
                            updateCostAmounts();
                        });

                        document.getElementById('cost_second_other_value').addEventListener('input', function() {
                            updateCostAmounts();
                        });


                        // Update amounts for the COST section on initial load
                        updateCostAmounts();

                        // Get the input field for VAT for the COST section
                        var inputCostVat = document.getElementById('cost-vat');

                        // Get the input field to display VAT for the COST section
                        var displayedCostVat = document.getElementById('displayed-cost-vat');

                        // Function to update the displayed VAT for the COST section
                        function updateDisplayedCostVat() {
                            displayedCostVat.value = inputCostVat.value + '%';
                        }

                        // Add event listener to input field for VAT for the COST section
                        inputCostVat.addEventListener('input', function() {
                            updateDisplayedCostVat();
                            updateCostAmounts(); // Update total amounts when input VAT changes
                        });

                        // Initial update of displayed VAT for the COST section
                        updateDisplayedCostVat();
                    </script>















                </div>

                {{-- sell --}}
                <div class="intro-y col-span-12 lg:col-span-6">

                    <header>
                        <b>SELL</b>
                    </header>

                    <div class="grid grid-cols-12 gap-2">
                        <div class="flex flex-row items-center gap-2 col-span-12 lg:col-span-4 justify-center">
                            <label class="w" for="sell-vat">Vat</label>
                            <input type="number" step="any" id="sell-vat" placeholder="Vat"
                                class="form-control" style="width: calc(50% - 1rem);"
                                value="{{ $job->sell_vat_value ?? '7' }}" name="sell_vat_value">
                            <span>%</span>
                        </div>

                        <div class="flex flex-row items-center gap-2 col-span-12 lg:col-span-4 justify-center">
                            <label class="w" for="sell-rate">Sell Rate</label>
                            <input type="number" step="any" id="sell-rate" placeholder="Rate"
                                class="form-control" style="width: 50%;" name="sell_rate_value"
                                value="{{ $job->sell_rate_value ?? '0' }}" step="any">

                        </div>




                        <div class="flex gap-2 col-span-12 lg:col-span-4 justify-center">
                            <button id="addSellRowBtn" class="btn btn-primary rounded-full"
                                type="button">เพิ่ม</button>

                            <button id="deleteSellRowBtn" class="btn btn-danger rounded-full" type="button">ลบ
                            </button>
                        </div>
                    </div>

                    <div id="sell-table" class="table-responsive flex flex-col gap-4 mt-5">

                        <table id="sellTable" class="table table-bordered table-hover " style="padding: 0;">

                            <thead class="table-dark">
                                <tr>
                                    <th style="width:100px">Description</th>
                                    <th style="width:60px">Value</th>
                                    <th style="width:30px">Rate</th>
                                    <th style="width:30px">Vat</th>
                                    <th style="width:60px">Tax</th>
                                    <th style="width:60px">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job->sells as $index => $sell)
                                    <tr>
                                        <td>
                                            <select class="type-to-search-dropdown"
                                                name="sell-description-{{ $index + 1 }}"
                                                style="width: 100%; font-size: 0.85rem;">
                                                <option value="">Select</option>
                                                @foreach ($masterFileDescriptions as $description)
                                                    <option value="{{ $description->id }}"
                                                        {{ $sell->description_id == $description->id ? 'selected' : '' }}>
                                                        {{ $description->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <script>
                                                jQuery('.type-to-search-dropdown').select2();
                                            </script>
                                        </td>


                                        <td>
                                            <input type="number" step="any" class="sell-value-cell"
                                                id="sell-value-{{ $index + 1 }}"
                                                name="sell-value-{{ $index + 1 }}" value="{{ $sell->value }}"
                                                style="width: 100%; font-size: 0.85rem;">
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="sell-rate-checkbox"
                                                id="sell-rate-{{ $index + 1 }}"
                                                name="sell-rate-{{ $index + 1 }}" value="true"
                                                {{ $sell->rate ? 'checked' : '' }}>
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="sell-vat-checkbox"
                                                id="sell-vat-{{ $index + 1 }}"
                                                name="sell-vat-{{ $index + 1 }}" value="true"
                                                {{ $sell->vat ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="number" step="any" class="sell-tax-cell"
                                                id="sell-tax-{{ $index + 1 }}"
                                                name="sell-tax-{{ $index + 1 }}" value="{{ $sell->tax }}"
                                                style="width: 100%; font-size: 0.85rem;">
                                        </td>
                                        <td class="amount-cell" style="font-size: 0.85rem; text-align: center;">

                                            @if ($sell->rate == 1)
                                                {{ $sell->value * $job->sell_rate_value }}
                                            @else
                                                {{ $sell->value }}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>

                        <ul class="nav nav-tabs" id="SELL" role="tablist">
                            <li class="nav-item mt-2" role="presentation">
                                <button class="nav-link active" id="SELL-total-tab" data-bs-toggle="tab"
                                    data-bs-target="#SELL-total" type="button" role="tab"
                                    aria-controls="nav-SELL" aria-selected="true">ยอดรวม</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link mt-2" id="nav-SELL-description-tab" data-bs-toggle="tab"
                                    data-bs-target="#SELL-description" type="button" role="tab"
                                    aria-controls="SELL-description" aria-selected="false">หมายเหตุ</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="SELLContent">
                            <div class="tab-pane fade show active" id="SELL-total" role="tabpanel"
                                aria-labelledby="SELL-total-tab">
                                <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                                    <div class="grid grid-cols-12 gap-4">


                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="sell-sub-total" class="form-label flex-2">Sub Total :</label>
                                            <input id="sell-sub-total" type="text" name="sell_sub_total"
                                                class="form-control flex-1" placeholder="Sub Total" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-sell-vat" class="form-label flex-2">VAT :</label>
                                            <input id="displayed-sell-vat" type="text" name="sell_total_vat"
                                                class="form-control flex-1" placeholder="VAT" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-sell-tax-1" class="form-label flex-2">Tax 1%
                                                :</label>
                                            <input id="displayed-sell-tax-1" type="text" name="sell_tax_only_1"
                                                class="form-control flex-1" placeholder="Tax 1%" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-sell-tax-3" class="form-label flex-2">Tax 3%
                                                :</label>
                                            <input id="displayed-sell-tax-3" type="text" name="sell_tax_only_3"
                                                class="form-control flex-1" placeholder="Tax 3%" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-sell-tax" class="form-label flex-2">Tax Amt
                                                :</label>
                                            <input id="displayed-sell-tax" type="text" name="sell_tax_amt"
                                                class="form-control flex-1" placeholder="Tax Amt" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-sell-included-vat"
                                                class="form-label flex-2">จำนวนเงินที่คิด VAT :</label>
                                            <input id="displayed-sell-included-vat" type="text"
                                                name="sell_total_with_vat" class="form-control flex-1"
                                                placeholder="VAT" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="displayed-sell-not-included-vat"
                                                class="form-label flex-2">จำนวนเงินที่ไม่คิด VAT :</label>
                                            <input id="displayed-sell-not-included-vat" type="text"
                                                name="sell_total_without_vat" class="form-control flex-1"
                                                placeholder="VAT" readonly>
                                        </div>

                                        <div class="intro-y col-span-12 lg:col-span-6 flex items-center gap-2">
                                            <label for="sell-total" class="form-label flex-2">Grand Total :</label>
                                            <input id="sell-total" type="text" name="sell_grand_total"
                                                class="form-control flex-1" placeholder="Total Cost" readonly>
                                        </div>







                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane fade mt-5" id="SELL-description" role="tabpanel"
                                aria-labelledby="SELL-description-tab">
                                <textarea rows="5" class="form-control w-full" placeholder="Note" name="sell_remark">{{ $job->sell_remark ?? '' }}</textarea>

                            </div>
                        </div>

                    </div>

                    <script>
                        // Function to calculate amount based on value and rate for the SELL section
                        function calculateSellAmount(row) {
                            var value = parseFloat(row.querySelector('.sell-value-cell').value);
                            var rateInput = row.querySelector('.sell-rate-checkbox');
                            var rate = rateInput.checked ? parseFloat(document.getElementById('sell-rate').value) : 1;
                            var amount = value * rate;
                            row.querySelector('.amount-cell').innerText = amount.toFixed(2);
                            updateSellAmounts(); // Update total amounts for SELL section
                        }

                        // Function to attach event listeners to value, rate, VAT, and tax input fields for the SELL section
                        function attachSellEventListeners(row) {
                            var valueInput = row.querySelector('.sell-value-cell');
                            var rateInput = row.querySelector('.sell-rate-checkbox');
                            var vatInput = row.querySelector('.sell-vat-checkbox');
                            var taxInput = row.querySelector('.sell-tax-cell'); // Corrected class name
                            var vatValue = document.querySelector('#sell-vat');

                            vatValue.addEventListener('change', function() {
                                updateSellAmounts();
                            });

                            // Update amount when value changes
                            valueInput.addEventListener('input', function() {

                                calculateSellAmount(row);
                            });

                            // Update amount when rate changes
                            rateInput.addEventListener('change', function() {
                                calculateSellAmount(row);
                                updateSellAmounts(); // Update total amounts immediately when rate changes
                            });

                            // Update amounts when VAT checkbox is changed
                            vatInput.addEventListener('change', function() {
                                updateSellAmounts();
                            });

                            // Update amounts when tax changes
                            taxInput.addEventListener('input', function() {
                                updateSellAmounts();
                            });
                        }



                        // Function to update total amounts for the SELL section
                        function updateSellAmounts() {
                            var totalSell = 0;
                            var vat = 0;
                            var tax = 0;
                            var tax1 = 0; // Variable for tax 1
                            var tax3 = 0; // Variable for tax 3
                            var includedVat = 0;
                            var notIncludedVat = 0;

                            // Calculate total sell amount
                            var sellRows = document.querySelectorAll('#sellTable tbody tr');
                            sellRows.forEach(function(row) {
                                var amount = parseFloat(row.querySelector('.amount-cell').innerText);
                                totalSell += amount;

                                var vatCheckbox = row.querySelector('.sell-vat-checkbox');
                                if (vatCheckbox.checked) {
                                    vat += amount * (parseFloat(document.getElementById('sell-vat').value) / 100);
                                }

                                var taxRate = parseFloat(row.querySelector('.sell-tax-cell').value);
                                tax += (amount * taxRate) / 100;

                                // Calculate tax 1 and tax 3 individually
                                switch (taxRate) {
                                    case 1:
                                        tax1 += (amount * taxRate) / 100;
                                        break;
                                    case 3:
                                        tax3 += (amount * taxRate) / 100;
                                        break;
                                }

                                // Update includedVat and notIncludedVat based on VAT checkbox
                                if (vatCheckbox.checked) {
                                    includedVat += amount;
                                } else {
                                    notIncludedVat += amount;
                                }
                            });

                            document.getElementById('sell-sub-total').value = totalSell.toFixed(2);
                            document.getElementById('sell-total').value = (totalSell + vat).toFixed(2);
                            document.getElementById('displayed-sell-vat').value = vat.toFixed(2);
                            document.getElementById('displayed-sell-tax').value = tax.toFixed(2);
                            document.getElementById('displayed-sell-tax-1').value = tax1.toFixed(2);
                            document.getElementById('displayed-sell-tax-3').value = tax3.toFixed(2);
                            document.getElementById('displayed-sell-included-vat').value = includedVat.toFixed(2);
                            document.getElementById('displayed-sell-not-included-vat').value = notIncludedVat.toFixed(2);

                            var totalSell = parseFloat(document.getElementById('sell-total').value); // Total sell amount
                            var taxSell = parseFloat(document.getElementById('displayed-sell-tax').value); // Tax amount for sell
                            var actualCost = parseFloat(document.getElementById('displayed-cost-price').value); // Actual cost

                            // Get cost_transport value
                            var costTransport = parseFloat(document.getElementById('cost_transport').value) || 0;

                            var costKba = parseFloat(document.getElementById('cost_kba_thb').value) || 0;
                            var costKbc = parseFloat(document.getElementById('cost_kbc_thb').value) || 0;
                            var costFirstOther = parseFloat(document.getElementById('cost_first_other_value').value) || 0;
                            var costSecondOther = parseFloat(document.getElementById('cost_second_other_value').value) || 0;

                            document.getElementById('cost_kba_thb').addEventListener('input', function() {
                                updateCostAmounts(); // Update total amounts when cost-transport changes
                            });

                            var subTotalSell = parseFloat(document.getElementById('sell-sub-total').value);
                            var subTotalCost = parseFloat(document.getElementById('cost-sub-total').value);
                            // Calculate profit
                            var profit = subTotalSell - subTotalCost - costTransport - costKba - costKbc - costFirstOther -
                                costSecondOther;

                            // Update profit input field
                            document.getElementById('profit').value = profit.toFixed(2);
                        }




                        // Attach event listeners to existing rows for the SELL section
                        var existingSellRows = document.querySelectorAll('#sellTable tbody tr');
                        existingSellRows.forEach(function(row) {
                            attachSellEventListeners(row);
                        });

                        // Define a variable to keep track of the row count
                        var rowCountSell = 4;

                        // Event listener for adding a new row for the SELL section
                        document.getElementById('addSellRowBtn').addEventListener('click', function() {
                            var tableBody = document.querySelector('#sellTable tbody');
                            var newRow = document.createElement('tr');

                            // Increment the counter for each new row
                            rowCountSell++;

                            newRow.innerHTML = `
        <td style="width:100px;">
            <select class="type-to-search-dropdown" name="sell-description-${rowCountSell}" style="width: 100%; font-size: 0.85rem;">
                <option value="">Select</option>
                @foreach ($masterFileDescriptions as $description)
                    <option value="{{ $description->id }}">{{ $description->description }}</option>
                @endforeach
            </select>
        </td>
        <td style="width:60px;"><input type="number" step="any" class="sell-value-cell" name="sell-value-${rowCountSell}" value="0" style="width: 100%; font-size: 0.85rem;  border: 1px solid #dee2e6; border-radius: .25rem; padding: .375rem .75rem;"></td>
        <td style="width:30px; text-align: center;"><input type="checkbox" class="sell-rate-checkbox" name="sell-rate-${rowCountSell}" value="true"></td>
        <td style="width:30px; text-align: center;"><input type="checkbox" class="sell-vat-checkbox" name="sell-vat-${rowCountSell}" value="true"></td>
        <td style="width:60px;"><input type="number" step="any" class="sell-tax-cell" name="sell-tax-${rowCountSell}" value="0.00" style="width: 100%; font-size: 0.85rem;  border: 1px solid #dee2e6; border-radius: .25rem; padding: .375rem .75rem;"></td>
        <td class="amount-cell" style="font-size: 0.85rem; text-align: center;">0</td>
    `;
                            tableBody.appendChild(newRow);
                            attachSellEventListeners(newRow);
                            updateSellAmounts();


                            // Initialize Select2 for the new dropdown
                            jQuery(newRow).find('.type-to-search-dropdown').select2({
                                tags: true, // Allow users to create new tags
                                createTag: function(params) {
                                    var term = jQuery.trim(params.term);

                                    if (term === '') {
                                        return null;
                                    }

                                    return {
                                        id: 'new=' + term,
                                        text: term + ' (Create new)',
                                        newTag: true // Additional parameters for new tag
                                    };
                                }
                            });
                        });




                        // Event listener for deleting a row for the SELL section
                        document.getElementById('deleteSellRowBtn').addEventListener('click', function() {
                            var tableRows = document.querySelectorAll('#sellTable tbody tr');
                            var lastRow = tableRows[tableRows.length - 1];
                            if (lastRow) {
                                lastRow.remove();
                                updateSellAmounts();
                            }
                        });

                        // Event listener for rate input field for the SELL section
                        document.getElementById('sell-rate').addEventListener('input', function() {
                            // Recalculate amounts and update totals when rate changes
                            var rows = document.querySelectorAll('#sellTable tbody tr');
                            rows.forEach(function(row) {
                                calculateSellAmount(row);
                            });
                            updateSellAmounts();
                        });

                        // Event listener for tax input field for the SELL section
                        document.getElementById('displayed-sell-tax').addEventListener('input', function() {
                            // Update total amounts based on the percentage tax input by the user
                            updateSellAmounts();
                        });

                        // Update amounts for the SELL section on initial load
                        updateSellAmounts();

                        // Get the input field for VAT for the SELL section
                        var inputSellVat = document.getElementById('sell-vat');

                        // Get the input field to display VAT for the SELL section
                        var displayedSellVat = document.getElementById('displayed-sell-vat');

                        // Function to update the displayed VAT for the SELL section
                        function updateDisplayedSellVat() {
                            displayedSellVat.value = inputSellVat.value + '%';
                        }

                        // Add event listener to input field for VAT for the SELL section
                        inputSellVat.addEventListener('input', function() {
                            updateDisplayedSellVat();
                            updateSellAmounts(); // Update total amounts when input VAT changes
                        });

                        // Initial update of displayed VAT for the SELL section
                        updateDisplayedSellVat();
                    </script>





                </div>


                <div class="intro-y col-span-12 lg:col-span-6">
                    <label for="profit" class="form-label">Profit</label>
                    <input id="profit" name="profit" type="number" step="any" class="form-control"
                        placeholder="Profit" value="{{ $job->profit }}" readonly>
                </div>



            </div>


        </div>

        <div class="intro-y box p-5 mt-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>3. Operation</b>
            </header>
            <div class="grid grid-cols-12 gap-6 mt-5">

                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="job_no" class="form-label">Job No.</label>
                    <input id="job_no" name="job_no" type="text" class="form-control w-full"
                        placeholder="Job No." value="{{ $job->job_no }}" readonly>
                </div>



                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="job_date" class="form-label">Job Date</label>
                    <input id="job_date" name="job_date" type="date" class="form-control w-full"
                        placeholder="Job Date"
                        value="{{ $job ? ($job->job_date ? \Carbon\Carbon::parse($job->job_date)->format('Y-m-d') : '') : '' }}">
                </div>






                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="prepared_by" class="form-label">Prepared By</label>
                    <input id="prepared_by" name="prepared_by" type="text" class="form-control w-full"
                        placeholder="Edit Name" readonly value="{{ optional($job->preparedBy)->name }}">


                </div>
                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="created_at" class="form-label">Prepared Date</label>
                    <input id="created_at" type="date" class="form-control w-full" readonly name="created_at"
                        value="{{ $job ? ($job->created_at ? \Carbon\Carbon::parse($job->created_at)->format('Y-m-d') : '') : '' }}">

                </div>

                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="edit_by" class="form-label">Edit By</label>
                    <input id="edit_by" name="edit_by" type="text" class="form-control w-full"
                        placeholder="Edit Name" readonly value="{{ optional($job->editedBy)->name }}">
                </div>

                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="edit_date" class="form-label">Edit Date</label>
                    <input id="edit_date" type="date" class="form-control w-full" readonly name="edit_date"
                        value="{{ $job ? ($job->edit_date ? \Carbon\Carbon::parse($job->edit_date)->format('Y-m-d') : '') : '' }}">
                </div>




            </div>


            <script>
                document.getElementById('draft_no').addEventListener('change', function() {
                    var draftId = this.value;

                    if (draftId) {
                        jQuery.ajax({
                            url: '{{ route('job.getDraftDetails', ':id') }}'.replace(':id', draftId),
                            type: 'GET',
                            success: function(response) {
                                $('#booking_no').val(response.booking_no);

                                // Update shipper's details
                                $('#shipper-name').val(response.shipper_name);
                                $('.shipper-address').text('Address: ' + response.shipper_address);
                                $('.shipper-contact').text('Contact: ' + response.shipper_contact + ',\n');
                                $('.shipper-tel').text('Telephone: ' + response.shipper_tel + ',\n');

                                // Update agent's details
                                $('#agent-name').val(response.agent_name);
                                $('.agent-contact').text('Contact: ' + response.agent_contact + ',\n');
                                $('.agent-tel').text('Telephone: ' + response.agent_tel + ',\n');
                                $('.agent-id').text('Agent-ID: ' + response.agent_id);

                                $('#ETD_date').val(response.ETD_date);

                                $('#volume').val(response.quantity + ' X ' + response.size + ' ' + response
                                    .temp);
                            }
                        });
                    }
                });
            </script>




        </div>






        <div class="text-right mt-5">
            @livewire('components.assets.button-type', ['color' => 'primary', 'title' => 'บันทึกข้อมูล', 'icon' => 'save', 'action' => '', 'type' => 'submit'])
        </div>
    </form>


</div>




{{-- type to search draft no script --}}
<script>
    jQuery(document).ready(function() {
        var allDrafts = {!! json_encode($drafts) !!};
        console.log(allDrafts);

        function updateDropdown(input) {
            var dropdown = jQuery('#draft_no_dropdown');
            dropdown.empty();

            // Filter draft options based on input
            var filteredDrafts = allDrafts.filter(function(draft) {
                return draft.draft_no.toString().includes(input);
            });

            // Construct HTML for dropdown options
            var dropdownHTML = '';
            filteredDrafts.forEach(function(draft) {
                dropdownHTML += '<div class="dropdown-item">' + draft.draft_no + '</div>';
            });

            // Set dropdown content
            dropdown.html(dropdownHTML);

            // Show dropdown if there are filtered options, otherwise hide it
            if (filteredDrafts.length > 0 && input !== '') {
                dropdown.show();
            } else {
                dropdown.hide();
            }
        }

        // Function to fetch draft details and populate fields
        function fetchDraftDetails(draftNo) {
            jQuery.ajax({
                url: '{{ route('job.getDraftDetails', ':id') }}'.replace(':id', draftNo),
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    jQuery('#booking_no').val(response.booking_no);

                    // Update shipper's details
                    jQuery('#shipper-name').val(response.shipper_name);
                    jQuery('.shipper-address').text('Address: ' + response.shipper_address);
                    jQuery('.shipper-contact').text('Contact: ' + response.shipper_contact + ',\n');
                    jQuery('.shipper-tel').text('Telephone: ' + response.shipper_tel + ',\n');

                    // Update agent's details
                    jQuery('#agent-name').val(response.agent_name);
                    jQuery('.agent-contact').text('Contact: ' + response.agent_contact + ',\n');
                    jQuery('.agent-tel').text('Telephone: ' + response.agent_tel + ',\n');
                    jQuery('.agent-id').text('Agent-ID: ' + response.agent_id);

                    jQuery('#ETD_date').val(response.ETD_date);

                    jQuery('#volume').val(response.qty + ' X ' + response.size + ' X ' + response
                        .temp);
                }
            });
        }

        // Initially update dropdown based on pre-filled input
        var initialDraftNo = jQuery('#draft_no_input').val().toLowerCase();
        updateDropdown(initialDraftNo);

        // Fetch and pre-fill fields if there's an initial draft number
        if (initialDraftNo) {
            fetchDraftDetails(initialDraftNo);
        }

        jQuery('#draft_no_input').on('input', function() {
            var input = jQuery(this).val().toLowerCase();
            updateDropdown(input);
        });

        // Handle click on dropdown item
        jQuery(document).on('click', '.dropdown-item', function() {
            var selectedDraft = jQuery(this).text();
            console.log(selectedDraft);
            jQuery('#draft_no_input').val(selectedDraft);
            jQuery('#draft_no_dropdown').hide();
            fetchDraftDetails(selectedDraft);
        });
    });
</script>


{{-- <script>
    jQuery(document).ready(function() {
        jQuery('#draft_no_input').on('input', function() {
            var draftId = jQuery(this).val();

            if (draftId) {
                jQuery.ajax({
                    url: '{{ route('job.getDraftDetails', ':id') }}'.replace(':id', draftId),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        jQuery('#booking_no').val(response.booking_no);

                        // Update shipper's details
                        jQuery('#shipper-name').val(response.shipper_name);
                        jQuery('.shipper-address').text('Address: ' + response
                            .shipper_address);
                        jQuery('.shipper-contact').text('Contact: ' + response
                            .shipper_contact + ',\n');
                        jQuery('.shipper-tel').text('Telephone: ' + response.shipper_tel +
                            ',\n');

                        // Update agent's details
                        jQuery('#agent-name').val(response.agent_name);
                        jQuery('.agent-contact').text('Contact: ' + response.agent_contact +
                            ',\n');
                        jQuery('.agent-tel').text('Telephone: ' + response.agent_tel +
                            ',\n');
                        jQuery('.agent-id').text('Agent-ID: ' + response.agent_id);

                        jQuery('#ETD_date').val(response.ETD_date);

                        jQuery('#volume').val(response.qty + ' X ' + response.size + ' X ' +
                            response.temp);
                    }
                });
            }
        });
    });
</script> --}}
