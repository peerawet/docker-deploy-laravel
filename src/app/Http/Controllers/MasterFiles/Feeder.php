<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileFeeder; // Assuming you have a Feeder model
use Illuminate\Support\Facades\Auth;

class Feeder extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch feeders
        $query = MasterFileFeeder::query()
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
        $allFeeders = $query->paginate(50)
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
        return view('front-end.pages.MasterFiles.masterFile-feeders', compact('allFeeders', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addFeeder(Request $request)
    {
        try {
            // Create a new Feeder entry
            MasterFileFeeder::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.feeder', ['#feeders'])->with('success', 'Feeder added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Feeder: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.feeder', ['#feeders'])->with("error", "Failed to add Feeder. Please try again." . $e->getMessage());
        }
    }

    public function deleteFeeder($id)
    {
        try {
            // Find the Feeder entry by ID
            $feeder = MasterFileFeeder::findOrFail($id);

            // Delete the Feeder entry
            $feeder->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.feeder', ['#feeders'])->with('success', 'Feeder deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.feeder', ['#feeders'])->with('error', 'Failed to delete Feeder. Please try again.');
        }
    }

    public function updateFeeder(Request $request, $id)
    {
        try {
            // Find the Feeder entry by ID
            $feeder = MasterFileFeeder::findOrFail($id);

            // Update the Feeder entry with the new data
            $feeder->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.feeder', ['#feeders'])->with('success', 'Feeder updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Feeder: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.feeder', ['#feeders'])->with("error", "Failed to update Feeder. Please try again.");
        }
    }
}
