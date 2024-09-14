<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Draft;
use App\Models\Job;
use App\Models\Receipt;
use App\Models\MasterFileReceiptDescription;

use Carbon\Carbon;

class ReceiptController extends Controller
{
    public $title_layouts = 'Receipts';

    public function vat(Request $request)
{
    // Retrieve query parameters with default values
    $sortField = $request->query('sort_field', 'receipt_no');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Initialize the query with the base table and joins
    $receiptsQuery = Receipt::query()
        ->select('receipts.*', 'invoices.invoice_no', 'jobs.sell_sub_total', 'jobs.sell_vat_value', 'jobs.sell_total_vat', 'jobs.sell_grand_total')
        ->where('receipts.is_vat', 1)
        ->leftJoin('invoices', 'receipts.invoice_no', '=', 'invoices.invoice_no')
        ->leftJoin('jobs', 'invoices.job_no', '=', 'jobs.job_no') // Assuming job_no links invoices to jobs
        ->orderBy($sortField, $sortOrder);

    // Apply search filter using when
    $receiptsQuery->when($searchValue, function ($query) use ($searchValue) {
        $query->where(function ($query) use ($searchValue) {
            $query->where('receipts.receipt_no', 'like', '%' . $searchValue . '%')
                ->orWhere('receipts.receipt_date', 'like', '%' . $searchValue . '%')
                ->orWhere('invoices.invoice_no', 'like', '%' . $searchValue . '%')
                ->orWhere('jobs.sell_sub_total', 'like', '%' . $searchValue . '%')
                ->orWhere('jobs.sell_vat_value', 'like', '%' . $searchValue . '%')
                ->orWhere('jobs.sell_total_vat', 'like', '%' . $searchValue . '%')
                ->orWhere('jobs.sell_grand_total', 'like', '%' . $searchValue . '%')
                ->orWhere('receipts.payment_method', 'like', '%' . $searchValue . '%')
                ->orWhere('receipts.bank', 'like', '%' . $searchValue . '%')
                ->orWhere('receipts.branch', 'like', '%' . $searchValue . '%')
                ->orWhere('receipts.bank_number', 'like', '%' . $searchValue . '%');
        });
    });

    // Paginate the results and append query parameters to pagination links
    $receipts = $receiptsQuery->paginate(50)
        ->appends([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'search_value' => $searchValue
        ]);

    // Prepare the data array with title_layouts
    $data = [
        'title_layouts' => $this->title_layouts,
    ];

    // Return the view with the data
    return view('front-end.pages.Receipt.vat', compact('receipts', 'sortField', 'sortOrder', 'searchValue') + $data);
}


public function noVat(Request $request)
{
   // Retrieve query parameters with default values
   $sortField = $request->query('sort_field', 'receipt_no');
   $sortOrder = $request->query('sort_order', 'desc');
   $searchValue = $request->query('search_value', '');

   // Initialize the query with the base table and joins
   $receiptsQuery = Receipt::query()
       ->select('receipts.*', 'invoices.invoice_no', 'jobs.sell_sub_total', 'jobs.sell_vat_value', 'jobs.sell_total_vat', 'jobs.sell_grand_total')
       ->where('receipts.is_vat', 0)
       ->leftJoin('invoices', 'receipts.invoice_no', '=', 'invoices.invoice_no')
       ->leftJoin('jobs', 'invoices.job_no', '=', 'jobs.job_no') // Assuming job_no links invoices to jobs
       ->orderBy($sortField, $sortOrder);

   // Apply search filter using when
   $receiptsQuery->when($searchValue, function ($query) use ($searchValue) {
       $query->where(function ($query) use ($searchValue) {
           $query->where('receipts.receipt_no', 'like', '%' . $searchValue . '%')
               ->orWhere('receipts.receipt_date', 'like', '%' . $searchValue . '%')
               ->orWhere('invoices.invoice_no', 'like', '%' . $searchValue . '%')
               ->orWhere('jobs.sell_sub_total', 'like', '%' . $searchValue . '%')
               ->orWhere('jobs.sell_vat_value', 'like', '%' . $searchValue . '%')
               ->orWhere('jobs.sell_total_vat', 'like', '%' . $searchValue . '%')
               ->orWhere('jobs.sell_grand_total', 'like', '%' . $searchValue . '%')
               ->orWhere('receipts.payment_method', 'like', '%' . $searchValue . '%')
               ->orWhere('receipts.bank', 'like', '%' . $searchValue . '%')
               ->orWhere('receipts.branch', 'like', '%' . $searchValue . '%')
               ->orWhere('receipts.bank_number', 'like', '%' . $searchValue . '%');
       });
   });

   // Paginate the results and append query parameters to pagination links
   $receipts = $receiptsQuery->paginate(50)
       ->appends([
           'sort_field' => $sortField,
           'sort_order' => $sortOrder,
           'search_value' => $searchValue
       ]);

   // Prepare the data array with title_layouts
   $data = [
       'title_layouts' => $this->title_layouts,
   ];

    // Return the view with the data
    return view('front-end.pages.Receipt.no-vat', compact('receipts', 'sortField', 'sortOrder', 'searchValue') + $data);
}




