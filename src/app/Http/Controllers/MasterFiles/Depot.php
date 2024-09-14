<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileDepot;
use Illuminate\Support\Facades\Auth;

class Depot extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch depots
        $query = MasterFileDepot::query()
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
        $allDepot = $query->paginate(50)
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
        return view('front-end.pages.MasterFiles.masterFile-depots', compact('allDepot', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function create()
    {
        $data = [
            'title_layouts' => 'สร้างInvoice'
        ];
        return view('front-end.pages.Invoice.form', $data);
    }

    public function addDepot(Request $request)
    {
        try {


            // Validate the request data
            // $request->validate([
            //     'name' => 'required|string|max:255',
            //     'contact' => 'required|string|max:255',
            //     'tel' => 'required|string|max:20',
            //     // Add validation rules for other Depot fields here
            // ]);

            // Create a new Depot entry
            MasterFileDepot::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'note' => $request->note,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field

            ]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Depot added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Depot: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->back()->withInput()->with("error", "Failed to add Depot. Please try again." . $e->getMessage());
        }
    }

    public function deleteDepot($id)
    {
        try {
            // Find the Depot entry by ID
            $depot = MasterFileDepot::findOrFail($id);

            // Delete the Depot entry
            $depot->delete();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Depot deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->back()->with('error', 'Failed to delete Depot. Please try again.');
        }
    }




    public function updateDepot(Request $request, $id)
    {
        try {



            // Find the Depot entry by ID
            $depot = MasterFileDepot::findOrFail($id);

            // Update the Depot entry with the new data
            $depot->update([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'note' => $request->note,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field

            ]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Depot updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Depot: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->back()->withInput()->with("error", "Failed to update Depot. Please try again.");
        }
    }
}
