<?php

namespace App\Http\Controllers\ManagerReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Draft;
use Carbon\Carbon;
use App\Models\MasterFileShipper;
use App\Models\MasterFileAgent;
use App\Models\MasterFileDestinationPort;
use App\Models\MasterFileTranshipmentPort;
use App\Models\MasterFileLoadingPort;
use App\Models\MasterFileContainerType;
use App\Models\MasterFileFeeder;
use App\Models\MasterFileVessel;
use App\Models\MasterFileDepot;
use App\Models\MasterFileGateInDepot;
use App\Models\MasterFileLoadingLocation;
use App\Models\Receipt;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Expense;
use DateTime;


class ManagerReport extends Controller
{


    public function kba($start = null, $end = null)
    {
        // Default to current month's first and last day if no dates are provided
        if (!$start || !$end) {
            $start = Carbon::now()->startOfMonth()->toDateString();
            $end = Carbon::now()->endOfMonth()->toDateString();
        }
    
        $agents = MasterFileAgent::all();
    
        // Fetch jobs without associated invoices within the specified date range
        $jobs = Job::whereHas('draft', function ($query) use ($start, $end) {
            $query->whereDate('ETD_date', '>=', $start)
                  ->whereDate('ETD_date', '<=', $end);
        })
        ->get();
    
        $title_layouts = 'Manager Report';
    
        $data = [
            'title_layouts' => $title_layouts,
            'jobs' => $jobs,
            'start' => $start,
            'end' => $end,
            'agents' => $agents,
        ];
    
        return view('front-end.pages.ManagerReport.KBA', $data);
    }
    

public function kbc($start = null, $end = null)
{
    // Default to current month's first and last day if no dates are provided
    if (!$start || !$end) {
        $start = Carbon::now()->startOfMonth()->toDateString();
        $end = Carbon::now()->endOfMonth()->toDateString();
    }

    $shippers = MasterFileShipper::all();

    // Fetch jobs without associated invoices within the specified ETD date range
    $jobs = Job::whereHas('draft', function ($query) use ($start, $end) {
                $query->whereDate('ETD_date', '>=', $start)
                      ->whereDate('ETD_date', '<=', $end);
            })
            ->get();

    $title_layouts = 'Manager Report';

    $data = [
        'title_layouts' => $title_layouts,
        'jobs' => $jobs,
        'start' => $start,
        'end' => $end,
        'shippers' => $shippers,
    ];

    return view('front-end.pages.ManagerReport.KBC', $data);
}


public function fullReport(Request $request, $start = null, $end = null)
{
    // Retrieve query parameters with default values
    $sortField = $request->query('sort_field', 'job_no'); // Default sort field
    $sortOrder = $request->query('sort_order', 'desc'); // Default sort order

    // Default to current month's first and last day if no dates are provided
    if (!$start || !$end) {
        $start = Carbon::now()->startOfMonth()->toDateString();
        $end = Carbon::now()->endOfMonth()->toDateString();
    }

    $shippers = MasterFileShipper::all();

    // Fetch jobs with sorting, eager loading sells, costs, and other relations within the specified date range
    $jobs = Job::with(['draft.sale', 'sells', 'costs'])
        ->whereDate('job_date', '>=', $start)
        ->whereDate('job_date', '<=', $end)
        ->when($sortField == 'sale', function ($query) use ($sortOrder) {
            return $query->leftJoin('drafts', 'jobs.draft_no', '=', 'drafts.draft_no')
                         ->leftJoin('master_file_sales', 'drafts.sale_id', '=', 'master_file_sales.id')
                         ->orderBy('master_file_sales.name', $sortOrder);
        }, function ($query) use ($sortField, $sortOrder) {
            return $query->orderBy($sortField, $sortOrder);
        })
        ->get();

    $title_layouts = 'Manager Report';

    $data = [
        'title_layouts' => $title_layouts,
        'jobs' => $jobs,
        'start' => $start,
        'end' => $end,
        'shippers' => $shippers,
        'sortField' => $sortField,
        'sortOrder' => $sortOrder,
    ];

    return view('front-end.pages.ManagerReport.fullReport', $data);
}





public function expenseReport(Request $request, $start = null, $end = null)
{
    $sortField = $request->query('sort_field', 'pv_no'); // Default sort field
    $sortOrder = $request->query('sort_order', 'desc'); // Default sort order

    // Default to current month's first and last day if no dates are provided
    if (!$start || !$end) {
        $start = Carbon::now()->startOfMonth()->toDateString();
        $end = Carbon::now()->endOfMonth()->toDateString();
    }

    // Fetch expenses within the specified PV Issue Date range and apply sorting
    $expenses = Expense::whereDate('pv_issue_date', '>=', $start)
                ->whereDate('pv_issue_date', '<=', $end)
                ->when($sortField == 'category', function ($query) use ($sortOrder) {
                    return $query->leftJoin('master_file_categories', 'expense.category_id', '=', 'master_file_categories.id')
                                 ->select('expense.*', 'master_file_categories.category as category_name')
                                 ->orderBy('category_name', $sortOrder);
                }, function ($query) use ($sortField, $sortOrder) {
                    return $query->orderBy($sortField, $sortOrder);
                })
                ->get();


    $title_layouts = 'Manager Report';

    $data = [
        'title_layouts' => $title_layouts,
        'expenses' => $expenses,
        'start' => $start,
        'end' => $end,
        'sortField' => $sortField,
        'sortOrder' => $sortOrder,
    ];

    return view('front-end.pages.ManagerReport.expenseReport', $data);
}





}