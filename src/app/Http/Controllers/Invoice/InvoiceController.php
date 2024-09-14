<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Draft;
use App\Models\Job;
use App\Models\MasterFileDescription;
use App\Models\Invoice;
use App\Models\Sell;
use App\Models\InvoiceInformation;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public $title_layouts = 'Invoices';

    public function print($invoiceId)
    {
        // Retrieve the invoice with the given ID
        $invoice = Invoice::findOrFail($invoiceId);
        
        // Retrieve the invoice informations associated with this invoice
        $invoice_informations = optional($invoice)->informations;
        
        $data = [
            'title_layouts' => "Preview Invoice",
            'invoice' => $invoice,
            'invoice_informations' => $invoice_informations
        ];
        
        // Return the appropriate view
        return view('front-end.pages.Invoice.pdfInvoice', $data);
    }
    
    

    public function edit($invoice)
    {
        $invoice = invoice::findOrFail($invoice);
     

        $data = [
            'title_layouts' => "แก้ไข Invoice",
            'invoice' => $invoice, // Pass $invoice to the view
        ];

        // Return the appropriate view
        return view('front-end.pages.Invoice.formEdit', $data);
    }

    public function index(Request $request)
{
    // Retrieve query parameters with default values
    $sortField = $request->query('sort_field', 'invoice_no');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Determine the actual column to sort by
    $sortFieldMap = [
        'job_no' => 'jobs.job_no',
        'invoice_no' => 'invoices.invoice_no',
        'draft_no' => 'drafts.draft_no',
        'status' => 'invoices.status',
        'due_date' => 'invoices.due_date',
        'shipper_name' => 'shippers.name',
        'agent_name' => 'agents.name',
        'booking_no' => 'drafts.booking_no',
        'bl_no' => 'invoices.bl_no',
        'ref_no' => 'invoices.ref_no',
        'attn' => 'invoices.attn',
    ];
    $actualSortField = $sortFieldMap[$sortField] ?? 'invoices.' . $sortField;

    // Initialize the query with the base table and joins for related fields
    $invoices = Invoice::query()
        ->select('invoices.*')
        ->leftJoin('jobs', 'invoices.job_no', '=', 'jobs.job_no')
        ->leftJoin('drafts', 'jobs.draft_no', '=', 'drafts.draft_no')
        ->leftJoin('master_file_shipper as shippers', 'drafts.shipper_id', '=', 'shippers.id')
        ->leftJoin('master_file_agent as agents', 'drafts.agent_id', '=', 'agents.id')
        ->orderBy($actualSortField, $sortOrder)
        ->with(['job', 'job.draft.shipper', 'job.draft.agent'])
        ->when($searchValue, function ($query) use ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('invoices.invoice_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('jobs.job_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('drafts.draft_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('invoices.status', 'like', '%' . $searchValue . '%')
                    ->orWhere('invoices.due_date', 'like', '%' . $searchValue . '%')
                    ->orWhere('shippers.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('agents.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('drafts.booking_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('invoices.bl_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('invoices.ref_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('invoices.attn', 'like', '%' . $searchValue . '%');
            });
        })
        ->paginate(50)
        ->appends([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'search_value' => $searchValue
        ]);

    // Prepare the data array with invoices and title_layouts
    $data = [
        'title_layouts' => $this->title_layouts,
    ];

    // Return the view with the data
    return view('front-end.pages.Invoice.index', compact('invoices', 'sortField', 'sortOrder', 'searchValue'), $data);
}


    public function create()
    {
        $data = [
            'title_layouts' => 'สร้าง Invoice'
        ];
        return view('front-end.pages.Invoice.form', $data);
    }

    public function getDraftByJobNo($job_no, $invoice_no = null)
{
    try {
        // Fetch invoice information if invoice_no is provided
        $invoice_informations = null;
        if ($invoice_no) {
            $invoice_informations = InvoiceInformation::where('invoice_no', $invoice_no)->get();
        }

        // Find the job by job_no and get the associated draft ID
        $job = Job::with(['sells.description'])->where('job_no', $job_no)->firstOrFail();
        $draft_no = $job->draft_no;
    
        // Fetch the draft with related shipper, agent, and destination port details
        $draft = Draft::with(['shipper', 'agent', 'destinationPort'])->findOrFail($draft_no);
    
        // Fetch master file descriptions
        $masterFileDescriptions = MasterFileDescription::all();
    
        // Check if the draft exists and return the details as JSON
        return response()->json([
            'draft_no' => $draft->draft_no ?? null,
            'shipper_name' => $draft->shipper->name ?? null,
            'agent_name' => $draft->agent->name ?? null,
            'destination_port' => $draft->destinationPort->name ?? null,
            'sells' => $job->sells ?? null,
            'masterFileDescriptions' => $masterFileDescriptions,
            'booking_no' => $draft->booking_no ?? null,
            'customer_ref' => $draft->customer_ref ?? null,
            'job' => $job,
            'invoice_informations' => $invoice_informations ?? null
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Return a 404 response if the job or draft is not found
        return response()->json(['message' => 'No draft found for the given job number'], 404);
    } catch (\Exception $e) {
        // Return a 500 response for any other errors
        return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}


public function store(Request $request, $id = null)
{
    try {

        $lastInvoice = Invoice::orderBy('invoice_no', 'desc')->first();
        // dd($lastInvoice);
        $year = date('y'); // Get the current year in YY format
        $nextInvoiceNo = $lastInvoice ? str_pad(intval(substr($lastInvoice->invoice_no, 6)) + 1, 6, '0', STR_PAD_LEFT) : '000001';
        $nextInvoiceNoFormatted = "EXP{$year}-{$nextInvoiceNo}";
        // dd($nextInvoiceNoFormatted);
        // Check if we are updating an existing invoice or creating a new one
        if ($id) {
            // Find the existing invoice
            $invoice = Invoice::findOrFail($id);
            
            // Update the invoice fields
            $invoice->update([
                'invoice_date' => $request->input('invoice_date'),
                'job_no' => $request->input('job_no'),
                'status' => $request->input('status'),
                'bl_no' => $request->input('bl_no'),
                'container_no' => $request->input('container_no'),
                'due_date' => $request->input('due_date'),
                'ref_no' => $request->input('ref_no'),
                'attn' => $request->input('attn'),
                'fax' => $request->input('fax'),
                'remark' => $request->input('remark'),
                'edit_date' => Carbon::now(),
                'edit_by' => auth()->user()->id,
            ]);
            $invoice_no = $invoice->invoice_no;
        } else {
            // Create a new invoice
            $invoice = Invoice::create([
                'invoice_no' => $nextInvoiceNoFormatted,
                'invoice_date' => $request->input('invoice_date'),
                'job_no' => $request->input('job_no'),
                'status' => $request->input('status'),
                'bl_no' => $request->input('bl_no'),
                'container_no' => $request->input('container_no'),
                'due_date' => $request->input('due_date'),
                'ref_no' => $request->input('ref_no'),
                'attn' => $request->input('attn'),
                'fax' => $request->input('fax'),
                'remark' => $request->input('remark'),
                'prepared_by' => auth()->user()->id,
                'prepared_date' => now(),
            ]);
            $invoice_no = $nextInvoiceNoFormatted;
        }
   

        // Get the invoice number
        


        // Determine the number of sell items
        $numSellItems = 0;
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'sell_id-') !== false) {
                $numSellItems++;
            }
        }

        // Loop through the sell items and update InvoiceInformation entries
        for ($i = 1; $i <= $numSellItems; $i++) {
            InvoiceInformation::updateOrCreate(
                [
                    'sell_id' => $request->input("sell_id-$i"),
                ],
                [
                    'information' => $request->input("sell-information-$i"),
                    'invoice_no' => $invoice_no // Assign invoice number
                    // Add other fields to update here if needed
                ]
            );
        }

        // Redirect to the edit page of the invoice
        return redirect()->route('invoice.edit', ['invoiceId' => $invoice_no])->with('success', 'Invoice created/updated successfully');
    } catch (\Exception $e) {
        // If any other type of exception occurs
        return redirect()->back()->withInput()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}




    
    

}
