<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileSale;
use Illuminate\Support\Facades\Auth;

class Sale extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
{
    // Retrieve query parameters
    $sortField = $request->query('sort_field', 'id');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Query to fetch sales with sorting and searching
    $query = MasterFileSale::query()
        ->orderBy($sortField, $sortOrder);

    // Apply search filter if search value is present
    if (!empty($searchValue)) {
        $query->where(function ($query) use ($searchValue) {
            $query->where('id', 'like', '%' . $searchValue . '%')
                ->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('note', 'like', '%' . $searchValue . '%')
                ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
        });
    }

    // Paginate the results
    $allSales = $query->paginate(50)
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
    return view('front-end.pages.MasterFiles.masterFile-sales', compact('allSales', 'sortField', 'sortOrder', 'searchValue'), $data);
}


    public function addSale(Request $request)
    {
        try {
            // Create a new Sale entry
            MasterFileSale::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.sale', ['#sales'])->with('success', 'Sale added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Sale: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.sale', ['#sales'])->with("error", "Failed to add Sale. Please try again." . $e->getMessage());
        }
    }

    public function deleteSale($id)
    {
        try {
            // Find the Sale entry by ID
            $sale = MasterFileSale::findOrFail($id);

            // Delete the Sale entry
            $sale->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.sale', ['#sales'])->with('success', 'Sale deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.sale', ['#sales'])->with('error', 'Failed to delete Sale. Please try again.');
        }
    }

    public function updateSale(Request $request, $id)
    {
        try {
            // Find the Sale entry by ID
            $sale = MasterFileSale::findOrFail($id);

            // Update the Sale entry with the new data
            $sale->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.sale', ['#sales'])->with('success', 'Sale updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Sale: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.sale', ['#sales'])->with("error", "Failed to update Sale. Please try again.");
        }
    }
}
