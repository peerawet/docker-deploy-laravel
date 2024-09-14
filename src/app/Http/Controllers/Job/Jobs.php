<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cost; // Import the Draft model
use Carbon\Carbon;
use App\Models\Draft;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use App\Models\Sell;
use App\Models\MasterFileDescription;
use App\Models\InvoiceInformation;


class Jobs extends Controller
{
    public $title_layouts = 'Jobs';

    public function edit($jobId)
    {
        $job = Job::findOrFail($jobId);

        $data = [
            'title_layouts' => "แก้ไข Job",
            'job' => $job, // Pass $job to the view
        ];

        // Return the appropriate view
        return view('front-end.pages.Job.formEdit', $data);
    }


    public function print($jobId)
    {


        // Retrieve the draft with the given ID
        $job = Job::findOrFail($jobId);


        $data = [
            'title_layouts' => "Preview Job",
        ];


        // Return the appropriate view
        return view('front-end.pages.Job.pdfJob', ['job' => $job], $data);
    }

    public function store(Request $request, $id = null)
    {
// dd($request);
        $lastJob = Job::orderBy('job_no', 'desc')->first();
        // dd($lastJob);
        $year = date('y'); // Get the current year in YY format
        $nextJobNo = $lastJob ? str_pad(intval(substr($lastJob->job_no, 6)) + 1, 6, '0', STR_PAD_LEFT) : '000001';
        $nextJobNoFormatted = "EXP{$year}-{$nextJobNo}";
                // dd($nextJobNoFormatted);
       
        // Check if we are updating an existing job or creating a new one
        if ($id) {
            $job = Job::findOrFail($id);
            $job->update([
                'booking_no' => $request->input('booking_no'),
                'draft_no' => $request->input('draft_no'),
                'cost_remark' => $request->input('cost_remark'),
                'sell_remark' => $request->input('sell_remark'),

                'job_date' => $request->input('job_date'),

                'edit_by' => Auth::user()->id,
                'edit_date' => Carbon::now(),

                'cost_second_other_value' => $request->input('cost_second_other_value'),
                'cost_second_other_name' => $request->input('cost_second_other_name'),
                'cost_first_other_value' => $request->input('cost_first_other_value'),
                'cost_first_other_name' => $request->input('cost_first_other_name'),
                'cost_kbc_thb' => $request->input('cost_kbc_thb'),
                'cost_kba_thb' => $request->input('cost_kba_thb'),
                'cost_transport' => $request->input('cost_transport'),
                'cost_vat_value' => $request->input('cost_vat_value'),
                'cost_rate_value' => $request->input('cost_rate_value'),
                'sell_vat_value' => $request->input('sell_vat_value'),
                'sell_rate_value' => $request->input('sell_rate_value'),
                'cost_sub_total' => $request->input('cost_sub_total'),
                'cost_total_vat' => $request->input('cost_total_vat'),
                'cost_tax_1' => $request->input('cost_tax_only_1'),
                'cost_tax_3' => $request->input('cost_tax_only_3'),
                'cost_tax_amt' => $request->input('cost_tax_amt'),
                'cost_total_with_vat' => $request->input('cost_total_with_vat'),
                'cost_total_without_vat' => $request->input('cost_total_without_vat'),
                'cost_grand_total' => $request->input('cost_grand_total'),
                'sell_sub_total' => $request->input('sell_sub_total'),
                'sell_total_vat' => $request->input('sell_total_vat'),
                'sell_tax_1' => $request->input('sell_tax_only_1'),
                'sell_tax_3' => $request->input('sell_tax_only_3'),
                'sell_tax_amt' => $request->input('sell_tax_amt'),
                'sell_total_with_vat' => $request->input('sell_total_with_vat'),
                'sell_total_without_vat' => $request->input('sell_total_without_vat'),
                'sell_grand_total' => $request->input('sell_grand_total'),
                'spend' => $request->input('spend'),
                'profit' => $request->input('profit'),
            ]);

            $job_no = $job->job_no;
        } else {
            $job = Job::create([
                'job_no' => $nextJobNoFormatted,
                'booking_no' => $request->input('booking_no'),
                'draft_no' => $request->input('draft_no'),
                'cost_remark' => $request->input('cost_remark'),
                'sell_remark' => $request->input('sell_remark'),
                'prepared_by' => Auth::user()->id,
                'job_date' => $request->input('job_date'),
                'created_at' => $request->input('created_at'),
                // 'edit_by' => $request->input('edit_by'),
                // 'edit_date' => $request->input('edit_date'),
                'cost_second_other_value' => $request->input('cost_second_other_value'),
                'cost_second_other_name' => $request->input('cost_second_other_name'),
                'cost_first_other_value' => $request->input('cost_first_other_value'),
                'cost_first_other_name' => $request->input('cost_first_other_name'),
                'cost_kbc_thb' => $request->input('cost_kbc_thb'),
                'cost_kba_thb' => $request->input('cost_kba_thb'),
                'cost_transport' => $request->input('cost_transport'),
                'cost_vat_value' => $request->input('cost_vat_value'),
                'cost_rate_value' => $request->input('cost_rate_value'),
                'sell_vat_value' => $request->input('sell_vat_value'),
                'sell_rate_value' => $request->input('sell_rate_value'),
                'cost_sub_total' => $request->input('cost_sub_total'),
                'cost_total_vat' => $request->input('cost_total_vat'),
                'cost_tax_1' => $request->input('cost_tax_only_1'),
                'cost_tax_3' => $request->input('cost_tax_only_3'),
                'cost_tax_amt' => $request->input('cost_tax_amt'),
                'cost_total_with_vat' => $request->input('cost_total_with_vat'),
                'cost_total_without_vat' => $request->input('cost_total_without_vat'),
                'cost_grand_total' => $request->input('cost_grand_total'),
                'sell_sub_total' => $request->input('sell_sub_total'),
                'sell_total_vat' => $request->input('sell_total_vat'),
                'sell_tax_1' => $request->input('sell_tax_only_1'),
                'sell_tax_3' => $request->input('sell_tax_only_3'),
                'sell_tax_amt' => $request->input('sell_tax_amt'),
                'sell_total_with_vat' => $request->input('sell_total_with_vat'),
                'sell_total_without_vat' => $request->input('sell_total_without_vat'),
                'sell_grand_total' => $request->input('sell_grand_total'),
                'spend' => $request->input('spend'),
                'profit' => $request->input('profit'),
            ]);

            $job_no = $nextJobNoFormatted;
        }

        // Retrieve the job_no after the record has been created and saved
        // dd($job_no);
     

        // Determine the number of cost items
        $numCostItems = 0;
        $requestDescriptionIds = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'cost-description-') !== false) {
                $numCostItems++;
                $requestDescriptionIds[] = $request->input($key); // Collect all description IDs in the request
            }
        }

        // Retrieve existing cost items for the job
        $currentCostItems = Cost::where('job_no', $job_no)->get();
        $currentDescriptionIds = $currentCostItems->pluck('description_id')->toArray();

        // Determine description IDs to delete, including NULL values
        $descriptionIDsToDelete = array_diff($currentDescriptionIds, $requestDescriptionIds);
        if (in_array(null, $currentDescriptionIds)) {
            $descriptionIDsToDelete[] = null;
        }

        // Update or create Cost entries
        for ($i = 1; $i <= $numCostItems; $i++) {
            $descriptionId = $request->input("cost-description-$i");

            // Check if the description ID starts with 'new='
            if (str_starts_with($descriptionId, 'new=')) {
                $description = substr($descriptionId, 4);

                // Create a new Cost Description entry
                $newDescription = MasterFileDescription::create([
                    'description' => $description,
                    'edit_by' => auth()->user()->name,
                    'edit_date' => now(),
                    // Add other fields as needed
                ]);
                $descriptionId = $newDescription->id;
            }

            // Update or create Cost entry
            Cost::updateOrCreate(
                ['job_no' => $job_no, 'description_id' => $descriptionId],
                [
                    'value' => $request->input("cost-value-$i"),
                    'rate' => $request->input("cost-rate-$i") === 'true', // Convert to boolean
                    'vat' => $request->input("cost-vat-$i") === 'true', // Convert to boolean
                    'tax' => $request->input("cost-tax-$i"),
                ]
            );
        }

        // Soft delete Cost items that are not in the updated request, including NULL values
        if (!empty($descriptionIDsToDelete)) {
            Cost::where('job_no', $job_no)
                ->whereIn('description_id', $descriptionIDsToDelete)
                ->orWhereNull('description_id') // Also delete entries where description_id is NULL
                ->delete();
        }



        // Determine the number of sell items
        $numSellItems = 0;
        $requestDescriptionIds = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'sell-description-') !== false) {
                $numSellItems++;
                $requestDescriptionIds[] = $request->input($key); // Collect all description IDs in the request
            }
        }

        // Retrieve existing sell items for the job
        $currentSellItems = Sell::where('job_no', $job_no)->get();
        $currentDescriptionIds = $currentSellItems->pluck('description_id')->toArray();

        // Determine description IDs to delete, including NULL values
        $descriptionIDsToDelete = array_diff($currentDescriptionIds, $requestDescriptionIds);
        if (in_array(null, $currentDescriptionIds)) {
            $descriptionIDsToDelete[] = null;
        }

        // Delete related invoice_information entries for sell items to be deleted
        if (!empty($descriptionIDsToDelete)) {
            InvoiceInformation::whereHas('sell', function ($query) use ($job_no, $descriptionIDsToDelete) {
                $query->where('job_no', $job_no)
                    ->whereIn('description_id', $descriptionIDsToDelete);
            })->delete();
        }

        // Update or create Sell entries
        for ($i = 1; $i <= $numSellItems; $i++) {
            $descriptionId = $request->input("sell-description-$i");

            // Check if the description ID starts with 'new='
            if (str_starts_with($descriptionId, 'new=')) {
                $description = substr($descriptionId, 4);

                // Create a new Sell Description entry
                $newDescription = MasterFileDescription::create([
                    'description' => $description,
                    'edit_by' => auth()->user()->name,
                    'edit_date' => now(),
                    // Add other fields as needed
                ]);
                $descriptionId = $newDescription->id;
            }

            // Update or create Sell entry
            $sell = Sell::updateOrCreate(
                ['job_no' => $job_no, 'description_id' => $descriptionId],
                [
                    'value' => $request->input("sell-value-$i"),
                    'rate' => $request->input("sell-rate-$i") === 'true', // Convert to boolean
                    'vat' => $request->input("sell-vat-$i") === 'true', // Convert to boolean
                    'tax' => $request->input("sell-tax-$i"),
                ]
            );
        }

        // Soft delete sell items that are not in the updated request, including NULL values
        if (!empty($descriptionIDsToDelete)) {
            Sell::where('job_no', $job_no)
                ->whereIn('description_id', $descriptionIDsToDelete)
                ->orWhereNull('description_id') // Also delete entries where description_id is NULL
                ->delete();
        }

        // Redirect the user to a relevant page, for example:
        return redirect()->route('job.edit', ['jobId' => $job_no])->with('success', 'Job saved successfully!');
    }

    


    public function destroy($id)
    {
        // Find the job by its ID
        $job = Job::findOrFail($id);

        // Delete associated cost entries
        $job->costs()->delete();

        // Delete associated sell entries
        $job->sells()->delete();

        // Delete the job itself
        $job->delete();

        // Return a response, e.g., redirect back with a success message
        return redirect()->route('job.index')->with('success', 'Job and associated costs and sells deleted successfully.');
    }


    public function deleteSelected(Request $request)
    {
        // Get the selected job IDs from the request
        $selectedJobIds = json_decode($request->input('ids'));

        // Delete selected jobs and associated costs and sells
        Job::whereIn('job_no', $selectedJobIds)->each(function ($job) {
            // Delete associated cost entries
            $job->costs()->delete();

            // Delete associated sell entries
            $job->sells()->delete();

            // Delete the job itself
            $job->delete();
        });

        // Return a response, e.g., redirect back with a success message
        return redirect()->route('job.index')->with('success', 'Selected jobs and associated costs and sells deleted successfully.');
    }


    public function index(Request $request)
{
    // Retrieve query parameters with default values
    $sortField = $request->query('sort_field', 'job_no');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Determine the actual column to sort by
    $sortFieldMap = [
        'shipper_name' => 'shippers.name',
        'agent_name' => 'agents.name',
        'booking_no' => 'drafts.booking_no',
    ];
    $actualSortField = $sortFieldMap[$sortField] ?? 'jobs.' . $sortField;

    // Initialize the query with the base table and joins for related fields
    $jobs = Job::query()
        ->select('jobs.*')
        ->leftJoin('drafts', 'jobs.draft_no', '=', 'drafts.draft_no')
        ->leftJoin('master_file_shipper as shippers', 'drafts.shipper_id', '=', 'shippers.id')
        ->leftJoin('master_file_agent as agents', 'drafts.agent_id', '=', 'agents.id')
        ->orderBy($actualSortField, $sortOrder)
        ->with(['draft.shipper', 'draft.agent'])
        ->when($searchValue, function ($query) use ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('jobs.job_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('jobs.draft_no', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('draft', function ($query) use ($searchValue) {
                        $query->where('drafts.booking_no', 'like', '%' . $searchValue . '%')
                              ->orWhereHas('shipper', function ($query) use ($searchValue) {
                                  $query->where('shippers.name', 'like', '%' . $searchValue . '%');
                              })
                              ->orWhereHas('agent', function ($query) use ($searchValue) {
                                  $query->where('agents.name', 'like', '%' . $searchValue . '%');
                              });
                    });
            });
        })
        ->paginate(50)
        ->appends([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'search_value' => $searchValue
        ]);

    // Prepare the data array with jobs and title_layouts
    $data = [
        'title_layouts' => $this->title_layouts,
    ];

    // Return the view with the data
    return view('front-end.pages.Job.index', compact('jobs', 'sortField', 'sortOrder', 'searchValue'), $data);
}





    public function create()
    {
        $data = [
            'title_layouts' => 'สร้าง Job'
        ];
        return view('front-end.pages.Job.form', $data);
    }

    // Controller
    public function getDraftDetails($id)
    {
        // Fetch the details of the draft with the given ID
        $draft = Draft::findOrFail($id);
        $etdDate = null;
        if ($draft->ETD_date) {
            $etdDate = Carbon::parse($draft->ETD_date);
        }



        // Return the draft and agent details as JSON response
        return response()->json([
            'booking_no' => $draft->booking_no ?? null,
            'shipper_name' => $draft->shipper->name ?? null,
            'shipper_address' => $draft->shipper->address ?? null,
            'shipper_contact' => $draft->shipper->contact ?? null,
            'shipper_tel' => $draft->shipper->tel ?? null,
            'agent_name' => $draft->agent->name ?? null,
            'agent_contact' => $draft->agent->contact ?? null,
            'agent_tel' => $draft->agent->tel ?? null,
            'agent_id' => $draft->agent->agent_id ?? null,
            'qty' => $draft->qty ?? null,
            'size' => $draft->containerType->size ?? null,
            'temp' => $draft->temp ?? null,
            'ETD_date' => $etdDate ? $etdDate->format('Y-m-d') : null,
        ]);
    }
}
