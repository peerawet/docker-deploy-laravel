<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileGateInDepot;
use Illuminate\Support\Facades\Auth;

class GateInDepot extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
{
    // Retrieve query parameters
    $sortField = $request->query('sort_field', 'id');
    $sortOrder = $request->query('sort_order', 'desc');
    $searchValue = $request->query('search_value', '');

    // Query to fetch depots with sorting and searching
    $query = MasterFileGateInDepot::query()
        ->orderBy($sortField, $sortOrder);

    // Apply search filter if search value is present
    if (!empty($searchValue)) {
        $query->where(function ($query) use ($searchValue) {
            $query->where('id', 'like', '%' . $searchValue . '%')
                ->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('contact', 'like', '%' . $searchValue . '%')
                ->orWhere('tel', 'like', '%' . $searchValue . '%')
                ->orWhere('note', 'like', '%' . $searchValue . '%')
                ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
        });
    }

    // Paginate the results
    $allGateInDepot = $query->paginate(50)
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
    return view('front-end.pages.MasterFiles.masterFile-gate-in-depots', compact('allGateInDepot', 'sortField', 'sortOrder', 'searchValue'), $data);
}


    public function addGateInDepot(Request $request)
    {
        try {
            // Create a new GateInDepot entry
            MasterFileGateInDepot::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'note' => $request->note,
                'paper_less' => $request->paper_less,

                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.gate-in-depot', ['#gate-in-depot'])->with('success', 'Gate In Depot added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Gate In Depot: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.gate-in-depot', ['#gate-in-depot'])->with("error", "Failed to add Gate In Depot. Please try again." . $e->getMessage());
        }
    }

    public function deleteGateInDepot($id)
    {
        try {
            // Find the GateInDepot entry by ID
            $gateInDepot = MasterFileGateInDepot::findOrFail($id);

            // Delete the GateInDepot entry
            $gateInDepot->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.gate-in-depot', ['#gate-in-depot'])->with('success', 'Gate In Depot deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.gate-in-depot', ['#gate-in-depot'])->with('error', 'Failed to delete Gate In Depot. Please try again.');
        }
    }

    public function updateGateInDepot(Request $request, $id)
    {
        try {
            // Find the GateInDepot entry by ID
            $gateInDepot = MasterFileGateInDepot::findOrFail($id);

            // Update the GateInDepot entry with the new data
            $gateInDepot->update([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'note' => $request->note,
                'paper_less' => $request->paper_less,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.gate-in-depot', ['#gate-in-depot'])->with('success', 'Gate In Depot updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Gate In Depot: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.gate-in-depot', ['#gate-in-depot'])->with("error", "Failed to update Gate In Depot. Please try again.");
        }
    }
}
