<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileLoadingPort; // Update the model reference to the LoadingPort model
use Illuminate\Support\Facades\Auth;

class LoadingPort extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
{
    // Retrieve query parameters
    $sortField = $request->query('sort_field', 'id');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Query to fetch loading ports with sorting and searching
    $query = MasterFileLoadingPort::query()
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
    $allPorts = $query->paginate(50)
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
    return view('front-end.pages.MasterFiles.masterFile-loading-port', compact('allPorts', 'sortField', 'sortOrder', 'searchValue'), $data);
}

    public function addLoadingPort(Request $request)
    {
        try {
            // Create a new LoadingPort entry
            MasterFileLoadingPort::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.loading-port')->with('success', 'Loading Port added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Loading Port: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.loading-port')->with("error", "Failed to add Loading Port. Please try again." . $e->getMessage());
        }
    }

    public function deleteLoadingPort($id)
    {
        try {
            // Find the LoadingPort entry by ID
            $port = MasterFileLoadingPort::findOrFail($id);

            // Delete the LoadingPort entry
            $port->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.loading-port')->with('success', 'Loading Port deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.loading-port')->with('error', 'Failed to delete Loading Port. Please try again.');
        }
    }

    public function updateLoadingPort(Request $request, $id)
    {
        try {
            // Find the LoadingPort entry by ID
            $port = MasterFileLoadingPort::findOrFail($id);

            // Update the LoadingPort entry with the new data
            $port->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.loading-port')->with('success', 'Loading Port updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Loading Port: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.loading-port')->with("error", "Failed to update Loading Port. Please try again.");
        }
    }
}