    public function edit($receipt)
    {

        $receipt = Receipt::findOrFail($receipt);
        $data = [
            'title_layouts' => 'แก้ไข Receipt',
            'receipt' => $receipt,
        ];
        return view('front-end.pages.Receipt.formEdit', $data);
    }

    

     

    public function create()
    {
        $data = [
            'title_layouts' => 'สร้าง Receipt'
        ];
        return view('front-end.pages.Receipt.form', $data);
    }


    public function getDataByJobNo($invoice_no)
{
    try {
        // Retrieve the invoice using the provided invoice number
        $invoice = Invoice::where('invoice_no', $invoice_no)->firstOrFail();
        
        // Retrieve the job number from the invoice
        $job_no = $invoice->job_no;
        
        // Retrieve the draft number from the related job
        $draft_no = $invoice->job->draft_no;

        // Fetch the draft with related shipper details
        $draft = Draft::with(['shipper'])->findOrFail($draft_no);
        
        // Fetch the job with related sells
        $job = Job::with(['sells'])->findOrFail($job_no);
        
         // Check if any of the job's sells have VAT
        $isVat = $job->sells->contains(function ($sell) {
            return $sell->vat == 1;
        });

        // Prepare the sells information
        $sells = $job->sells->map(function ($sell) {
            return [
                'id' => $sell->id,
                'vat' => $sell->vat,
                // Add other fields from the sells as needed
            ];
        });

        // Prepare the response data
        $response = [
            'draft_no' => $draft->draft_no ?? null,
            'shipper_name' => $draft->shipper->name ?? null,
            'shipper_note' => $draft->shipper->note ?? null,
            // 'invoice_informations' => $invoice->toArray(), // Assuming you want to include invoice info
            'sells' => $sells ?? null,
            'sell_sub_total' => $job->sell_sub_total ?? null,
            'sell_total_vat' => $job->sell_total_vat ?? null,
            'sell_grand_total' => $job->sell_grand_total ?? null,
         
        ];

        // Conditionally add 'isvat' to the response
        if ($isVat) {
            $response['isvat'] = 1;
        }

        return response()->json($response);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Return a 404 response if the job or draft is not found
        return response()->json(['message' => 'No draft found for the given invoice number'], 404);
    } catch (\Exception $e) {
        // Return a 500 response for any other errors
        return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}

public function store(Request $request, $id = null)
{
    try {
        $receiptDescriptionId = $request->input('receipt_description_id');


        $lastReceipt = Receipt::orderBy('receipt_no', 'desc')->first();
        // dd($lastReceipt);
        $year = date('y'); // Get the current year in YY format
        $nextReceiptNo = $lastReceipt ? str_pad(intval(substr($lastReceipt->receipt_no, 6)) + 1, 6, '0', STR_PAD_LEFT) : '000001';
        $nextReceiptNoFormatted = "EXP{$year}-{$nextReceiptNo}";

        if (str_starts_with($receiptDescriptionId, 'new=')) {
            $description =    substr($receiptDescriptionId, 4);
             // Create a new Receipt Description entry
             $newDescription = MasterFileReceiptDescription::create([
                'description' => $description,
                'edit_by' => auth()->user()->name,
                'edit_date' => now(),
                // Add other fields as needed
            ]);
            $receiptDescriptionId = $newDescription->id;
        }
      
        // dd($request);
        // Check if we are updating an existing receipt or creating a new one
        if ($id) {
            // Find the existing receipt
            $receipt = Receipt::findOrFail($id);
            

            // Update the receipt fields
            $receipt->update([
                'invoice_no' => $request->input('invoice_no'),
                'receipt_date' => $request->input('receipt_date'),
                'is_vat' => $request->has('is_vat') ? true : false, // Assuming 'is_vat' is a checkbox
                'receipt_description_id' => $receiptDescriptionId,
                'bank' => $request->input('bank'),
                'branch' => $request->input('branch'),
                'bank_number' => $request->input('bank_number'),
                'transaction_date' => $request->input('transaction_date'),
                'payment_method' => $request->input('payment_method'),
                'edit_date' => now(),
                'edit_by' => auth()->user()->id,
            ]);
            $redirectId = $receipt->receipt_no;
        } else {
            // Create a new receipt
            $receipt = Receipt::create([
                'receipt_no' => $nextReceiptNoFormatted,
                'invoice_no' => $request->input('invoice_no'),
                'receipt_date' => $request->input('receipt_date'),
                'is_vat' => $request->has('is_vat') ? true : false, // Assuming 'is_vat' is a checkbox
                'receipt_description_id' => $receiptDescriptionId,
                'bank' => $request->input('bank'),
                'branch' => $request->input('branch'),
                'bank_number' => $request->input('bank_number'),
                'transaction_date' => $request->input('transaction_date'),
                'payment_method' => $request->input('payment_method'),
                'prepared_by' => auth()->user()->id,
                'created_at' => now(),
            ]);
            $redirectId = $nextReceiptNoFormatted;
        }

        return redirect()->route('receipt.edit', ['receiptId' => $redirectId])->with('success', 'Receipt created/updated successfully');
        
    } catch (\Exception $e) {
        // If any other type of exception occurs
        return redirect()->back()->withInput()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}

    

}
