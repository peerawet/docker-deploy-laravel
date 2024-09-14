<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileDescription;
use Illuminate\Support\Facades\Auth;

class Description extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch descriptions
        $query = MasterFileDescription::query()
            ->orderBy($sortField, $sortOrder);

        // Apply search filter if search value is present
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%')
                    ->orWhere('invoice_description', 'like', '%' . $searchValue . '%')
                    ->orWhere('edit_by', 'like', '%' . $searchValue . '%')
                    ->orWhere('edit_date', 'like', '%' . $searchValue . '%');
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
        return view('front-end.pages.MasterFiles.masterFile-descriptions', compact('allDescriptions', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addDescription(Request $request)
    {
        try {
            // Create a new description entry
            MasterFileDescription::create([
                'description' => $request->description,
                'invoice_description' => $request->invoice_description,
                'edit_by' => Auth::user()->name,
                'edit_date' => now(),
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.description', ['#descriptions'])->with('success', 'Description added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Description: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.description', ['#descriptions'])->with("error", "Failed to add Description. Please try again." . $e->getMessage());
        }
    }

    public function deleteDescription($id)
    {
        try {
            // Find the description entry by ID
            $description = MasterFileDescription::findOrFail($id);

            // Delete the description entry
            $description->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.description', ['#descriptions'])->with('success', 'Description deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.description', ['#descriptions'])->with('error', 'Failed to delete Description. Please try again.');
        }
    }

    public function updateDescription(Request $request, $id)
    {
        try {
            // Find the description entry by ID
            $description = MasterFileDescription::findOrFail($id);

            // Update the description entry with the new data
            $description->update([
                'description' => $request->description,
                'invoice_description' => $request->invoice_description,
                'edit_by' => Auth::user()->name,
                'edit_date' => now(),
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.description', ['#descriptions'])->with('success', 'Description updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Description: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.description', ['#descriptions'])->with("error", "Failed to update Description. Please try again.");
        }
    }
}
