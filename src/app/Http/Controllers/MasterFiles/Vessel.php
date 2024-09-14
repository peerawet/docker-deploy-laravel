<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileVessel;
use Illuminate\Support\Facades\Auth;

class Vessel extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch vessels with sorting and searching
        $query = MasterFileVessel::query()
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
        $allVessels = $query->paginate(50)
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
        return view('front-end.pages.MasterFiles.masterFile-vessels', compact('allVessels', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addVessel(Request $request)
    {
        try {
            // Create a new Vessel entry
            MasterFileVessel::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.vessel', ['#vessels'])->with('success', 'Vessel added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Vessel: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.vessel', ['#vessels'])->with("error", "Failed to add Vessel. Please try again." . $e->getMessage());
        }
    }

    public function deleteVessel($id)
    {
        try {
            // Find the Vessel entry by ID
            $vessel = MasterFileVessel::findOrFail($id);

            // Delete the Vessel entry
            $vessel->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.vessel', ['#vessels'])->with('success', 'Vessel deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.vessel', ['#vessels'])->with('error', 'Failed to delete Vessel. Please try again.');
        }
    }

    public function updateVessel(Request $request, $id)
    {
        try {
            // Find the Vessel entry by ID
            $vessel = MasterFileVessel::findOrFail($id);

            // Update the Vessel entry with the new data
            $vessel->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.vessel', ['#vessels'])->with('success', 'Vessel updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Vessel: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.vessel', ['#vessels'])->with("error", "Failed to update Vessel. Please try again.");
        }
    }
}
