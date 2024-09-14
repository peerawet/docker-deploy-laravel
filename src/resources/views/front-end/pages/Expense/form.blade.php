@extends('front-end.layouts.main')
@section('title', 'สร้าง Expense')
@section('content')
    <div>
        <div class="text-right mb-5">
            @livewire('components.assets.button', ['color' => 'secondary', 'title' => 'กลับสู่หน้ารายการ Expense', 'icon' => 'corner-up-left', 'route' => 'expense.index', 'action' => ''])

        </div>
        <form action="{{ route('expense.store-update') }}" method="POST">
            @csrf
            <div class="page-header">
                <div class="intro-y box p-5">

                    <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                        <b>1. Payment Voucher Info</b>
                    </header>
                    <div class="grid grid-cols-12 gap-5 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-6">
                            <label for="pv_no" class="form-label">PV No.</label>
                            <input id="pv_no" name="pv_no" type="text" class="form-control w-full"
                                placeholder="PV No." value="{{ $expense ? $expense->pv_no : '' }}">

                        </div>

                        @php
                            use Carbon\Carbon;
                            $currentDate = Carbon::now()->toDateString(); // Get the current date in YYYY-MM-DD format
                        @endphp

                        <div class="intro-y col-span-12 lg:col-span-6">
                            <label for="pv_issue_date" class="form-label">PV Issue date</label>
                            <input name="pv_issue_date" id="pv_issue_date" type="date" class="form-control"
                                placeholder="" value="{{ $expense ? $expense->pv_issue_date : $currentDate }}">
                        </div>




                        <div class="intro-y col-span-12 lg:col-span-6">
                            <label for="payee" class="form-label">Payee</label>
                            <select id="payee" name="payee_id" class="form-control">
                                @foreach ($payees as $payee)
                                    <option value="{{ $payee->id }}"
                                        {{ $expense && $expense->payee_id == $payee->id ? 'selected' : '' }}>
                                        {{ $payee->payee }}
                                    </option>
                                @endforeach
                            </select>
                            <script>
                                jQuery('#payee').select2();
                            </script>
                        </div>



                        <div class="intro-y col-span-12 lg:col-span-6">
                            <label for="is_vat" class="form-label">Category</label>
                            <select id="category" name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $expense && $expense->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                            <script>
                                jQuery('#category').select2();
                            </script>
                        </div>


                        <div class="intro-y col-span-12 lg:col-span-6">
                            <label for="payment_date" class="form-label">Payment Date</label>
                            <input name="payment_date" id="payment_date" type="date" class="form-control" placeholder=""
                                value="{{ $expense ? $expense->payment_date : $currentDate }}"">
                        </div>

                        <div class="intro-y col-span-12 lg:col-span-6">
                        </div>


                        <div class="intro-y col-span-12 lg:col-span-4">
                            <label>Payment Method</label>
                            <div class="payment-option mt-5">
                                <input type="checkbox" class="form-check-input border payment-method" id="payment-cash"
                                    name="payment_method" value="cash"
                                    {{ $expense && $expense->payment_method === 'cash' ? 'checked' : '' }}>
                                <label for="payment-cash" class="form-label">เงินสด</label>
                            </div>
                            <div class="payment-option mt-5">
                                <input type="checkbox" class="form-check-input border payment-method" id="payment-transfer"
                                    name="payment_method" value="transfer"
                                    {{ $expense && $expense->payment_method === 'transfer' ? 'checked' : '' }}>
                                <label for="payment-transfer" class="form-label">โอนเงิน</label>
                            </div>
                            <div class="payment-option mt-5">
                                <input type="checkbox" class="form-check-input border payment-method" id="payment-check"
                                    name="payment_method" value="check"
                                    {{ $expense && $expense->payment_method === 'check' ? 'checked' : '' }}>
                                <label for="payment-check" class="form-label">เช็คธนาคาร</label>
                            </div>
                        </div>

                        <div class="intro-y col-span-12 lg:col-span-8">
                            <div class="mt-2 bank-details"
                                style="display: {{ $expense && in_array($expense->payment_method, ['transfer', 'check']) ? 'block' : 'none' }};"
                                id="bankFields">
                                <label for="bank" class="form-label">ธนาคาร</label>
                                <input id="bank" name="bank" type="text" class="form-control w-full"
                                    placeholder="ธนาคาร" value="{{ $expense ? $expense->bank : '' }}">
                            </div>
                            <div class="mt-2 bank-details"
                                style="display: {{ $expense && in_array($expense->payment_method, ['transfer', 'check']) ? 'block' : 'none' }};"
                                id="branchFields">
                                <label for="branch" class="form-label">สาขา</label>
                                <input id="branch" name="branch" type="text" class="form-control w-full"
                                    placeholder="สาขา" value="{{ $expense ? $expense->branch : '' }}">
                            </div>
                            <div class="mt-2 bank-details"
                                style="display: {{ $expense && in_array($expense->payment_method, ['transfer', 'check']) ? 'block' : 'none' }};"
                                id="bankNumberFields">
                                <label for="bank_number" class="form_label">เลขที่</label>
                                <input id="bank_number" name="bank_no" type="text" class="form-control w-full"
                                    placeholder="เลขที่" value="{{ $expense ? $expense->bank_no : '' }}">
                            </div>
                        </div>



                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const paymentCash = document.getElementById('payment-cash');
                                const paymentTransfer = document.getElementById('payment-transfer');
                                const paymentCheck = document.getElementById('payment-check');
                                const bankFields = document.getElementById('bankFields');
                                const branchFields = document.getElementById('branchFields');
                                const bankNumberFields = document.getElementById('bankNumberFields');

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
                                    if (isChecked) {
                                        bankFields.style.display = 'block';
                                        branchFields.style.display = 'block';
                                        bankNumberFields.style.display = 'block';
                                    } else {
                                        bankFields.style.display = 'none';
                                        branchFields.style.display = 'none';
                                        bankNumberFields.style.display = 'none';
                                    }
                                }
                            });
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
                        <b>2. Description & Amount</b>
                    </header>
                    <div class="grid grid-cols-12 gap-5 mt-5">
                        <!-- Expense Description Section -->
                        <div class="intro-y col-span-6 lg:col-span-6">
                            <label for="sell_sub_total" class="form-label">Expense Description</label>
                            <div style="display: flex; flex-direction: column; gap: 22px;">
                                <select id="description-1" name="description_1" class="form-control">
                                    @foreach ($expenseDescriptions as $description)
                                        <option value="{{ $description->id }}"
                                            {{ $expense && $expense->description_1 == $description->id ? 'selected' : '' }}>
                                            {{ $description->description }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="description-2" name="description_2" class="form-control">
                                    @foreach ($expenseDescriptions as $description)
                                        <option value="{{ $description->id }}"
                                            {{ $expense && $expense->description_2 == $description->id ? 'selected' : '' }}>
                                            {{ $description->description }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="description-3" name="description_3" class="form-control">
                                    @foreach ($expenseDescriptions as $description)
                                        <option value="{{ $description->id }}"
                                            {{ $expense && $expense->description_3 == $description->id ? 'selected' : '' }}>
                                            {{ $description->description }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="description-4" name="description_4" class="form-control">
                                    @foreach ($expenseDescriptions as $description)
                                        <option value="{{ $description->id }}"
                                            {{ $expense && $expense->description_4 == $description->id ? 'selected' : '' }}>
                                            {{ $description->description }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="description-5" name="description_5" class="form-control">
                                    @foreach ($expenseDescriptions as $description)
                                        <option value="{{ $description->id }}"
                                            {{ $expense && $expense->description_5 == $description->id ? 'selected' : '' }}>
                                            {{ $description->description }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <script>
                                jQuery('#description-1').select2();
                                jQuery('#description-2').select2();
                                jQuery('#description-3').select2();
                                jQuery('#description-4').select2();
                                jQuery('#description-5').select2();
                            </script>
                        </div>

                        <!-- Amount Section -->
                        <div class="intro-y col-span-6 lg:col-span-6">
                            <label class="form-label">Amount</label>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <input type="number" class="form-control w-full" name="amount_1"
                                    value="{{ $expense ? $expense->amount_1 : '' }}">
                                <input type="number" class="form-control w-full" name="amount_2"
                                    value="{{ $expense ? $expense->amount_2 : '' }}">
                                <input type="number" class="form-control w-full" name="amount_3"
                                    value="{{ $expense ? $expense->amount_3 : '' }}">
                                <input type="number" class="form-control w-full" name="amount_4"
                                    value="{{ $expense ? $expense->amount_4 : '' }}">
                                <input type="number" class="form-control w-full" name="amount_5"
                                    value="{{ $expense ? $expense->amount_5 : '' }}">

                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <div class="intro-y box p-5 mt-5">
                <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <b>3. Remark</b>
                </header>

                <div class="grid grid-cols-12 gap-9 mt-5">


                    <div class="intro-y col-span-12 lg:col-span-12">
                        <div class="mt-2">
                            <label for="remark" class="form-label">Remark :</label>
                            <textarea id="remark" name="remark" class="form-control w-full">{{ $expense ? $expense->remark : '' }}</textarea>

                        </div>
                    </div>








                </div>
            </div>

            {{-- <div class="intro-y box p-5 mt-5">
                <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <b>4. Operation</b>
                </header>
                <div class="grid grid-cols-12 gap-6 mt-5">



                    <div class="intro-y col-span-12 lg:col-span-3 mt-2">
                        <label for="prepared_by" class="form-label">Prepared By</label>
                        <input id="prepared_by" name="prepared_by_name" type="text" class="form-control w-full"
                            placeholder="Edit Name" readonly value="{{ auth()->user()->name }}">
                        <input type="hidden" name="prepared_by" value="{{ auth()->user()->id }}">
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




            </div> --}}

            <div class="text-right mt-5">
                @livewire('components.assets.button-type', ['color' => 'primary', 'title' => 'บันทึกข้อมูล', 'icon' => 'save', 'action' => '', 'type' => 'submit'])
            </div>

        </form>


    </div>
    <!-- Script for confirmation before closing the page -->
    <script>
        // Function to handle the beforeunload event
        function handleBeforeUnload(e) {
            var confirmationMessage = 'Are you sure you want to leave? Your changes may not be saved.';
            e.preventDefault();
            e.returnValue = confirmationMessage;
            return confirmationMessage;
        }

        // Add the beforeunload event listener when the page loads
        window.addEventListener('beforeunload', handleBeforeUnload);

        // Add event listener to the form submit event to remove the beforeunload listener
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');
            form.addEventListener('submit', function() {
                window.removeEventListener('beforeunload', handleBeforeUnload);
            });
        });
    </script>

@endsection
