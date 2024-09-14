<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pdf\PdfGenerate;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Dompdf\Options;


Route::prefix('pdf')->middleware('auth')->group(function () {
    Route::prefix('selected')->group(function () {
        Route::post('/draft', [PdfGenerate::class, 'drafts'])->name('pdf.selected.draft');
        // Route::post('/draft', [PdfGenerate::class, 'truckWaybill'])->name('pdf.selected.truckWaybill');
        Route::post('/job', [PdfGenerate::class, 'jobs'])->name('pdf.selected.job');
    });

    Route::prefix('single')->group(function () {
        Route::post('/draft', function (Request $request) {
            // Get the HTML content from the request
            $htmlContent = $request->input('html_content');
        
            // Inline CSS to reduce top margin
            $htmlContent = '<style>
                                @page {
                                    margin-top: 40px;
                                }
                            </style>' . $htmlContent;
        
            // Configure domPDF
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $options->set('defaultFont', 'Roboto');
        
            // Create a new Dompdf instance with configured options
            $dompdf = new Dompdf($options);
        
            // Load HTML content into Dompdf
            $dompdf->loadHtml($htmlContent);
        
            // (Optional) Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
        
            // Render the HTML as PDF
            $dompdf->render();
        
            // Output the generated PDF to the browser
            return $dompdf->stream('draft.pdf', ["Attachment" => false]);
        })->name('pdf.single.draft');
        

        Route::post('/legal', function (Request $request) {
            // Get the HTML content from the request
            $htmlContent = $request->input('html_content');
        
            // Configure domPDF options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
        
            // Create a new Dompdf instance with configured options
            $dompdf = new Dompdf($options);
        
            // Load HTML content into Dompdf
            $dompdf->loadHtml($htmlContent);
        
            // Set paper size to legal (8.5 x 14 inches)
            $dompdf->setPaper('legal');
        
            // (Optional) Set paper orientation (portrait or landscape)
            $dompdf->setPaper('legal', 'landscape'); // or 'landscape'
        
            // Render the HTML as PDF
            $dompdf->render();
        
            // Output the generated PDF to the browser
            return $dompdf->stream('legal.pdf', ["Attachment" => false]);
        })->name('pdf.single.legal');
    });

    Route::post('/job', function (Request $request) {
        // Get the HTML content from the request
        $htmlContent = $request->input('html_content');
    
        // Configure domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Roboto');
    
        // Create a new Dompdf instance with configured options
        $dompdf = new Dompdf($options);
    
        // Add inline CSS to set margins to 50px
        $htmlContent = '<style>
            @page { margin: 20px; }
            body { margin: 0px; }
        </style>' . $htmlContent;
    
        // Load HTML content into Dompdf
        $dompdf->loadHtml($htmlContent);
    
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Output the generated PDF to the browser
        return $dompdf->stream('job.pdf', ["Attachment" => false]);
    })->name('pdf.single.job');

    Route::post('/truck-waybill', function (Request $request) {
        // Get the HTML content from the request
        $htmlContent = $request->input('html_content');
    
        // Configure domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Noto Sans Thai');
    
        // Create a new Dompdf instance with configured options
        $dompdf = new Dompdf($options);
    
        // Add inline CSS to load the font from Google Fonts and reduce margins
        $htmlContent = '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
                        <style>
                            @page {
                                margin-top: 10px; /* Reduced top margin */
                                margin-bottom: 10px; /* Reduced bottom margin */
                                margin-left: 20px;
                                margin-right: 20px;
                            }
                            body { font-family: "Noto Sans Thai", sans-serif; margin: 0; }
                            table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 9px; }
                            th, td { border: 1px solid black; padding: 8px; text-align: left; vertical-align: top; }
                            th { background-color: #f2f2f2; }
                            .header, .section-header { font-weight: bold; }
                            .center { text-align: center; vertical-align: middle; }
                            .small-text { font-size: 7.5px; width: 100%; word-wrap: break-word; }
                            .font { font-family: "Noto Sans Thai", sans-serif; }
                        </style>' . $htmlContent;
    
        // Load HTML content into Dompdf
        $dompdf->loadHtml($htmlContent);
    
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Output the generated PDF to the browser
        return $dompdf->stream('truck-waybill.pdf', ["Attachment" => false]);
    })->name('pdf.single.truck-waybill');

    Route::post('/invoice', function (Request $request) {
        // Get the HTML content from the request
        $htmlContent = $request->input('html_content');
    
        // Configure domPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Roboto');
    
        // Create a new Dompdf instance with configured options
        $dompdf = new Dompdf($options);
    
        // Add inline CSS to set margins to 50px
        $htmlContent = '<style>
            @page { margin: 20px; }
            body { margin: 0px; }
        </style>' . $htmlContent;
    
        // Load HTML content into Dompdf
        $dompdf->loadHtml($htmlContent);
    
        // Set paper size and orientation
        $dompdf->setPaper('letter', 'portrait');
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Output the generated PDF to the browser
        return $dompdf->stream('invoice.pdf', ["Attachment" => false]);
    })->name('pdf.single.invoice');
});
