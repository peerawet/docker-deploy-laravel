<div>
    <div class="text-right mb-5">
        @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้ารายการ Invoice', 'icon' => 'corner-up-left', 'route' => 'invoice.index', 'action' => ''])

    </div>
    <form action="{{ route('invoice.store') }}" method="POST">
        @csrf
        <div class="page-header">


            {{-- section 1 --}}
            <div class="intro-y box p-5">
                <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <b>1. Fill in Job No.</b>
                </header>
                <div class="grid grid-cols-12 mt-5 gap-5">
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 lg:col-span-6">
                                <label for="job_no" class="form-label">Job No.</label>
                                <select id="job_no" name="job_no" class="form-control mr-2">
                                    <option value="" disabled>Select job No.</option>
                                    <option value="">Please select job</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->job_no }}">
                                            {{ $job->job_no }}
                                        </option>
                                    @endforeach
                                </select>
                                <script>
                                    jQuery('#job_no').select2()
                                </script>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <label for="draft_no" class="form-label">Draft No.</label>
                                <input id="draft_no" name="draft_no" type="text" class="form-control"
                                    placeholder="Draft No." value="" readonly>
                            </div>
                        </div>
                        <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                            <label for="shipper_name" class="form-label">Shipper Name</label>
                            <input id="shipper_name" name="shipper_name" type="text" class="form-control w-full"
                                placeholder="Shipper Name" readonly>
                        </div>
                        <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-control w-full">
                                <option value="" selected>เลือกสถานะ</option>
                                <option value="Get">Get</option>
                                <option value="ยกเลิกโดยไม่มีการเก็บเงิน">ยกเลิกโดยไม่มีการเก็บเงิน</option>
                                <option value="เก็บเงินแล้วแต่ไม่ได้ออกใบเสร็จ">เก็บเงินแล้วแต่ไม่ได้ออกใบเสร็จ</option>
                            </select>
                        </div>

                    </div>

                    <div class="intro-y col-span-12 lg:col-span-6">
                        <div class="intro-y col-span-12 lg:col-span-6">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input id="agent_name" name="agent_name" type="text" class="form-control w-full"
                                placeholder="Agent Name" readonly>
                        </div>
                        <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                            <label for="destination_port" class="form-label">Port</label>
                            <input id="destination_port" name="destination_port" type="text"
                                class="form-control w-full" placeholder="Port" value="" readonly>
                        </div>
                    </div>
                </div>

                <script>
                    jQuery('#job_no').on('change', function() {
                        var jobNo = jQuery(this).val();
                        var url = "{{ route('get-draft', ':job_no') }}".replace(':job_no', jobNo);

                        jQuery.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                console.log(response);
                                jQuery('#draft_no').val(response.draft_no);
                                jQuery('#shipper_name').val(response.shipper_name);
                                jQuery('#agent_name').val(response.agent_name);
                                jQuery('#destination_port').val(response.destination_port);
                                jQuery('#booking_no').val(response.booking_no);
                                jQuery('#ref_no').val(response.customer_ref);

                                // Pre-fill the table rows based on the response data
                                var sells = response.sells; // Assume response.sells contains the sell data
                                var $tbody = jQuery('tbody');

                                $tbody.empty(); // Clear the existing table body

                                sells.forEach(function(sell, index) {
                                    var $row = jQuery('<tr>');

                                    var $descriptionCell = jQuery('<td>').append(
                                        jQuery('<input>')
                                        .addClass('form-control')
                                        .attr('type', 'text')
                                        .attr('name', 'sell-description-name-' + (index + 1))
                                        .attr('style', 'width: 100%; font-size: 0.85rem;')
                                        .attr('readonly', true)

                                        .attr('data-description', sell.description
                                            .description) // Store the description as data
                                        .val(sell.description.description) // Display the description
                                    );

                                    var $hiddenSellIdCell = jQuery('<td>').append(
                                        jQuery('<input>')
                                        .addClass('form-control')
                                        .attr('type', 'text')
                                        .attr('name', 'sell_id-' + (index + 1))
                                        .attr('style', 'width: 100%; font-size: 0.85rem; display:none;')
                                        .attr('readonly', true)
                                        .attr('value', sell.id) // Set the value to the ID


                                    );



                                    var $invoiceDescriptionCell = jQuery('<td>').append(
                                        jQuery('<input>')
                                        .attr('type', 'text')
                                        .attr('step', 'any')
                                        .addClass('sell-value-cell')
                                        .attr('id', 'sell-invoice-description-' + (index + 1))
                                        .attr('name', 'sell-invoice-description-' + (index + 1))
                                        .attr('value', sell.description.invoice_description || '')
                                        .attr('style', 'width: 100%; font-size: 0.85rem;')
                                        .prop('readonly', true)
                                    );

                                    var $informationCell = jQuery('<td>').append(
                                        jQuery('<input>')
                                        .attr('type', 'text')
                                        .attr('step', 'any')
                                        .addClass('sell-information-cell')
                                        .attr('id', 'sell-information-' + (index + 1))
                                        .attr('name', 'sell-information-' + (index + 1))
                                        .attr('value', sell.information ||
                                            '') // Assume 'information' is part of sell data
                                        .attr('style', 'width: 100%; font-size: 0.85rem;')
                                    );

                                    // Add the remaining cells for the sell information


                                    var $valueCell = jQuery('<td>').append(
                                        jQuery('<input>')
                                        .attr('type', 'number')
                                        .attr('step', 'any')
                                        .addClass('sell-value-cell')
                                        .attr('id', 'sell-value-' + (index + 1))
                                        .attr('name', 'sell-value-' + (index + 1))
                                        .attr('value', sell.value)
                                        .attr('style', 'width: 100%; font-size: 0.85rem;')
                                        .prop('readonly', true)
                                    );

                                    var $rateCell = jQuery('<td>').css('text-align', 'center').append(
                                        jQuery('<input>')
                                        .attr('type', 'checkbox')
                                        .addClass('sell-rate-checkbox')
                                        .attr('id', 'sell-rate-' + (index + 1))
                                        .attr('name', 'sell-rate-' + (index + 1))
                                        .attr('value', 'true')
                                        .prop('checked', sell.rate)
                                        .prop('disabled', true)
                                    );

                                    var $vatCell = jQuery('<td>').css('text-align', 'center').append(
                                        jQuery('<input>')
                                        .attr('type', 'checkbox')
                                        .addClass('sell-vat-checkbox')
                                        .attr('id', 'sell-vat-' + (index + 1))
                                        .attr('name', 'sell-vat-' + (index + 1))
                                        .attr('value', 'true')
                                        .prop('checked', sell.vat)
                                        .prop('disabled', true)
                                    );

                                    var $taxCell = jQuery('<td>').append(
                                        jQuery('<input>')
                                        .attr('type', 'number')
                                        .attr('step', 'any')
                                        .addClass('sell-tax-cell')
                                        .attr('id', 'sell-tax-' + (index + 1))
                                        .attr('name', 'sell-tax-' + (index + 1))
                                        .attr('value', sell.tax)
                                        .attr('style', 'width: 100%; font-size: 0.85rem;')
                                        .prop('readonly', true)
                                    );

                                    var $amountCell = jQuery('<td>').css('font-size', '0.85rem').css(
                                        'text-align', 'center').text(
                                        sell.rate ? (sell.value * response.job.sell_rate_value) : sell
                                        .value
                                    );

                                    $hiddenSellIdCell.hide(); // Hide the hidden input field

                                    $row.append(
                                        $descriptionCell,
                                        $hiddenSellIdCell, // Append the hidden input field
                                        $invoiceDescriptionCell,
                                        $informationCell,
                                        $valueCell,
                                        $rateCell,
                                        $vatCell,
                                        $taxCell,
                                        $amountCell
                                    );

                                    $tbody.append($row);


                                });
                            },
                            error: function(xhr) {
                                if (xhr.status === 404) {
                                    alert('No draft found for the selected job.');
                                    jQuery('#draft_no').val('');
                                    jQuery('#shipper_name').val('');
                                    jQuery('#agent_name').val('');
                                    jQuery('#destination_port').val('');
                                }
                            }
                        });
                    });
                </script>




            </div>
        </div>



        {{-- section 2 --}}
        <div class="intro-y box p-5 mt-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>2. Sell Information</b>
            </header>
            <div class="overflow-x-auto">
                <table id="costTable" class="table table-bordered table-hover" style="padding: 0; text-align: center;">
                    <thead class="table-dark">
                        <tr>
                            <th>Description</th>
                            <th>Invoice Description</th>
                            <th>Information</th>
                            <th>Value</th>
                            <th>Rate</th>
                            <th>Vat</th>
                            <th>Tax</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="sells-tbody">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="sell-description-name-1"
                                    style="width: 100%; font-size: 0.85rem;" readonly>
                                <input type="text" class="form-control" name="sell_id-1"
                                    style="width: 100%; font-size: 0.85rem; display:none;">
                            </td>

                            <td>
                                <input type="text" step="any" class="sell-value-cell"
                                    id="sell-invoice-description-1" name="sell-invoice-description-1" value=""
                                    style="width: 100%; font-size: 0.85rem;" readonly>
                            </td>
                            <td>
                                <input type="text" step="any" class="sell-value-cell"
                                    id="sell-invoice-infromation-1" name="sell-invoice-infromation-1" value=""
                                    style="width: 100%; font-size: 0.85rem;">
                            </td>
                            <td>
                                <input type="number" step="any" class="sell-value-cell" id="sell-value-1"
                                    name="sell-value-1" value="" style="width: 100%; font-size: 0.85rem;"
                                    readonly>
                            </td>
                            <td style="text-align: center;">
                                <input type="checkbox" class="sell-rate-checkbox" id="sell-rate-1"
                                    name="sell-rate-1" value="true" disabled>
                            </td>
                            <td style="text-align: center;">
                                <input type="checkbox" class="sell-vat-checkbox" id="sell-vat-1" name="sell-vat-1"
                                    value="true" disabled>
                            </td>
                            <td>
                                <input type="number" step="any" class="sell-tax-cell" id="sell-tax-1"
                                    name="sell-tax-1" value="" style="width: 100%; font-size: 0.85rem;"
                                    readonly>
                            </td>
                            <td class="amount-cell" style="font-size: 0.85rem; text-align: center;"></td>
                        </tr>
                    </tbody>



                </table>

            </div>
        </div>

        {{-- section 3 --}}
        <div class="intro-y box p-5 mt-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>3. Invoice Information</b>
            </header>
            <div class="grid grid-cols-12 gap-5 mt-5">
                <div class="intro-y col-span-12 lg:col-span-6" style="margin-left: 10px">


                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <label for="booking_no" class="form-label">Booking No.</label>
                        <input id="booking_no" name="booking_no" type="text" class="form-control w-full"
                            placeholder="Booking No." readonly>
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <label for="bl_no" class="form-label">B/L No.</label>
                        <input id="bl_no" name="bl_no" type="text" class="form-control w-full"
                            placeholder="B/L No.">
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <label for="container_no" class="form-label">Container No.</label>
                        <input id="container_no" name="container_no" type="text" class="form-control w-full"
                            placeholder="Container No.">
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input id="due_date" name="due_date" type="date" class="form-control w-full"
                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <label for="ref_no" class="form-label">Ref No.</label>
                        <input id="ref_no" name="ref_no" type="text" class="form-control w-full"
                            placeholder="Ref No." readonly>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">

                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <label for="attn" class="form-label">Attn</label>
                        <input id="attn" name="attn" type="text" class="form-control w-full"
                            placeholder="Attn">
                    </div>

                    <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5 mt-5">
                        <p>Remark</p>
                    </header>
                    <div class="intro-y col-span-12 lg:col-span-6 mt-2">
                        <textarea rows="5" name="remark" class="form-control w-full" placeholder="Remark"></textarea>
                    </div>
                </div>
            </div>



        </div>

        {{-- section 4 --}}
        <div class="intro-y box p-5 mt-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>4. Operation</b>
            </header>
            <div class="grid grid-cols-12 gap-6 mt-5">

                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="invoice_no" class="form-label">Invoice No.</label>
                    <input id="invoice_no" name="invoice_no" type="text" class="form-control w-full"
                        placeholder="invoice No." value="" readonly>
                </div>



                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="invoice_date" class="form-label">Invoice Date</label>
                    <input id="invoice_date" name="invoice_date" type="date" class="form-control w-full"
                        placeholder="invoice Date">
                </div>

                <script>
                    // Function to set current date to the input field
                    function setCurrentDate() {
                        const dateInput = document.getElementById('invoice_date');
                        const today = new Date();
                        const year = today.getFullYear();
                        const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        const day = String(today.getDate()).padStart(2, '0');

                        // Format the date as yyyy-mm-dd
                        const currentDate = `${year}-${month}-${day}`;

                        dateInput.value = currentDate;
                    }

                    // Set current date on page load
                    window.onload = setCurrentDate;
                </script>



                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="prepared_by" class="form-label">Prepared By</label>
                    <input id="prepared_by" name="prepared_by" type="text" class="form-control w-full"
                        placeholder="Edit Name" readonly value="{{ auth()->user()->name }}">

                </div>
                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="created_at" class="form-label">Prepared Date</label>
                    <input id="created_at" type="datetime-local" class="form-control w-full" readonly
                        name="created_at">
                    <script>
                        // Get current date and time
                        var currentDateTime = new Date();

                        // Format current date and time as YYYY-MM-DDTHH:MM (required by input type="datetime-local")
                        var formattedDateTime = currentDateTime.getFullYear() + '-' +
                            ('0' + (currentDateTime.getMonth() + 1)).slice(-2) + '-' +
                            ('0' + currentDateTime.getDate()).slice(-2) + 'T' +
                            ('0' + currentDateTime.getHours()).slice(-2) + ':' +
                            ('0' + currentDateTime.getMinutes()).slice(-2);

                        // Set the value of the input field
                        document.getElementById("created_at").value = formattedDateTime;
                    </script>
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
