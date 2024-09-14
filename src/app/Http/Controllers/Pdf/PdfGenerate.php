<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Draft;
use setasign\Fpdi\Tcpdf\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Models\TruckWaybill;
use Dompdf\Dompdf;
use App\Models\Job;
use Dompdf\Options;



class PdfGenerate extends Controller
{
  
    public function drafts (Request $request)
    {
        // Get the list of draft numbers from the request
        $draftNumbers = $request->input('ids');

        if (is_string($draftNumbers)) {
            $draftNumbers = json_decode($draftNumbers, true);
        }

        // Ensure $draftNumbers is initialized as an array
        $draftNumbers = is_array($draftNumbers) ? $draftNumbers : [];

        // Fetch the drafts based on the draft numbers
        $drafts = Draft::whereIn('draft_no', $draftNumbers)->get();

        // Initialize an empty PDF content
        $pdfContent = '';

        // Loop through each draft and generate its content
        foreach ($drafts as $draft) {
            // Determine the view based on the draft type
            switch ($draft->type) {
                case 'Sea':
                    $viewName = 'front-end.pdf.draftSea';
                    break;
                case 'Truck':
                    $viewName = 'front-end.pdf.draftTruck';
                    break;
                case 'Air':
                    $viewName = 'front-end.pdf.draftAir';
                    break;
                default:
                    // Set a default view if the type is not recognized
                    $viewName = 'front-end.pdf.draftSea';
                    break;
            }

            // Generate content for the current draft
            $content = view($viewName, ['draft' => $draft])->render();

            // Append the content of the current draft to the PDF content
            $pdfContent .= $content;
        }

        // Create a PDF instance and load the HTML content
        $pdf = PDF::loadHTML($pdfContent);

        // Return the PDF for download
        return $pdf->download('drafts.pdf');
    }


    public function truckWaybill(Request $request)
{
     // Get the list of truck waybill IDs from the request
     $waybillIds = $request->input('ids');

     if (is_string($waybillIds)) {
         $waybillIds = json_decode($waybillIds, true);
     }
 
     // Ensure $waybillIds is initialized as an array
     $waybillIds = is_array($waybillIds) ? $waybillIds : [];
 
     // Fetch the truck waybills based on the IDs
     $truckWaybills = TruckWaybill::whereIn('invoice_no', $waybillIds)->get();
 
     // Initialize an empty PDF content
     $pdfContent = '';
 
     // Loop through each truck waybill and generate its content
     foreach ($truckWaybills as $waybill) {
         // Specify the view for the truck waybill PDF content
         $viewName = 'front-end.pdf.truckWaybill';
 
         // Generate content for the current truck waybill
         $content = view($viewName, ['waybill' => $waybill])->render();
 
         // Append the content of the current truck waybill to the PDF content
         $pdfContent .= $content;
 
         // Add a page break after each waybill except the last one
         $pdfContent .= '<div style="page-break-after: always;"></div>';
     }
 
     // Remove the last page break
     $pdfContent = rtrim($pdfContent, '<div style="page-break-after: always;"></div>');
 
     // Configure Dompdf
     $options = new Options();
     $options->set('isHtml5ParserEnabled', true);
     $options->set('isRemoteEnabled', true);
     $options->set('defaultFont', 'Noto Sans Thai');
 
     // Create a new Dompdf instance with configured options
     $dompdf = new Dompdf($options);
 
     // Add inline CSS to load the font from Google Fonts and set margins
     $pdfContent = '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
                     <style>
                          @page {
                                margin-top: 10px; /* Reduced top margin */
                                margin-bottom: 10px; /* Reduced bottom margin */
                            }
                            body { font-family: "Noto Sans Thai", sans-serif; margin: 0; }
                            table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 9px; }
                            th, td { border: 1px solid black; padding: 8px; text-align: left; vertical-align: top; }
                            th { background-color: #f2f2f2; }
                            .header, .section-header { font-weight: bold; }
                            .center { text-align: center; vertical-align: middle; }
                            .small-text { font-size: 7.5px; width: 100%; word-wrap: break-word; }
                            .font { font-family: "Noto Sans Thai", sans-serif; }
                     </style>' . $pdfContent;
 
     // Load HTML content into Dompdf
     $dompdf->loadHtml($pdfContent);
 
     // Set paper size and orientation
     $dompdf->setPaper('A4', 'portrait');
 
     // Render the HTML as PDF
     $dompdf->render();
 
     // Output the generated PDF to the browser
     return $dompdf->stream();
}



public function jobs(Request $request)
{
    // Get the list of job numbers from the request
    $jobNumbers = $request->input('ids');

    if (is_string($jobNumbers)) {
        $jobNumbers = json_decode($jobNumbers, true);
    }

    // Ensure $jobNumbers is initialized as an array
    $jobNumbers = is_array($jobNumbers) ? $jobNumbers : [];

    // Fetch the jobs based on the job numbers
    $jobs = Job::whereIn('job_no', $jobNumbers)->get();

    // Initialize an empty PDF content
    $pdfContent = '';

    // Loop through each job and generate its content
    foreach ($jobs as $job) {
        // Specify the view for the job PDF content
        $viewName = 'front-end.pdf.job';

        // Generate content for the current job
        $content = view($viewName, ['job' => $job])->render();

        // Append the content of the current job to the PDF content
        $pdfContent .= $content;

        // Add a page break after each job except the last one
        $pdfContent .= '<div style="page-break-after: always;"></div>';
    }

    // Remove the last page break
    $pdfContent = rtrim($pdfContent, '<div style="page-break-after: always;"></div>');

    // Add inline CSS to set margins to 50px
    $htmlContent = '<style>
        @page { margin: 20px; }
        body { margin: 0px; }
    </style>' . $pdfContent;

    // Configure Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Roboto');

    // Create a new Dompdf instance with configured options
    $dompdf = new Dompdf($options);

    // Load HTML content into Dompdf
    $dompdf->loadHtml($htmlContent);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to the browser for download
    return $dompdf->stream('jobs.pdf');
}


}
