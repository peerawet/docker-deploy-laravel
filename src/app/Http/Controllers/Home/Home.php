<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Draft;
use DB;

class Home extends Controller
{
    public function index(Request $request)
{
    $title_layouts = 'Dashboard';

    // Get year and month from query parameters or use the current year and month as default
    $year = $request->query('year', date('Y'));
    $month = $request->query('month', date('m'));

    if (!$request->has('year') || !$request->has('month')) {
        // Redirect to the same route with the current year and month as query parameters
        return redirect()->route('home', ['year' => $year, 'month' => $month]);
    }

    // Build the query to fetch total volumes by shipper
    $shipperQuery = Draft::with('shipper', 'containerType')
        ->select(
            'shipper_id',
            DB::raw(
                "
                SUM(qty * 
                    CASE 
                        WHEN master_file_container_type.size LIKE '%40%' THEN 2 
                        WHEN master_file_container_type.size LIKE '%20%' THEN 1 
                        ELSE 0 
                    END
                ) as total_volume"
            )
        )
        ->join('master_file_container_type', 'drafts.container_type_id', '=', 'master_file_container_type.id')
        ->join('master_file_shipper', 'drafts.shipper_id', '=', 'master_file_shipper.id')
        ->groupBy('shipper_id');

    // Build the query to fetch total volumes by agent
    $agentQuery = Draft::with('agent', 'containerType')
        ->select(
            'drafts.agent_id', // Specify the table name for the agent_id column
            DB::raw(
                "
                SUM(qty * 
                    CASE 
                        WHEN master_file_container_type.size LIKE '%40%' THEN 2 
                        WHEN master_file_container_type.size LIKE '%20%' THEN 1 
                        ELSE 0 
                    END
                ) as total_volume"
            )
        )
        ->join('master_file_container_type', 'drafts.container_type_id', '=', 'master_file_container_type.id')
        ->join('master_file_agent', 'drafts.agent_id', '=', 'master_file_agent.id')
        ->groupBy('drafts.agent_id'); // Specify the table name for the GROUP BY clause

    // Build the query to fetch total volumes by type
    $typeQuery = Draft::with('containerType')
        ->select(
            'type',
            DB::raw(
                "
        SUM(qty * 
            CASE 
                WHEN master_file_container_type.size LIKE '%40%' THEN 2 
                WHEN master_file_container_type.size LIKE '%20%' THEN 1 
                ELSE 0 
            END
        ) as total_volume"
            )
        )
        ->join('master_file_container_type', 'drafts.container_type_id', '=', 'master_file_container_type.id')
        ->groupBy('type'); // Group by the type column

    // Build the query to fetch total volumes by destination port
    $destinationPortQuery = Draft::with('destinationPort', 'containerType')
        ->select(
            'destination_port_id', // Specify the column name for the destination port ID
            DB::raw(
                "
        SUM(qty * 
            CASE 
                WHEN master_file_container_type.size LIKE '%40%' THEN 2 
                WHEN master_file_container_type.size LIKE '%20%' THEN 1 
                ELSE 0 
            END
        ) as total_volume"
            )
        )
        ->join('master_file_container_type', 'drafts.container_type_id', '=', 'master_file_container_type.id')
        ->join('master_file_destination_port', 'drafts.destination_port_id', '=', 'master_file_destination_port.id')
        ->groupBy('destination_port_id');

    $vesselSummaryQuery = Draft::with('vessel', 'destinationPort')
        ->select(
            'shipper_id',
            'vessel_id',
            'destination_port_id',
            'voy_vessel',
            DB::raw('COUNT(*) as count')
        )
        ->join('master_file_vessel', 'drafts.vessel_id', '=', 'master_file_vessel.id')
        ->join('master_file_destination_port', 'drafts.destination_port_id', '=', 'master_file_destination_port.id')
        ->groupBy('shipper_id', 'vessel_id', 'destination_port_id', 'voy_vessel');

    // Apply the date filter if year and month are provided
    $shipperQuery->whereYear('draft_date', $year)
        ->whereMonth('draft_date', $month);
    $agentQuery->whereYear('draft_date', $year)
        ->whereMonth('draft_date', $month);
    $destinationPortQuery->whereYear('draft_date', $year)
        ->whereMonth('draft_date', $month);
    $typeQuery->whereYear('draft_date', $year)
        ->whereMonth('draft_date', $month);
    $vesselSummaryQuery->whereYear('draft_date', $year)
        ->whereMonth('draft_date', $month);

    $totalVolumesByDestinationPort = $destinationPortQuery->get();
    $totalVolumesByType = $typeQuery->get();
    $totalVolumesByShipper = $shipperQuery->get();
    $totalVolumesByAgent = $agentQuery->get();
    $vesselSummary = $vesselSummaryQuery->get();

    // Pass total volumes by shipper and agent to the view
    $data = [
        'title_layouts' => $title_layouts,
        'totalVolumesByShipper' => $totalVolumesByShipper,
        'totalVolumesByAgent' => $totalVolumesByAgent,
        'totalVolumesByType' => $totalVolumesByType,
        'totalVolumesByDestinationPort' => $totalVolumesByDestinationPort,
        'vesselSummary' => $vesselSummary,
    ];

    return view('welcome', $data);
}

}
