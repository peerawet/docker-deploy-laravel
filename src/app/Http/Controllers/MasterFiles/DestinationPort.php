<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileDestinationPort; // Assuming you have a MasterFileDestinationPort model
use Illuminate\Support\Facades\Auth;

class DestinationPort extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch destination ports
        $query = MasterFileDestinationPort::query()
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

        // Paginate the results (assuming pagination is needed)
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
        return view('front-end.pages.MasterFiles.masterFile-destination_port', compact('allPorts', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addDestinationPort(Request $request)
    {
        try {
            // Create a new DestinationPort entry
            MasterFileDestinationPort::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.destination-port')->with('success', 'Destination Port added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Destination Port: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.destination-port')->with("error", "Failed to add Destination Port. Please try again." . $e->getMessage());
        }
    }

    public function deleteDestinationPort($id)
    {
        try {
            // Find the DestinationPort entry by ID
            $port = MasterFileDestinationPort::findOrFail($id);

            // Delete the DestinationPort entry
            $port->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.destination-port')->with('success', 'Destination Port deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.destination-port')->with('error', 'Failed to delete Destination Port. Please try again.');
        }
    }

    public function updateDestinationPort(Request $request, $id)
    {
        try {
            // Find the DestinationPort entry by ID
            $port = MasterFileDestinationPort::findOrFail($id);

            // Update the DestinationPort entry with the new data
            $port->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.destination-port')->with('success', 'Destination Port updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Destination Port: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.destination-port')->with("error", "Failed to update Destination Port. Please try again.");
        }
    }
}
