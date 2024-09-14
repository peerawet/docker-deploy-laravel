<div>
    <div class="text-right mb-5">
        <a href="{{ route('drafts.index') }}" class="btn btn-outline-secondary btn-rounded w-36 mr-2 mb-2">
            <i class="fas fa-corner-up-left mr-2"></i> กลับสู่หน้ารายการ Draft
        </a>

        <a href="{{ route('drafts.report.accident') }}" class="btn btn-outline-pending btn-rounded w-36 mr-2 mb-2">
            <i class="fas fa-file-text mr-2"></i> Incident Report
        </a>

        <a href="{{ route('drafts.print', ['draftId' => $draft->draft_no]) }}"
            class="btn btn-outline-success btn-rounded w-36 mr-2 mb-2" target="_blank">
            <i class="fas fa-print mr-2"></i> Preview
        </a>




    </div>


    <div class="intro-y box p-5">

        <form action="{{ route('drafts.post', ['draftId' => $draft->draft_no]) }}" method="POST">
            @csrf
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-6">


                    <div class="intro-y box p-5">
                        <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                            <b>1. Draft Information</b>
                        </header>

                        <div class="intro-y col-span-12 lg:col-span-6 mt-4">
                            <style>
                                .custom-dropdown-booking {
                                    position: absolute;
                                    background-color: white;
                                    border: 1px solid #ccc;
                                    max-height: 200px;
                                    overflow-y: auto;
                                    z-index: 1000;
                                    top: 65px;

                                }

                                .dropdown-item {
                                    padding: 8px 16px;
                                    cursor: pointer;
                                }

                                .dropdown-item:hover {
                                    background-color: #f1f1f1;
                                }
                            </style>
                            <label for="booking_no" class="form-label">Booking No.</label>
                            <div class="input-group">
                                <input type="text" id="booking_no_input" class="form-control flex-1 mr-2"
                                    placeholder="Type to search booking" autocomplete="off" name="booking_no"
                                    value="{{ $draft->booking_no ?? '' }}">
                                <div id="booking_no_dropdown" class="custom-dropdown-booking" style="display: none;">
                                </div>
                                <button type="button" id="checkBookingBtn" class="btn btn-primary">Check
                                    Existence</button>
                            </div>


                            <div id="bookingResponse" class="text-muted mt-5"></div>



                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            {{-- type to search booking no --}}
                            <script>
                                jQuery(document).ready(function() {
                                    var allBookingNumbers = {!! json_encode($all_truck_waybills->pluck('invoice_no')) !!};
                                    console.log(allBookingNumbers);

                                    jQuery('#booking_no_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#booking_no_dropdown');
                                        dropdown.empty();

                                        // Filter booking numbers based on input
                                        var filteredBookingNumbers = allBookingNumbers.filter(function(bookingNo) {
                                            return bookingNo.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredBookingNumbers.forEach(function(bookingNo) {
                                            dropdownHTML += '<div class="dropdown-item">' + bookingNo + '</div>';
                                        });

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredBookingNumbers.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#booking_no_dropdown').on('click', '.dropdown-item', function() {
                                        var selectedBookingNo = jQuery(this).text();
                                        console.log(selectedBookingNo);
                                        jQuery('#booking_no_input').val(selectedBookingNo);
                                        jQuery('#booking_no_dropdown').hide();
                                    });

                                    // Handle click on "Check Existence" button
                                    jQuery('#checkBookingBtn').click(function() {
                                        var bookingNo = jQuery('#booking_no_input').val();
                                        if (bookingNo) {
                                            // Perform AJAX request
                                            jQuery.ajax({
                                                url: "{{ route('checkBooking') }}",
                                                type: "POST",
                                                data: {
                                                    _token: "{{ csrf_token() }}",
                                                    booking_no: bookingNo
                                                },
                                                success: function(response) {
                                                    var responseText = response.exists ? "Booking number exists!" :
                                                        "Booking number doesn't exist.";
                                                    jQuery('#bookingResponse').text(responseText);
                                                    jQuery('#bookingResponse').removeClass().addClass(response.exists ?
                                                        'text-warning' : 'text-success');
                                                },
                                                error: function(xhr, status, error) {
                                                    jQuery('#bookingResponse').text(
                                                        "An error occurred while checking the booking number. Please try again."
                                                    );
                                                    jQuery('#bookingResponse').removeClass().addClass('text-danger');
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        } else {
                                            jQuery('#bookingResponse').text("Please enter a booking number.");
                                            jQuery('#bookingResponse').removeClass().addClass('text-danger');
                                        }
                                    });
                                });
                            </script>
                            {{-- check existing code --}}
                            <script>
                                jQuery(document).ready(function() {
                                    const draft = @json($draft);
                                    console.log(draft);

                                    jQuery('#checkBookingBtn').click(function() {
                                        var bookingNo = jQuery('#booking_no').val();
                                        if (bookingNo) {
                                            jQuery.ajax({
                                                url: "{{ route('checkBooking') }}",
                                                type: "POST",
                                                data: {
                                                    _token: "{{ csrf_token() }}",
                                                    booking_no: bookingNo
                                                },
                                                success: function(response) {
                                                    var responseText = response.exists ? "Booking number exists!" :
                                                        "Booking number doesn't exist.";
                                                    jQuery('#bookingResponse').text(responseText);
                                                    jQuery('#bookingResponse').removeClass().addClass(response.exists ?
                                                        'text-warning' : 'text-success');
                                                },
                                                error: function(xhr, status, error) {
                                                    jQuery('#bookingResponse').text(
                                                        "An error occurred while checking the booking number. Please try again."
                                                    );
                                                    jQuery('#bookingResponse').removeClass().addClass('text-danger');
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        } else {
                                            jQuery('#bookingResponse').text("Please enter a booking number.");
                                            jQuery('#bookingResponse').removeClass().addClass('text-danger');
                                        }
                                    });
                                });
                            </script>


                        </div>

                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <label for="customer_ref" class="form-label">Customer Reference</label>
                            <div class="input-group">
                                <input id="customer_ref" name="customer_ref" type="text"
                                    class="form-control flex-1 mr-2" placeholder="Customer Reference"
                                    value="{{ $draft->customer_ref ?? '' }}">


                                <button type="button" id="checkCustomerRefBtn" class="btn btn-primary">Check
                                    Existence</button>
                            </div>
                            <div id="customerRefResponse" class="text-muted mt-5"></div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                jQuery(document).ready(function() {
                                    jQuery('#checkCustomerRefBtn').click(function() {
                                        var customerRef = jQuery('#customer_ref').val();
                                        if (customerRef) {
                                            jQuery.ajax({
                                                url: "{{ route('checkCustomerRef') }}",
                                                type: "POST",
                                                data: {
                                                    _token: "{{ csrf_token() }}",
                                                    customer_ref: customerRef
                                                },
                                                success: function(response) {
                                                    var responseText = response.exists ? "Customer reference exists!" :
                                                        "Customer reference doesn't exist.";
                                                    jQuery('#customerRefResponse').text(responseText);
                                                    jQuery('#customerRefResponse').removeClass().addClass(response
                                                        .exists ?
                                                        'text-warning' : 'text-success');
                                                },
                                                error: function(xhr, status, error) {
                                                    jQuery('#customerRefResponse').text(
                                                        "An error occurred while checking the customer reference. Please try again."
                                                    );
                                                    jQuery('#customerRefResponse').removeClass().addClass(
                                                        'text-danger');
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        } else {
                                            jQuery('#customerRefResponse').text("Please enter a customer reference.");
                                            jQuery('#customerRefResponse').removeClass().addClass('text-danger');
                                        }
                                    });
                                });
                            </script>
                        </div>

                        {{-- style for type to search --}}
                        <style>
                            .custom-dropdown {
                                position: absolute;
                                background-color: white;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                                max-height: 200px;
                                overflow-y: auto;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                z-index: 1000;
                            }

                            .custom-dropdown a {
                                display: block;
                                padding: 10px;
                                text-decoration: none;
                                color: #333;
                            }

                            .custom-dropdown a:hover {
                                background-color: #f0f0f0;
                            }
                        </style>

                        {{-- shipper type to search --}}

                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="shipper_input" class="form-label">Shipper</label>
                                <input type="text" id="shipper_input" name="shipper_name" class="form-control"
                                    placeholder="Type to search shipper" autocomplete="off"
                                    value="{{ $draft->shipper->name ?? '' }}">

                                <!-- Hidden input field to store the selected shipper's ID -->
                                <input type="hidden" id="shipper_id" name="shipper_id">
                                <div id="shipper_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-6 mt-5" style="color: blue;">
                                <span class="selected_contact"></span>
                                <span class="selected_tel"></span>
                                <span class="selected_address"></span>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allShippers = {!! json_encode($all_shippers) !!};

                                    jQuery('#shipper_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#shipper_dropdown');
                                        dropdown.empty();

                                        // Filter shipper options based on input
                                        var filteredShippers = allShippers.filter(function(shipper) {
                                            return shipper.name.toLowerCase().indexOf(input) !== -1;
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredShippers.forEach(function(shipper) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + shipper.id +
                                                '" data-contact="' + shipper.contact + '" data-tel="' + shipper.tel +
                                                '" data-address="' + shipper.address + '" data-sale-id="' + shipper
                                                .sale_id +
                                                '">' + shipper.name + '</a>';
                                        });

                                        // Option to add a new shipper if no matches found
                                        if (filteredShippers.length === 0) {
                                            dropdownHTML += '<a class="dropdown-item new-shipper" href="#">Create new shipper: ' +
                                                input + '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredShippers.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#shipper_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-shipper')) {
                                            // Create new shipper (set to be handled by the form submission)
                                            var shipperName = jQuery('#shipper_input').val();
                                            jQuery('#shipper_name').val(shipperName);
                                            jQuery('#shipper_id').val('');
                                        } else {
                                            // Existing shipper selected
                                            var id = selectedItem.data('id');
                                            var contact = selectedItem.data('contact');
                                            var tel = selectedItem.data('tel');
                                            var address = selectedItem.data('address');
                                            var sale = selectedItem.data('sale-id');
                                            // Set the selected shipper's ID to the hidden input field
                                            jQuery('#shipper_id').val(id);
                                            jQuery('#sale_id').val(sale);

                                            // Update the UI with selected shipper's details
                                            jQuery('.selected_contact').html("Contact: " + contact + "<br>");
                                            jQuery('.selected_tel').html("Tel: " + tel + "<br>");
                                            jQuery('.selected_address').html("Address: " + address);

                                            // Set the input field value with the selected shipper's name
                                            jQuery('#shipper_input').val(selectedItem.text());

                                            // Set the shipper name hidden input
                                            jQuery('#shipper_name').val(selectedItem.text());
                                        }

                                        // Hide the dropdown
                                        jQuery('#shipper_dropdown').hide();
                                    });

                                    // Before submitting the form, ensure the shipper name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#shipper_input').val().toLowerCase();
                                        var matchingShipper = allShippers.find(function(shipper) {
                                            return shipper.name.toLowerCase() === input;
                                        });

                                        if (matchingShipper) {
                                            jQuery('#shipper_id').val(matchingShipper.id);
                                            jQuery('#shipper_name').val(matchingShipper.name);
                                        } else {
                                            jQuery('#shipper_name').val(jQuery('#shipper_input').val());
                                            jQuery('#shipper_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>


                        {{-- agent type to search --}}
                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="agent_input" class="form-label">Agent</label>
                                <input type="text" id="agent_input" name="agent_name" class="form-control"
                                    placeholder="Type to search agent" autocomplete="off"
                                    value="{{ $draft->agent->name ?? '' }}">

                                <!-- Hidden input field to store the selected agent's ID -->
                                <input type="hidden" id="agent_id" name="agent_id">
                                <div id="agent_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-6 mt-5" style="color: blue;">
                                <span class="selected_agent_contact"></span>
                                <span class="selected_agent_tel"></span>
                                <span class="selected_agent_id"></span>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allAgents = {!! json_encode($all_agents) !!};

                                    jQuery('#agent_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#agent_dropdown');
                                        dropdown.empty();

                                        // Filter agent options based on input
                                        var filteredAgents = allAgents.filter(function(agent) {
                                            return agent.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredAgents.forEach(function(agent) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + agent.agent_id +
                                                '" data-contact="' + agent.contact + '" data-tel="' + agent.tel +
                                                '">' + agent.name + '</a>';
                                        });

                                        // Option to add a new agent if no matches found
                                        if (filteredAgents.length === 0) {
                                            dropdownHTML += '<a class="dropdown-item new-agent" href="#">Create new agent: ' +
                                                input + '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredAgents.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#agent_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-agent')) {
                                            // Create new agent (set to be handled by the form submission)
                                            var agentName = jQuery('#agent_input').val();
                                            jQuery('#agent_name').val(agentName);
                                            jQuery('#agent_id').val('');
                                        } else {
                                            // Existing agent selected
                                            var id = selectedItem.data('id');
                                            var contact = selectedItem.data('contact');
                                            var tel = selectedItem.data('tel');

                                            // Set the selected agent's ID to the hidden input field
                                            jQuery('#agent_id').val(id);

                                            // Update the UI with selected agent's details
                                            jQuery('.selected_agent_contact').html("Contact: " + contact + "<br>");
                                            jQuery('.selected_agent_tel').html("Tel: " + tel + "<br>");
                                            jQuery('.selected_agent_id').html("Agent ID: " + id);

                                            // Set the input field value with the selected agent's name
                                            jQuery('#agent_input').val(selectedItem.text());

                                            // Set the agent name hidden input
                                            jQuery('#agent_name').val(selectedItem.text());
                                        }

                                        // Hide the dropdown
                                        jQuery('#agent_dropdown').hide();
                                    });

                                    // Before submitting the form, ensure the agent name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#agent_input').val().toLowerCase();
                                        var matchingAgent = allAgents.find(function(agent) {
                                            return agent.name.toLowerCase() === input;
                                        });

                                        if (matchingAgent) {
                                            jQuery('#agent_id').val(matchingAgent.id);
                                            jQuery('#agent_name').val(matchingAgent.name);
                                        } else {
                                            jQuery('#agent_name').val(jQuery('#agent_input').val());
                                            jQuery('#agent_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>


                        {{-- container type --}}
                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 lg:col-span-4">
                                    <label for="qty" class="form-label">Volume</label>
                                    <input id="qty" name="qty" type="text" class="form-control w-full"
                                        placeholder="Volume" value="{{ $draft->qty ?? '' }}">
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <label for="container_type_input" class="form-label">Container
                                        Type</label>
                                    <input type="text" id="container_type_input" name="container_type_name"
                                        class="form-control" placeholder="Type to search container type"
                                        autocomplete="off" value="{{ $draft->containerType->size ?? '' }}">
                                    <!-- Hidden input field to store the selected container type's ID -->
                                    <input type="hidden" id="container_type_id" name="container_type_id">
                                    <div id="container_type_dropdown" class="custom-dropdown" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <label for="temp" class="form-label">Temp</label>
                                    <input id="temp" name="temp" type="text" class="form-control w-full"
                                        placeholder="Temp" value="{{ $draft->temp ?? '' }}">
                                </div>
                            </div>
                            <script>
                                jQuery(document).ready(function() {
                                    var allContainerTypes = {!! json_encode($all_container_types) !!};

                                    jQuery('#container_type_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#container_type_dropdown');
                                        dropdown.empty();

                                        // Filter container type options based on input
                                        var filteredContainerTypes = allContainerTypes.filter(function(containerType) {
                                            return containerType.size.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredContainerTypes.forEach(function(containerType) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + containerType
                                                .id + '">' +
                                                containerType.size + '</a>';
                                        });

                                        // Option to add a new container type if no matches found
                                        if (filteredContainerTypes.length === 0) {
                                            dropdownHTML +=
                                                '<a class="dropdown-item new-container-type" href="#">Create new container type: ' +
                                                input +
                                                '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredContainerTypes.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#container_type_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-container-type')) {
                                            // Create new container type (set to be handled by the form submission)
                                            var containerTypeName = jQuery('#container_type_input').val();
                                            jQuery('#container_type_name').val(containerTypeName);
                                            jQuery('#container_type_id').val('');

                                            // Hide the dropdown
                                            jQuery('#container_type_dropdown').hide();
                                        } else {
                                            // Existing container type selected
                                            var containerTypeId = selectedItem.data('id');

                                            // Set the selected container type's ID to the hidden input field
                                            jQuery('#container_type_id').val(containerTypeId);

                                            // Set the input field value with the selected container type's name
                                            jQuery('#container_type_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#container_type_dropdown').hide();
                                        }
                                    });

                                    // Before submitting the form, ensure the container type name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#container_type_input').val().toLowerCase();
                                        var matchingContainerType = allContainerTypes.find(function(containerType) {
                                            return containerType.size.toLowerCase() === input;
                                        });

                                        if (matchingContainerType) {
                                            jQuery('#container_type_id').val(matchingContainerType.id);
                                        } else {
                                            jQuery('#container_type_name').val(jQuery('#container_type_input').val());
                                            jQuery('#container_type_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>





                        {{-- Port of Destination --}}
                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="destination_port_input" class="form-label">Port of
                                    Destination</label>
                                <input type="text" id="destination_port_input" name="destination_port_name"
                                    class="form-control" placeholder="Type to search port" autocomplete="off"
                                    value="{{ $draft->destinationPort->name ?? '' }}">
                                <!-- Hidden input field to store the selected destination port's ID -->
                                <input type="hidden" id="destination_port_id" name="destination_port_id">
                                <div id="destination_port_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allDestinationPorts = {!! json_encode($all_destination_ports) !!};

                                    jQuery('#destination_port_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#destination_port_dropdown');
                                        dropdown.empty();

                                        // Filter destination port options based on input
                                        var filteredPorts = allDestinationPorts.filter(function(port) {
                                            return port.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredPorts.forEach(function(port) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + port.id + '">' +
                                                port.name + '</a>';
                                        });

                                        // Option to add a new port if no matches found
                                        if (filteredPorts.length === 0) {
                                            dropdownHTML += '<a class="dropdown-item new-port" href="#">Create new port: ' + input +
                                                '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredPorts.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#destination_port_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-port')) {
                                            // Create new port (set to be handled by the form submission)
                                            var portName = jQuery('#destination_port_input').val();
                                            jQuery('#destination_port_name').val(portName);
                                            jQuery('#destination_port_id').val('');

                                            // Hide the dropdown
                                            jQuery('#destination_port_dropdown').hide();
                                        } else {
                                            // Existing port selected
                                            var portId = selectedItem.data('id');

                                            // Set the selected destination port's ID to the hidden input field
                                            jQuery('#destination_port_id').val(portId);

                                            // Set the input field value with the selected destination port's name
                                            jQuery('#destination_port_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#destination_port_dropdown').hide();
                                        }
                                    });

                                    // Before submitting the form, ensure the destination port name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#destination_port_input').val().toLowerCase();
                                        var matchingPort = allDestinationPorts.find(function(port) {
                                            return port.name.toLowerCase() === input;
                                        });

                                        if (matchingPort) {
                                            jQuery('#destination_port_id').val(matchingPort.id);
                                        } else {
                                            jQuery('#destination_port_name').val(jQuery('#destination_port_input').val());
                                            jQuery('#destination_port_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>



                        {{-- Transhipment Port --}}
                        <div id="transhipment-port-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="transhipment_port_input" class="form-label">Transhipment
                                    Port</label>
                                <input type="text" id="transhipment_port_input" name="transhipment_port_name"
                                    class="form-control" placeholder="Type to search port" autocomplete="off"
                                    value="{{ $draft->transhipmentPort->name ?? '' }}">
                                <!-- Hidden input field to store the selected transhipment port's ID -->
                                <input type="hidden" id="transhipment_port_id" name="transhipment_port_id">
                                <div id="transhipment_port_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allTranshipmentPorts = {!! json_encode($all_transhipment_ports) !!};

                                    jQuery('#transhipment_port_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#transhipment_port_dropdown');
                                        dropdown.empty();

                                        // Filter transhipment port options based on input
                                        var filteredPorts = allTranshipmentPorts.filter(function(port) {
                                            return port.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredPorts.forEach(function(port) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + port.id + '">' +
                                                port.name + '</a>';
                                        });

                                        // Option to add a new port if no matches found
                                        if (filteredPorts.length === 0) {
                                            dropdownHTML += '<a class="dropdown-item new-port" href="#">Create new port: ' + input +
                                                '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredPorts.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#transhipment_port_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-port')) {
                                            // Create new port (set to be handled by the form submission)
                                            var portName = jQuery('#transhipment_port_input').val();
                                            jQuery('#transhipment_port_name').val(portName);
                                            jQuery('#transhipment_port_id').val('');

                                            // Hide the dropdown
                                            jQuery('#transhipment_port_dropdown').hide();
                                        } else {
                                            // Existing port selected
                                            var portId = selectedItem.data('id');

                                            // Set the selected transhipment port's ID to the hidden input field
                                            jQuery('#transhipment_port_id').val(portId);

                                            // Set the input field value with the selected transhipment port's name
                                            jQuery('#transhipment_port_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#transhipment_port_dropdown').hide();
                                        }
                                    });

                                    // Before submitting the form, ensure the transhipment port name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#transhipment_port_input').val().toLowerCase();
                                        var matchingPort = allTranshipmentPorts.find(function(port) {
                                            return port.name.toLowerCase() === input;
                                        });

                                        if (matchingPort) {
                                            jQuery('#transhipment_port_id').val(matchingPort.id);
                                        } else {
                                            jQuery('#transhipment_port_name').val(jQuery('#transhipment_port_input').val());
                                            jQuery('#transhipment_port_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>


                        {{-- Port of Loading --}}
                        <div id="loading-port-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="loading_port_input" class="form-label">Loading Port</label>
                                <input type="text" id="loading_port_input" name="loading_port_name"
                                    class="form-control" placeholder="Type to search port" autocomplete="off"
                                    value="{{ $draft->loadingPort->name ?? '' }}">
                                <!-- Hidden input field to store the selected loading port's ID -->
                                <input type="hidden" id="loading_port_id" name="loading_port_id">
                                <div id="loading_port_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allLoadingPorts = {!! json_encode($all_loading_ports) !!};

                                    jQuery('#loading_port_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#loading_port_dropdown');
                                        dropdown.empty();

                                        // Filter loading port options based on input
                                        var filteredPorts = allLoadingPorts.filter(function(port) {
                                            return port.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredPorts.forEach(function(port) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + port.id + '">' +
                                                port.name + '</a>';
                                        });

                                        // Option to add a new port if no matches found
                                        if (filteredPorts.length === 0) {
                                            dropdownHTML += '<a class="dropdown-item new-port" href="#">Create new port: ' + input +
                                                '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        if (filteredPorts.length > 0 || input !== '') {
                                            dropdown.show();
                                        } else {
                                            dropdown.hide();
                                        }
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#loading_port_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-port')) {
                                            // Create new port (set to be handled by the form submission)
                                            var portName = jQuery('#loading_port_input').val();
                                            jQuery('#loading_port_name').val(portName);
                                            jQuery('#loading_port_id').val('');

                                            // Hide the dropdown
                                            jQuery('#loading_port_dropdown').hide();
                                        } else {
                                            // Existing port selected
                                            var portId = selectedItem.data('id');

                                            // Set the selected loading port's ID to the hidden input field
                                            jQuery('#loading_port_id').val(portId);

                                            // Set the input field value with the selected loading port's name
                                            jQuery('#loading_port_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#loading_port_dropdown').hide();
                                        }
                                    });

                                    // Before submitting the form, ensure the loading port name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#loading_port_input').val().toLowerCase();
                                        var matchingPort = allLoadingPorts.find(function(port) {
                                            return port.name.toLowerCase() === input;
                                        });

                                        if (matchingPort) {
                                            jQuery('#loading_port_id').val(matchingPort.id);
                                        } else {
                                            jQuery('#loading_port_name').val(jQuery('#loading_port_input').val());
                                            jQuery('#loading_port_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>

                        {{-- pick-up-first-container-section --}}
                        <div id="pick-up-first-container-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">
                                <div class="intro-y col-span-3 lg:col-span-3">
                                    <label for="pick_up_date" class="form-label">Pick Up Date</label>
                                    <input id="pick_up_date" name="pick_up_date" type="date"
                                        class="form-control w-full"
                                        value="{{ $draft ? ($draft->pick_up_date ? \Carbon\Carbon::parse($draft->pick_up_date)->format('Y-m-d') : '') : '' }}">



                                </div>
                                <div class="intro-y col-span-3 lg:col-span-3">
                                    <label for="first_container_return_date" class="form-label">1ST Container
                                        Return
                                        Date</label>
                                    <input id="first_container_return_date" name="first_container_return_date"
                                        type="date" class="form-control w-full"
                                        value="{{ $draft ? ($draft->first_container_return_date ? \Carbon\Carbon::parse($draft->first_container_return_date)->format('Y-m-d') : '') : '' }}">


                                </div>

                            </div>
                        </div>


                        {{-- Loading Date time --}}
                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">
                                <div class="intro-y col-span-12 lg:col-span-6">
                                    <label for="loading_date" class="form-label">Loading Date</label>
                                    <input id="loading_date" name="loading_date" type="date"
                                        class="form-control w-full"
                                        value="{{ $draft && $draft->loading_date ? \Carbon\Carbon::parse($draft->loading_date)->format('Y-m-d') : '' }}">
                                </div>
                                <div class="intro-y col-span-12 lg:col-span-6">
                                    <label for="loading_time" class="form-label">Loading Time</label>
                                    <input id="loading_time" name="loading_time" type="time"
                                        class="form-control w-full" placeholder="Loading Time"
                                        value="{{ $draft && $draft->loading_time ? $draft->loading_time : '' }}">
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        flatpickr("#loading_time", {
                                            enableTime: true,
                                            noCalendar: true,
                                            dateFormat: "H:i",
                                            time_24hr: true
                                        });
                                    });
                                </script>
                            </div>

                        </div>

                        {{-- return date --}}
                        <div id="return-date-section" class="intro-y col-span-3 lg:col-span-3 mt-5">
                            <label for="return_date" class="form-label">Return Date</label>
                            <input id="return_date" name="return_date" type="date" class="form-control w-full"
                                value="{{ $draft && $draft->return_date ? \Carbon\Carbon::parse($draft->return_date)->format('Y-m-d') : '' }}">
                        </div>

                        {{-- feeder type to search  --}}
                        <div id="feeder-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">

                                <div class="intro-y col-span-12 lg:col-span-6">
                                    <div class="dropdown">
                                        <label for="feeder_input" class="form-label">Feeder</label>
                                        <input type="text" id="feeder_input" name="feeder_name"
                                            class="form-control" placeholder="Type to search feeder"
                                            autocomplete="off" value="{{ $draft->feeder->name ?? '' }}">
                                        <!-- Hidden input field to store the selected feeder's ID -->
                                        <input type="hidden" id="feeder_id" name="feeder_id">
                                        <div id="feeder_dropdown" class="custom-dropdown" style="display: none;">
                                        </div>
                                    </div>

                                    <script>
                                        jQuery(document).ready(function() {
                                            var allFeeders = {!! json_encode($all_feeders) !!};

                                            jQuery('#feeder_input').on('input', function() {
                                                var input = jQuery(this).val().toLowerCase();
                                                var dropdown = jQuery('#feeder_dropdown');
                                                dropdown.empty();

                                                // Filter feeder options based on input
                                                var filteredFeeders = allFeeders.filter(function(feeder) {
                                                    return feeder.name.toLowerCase().includes(input);
                                                });

                                                // Construct HTML for dropdown options
                                                var dropdownHTML = '';
                                                filteredFeeders.forEach(function(feeder) {
                                                    dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + feeder.id +
                                                        '">' + feeder.name + '</a>';
                                                });

                                                // Option to add a new feeder if no matches found
                                                if (filteredFeeders.length === 0) {
                                                    dropdownHTML += '<a class="dropdown-item new-feeder" href="#">Create new feeder: ' +
                                                        input + '</a>';
                                                }

                                                // Set dropdown content
                                                dropdown.html(dropdownHTML);

                                                // Show dropdown if there are filtered options, otherwise hide it
                                                dropdown.toggle(filteredFeeders.length > 0 || input !== '');
                                            });

                                            // Handle click on dropdown item
                                            jQuery('#feeder_dropdown').on('click', '.dropdown-item', function(e) {
                                                e.preventDefault();
                                                var selectedItem = jQuery(this);

                                                if (selectedItem.hasClass('new-feeder')) {
                                                    // Create new feeder (set to be handled by the form submission)
                                                    var feederName = jQuery('#feeder_input').val();
                                                    jQuery('#feeder_name').val(feederName);
                                                    jQuery('#feeder_id').val('');

                                                    // Hide the dropdown
                                                    jQuery('#feeder_dropdown').hide();
                                                } else {
                                                    // Existing feeder selected
                                                    var feederId = selectedItem.data('id');

                                                    // Set the selected feeder's ID to the hidden input field
                                                    jQuery('#feeder_id').val(feederId);

                                                    // Set the input field value with the selected feeder's name
                                                    jQuery('#feeder_input').val(selectedItem.text());

                                                    // Hide the dropdown
                                                    jQuery('#feeder_dropdown').hide();
                                                }
                                            });

                                            // Before submitting the form, ensure the feeder name and ID are set correctly
                                            jQuery('#draft_form').on('submit', function() {
                                                var input = jQuery('#feeder_input').val().toLowerCase();
                                                var matchingFeeder = allFeeders.find(function(feeder) {
                                                    return feeder.name.toLowerCase() === input;
                                                });

                                                if (matchingFeeder) {
                                                    jQuery('#feeder_id').val(matchingFeeder.id);
                                                } else {
                                                    jQuery('#feeder_name').val(jQuery('#feeder_input').val());
                                                    jQuery('#feeder_id').val('');
                                                }
                                            });
                                        });
                                    </script>
                                </div>



                                <div class="intro-y col-span-12 lg:col-span-6">
                                    <label for="voy_feeder" class="form-label">Voyage</label>
                                    <input id="voy_feeder" name="voy_feeder" type="text" class="form-control"
                                        placeholder="Voy" value="{{ $draft->voy_feeder ?? '' }}">
                                </div>
                            </div>
                        </div>


                        {{-- vessel type to search  --}}
                        <div id="vessel-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">


                                <div class="intro-y col-span-12 lg:col-span-6">
                                    <div class="dropdown">
                                        <label for="vessel_input" class="form-label">Vessel</label>
                                        <input type="text" id="vessel_input" name="vessel_name"
                                            class="form-control" placeholder="Type to search vessel"
                                            autocomplete="off" value="{{ $draft->vessel->name ?? '' }}">
                                        <!-- Hidden input field to store the selected vessel's ID -->
                                        <input type="hidden" id="vessel_id" name="vessel_id">
                                        <div id="vessel_dropdown" class="custom-dropdown" style="display: none;">
                                        </div>
                                    </div>

                                    <script>
                                        jQuery(document).ready(function() {
                                            var allVessels = {!! json_encode($all_vessels) !!};

                                            jQuery('#vessel_input').on('input', function() {
                                                var input = jQuery(this).val().toLowerCase();
                                                var dropdown = jQuery('#vessel_dropdown');
                                                dropdown.empty();

                                                // Filter vessel options based on input
                                                var filteredVessels = allVessels.filter(function(vessel) {
                                                    return vessel.name.toLowerCase().includes(input);
                                                });

                                                // Construct HTML for dropdown options
                                                var dropdownHTML = '';
                                                filteredVessels.forEach(function(vessel) {
                                                    dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + vessel.id +
                                                        '">' + vessel.name + '</a>';
                                                });

                                                // Option to add a new vessel if no matches found
                                                if (filteredVessels.length === 0) {
                                                    dropdownHTML += '<a class="dropdown-item new-vessel" href="#">Create new vessel: ' +
                                                        input + '</a>';
                                                }

                                                // Set dropdown content
                                                dropdown.html(dropdownHTML);

                                                // Show dropdown if there are filtered options, otherwise hide it
                                                dropdown.toggle(filteredVessels.length > 0 || input !== '');
                                            });

                                            // Handle click on dropdown item
                                            jQuery('#vessel_dropdown').on('click', '.dropdown-item', function(e) {
                                                e.preventDefault();
                                                var selectedItem = jQuery(this);

                                                if (selectedItem.hasClass('new-vessel')) {
                                                    // Create new vessel (set to be handled by the form submission)
                                                    var vesselName = jQuery('#vessel_input').val();
                                                    jQuery('#vessel_name').val(vesselName);
                                                    jQuery('#vessel_id').val('');

                                                    // Hide the dropdown
                                                    jQuery('#vessel_dropdown').hide();
                                                } else {
                                                    // Existing vessel selected
                                                    var vesselId = selectedItem.data('id');

                                                    // Set the selected vessel's ID to the hidden input field
                                                    jQuery('#vessel_id').val(vesselId);

                                                    // Set the input field value with the selected vessel's name
                                                    jQuery('#vessel_input').val(selectedItem.text());

                                                    // Hide the dropdown
                                                    jQuery('#vessel_dropdown').hide();
                                                }
                                            });

                                            // Before submitting the form, ensure the vessel name and ID are set correctly
                                            jQuery('#draft_form').on('submit', function() {
                                                var input = jQuery('#vessel_input').val().toLowerCase();
                                                var matchingVessel = allVessels.find(function(vessel) {
                                                    return vessel.name.toLowerCase() === input;
                                                });

                                                if (matchingVessel) {
                                                    jQuery('#vessel_id').val(matchingVessel.id);
                                                } else {
                                                    jQuery('#vessel_name').val(jQuery('#vessel_input').val());
                                                    jQuery('#vessel_id').val('');
                                                }
                                            });
                                        });
                                    </script>
                                </div>


                                <div class="intro-y col-span-12 lg:col-span-6">
                                    <label for="voy_vessel" class="form-label">Voyage</label>
                                    <input id="voy_vessel" type="text" class="form-control" placeholder="Voy"
                                        name="voy_vessel" value="{{ $draft->voy_vessel ?? '' }}">
                                </div>
                            </div>
                        </div>

                        {{-- ETD ETA --}}
                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">

                                <div id="ETD-section" class="intro-y col-span-2 lg:col-span-2">
                                    <label for="ETD_date" class="form-label">ETD</label>
                                    <input id="ETD_date" name="ETD_date" type="date" class="form-control w-full"
                                        placeholder="ETD Date"
                                        value="{{ $draft && $draft->ETD_date ? \Carbon\Carbon::parse($draft->ETD_date)->format('Y-m-d') : '' }}">


                                </div>

                                <div class="intro-y col-span-3 lg:col-span-3">
                                    <label for="ETA_date" class="form-label">ETA</label>
                                    <input id="ETA_date" type="date" class="form-control w-full" name="ETA_date"
                                        placeholder="ETA Date"
                                        value="{{ $draft && $draft->ETA_date ? \Carbon\Carbon::parse($draft->ETA_date)->format('Y-m-d') : '' }}">


                                </div>

                            </div>
                        </div>

                        {{-- closing date time --}}
                        <div id="closing-date-time-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">
                                <div class="intro-y col-span-3 lg:col-span-3">
                                    <label for="closing_date" class="form-label">Closing Date</label>
                                    <input id="closing_date" type="date" class="form-control"
                                        placeholder="Closing Date" name="closing_date"
                                        value="{{ $draft && $draft->closing_date ? \Carbon\Carbon::parse($draft->closing_date)->format('Y-m-d') : '' }}">

                                </div>
                                <div class="intro-y col-span-2 lg:col-span-2">
                                    <label for="closing_time" class="form-label">Closing Time</label>
                                    <input id="closing_time" type="time" class="form-control"
                                        placeholder="Closing Time" name="closing_time" placeholder="Closing Time"
                                        value="{{ $draft && $draft->closing_time ? $draft->closing_time : '' }}">
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            flatpickr("#closing_time", {
                                                enableTime: true,
                                                noCalendar: true,
                                                dateFormat: "H:i",
                                                time_24hr: true
                                            });
                                        });
                                    </script>


                                </div>
                            </div>
                        </div>

                        {{-- depot  type to search --}}
                        <div id="depot-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="depot_input" class="form-label">Depot</label>
                                <input type="text" id="depot_input" name="depot_name" class="form-control"
                                    placeholder="Type to search depot" autocomplete="off"
                                    value="{{ $draft->depot->name ?? '' }}">
                                <!-- Hidden input field to store the selected depot's ID -->
                                <input type="hidden" id="depot_id" name="depot_id">
                                <div id="depot_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-6 mt-5" style="color: blue;">
                                <span class="selected_contact_depot"></span>
                                <span class="selected_tel_depot"></span>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allDepots = {!! json_encode($all_depot) !!};

                                    jQuery('#depot_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#depot_dropdown');
                                        dropdown.empty();

                                        // Filter depot options based on input
                                        var filteredDepots = allDepots.filter(function(depot) {
                                            return depot.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredDepots.forEach(function(depot) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + depot.id +
                                                '" data-contact="' + depot.contact + '" data-tel="' + depot.tel + '">' +
                                                depot.name + '</a>';
                                        });

                                        // Option to add a new depot if no matches found
                                        if (input.trim() !== '') {
                                            dropdownHTML += '<a class="dropdown-item new-depot" href="#">Create new depot: ' +
                                                input + '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        dropdown.toggle(filteredDepots.length > 0 || input !== '');
                                    });

                                    // Handle click on depot dropdown item
                                    jQuery('#depot_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-depot')) {
                                            // Create new depot (set to be handled by the form submission)
                                            var depotName = jQuery('#depot_input').val();
                                            jQuery('#depot_name').val(depotName);
                                            jQuery('#depot_id').val('');

                                            // Hide the dropdown
                                            jQuery('#depot_dropdown').hide();
                                        } else {
                                            // Existing depot selected
                                            var depotId = selectedItem.data('id');

                                            // Set the selected depot's ID to the hidden input field
                                            jQuery('#depot_id').val(depotId);

                                            // Set the input field value with the selected depot's name
                                            jQuery('#depot_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#depot_dropdown').hide();
                                        }

                                        // Display selected depot details
                                        var contact = selectedItem.data('contact');
                                        var tel = selectedItem.data('tel');
                                        $('.selected_contact_depot').text("Contact: " + contact);
                                        $('.selected_tel_depot').text("Tel: " + tel);
                                    });

                                    // Before submitting the form, ensure the depot name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#depot_input').val().toLowerCase();
                                        var matchingDepot = allDepots.find(function(depot) {
                                            return depot.name.toLowerCase() === input;
                                        });

                                        if (matchingDepot) {
                                            jQuery('#depot_id').val(matchingDepot.id);
                                        } else {
                                            jQuery('#depot_name').val(jQuery('#depot_input').val());
                                            jQuery('#depot_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>

                        {{-- gate in depot type to search --}}
                        <div id="gate-in-depot-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="dropdown">
                                <label for="gate_in_depot_input" class="form-label">Gate In Depot</label>
                                <input type="text" id="gate_in_depot_input" name="gate_in_depot_name"
                                    class="form-control" placeholder="Type to search gate in depot"
                                    autocomplete="off" value="{{ $draft->gateInDepot->name ?? '' }}">
                                <!-- Hidden input field to store the selected gate in depot's ID -->
                                <input type="hidden" id="gate_in_depot_id" name="gate_in_depot_id">
                                <div id="gate_in_depot_dropdown" class="custom-dropdown" style="display: none;">
                                </div>
                            </div>

                            <div class="intro-y col-span-12 lg:col-span-6 mt-5" style="color: blue;">
                                <span class="selected_contact_gate_in_depot"></span>
                                <span class="selected_tel_gate_in_depot"></span>
                                <span class="selected_paperless_gate_in_depot"></span>
                            </div>

                            <script>
                                jQuery(document).ready(function() {
                                    var allGateInDepots = {!! json_encode($all_gate_in_depots) !!};

                                    jQuery('#gate_in_depot_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#gate_in_depot_dropdown');
                                        dropdown.empty();

                                        // Filter gate in depot options based on input
                                        var filteredGateInDepots = allGateInDepots.filter(function(gateInDepot) {
                                            return gateInDepot.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredGateInDepots.forEach(function(gateInDepot) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + gateInDepot.id +
                                                '" data-contact="' + gateInDepot.contact + '" data-tel="' + gateInDepot
                                                .tel +
                                                '" data-paperless="' + gateInDepot.paper_less + '">' +
                                                gateInDepot.name + '</a>';
                                        });

                                        // Option to add a new gate in depot if no matches found
                                        if (input.trim() !== '') {
                                            dropdownHTML +=
                                                '<a class="dropdown-item new-gate-in-depot" href="#">Create new gate in depot: ' +
                                                input + '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        dropdown.toggle(filteredGateInDepots.length > 0 || input !== '');
                                    });

                                    // Handle click on gate in depot dropdown item
                                    jQuery('#gate_in_depot_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-gate-in-depot')) {
                                            // Create new gate in depot (set to be handled by the form submission)
                                            var gateInDepotName = jQuery('#gate_in_depot_input').val();
                                            jQuery('#gate_in_depot_name').val(gateInDepotName);
                                            jQuery('#gate_in_depot_id').val('');

                                            // Hide the dropdown
                                            jQuery('#gate_in_depot_dropdown').hide();
                                        } else {
                                            // Existing gate in depot selected
                                            var gateInDepotId = selectedItem.data('id');

                                            // Set the selected gate in depot's ID to the hidden input field
                                            jQuery('#gate_in_depot_id').val(gateInDepotId);

                                            // Set the input field value with the selected gate in depot's name
                                            jQuery('#gate_in_depot_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#gate_in_depot_dropdown').hide();
                                        }

                                        // Display selected gate in depot details
                                        var contact = selectedItem.data('contact');
                                        var tel = selectedItem.data('tel');
                                        var paperless = selectedItem.data('paperless');
                                        $('.selected_contact_gate_in_depot').text("Contact: " + contact);
                                        $('.selected_tel_gate_in_depot').text("Tel: " + tel);
                                        $('.selected_paperless_gate_in_depot').text("Paperless: " + paperless);
                                    });

                                    // Before submitting the form, ensure the gate in depot name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#gate_in_depot_input').val().toLowerCase();
                                        var matchingGateInDepot = allGateInDepots.find(function(gateInDepot) {
                                            return gateInDepot.name.toLowerCase() === input;
                                        });

                                        if (matchingGateInDepot) {
                                            jQuery('#gate_in_depot_id').val(matchingGateInDepot.id);
                                        } else {
                                            jQuery('#gate_in_depot_name').val(jQuery('#gate_in_depot_input').val());
                                            jQuery('#gate_in_depot_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>


                        {{-- VGM Cut-Off --}}
                        <div id="VGM-cut-off-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">
                                <div class="intro-y col-span-2 lg:col-span-2">
                                    <label for="VGM_date" class="form-label">VGM Cut-Off date</label>
                                    <input id="VGM_date" type="date" class="form-control w-full" name="VGM_date"
                                        value="{{ $draft && $draft->VGM_date ? \Carbon\Carbon::parse($draft->VGM_date)->format('Y-m-d') : '' }}">


                                </div>
                                <div class="intro-y col-span-3 lg:col-span-3">
                                    <label for="VGM_time" class="form-label">VGM Cut-Off time</label>
                                    <input id="VGM_time" type="time" class="form-control w-full" name="VGM_time"
                                        placeholder="VGM Cut-Off time"
                                        value="{{ $draft && $draft->VGM_time ? $draft->VGM_time : '' }}">
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            flatpickr("#VGM_time", {
                                                enableTime: true,
                                                noCalendar: true,
                                                dateFormat: "H:i",
                                                time_24hr: true
                                            });
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>


                        {{-- SI Cut-Off --}}
                        <div id="SI-cut-off-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="flex justify-between items-center gap-5">
                                <div class="intro-y col-span-2 lg:col-span-2">
                                    <label for="SI_date" class="form-label">SI Cut-Off date</label>
                                    <input id="SI_date" type="date" class="form-control w-full" name="SI_date"
                                        value="{{ $draft && $draft->SI_date ? \Carbon\Carbon::parse($draft->SI_date)->format('Y-m-d') : '' }}">


                                </div>
                                <div class="intro-y col-span-3 lg:col-span-3">
                                    <label for="SI_time" class="form-label">SI Cut-Off time</label>
                                    <input id="SI_time" type="time" class="form-control w-full" name="SI_time"
                                        placeholder="SI Cut-Off time"
                                        value="{{ $draft && $draft->SI_time ? $draft->SI_time : '' }}">
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            flatpickr("#SI_time", {
                                                enableTime: true,
                                                noCalendar: true,
                                                dateFormat: "H:i",
                                                time_24hr: true
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                        {{-- Loading location --}}
                        <div id="loading-location-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <label for="loading_location_input" class="form-label">Loading Location</label>
                            <input type="text" id="loading_location_input" class="form-control"
                                placeholder="Type to search loading location" autocomplete="off"
                                name="loading_location_name" value="{{ $draft->loadingLocation->name ?? '' }}">
                            <!-- Hidden input field to store the selected loading location's ID -->
                            <input type="hidden" id="loading_location_id" name="loading_location_id">
                            <div id="loading_location_dropdown" class="custom-dropdown" style="display: none;"></div>
                            <script>
                                jQuery(document).ready(function() {
                                    var allLoadingLocations = {!! json_encode($all_loading_locations) !!};

                                    jQuery('#loading_location_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#loading_location_dropdown');
                                        dropdown.empty();

                                        // Filter loading location options based on input
                                        var filteredLoadingLocations = allLoadingLocations.filter(function(location) {
                                            return location.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredLoadingLocations.forEach(function(location) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + location.id +
                                                '">' + location.name + '</a>';
                                        });

                                        // Option to add a new loading location if no matches found
                                        if (filteredLoadingLocations.length === 0) {
                                            dropdownHTML +=
                                                '<a class="dropdown-item new-loading-location" href="#">Create new loading location: ' +
                                                input + '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        dropdown.toggle(filteredLoadingLocations.length > 0 || input !== '');
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#loading_location_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-loading-location')) {
                                            // Create new loading location (set to be handled by the form submission)
                                            var loadingLocationName = jQuery('#loading_location_input').val();
                                            jQuery('#loading_location_name').val(loadingLocationName);
                                            jQuery('#loading_location_id').val('');

                                            // Hide the dropdown
                                            jQuery('#loading_location_dropdown').hide();
                                        } else {
                                            // Existing loading location selected
                                            var loadingLocationId = selectedItem.data('id');

                                            // Set the selected loading location's ID to the hidden input field
                                            jQuery('#loading_location_id').val(loadingLocationId);

                                            // Set the input field value with the selected loading location's name
                                            jQuery('#loading_location_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#loading_location_dropdown').hide();
                                        }
                                    });

                                    // Before submitting the form, ensure the loading location name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#loading_location_input').val().toLowerCase();
                                        var matchingLocation = allLoadingLocations.find(function(location) {
                                            return location.name.toLowerCase() === input;
                                        });

                                        if (matchingLocation) {
                                            jQuery('#loading_location_id').val(matchingLocation.id);
                                        } else {
                                            jQuery('#loading_location_name').val(jQuery('#loading_location_input').val());
                                            jQuery('#loading_location_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>




                        {{-- cross border date --}}
                        <div id="cross-border-date-section" class="intro-y col-span-12 lg:col-span-6 mt-5">

                            <div class="intro-y col-span-2 lg:col-span-2">
                                <label for="cross_border_date" class="form-label">Cross Border Date</label>
                                <input id="cross_border_date" type="date" class="form-control w-full"
                                    name="cross_border_date" placeholder="Cross Border Date"
                                    value="{{ $draft && $draft->cross_border_date ? \Carbon\Carbon::parse($draft->cross_border_date)->format('Y-m-d') : '' }}">
                            </div>
                        </div>

                        {{-- delivery location --}}
                        <div id="delivery-location-section" class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <label for="delivery_location_input" class="form-label">Delivery Location</label>
                            <input type="text" id="delivery_location_input" class="form-control"
                                placeholder="Type to search delivery location" autocomplete="off"
                                value="{{ $draft->deliveryLocation->name ?? '' }}" name="delivery_location_name">
                            <!-- Hidden input field to store the selected delivery location's ID -->
                            <input type="hidden" id="delivery_location_id" name="delivery_location_id">
                            <div id="delivery_location_dropdown" class="custom-dropdown" style="display: none;">
                            </div>
                            <script>
                                jQuery(document).ready(function() {
                                    var allDeliveryLocations = {!! json_encode($all_delivery_locations) !!};

                                    jQuery('#delivery_location_input').on('input', function() {
                                        var input = jQuery(this).val().toLowerCase();
                                        var dropdown = jQuery('#delivery_location_dropdown');
                                        dropdown.empty();

                                        // Filter delivery location options based on input
                                        var filteredDeliveryLocations = allDeliveryLocations.filter(function(location) {
                                            return location.name.toLowerCase().includes(input);
                                        });

                                        // Construct HTML for dropdown options
                                        var dropdownHTML = '';
                                        filteredDeliveryLocations.forEach(function(location) {
                                            dropdownHTML += '<a class="dropdown-item" href="#" data-id="' + location.id +
                                                '">' + location.name + '</a>';
                                        });

                                        // Option to add a new delivery location if no matches found
                                        if (filteredDeliveryLocations.length === 0) {
                                            dropdownHTML +=
                                                '<a class="dropdown-item new-delivery-location" href="#">Create new delivery location: ' +
                                                input + '</a>';
                                        }

                                        // Set dropdown content
                                        dropdown.html(dropdownHTML);

                                        // Show dropdown if there are filtered options, otherwise hide it
                                        dropdown.toggle(filteredDeliveryLocations.length > 0 || input !== '');
                                    });

                                    // Handle click on dropdown item
                                    jQuery('#delivery_location_dropdown').on('click', '.dropdown-item', function(e) {
                                        e.preventDefault();
                                        var selectedItem = jQuery(this);

                                        if (selectedItem.hasClass('new-delivery-location')) {
                                            // Create new delivery location (set to be handled by the form submission)
                                            var deliveryLocationName = jQuery('#delivery_location_input').val();
                                            jQuery('#delivery_location_name').val(deliveryLocationName);
                                            jQuery('#delivery_location_id').val('');

                                            // Hide the dropdown
                                            jQuery('#delivery_location_dropdown').hide();
                                        } else {
                                            // Existing delivery location selected
                                            var deliveryLocationId = selectedItem.data('id');

                                            // Set the selected delivery location's ID to the hidden input field
                                            jQuery('#delivery_location_id').val(deliveryLocationId);

                                            // Set the input field value with the selected delivery location's name
                                            jQuery('#delivery_location_input').val(selectedItem.text());

                                            // Hide the dropdown
                                            jQuery('#delivery_location_dropdown').hide();
                                        }
                                    });

                                    // Before submitting the form, ensure the delivery location name and ID are set correctly
                                    jQuery('#draft_form').on('submit', function() {
                                        var input = jQuery('#delivery_location_input').val().toLowerCase();
                                        var matchingLocation = allDeliveryLocations.find(function(location) {
                                            return location.name.toLowerCase() === input;
                                        });

                                        if (matchingLocation) {
                                            jQuery('#delivery_location_id').val(matchingLocation.id);
                                        } else {
                                            jQuery('#delivery_location_name').val(jQuery('#delivery_location_input').val());
                                            jQuery('#delivery_location_id').val('');
                                        }
                                    });
                                });
                            </script>
                        </div>




                    </div>
                </div>


                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5">
                        <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                            <b>2. Status</b>
                        </header>
                        <div class="mt-5">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="" selected>Select Status</option>
                                <option value="Prepare" {{ $draft && $draft->status == 'Prepare' ? 'selected' : '' }}>
                                    Prepare</option>
                                <option value="Get" {{ $draft && $draft->status == 'Get' ? 'selected' : '' }}>Get
                                </option>
                                <option value="Cancel" {{ $draft && $draft->status == 'Cancel' ? 'selected' : '' }}>
                                    Cancel</option>
                            </select>
                        </div>

                        <div class="mt-5">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" name="type" id="type">
                                <option value="" selected>Select type</option>
                                <option value="Sea" {{ $draft && $draft->type == 'Sea' ? 'selected' : '' }}>
                                    By Sea</option>
                                <option value="Truck" {{ $draft && $draft->type == 'Truck' ? 'selected' : '' }}>
                                    By Truck
                                </option>
                                <option value="Air" {{ $draft && $draft->type == 'Air' ? 'selected' : '' }}>
                                    By Air</option>
                            </select>
                        </div>



                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                            <b>3. Operation</b>
                        </header>

                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <label for="draft_no" class="form-label">Draft No.</label>
                            <input id="draft_no" name="draft_no" type="text" class="form-control w-full"
                                placeholder="Draft No." value={{ $draft->draft_no }} disabled>
                        </div>

                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">

                            <label for="draft_date" class="form-label">Draft Date</label>
                            <input id="draft_date" name="draft_date" type="date" class="form-control w-full"
                                placeholder="Draft Date"
                                value="{{ $draft ? ($draft->draft_date ? \Carbon\Carbon::parse($draft->draft_date)->format('Y-m-d') : '') : '' }}">

                        </div>

                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                                <label for="sale_id" class="form-label">Sales</label>
                                <select class="form-select" name="sale_id" id="sale_id">
                                    <option value="" selected>Select Sales</option>
                                    @foreach ($all_sales as $sale)
                                        <option value="{{ $sale->id }}"
                                            {{ $draft && $draft->sale_id == $sale->id ? 'selected' : '' }}>
                                            {{ $sale->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                        </div>

                        <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                            <label for="prepared_by" class="form-label">Prepared By</label>
                            <input id="prepared_by" name="prepared_by" type="text" class="form-control w-full"
                                placeholder="Name" readonly value="{{ optional($draft->preparedBy)->name }}" </div>


                            <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                                <label for="created_at" class="form-label">Prepared Date</label>
                                <input id="created_at" type="date" class="form-control w-full" readonly
                                    name="created_at"
                                    value="{{ $draft ? ($draft->created_at ? \Carbon\Carbon::parse($draft->created_at)->format('Y-m-d') : '') : '' }}">

                            </div>

                            <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                                <label for="edit_by" class="form-label">Edit by</label>
                                <input id="edit_by" type="text" class="form-control w-full" readonly
                                    name="edit_by" value="{{ optional($draft->editedBy)->name }} ">
                            </div>


                            <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                                <label for="edit_date" class="form-label">Edit Date</label>
                                <input id="edit_date" type="date" class="form-control w-full" readonly
                                    name="edit_date"
                                    value="{{ $draft ? ($draft->edit_date ? \Carbon\Carbon::parse($draft->edit_date)->format('Y-m-d') : '') : '' }}">
                            </div>








                        </div>

                        <div class="intro-y box p-5 mt-5">
                            <header class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                                <b>4. Remark</b>
                            </header>
                            <div class="intro-y col-span-12 lg:col-span-6 mt-5">
                                <textarea rows="5" class="form-control w-full" placeholder="Remark" name="remark">{{ $draft ? $draft->remark : '' }}</textarea>
                            </div>



                        </div>
                    </div>
                    <div class="text-right mt-5">
                        @livewire('components.assets.button-type', ['color' => 'primary', 'title' => 'บันทึกข้อมูล', 'icon' => 'save', 'action' => '', 'type' => 'submit'])
                    </div>
                </div>
            </div>


        </form>




    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    // Get the current date
    var currentDate = new Date().toISOString().slice(0, 10);

    // Set the value of the input field to the current date
    document.getElementById('edit-date').value = currentDate;
</script>



{{-- active taps --}}
<script>
    function updateUrlParameter(key, value) {
        if (history.pushState) {
            let newUrl = new URL(window.location.href);
            newUrl.searchParams.set(key, value);
            history.pushState(null, '', newUrl.toString());
        }
    }

    function updateTabAndSelect(tab) {
        updateUrlParameter('tab', tab);
        const selectElement = document.getElementById('type');
        selectElement.value = tab;

        // Hide or show the transhipment section based on the selected tab
        const transhipmentSection = document.getElementById('transhipment-port-section');
        if (tab === 'Truck' || tab === 'Air') {
            transhipmentSection.style.display = 'none';
        } else {
            transhipmentSection.style.display = 'block';
        }

        // Hide or show the loading port section based on the selected tab
        const loadingPortSection = document.getElementById('loading-port-section');
        if (tab === 'Truck' || tab === 'Air') {
            loadingPortSection.style.display = 'none';
        } else {
            loadingPortSection.style.display = 'block';
        }

        // Hide or show the pick-up first container section based on the selected tab
        const pickUpFirstContainerSection = document.getElementById('pick-up-first-container-section');
        if (tab === 'Truck' || tab === 'Air') {
            pickUpFirstContainerSection.style.display = 'none';
        } else {
            pickUpFirstContainerSection.style.display = 'block';
        }

        // Hide or show the feeder section based on the selected tab
        const feederSection = document.getElementById('feeder-section');
        if (tab === 'Truck' || tab === 'Air') {
            feederSection.style.display = 'none';
        } else {
            feederSection.style.display = 'block';
        }

        // Hide or show the return date section based on the selected tab
        const returnDateSection = document.getElementById('return-date-section');
        if (tab === 'Truck' || tab === 'Air') {
            returnDateSection.style.display = 'none';
        } else {
            returnDateSection.style.display = 'block';
        }

        // Hide or show the vessel section based on the selected tab
        const vesselSection = document.getElementById('vessel-section');
        if (tab === 'Truck' || tab === 'Air') {
            vesselSection.style.display = 'none';
        } else {
            vesselSection.style.display = 'block';
        }

        // Hide or show the ETD section based on the selected tab
        const etdSection = document.getElementById('ETD-section');
        if (tab === 'Truck' || tab === 'Air') {
            etdSection.style.display = 'none';
        } else {
            etdSection.style.display = 'block';
        }

        // Hide or show the closing date-time section based on the selected tab
        const closingDateTimeSection = document.getElementById('closing-date-time-section');
        if (tab === 'Truck' || tab === 'Air') {
            closingDateTimeSection.style.display = 'none';
        } else {
            closingDateTimeSection.style.display = 'block';
        }

        // Hide or show the depot section based on the selected tab
        const depotSection = document.getElementById('depot-section');
        if (tab === 'Truck' || tab === 'Air') {
            depotSection.style.display = 'none';
        } else {
            depotSection.style.display = 'block';
        }

        // Hide or show the gate-in-depot section based on the selected tab
        const gateInDepotSection = document.getElementById('gate-in-depot-section');
        if (tab === 'Truck' || tab === 'Air') {
            gateInDepotSection.style.display = 'none';
        } else {
            gateInDepotSection.style.display = 'block';
        }

        // Hide or show the VGM cut-off section based on the selected tab
        const vgmCutoffSection = document.getElementById('VGM-cut-off-section');
        if (tab === 'Truck' || tab === 'Air') {
            vgmCutoffSection.style.display = 'none';
        } else {
            vgmCutoffSection.style.display = 'block';
        }

        // Hide or show the SI cut-off section based on the selected tab
        const siCutoffSection = document.getElementById('SI-cut-off-section');
        if (tab === 'Truck' || tab === 'Air') {
            siCutoffSection.style.display = 'none';
        } else {
            siCutoffSection.style.display = 'block';
        }

        // Hide or show the loading location section based on the selected tab
        const loadingLocationSection = document.getElementById('loading-location-section');
        if (tab === 'Sea' || tab === 'Air') {
            loadingLocationSection.style.display = 'none';
        } else {
            loadingLocationSection.style.display = 'block';
        }

        // Hide or show the cross-border date section based on the selected tab
        const crossBorderDateSection = document.getElementById('cross-border-date-section');
        if (tab === 'Sea' || tab === 'Air') {
            crossBorderDateSection.style.display = 'none';
        } else {
            crossBorderDateSection.style.display = 'block';
        }

        // Hide or show the delivery location section based on the selected tab
        const deliveryLocationSection = document.getElementById('delivery-location-section');
        if (tab === 'Sea' || tab === 'Air') {
            deliveryLocationSection.style.display = 'none';
        } else {
            deliveryLocationSection.style.display = 'block';
        }

        const tabButton = document.getElementById(`${tab}-tab`);
        if (tabButton) {
            tabButton.click();
        }
    }



    function updateTabFromSelect() {
        const selectElement = document.getElementById('type');
        const selectedOption = selectElement.value;

        updateTabAndSelect(selectedOption);
    }

    // On page load, set the active tab and select the dropdown based on the URL parameter
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'Sea'; // Default to 'Sea' if no parameter is found
        updateTabAndSelect(activeTab);
    }

    // Add event listener to dropdown
    document.getElementById('type').addEventListener('change', updateTabFromSelect);

    // Add event listener to tabs to update content when clicked
    const tabButtons = document.querySelectorAll('.nav-link');
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tab = button.textContent.trim();
            updateTabAndSelect(tab);
        });
    });
</script>
