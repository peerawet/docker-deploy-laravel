<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileLoadingLocation;
use Illuminate\Support\Facades\Auth;

class LoadingLocation extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
{
    // Retrieve query parameters
    $sortField = $request->query('sort_field', 'id');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Query to fetch loading locations with sorting and searching
    $query = MasterFileLoadingLocation::query()
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
    $allLoadingLocations = $query->paginate(50)
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
    return view('front-end.pages.MasterFiles.masterFile-loading-locations', compact('allLoadingLocations', 'sortField', 'sortOrder', 'searchValue'), $data);
}


    public function addLoadingLocation(Request $request)
    {
        try {
            // Create a new LoadingLocation entry
            MasterFileLoadingLocation::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.loading-location', ['#loadingLocations'])->with('success', 'Loading Location added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Loading Location: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.loading-location', ['#loadingLocations'])->with("error", "Failed to add Loading Location. Please try again." . $e->getMessage());
        }
    }

    public function deleteLoadingLocation($id)
    {
        try {
            // Find the LoadingLocation entry by ID
            $loadingLocation = MasterFileLoadingLocation::findOrFail($id);

            // Delete the LoadingLocation entry
            $loadingLocation->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.loading-location', ['#loadingLocations'])->with('success', 'Loading Location deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.loading-location', ['#loadingLocations'])->with('error', 'Failed to delete Loading Location. Please try again.');
        }
    }

    public function updateLoadingLocation(Request $request, $id)
    {
        try {
            // Find the LoadingLocation entry by ID
            $loadingLocation = MasterFileLoadingLocation::findOrFail($id);

            // Update the LoadingLocation entry with the new data
            $loadingLocation->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.loading-location', ['#loadingLocations'])->with('success', 'Loading Location updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Loading Location: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.loading-location', ['#loadingLocations'])->with("error", "Failed to update Loading Location. Please try again.");
        }
    }
}
