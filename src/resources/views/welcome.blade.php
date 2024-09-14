@extends('front-end.layouts.main')
@section('title', 'Landing Page')

@section('content')
    <!-- Input to select year and month for filtering -->
    <div>
        <label for="year_month">Year and Month:</label>
        <input type="month" id="year_month" name="year_month" required>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the current date
            var today = new Date();
            var year = today.getFullYear();
            var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based

            // Set the value of the input field to the current year and month
            document.getElementById('year_month').value = `${year}-${month}`;
        });
    </script>

    <div class="grid grid-cols-12 gap-6 justify-center">
        <div class="flex flex-col items-center col-span-12 lg:col-span-6">
            <div class="mt-6">
                <b>Total Volume by Shipper</b>
                <div class="w-500px mt-4">
                    <canvas id="volumeChart" width="500"></canvas> <!-- Adjusted canvas size -->
                </div>
            </div>

            <div class="mt-6">
                <b>Total Volume by Agent</b>
                <div class="w-500px mt-4">
                    <canvas id="agentChart" width="500"></canvas>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center col-span-12 lg:col-span-6">
            <div class="mt-6">
                <b>Total Volume by Type</b>
                <div class="w-500px mt-4">
                    <canvas id="typeChart" width="500"></canvas>
                </div>
            </div>

            <div class="mt-6">
                <b>Total Volume by Destination Port</b>
                <div class="w-500px mt-4">
                    <canvas id="destinationPortChart" width="500"></canvas>
                </div>
            </div>
        </div>
    </div>




    <div style="margin-top: 1rem;">
        <b>Vessel Summary</b>
        <table class="table table-striped table-hover text-center table-bordered" style="text-align: center;">
            <thead class="table-dark">
                <tr>
                    <th>Vessel</th>
                    <th>Voy</th>
                    <th>Destination Port</th>
                    @foreach ($vesselSummary->unique('shipper_id') as $uniqueShipper)
                        <th>{{ $uniqueShipper->shipper->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($vesselSummary as $summary)
                    <tr>
                        <td>{{ $summary->vessel->name }}</td>
                        <td>{{ $summary->voy_vessel }}</td>
                        <td>{{ $summary->destinationPort->name }}</td>
                        @foreach ($vesselSummary->unique('shipper_id') as $uniqueShipper)
                            <td>
                                @if ($summary->shipper_id == $uniqueShipper->shipper_id)
                                    {{ $summary->count }}
                                @else
                                    0
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Embedding the total volumes by shipper, agent, type, and destination port data into JavaScript variables -->
    <script>
        // Encode the PHP variables into JSON strings
        const totalVolumesByShipper = @json($totalVolumesByShipper);
        const totalVolumesByAgent = @json($totalVolumesByAgent);
        const totalVolumesByType = @json($totalVolumesByType);
        const totalVolumesByDestinationPort = @json($totalVolumesByDestinationPort);
        const vesselSummaryQuery = @json($vesselSummary);

        // Log the variables to the console
        console.log(totalVolumesByShipper);
        console.log(totalVolumesByAgent);
        console.log(totalVolumesByType);
        console.log(totalVolumesByDestinationPort);
        console.log(vesselSummaryQuery);

        // Function to set the value of the year_month input based on URL query parameters
        function setYearMonthInputFromURL() {
            // Get the current URL query parameters
            const params = new URLSearchParams(window.location.search);

            // Get the year and month from the query parameters
            const year = params.get('year');
            const month = params.get('month');

            // If year and month are both provided, set the value of the year_month input
            if (year && month) {
                document.getElementById('year_month').value = `${year}-${month}`;
            } else {
                // If no year and month are provided, set the input field value to the current date
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear();
                const currentMonth = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed
                const yearMonth = `${currentYear}-${currentMonth}`;
                document.getElementById('year_month').value = yearMonth;

                // Update the URL with the current year and month
                updateURL(yearMonth);
            }
        }

        // Call the function to set the initial value of the year_month input
        // setYearMonthInputFromURL();

        // Function to update URL with selected year and month
        function updateURL(yearMonth) {
            // Split year and month from the input value (format: YYYY-MM)
            const [year, month] = yearMonth.split('-');

            // Construct the new URL with updated query parameters
            const newURL = window.location.pathname + `?year=${year}&month=${month}`;

            // Replace the current URL with the new one
            window.history.replaceState({}, '', newURL);
            window.location.reload();
        }

        // Use jQuery to handle the change event
        jQuery('#year_month').on('change', function() {
            // Get the selected year and month
            const yearMonth = jQuery(this).val();

            // Update the URL with the selected year and month
            updateURL(yearMonth);
        });

        // Extract data for the chart
        const labels = totalVolumesByShipper.map(volume => volume.shipper.name);
        const data = totalVolumesByShipper.map(volume => volume.total_volume);

        // Create the chart
        const ctx = document.getElementById('volumeChart').getContext('2d');
        const volumeChart = new Chart(ctx, {
            type: 'bar', // chart type
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Volume',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // this makes the bars horizontal
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value, context) {
                            return value;
                        },
                        color: 'black',
                        font: {
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false // Hide legend to save space
                    },
                    tooltip: {
                        enabled: true // Display tooltips when hovering over the bars
                    }
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // agent chart
        // Extract data for the chart
        const agentLabels = @json($totalVolumesByAgent->pluck('agent.name'));
        const agentData = @json($totalVolumesByAgent->pluck('total_volume'));
        // const agentLabels = Array.from({
        //     length: 10
        // }, (_, i) => `Agent ${i + 1}`);
        // const agentData = Array.from({
        //     length: 10
        // }, () => Math.floor(Math.random() * 100)); // Generate random values

        // Create the chart
        const agentCtx = document.getElementById('agentChart').getContext('2d');
        const agentChart = new Chart(agentCtx, {
            type: 'bar', // chart type
            data: {
                labels: agentLabels,
                datasets: [{
                    label: 'Total Volume',
                    data: agentData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // this makes the bars horizontal
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value, context) {
                            return value;
                        },
                        color: 'black',
                        font: {
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false // Hide legend to save space
                    },
                    tooltip: {
                        enabled: true // Display tooltips when hovering over the bars
                    }
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // type chart
        // Extract data for the chart
        const typeLabels = @json($totalVolumesByType->pluck('type'));
        const typeData = @json($totalVolumesByType->pluck('total_volume'));

        // Create the chart
        const typeCtx = document.getElementById('typeChart').getContext('2d');
        const typeChart = new Chart(typeCtx, {
            type: 'bar', // chart type
            data: {
                labels: typeLabels,
                datasets: [{
                    label: 'Total Volume',
                    data: typeData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // this makes the bars horizontal
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value, context) {
                            return value;
                        },
                        color: 'black',
                        font: {
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false // Hide legend to save space
                    },
                    tooltip: {
                        enabled: true // Display tooltips when hovering over the bars
                    }
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        //destinationPortChart
        // Extract data for the chart
        const destinationPortLabels = @json($totalVolumesByDestinationPort->pluck('destinationPort.name'));
        const destinationPortData = @json($totalVolumesByDestinationPort->pluck('total_volume'));

        // Create the chart
        const destinationPortCtx = document.getElementById('destinationPortChart').getContext('2d');
        const destinationPortChart = new Chart(destinationPortCtx, {
            type: 'bar', // chart type
            data: {
                labels: destinationPortLabels,
                datasets: [{
                    label: 'Total Volume',
                    data: destinationPortData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // this makes the bars horizontal
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value, context) {
                            return value;
                        },
                        color: 'black',
                        font: {
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false // Hide legend to save space
                    },
                    tooltip: {
                        enabled: true // Display tooltips when hovering over the bars
                    }
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>

@endsection
{{-- <div style="margin-top: 1rem">
        <b>Total Volume by Shipper</b>
        <ul id="total-volume-by-shipper-list">
            @foreach ($totalVolumesByShipper as $totalVolume)
                <li>{{ $totalVolume->shipper->name }} - Total Volume: {{ $totalVolume->total_volume }}</li>
            @endforeach
        </ul>
    </div> --}}

{{-- <div style="margin-top: 1rem">
        <b>Total Volume by Agent</b>
        <ul id="total-volume-by-agent-list">
            @foreach ($totalVolumesByAgent as $totalVolume)
                <li>{{ $totalVolume->agent->name }} - Total Volume: {{ $totalVolume->total_volume }}</li>
            @endforeach
        </ul>
    </div>
    <div style="margin-top: 1rem">
        <b>Total Volume by Type</b>
        <ul id="total-volume-by-type-list">
            @foreach ($totalVolumesByType as $totalVolume)
                <li>Type: {{ $totalVolume->type }} - Total Volume: {{ $totalVolume->total_volume }}</li>
            @endforeach
        </ul>
    </div>
    <div style="margin-top: 1rem">
        <b>Total Volume by Destination Port</b>
        <ul id="total-volume-by-destination-port-list">
            @foreach ($totalVolumesByDestinationPort as $totalVolume)
                <li>Destination Port: {{ $totalVolume->destinationPort->name }} - Total Volume:
                    {{ $totalVolume->total_volume }}</li>
            @endforeach
        </ul>
    </div> --}}
