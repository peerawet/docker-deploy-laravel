<div>
    <div class="text-right mb-5">
        @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้ารายการInvoice', 'icon' => 'corner-up-left', 'route' => 'receipt.vat.index', 'action' => ''])

    </div>

    <form action="{{ route('receipt.store', ['id' => $receipt->receipt_no]) }}" method="POST">
        @csrf
        <div class="page-header">
            <div class="intro-y box p-5">

                <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <b>1. Fill in Invoice No.</b>
                </header>
                <div class="grid grid-cols-12 gap-5 mt-5">
                    <div class="intro-y col-span-3 lg:col-span-3">
                        <label for="invoice_no" class="form-label">เลือก Invoice No.</label>
                        <select id="invoice_no" name="invoice_no" class="form-control mr-2">
                            @foreach ($invoices as $invoice)
                                <option value="{{ $invoice->invoice_no }}"
                                    {{ $invoice->invoice_no == $receipt->invoice_no ? 'selected' : '' }}>
                                    {{ $invoice->invoice_no }}
                                </option>
                            @endforeach
                        </select>
                        <script>
                            jQuery('#invoice_no').select2();
                        </script>
                    </div>

                    <div class="intro-y col-span-3 lg:col-span-3">
                        <label for="receipt_no" class="form-label">Receipt No.</label>
                        <input id="receipt_no" type="text" class="form-control w-full"
                            value="{{ $receipt->receipt_no }}" disabled>
                    </div>


                    <div class="intro-y col-span-3 lg:col-span-3">
                        <label for="receipt_date" class="form-label">Receipt Date</label>
                        <input name="receipt_date" id="receipt_date" type="date" class="form-control" placeholder=""
                            value="{{ $receipt ? ($receipt->receipt_date ? \Carbon\Carbon::parse($receipt->receipt_date)->format('Y-m-d') : '') : '' }}">
                    </div>

                    <div class="intro-y col-span-3 lg:col-span-3">
                        <label for="shipper_name" class="form-label">Shipper</label>
                        <input id="shipper_name" type="text" class="form-control w-full" placeholder="Shipper"
                            readonly>
                    </div>

                    <div class="intro-y col-span-3 lg:col-span-3 gap-4">
                        <label for="is_vat" class="form-label">Bill Vat</label>
                        <input name="is_vat" id="is_vat" type="checkbox" class="form-check-input border" readonly>
                    </div>

                    <div class="intro-y col-span-3 lg:col-span-3">
                        <small id="shipper_note" class="shipper_note"></small>
                    </div>

                    <script>
                        console.log(@json($receipt))
                        jQuery(document).ready(function() {
                            // Trigger the change event if there is a pre-selected Invoice_no
                            var preSelectedInvoiceNo = jQuery('#invoice_no').val();
                            if (preSelectedInvoiceNo) {
                                jQuery('#invoice_no').trigger('change');
                            }
                        });

                        jQuery('#invoice_no').on('change', function() {
                            var invoiceNo = jQuery(this).val();
                            var url = "{{ route('get-data', ':invoice_no') }}".replace(':invoice_no', invoiceNo);

                            jQuery.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response) {
                                    console.log(response);
                                    jQuery('#shipper_name').val(response.shipper_name);
                                    jQuery('#shipper_note').html(response.shipper_note);
                                    jQuery('#is_vat').prop('checked', response.isvat == 1);
                                    jQuery('#sell_sub_total').val(response.sell_sub_total);
                                    jQuery('#sell_total_vat').val(response.sell_total_vat);
                                    jQuery('#sell_grand_total').val(response.sell_grand_total);

                                },
                                error: function(xhr) {
                                    if (xhr.status === 404) {
                                        alert('No draft found for the selected job.');
                                        jQuery('#shipper_name').val('');
                                        jQuery('#shipper_note').html('');
                                        jQuery('#is_vat').prop('checked', false);
                                    }
                                }
                            });
                        });
                    </script>
                </div>



            </div>


            <div class="intro-y box p-5 mt-5">
                <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <b>2. ยอดรวมในบิล</b>
                </header>
                <div class="grid grid-cols-12 gap-5 mt-5">
                    <div class="intro-y col-span-6 lg:col-span-6">
                        <label for="receipt_description" class="form-label">Receipt Description</label>
                        <select id="receipt_description" name="receipt_description_id" class="form-control mr-2">
                            @foreach ($masterFileReceiptDescriptions as $description)
                                <option value="{{ $description->id }}"
                                    {{ $receipt->receipt_description_id == $description->id ? 'selected' : '' }}>
                                    {{ $description->description }}
                                </option>
                            @endforeach
                        </select>
                        <script>
                            // jQuery('#receipt_description').select2();
                            jQuery('#receipt_description').select2({
                                tags: true,
                                createTag: function(params) {
                                    var term = jQuery.trim(params.term);

                                    if (term === '') {
                                        return null;
                                    }

                                    return {
                                        id: 'new=' + term,
                                        text: term + ' (Create new)',
                                        newTag: true // add additional parameters
                                    }
                                }
                            });
                        </script>
                    </div>

                    <div class="intro-y col-span-6 lg:col-span-6">
                        <label for="sell_sub_total" class="form-label">Sub Total</label>
                        <input id="sell_sub_total" type="text" class="form-control w-full" placeholder="Sub Total"
                            readonly>
                    </div>

                    <div class="intro-y col-span-6 lg:col-span-6">
                        <label for="sell_total_vat" class="form-label">Vat</label>
                        <input id="sell_total_vat" type="text" class="form-control w-full" placeholder="Vat"
                            readonly>
                    </div>

                    <div class="intro-y col-span-6 lg:col-span-6">
                        <label for="sell_grand_total" class="form-label">Grand Total</label>
                        <input id="sell_grand_total" type="text" class="form-control w-full"
                            placeholder="Grand Total" readonly>
                    </div>
                </div>

            </div>
        </div>


        <div class="intro-y box p-5 mt-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>3. การชำระเงิน</b>
            </header>

            <div class="grid grid-cols-12 gap-9 mt-5">
                <div class="intro-y col-span-12 lg:col-span-4 ml-5">
                    <b>ชำระโดย</b>
                    <div class="payment-option mt-5">
                        <input type="checkbox" class="form-check-input border payment-method" id="payment-cash"
                            name="payment_method" value="cash" <?php echo $receipt->payment_method == 'cash' ? 'checked' : ''; ?>>
                        <label for="payment-cash" class="form-label">เงินสด</label>
                    </div>
                    <div class="payment-option mt-5">
                        <input type="checkbox" class="form-check-input border payment-method" id="payment-transfer"
                            name="payment_method" value="transfer" <?php echo $receipt->payment_method == 'transfer' ? 'checked' : ''; ?>>
                        <label for="payment-transfer" class="form-label">โอนเงิน</label>
                    </div>
                    <div class="payment-option mt-5">
                        <input type="checkbox" class="form-check-input border payment-method" id="payment-check"
                            name="payment_method" value="check" <?php echo $receipt->payment_method == 'check' ? 'checked' : ''; ?>>
                        <label for="payment-check" class="form-label">เช็คธนาคาร</label>
                    </div>
                </div>

                <div class="intro-y col-span-12 lg:col-span-8">
                    <div class="mt-2 bank-details" style="display: <?php echo $receipt->payment_method == 'check' ? 'block' : 'none'; ?>">
                        <label for="bank" class="form-label">ธนาคาร</label>
                        <input id="bank" name="bank" type="text" class="form-control w-full"
                            placeholder="ธนาคาร" value="{{ $receipt->bank }}">
                    </div>
                    <div class="mt-2 bank-details" style="display: <?php echo $receipt->payment_method == 'check' ? 'block' : 'none'; ?>">
                        <label for="branch" class="form-label">สาขา</label>
                        <input id="branch" name="branch" type="text" class="form-control w-full"
                            placeholder="สาขา" value="{{ $receipt->branch }}">
                    </div>
                    <div class="mt-2 bank-details" style="display: <?php echo $receipt->payment_method == 'check' ? 'block' : 'none'; ?>">
                        <label for="bank_number" class="form_label">เลขที่</label>
                        <input id="bank_number" name="bank_number" type="text" class="form-control w-full"
                            placeholder="เลขที่" value="{{ $receipt->bank_number }}">
                    </div>
                    <div class="mt-2">
                        <label for="transaction_date" class="form_label">วันที่ทำรายการ</label>
                        <input id="transaction_date" name="transaction_date" type="date"
                            class="form-control w-full"
                            value="{{ $receipt ? ($receipt->transaction_date ? \Carbon\Carbon::parse($receipt->transaction_date)->format('Y-m-d') : '') : '' }}">
                    </div>
                </div>

                <script>
                    const paymentCash = document.getElementById('payment-cash');
                    const paymentTransfer = document.getElementById('payment-transfer');
                    const paymentCheck = document.getElementById('payment-check');
                    const bankDetails = document.querySelectorAll('.bank-details');

                    // Initially hide/show bank details based on payment method
                    toggleBankDetails(paymentCheck.checked);

                    // Add event listeners to toggle bank details visibility
                    paymentCash.addEventListener('change', function() {
                        if (this.checked) {
                            toggleBankDetails(false); // Hide bank details
                        }
                    });

                    paymentTransfer.addEventListener('change', function() {
                        if (this.checked) {
                            toggleBankDetails(false); // Hide bank details
                        }
                    });

                    paymentCheck.addEventListener('change', function() {
                        toggleBankDetails(this.checked); // Show/hide bank details based on checkbox state
                    });

                    function toggleBankDetails(isChecked) {
                        bankDetails.forEach(detail => {
                            detail.style.display = isChecked ? 'block' : 'none';
                        });
                    }
                </script>


                <script>
                    const checkboxes = document.querySelectorAll('.payment-option input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            checkboxes.forEach(cb => {
                                if (cb !== this) {
                                    cb.checked = false;
                                }
                            });
                        });
                    });
                </script>



            </div>
        </div>

        <div class="intro-y box p-5 mt-5">
            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                <b>4. Operation</b>
            </header>
            <div class="grid grid-cols-12 gap-6 mt-5">



                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="prepared_by" class="form-label">Prepared By</label>
                    <input id="prepared_by" name="prepared_by" type="text" class="form-control w-full"
                        placeholder="Edit Name" readonly value="{{ optional($receipt->preparedBy)->name }}">


                </div>
                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="created_at" class="form-label">Prepared Date</label>
                    <input id="created_at" type="date" class="form-control w-full" readonly name="created_at"
                        value="{{ $receipt ? ($receipt->created_at ? \Carbon\Carbon::parse($receipt->created_at)->format('Y-m-d') : '') : '' }}">

                </div>

                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="edit_by" class="form-label">Edit By</label>
                    <input id="edit_by" name="edit_by" type="text" class="form-control w-full"
                        placeholder="Edit Name" readonly value="{{ optional($receipt->editedBy)->name }}">

                </div>
                <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                    <label for="edit_date" class="form-label">Edit Date</label>
                    <input id="edit_date" type="date" class="form-control w-full" readonly name="edit_date"
                        value="{{ $receipt ? ($receipt->edit_date ? \Carbon\Carbon::parse($receipt->edit_date)->format('Y-m-d') : '') : '' }}">
                </div>



            </div>




        </div>

        <div class="text-right mt-5">
            @livewire('components.assets.button-type', ['color' => 'primary', 'title' => 'บันทึกข้อมูล', 'icon' => 'save', 'action' => '', 'type' => 'submit'])
        </div>

    </form>


</div>
