<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileTranshipmentPort; // Assuming you have a MasterFileTranshipmentPort model
use Illuminate\Support\Facades\Auth;

class TranshipmentPort extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch transhipment ports with sorting and searching
        $query = MasterFileTranshipmentPort::query()
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
        return view('front-end.pages.MasterFiles.masterFile-transhipment-port', compact('allPorts', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addTranshipmentPort(Request $request)
    {
        try {
            // Create a new TranshipmentPort entry
            MasterFileTranshipmentPort::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.transhipment-port')->with('success', 'Transhipment Port added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Transhipment Port: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.transhipment-port')->with("error", "Failed to add Transhipment Port. Please try again." . $e->getMessage());
        }
    }

    public function deleteTranshipmentPort($id)
    {
        try {
            // Find the TranshipmentPort entry by ID
            $port = MasterFileTranshipmentPort::findOrFail($id);

            // Delete the TranshipmentPort entry
            $port->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.transhipment-port')->with('success', 'Transhipment Port deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.transhipment-port')->with('error', 'Failed to delete Transhipment Port. Please try again.');
        }
    }

    public function updateTranshipmentPort(Request $request, $id)
    {
        try {
            // Find the TranshipmentPort entry by ID
            $port = MasterFileTranshipmentPort::findOrFail($id);

            // Update the TranshipmentPort entry with the new data
            $port->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.transhipment-port')->with('success', 'Transhipment Port updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Transhipment Port: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.transhipment-port')->with("error", "Failed to update Transhipment Port. Please try again.");
        }
    }
}
