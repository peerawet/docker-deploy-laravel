<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileShipper;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterFileSale;

class Shipper extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch shippers with sorting and searching
        $query = MasterFileShipper::query()
            ->with('sale') // Eager load the 'sale' relationship
            ->orderBy($sortField, $sortOrder);

        // Apply search filter if search value is present
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('contact', 'like', '%' . $searchValue . '%')
                    ->orWhere('tel', 'like', '%' . $searchValue . '%')
                    ->orWhere('address', 'like', '%' . $searchValue . '%')
                    ->orWhere('note', 'like', '%' . $searchValue . '%')
                    ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
            });
        }

        // Paginate the results
        $allShippers = $query->paginate(50)
            ->appends([
                'sort_field' => $sortField,
                'sort_order' => $sortOrder,
                'search_value' => $searchValue
            ]);
            $masterFileSales = MasterFileSale::all(); // You might need to adjust this query to fit your specific needs
        // Prepare data to pass to view
        $data = [
            'title_layouts' => $this->title_layouts,
        ];

        // Return view with data
        return view('front-end.pages.MasterFiles.masterFile-shippers', compact('allShippers', 'sortField', 'sortOrder', 'searchValue', 'masterFileSales'), $data);
    }

    public function addShipper(Request $request)
    {
        try {
            // Determine if sale_id is provided in the request
            $saleId = $request->sale_id ?? null;

            // Create a new Shipper entry
            MasterFileShipper::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'address' => $request->address,
                'note' => $request->note,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field
                'sale_id' => $saleId, // Assign sale_id if available
            ]);

            // Redirect back to the index page with the #shipper anchor
            return redirect()->route('masterFiles.index.shipper', ['#shipper'])->with('success', 'Shipper added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Shipper: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.shipper', ['#shipper'])->with("error", "Failed to add Shipper. Please try again. " . $e->getMessage());
        }
    }

    public function deleteShipper($id)
    {
        try {
            // Find the Shipper entry by ID
            $shipper = MasterFileShipper::findOrFail($id);

            // Delete the Shipper entry
            $shipper->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.shipper', ['#shipper'])->with('success', 'Shipper deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.shipper', ['#shipper'])->with('error', 'Failed to delete Shipper. Please try again.');
        }
    }

    public function updateShipper(Request $request, $id)
    {
        try {
            // Determine if sale_id is provided in the request
            $saleId = $request->sale_id ?? null;

            // Find the Shipper entry by ID
            $shipper = MasterFileShipper::findOrFail($id);

            // Update the Shipper entry with the new data
            $shipper->update([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'address' => $request->address,
                'note' => $request->note,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field
                'sale_id' => $saleId, // Update sale_id if available
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.shipper', ['#shipper'])->with('success', 'Shipper updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Shipper: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.shipper', ['#shipper'])->withInput()->with("error", "Failed to update Shipper. Please try again.");
        }
    }
}
