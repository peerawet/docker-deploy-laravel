<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFilePayee;
use Illuminate\Support\Facades\Auth;

class Payee extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch payees with sorting and searching
        $query = MasterFilePayee::query()
            ->orderBy($sortField, $sortOrder);

        // Apply search filter if search value is present
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('payee', 'like', '%' . $searchValue . '%')
                    ->orWhere('note', 'like', '%' . $searchValue . '%')
                    ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
            });
        }

        // Paginate the results
        $allPayees = $query->paginate(50)
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
        return view('front-end.pages.MasterFiles.masterFile-payee', compact('allPayees', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addPayee(Request $request)
    {
        try {
            // Create a new Payee entry
            MasterFilePayee::create([
                'payee' => $request->payee,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.payee', ['#payees'])->with('success', 'Payee added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Payee: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.payee', ['#payees'])->with("error", "Failed to add Payee. Please try again." . $e->getMessage());
        }
    }

    public function deletePayee($id)
    {
        try {
            // Find the Payee entry by ID
            $payee = MasterFilePayee::findOrFail($id);

            // Delete the Payee entry
            $payee->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.payee', ['#payees'])->with('success', 'Payee deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.payee', ['#payees'])->with('error', 'Failed to delete Payee. Please try again.');
        }
    }

    public function updatePayee(Request $request, $id)
    {
        try {
            // Find the Payee entry by ID
            $payee = MasterFilePayee::findOrFail($id);

            // Update the Payee entry with the new data
            $payee->update([
                'payee' => $request->payee,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.payee', ['#payees'])->with('success', 'Payee updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Payee: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.payee', ['#payees'])->with("error", "Failed to update Payee. Please try again.");
        }
    }
}
