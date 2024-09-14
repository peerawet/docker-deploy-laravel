<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileExpenseDescription;
use Illuminate\Support\Facades\Auth;

class ExpenseDescription extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch expense descriptions with sorting and searching
        $query = MasterFileExpenseDescription::query()
            ->orderBy($sortField, $sortOrder);

        // Apply search filter if search value is present
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%')
                    ->orWhere('note', 'like', '%' . $searchValue . '%')
                    ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
            });
        }

        // Paginate the results
        $allExpenseDescriptions = $query->paginate(50)
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
        return view('front-end.pages.MasterFiles.masterFile-expense-description', compact('allExpenseDescriptions', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addExpenseDescription(Request $request)
    {
        try {
            // Create a new Expense Description entry
            MasterFileExpenseDescription::create([
                'description' => $request->description,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.expense-description', ['#expense-descriptions'])->with('success', 'Expense Description added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Expense Description: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.expense-description', ['#expense-descriptions'])->with("error", "Failed to add Expense Description. Please try again." . $e->getMessage());
        }
    }

    public function deleteExpenseDescription($id)
    {
        try {
            // Find the Expense Description entry by ID
            $expenseDescription = MasterFileExpenseDescription::findOrFail($id);

            // Delete the Expense Description entry
            $expenseDescription->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.expense-description', ['#expense-descriptions'])->with('success', 'Expense Description deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.expense-description', ['#expense-descriptions'])->with('error', 'Failed to delete Expense Description. Please try again.');
        }
    }

    public function updateExpenseDescription(Request $request, $id)
    {
        try {
            // Find the Expense Description entry by ID
            $expenseDescription = MasterFileExpenseDescription::findOrFail($id);

            // Update the Expense Description entry with the new data
            $expenseDescription->update([
                'description' => $request->description,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.expense-description', ['#expense-descriptions'])->with('success', 'Expense Description updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Expense Description: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.expense-description', ['#expense-descriptions'])->with("error", "Failed to update Expense Description. Please try again.");
        }
    }
}
