<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileReceiptDescription;
use Illuminate\Support\Facades\Auth;

class ReceiptDescription extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
{
    // Retrieve query parameters
    $sortField = $request->query('sort_field', 'id');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Query to fetch receipt descriptions with sorting and searching
    $query = MasterFileReceiptDescription::query()
        ->orderBy($sortField, $sortOrder);

    // Apply search filter if search value is present
    if (!empty($searchValue)) {
        $query->where(function ($query) use ($searchValue) {
            $query->where('id', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%')
                ->orWhere('note', 'like', '%' . $searchValue . '%')
                ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
        });
    }

    // Paginate the results
    $allDescriptions = $query->paginate(50)
        ->appends([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'search_value' => $searchValue
        ]);

    // Prepare data to pass to view
    $data = [
        'title_layouts' => $this->title_layouts,
    ];

    // Return view with data
    return view('front-end.pages.MasterFiles.masterFile-receipt-descriptions', compact('allDescriptions', 'sortField', 'sortOrder', 'searchValue'), $data);
}


    public function addDescription(Request $request)
    {
        try {
            // Create a new Receipt Description entry
            MasterFileReceiptDescription::create([
                'description' => $request->description,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.receiptDescription', ['#descriptions'])->with('success', 'Receipt Description added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Receipt Description: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.receiptDescription', ['#descriptions'])->with("error", "Failed to add Receipt Description. Please try again.");
        }
    }

    public function deleteDescription($id)
    {
        try {
            // Find the Receipt Description entry by ID
            $description = MasterFileReceiptDescription::findOrFail($id);

            // Delete the Receipt Description entry
            $description->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.receiptDescription', ['#descriptions'])->with('success', 'Receipt Description deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.receiptDescription', ['#descriptions'])->with('error', 'Failed to delete Receipt Description. Please try again.');
        }
    }

    public function updateDescription(Request $request, $id)
    {
        try {
            // Find the Receipt Description entry by ID
            $description = MasterFileReceiptDescription::findOrFail($id);

            // Update the Receipt Description entry with the new data
            $description->update([
                'description' => $request->description,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.receiptDescription', ['#descriptions'])->with('success', 'Receipt Description updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Receipt Description: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.receiptDescription', ['#descriptions'])->with("error", "Failed to update Receipt Description. Please try again.");
        }
    }
}
