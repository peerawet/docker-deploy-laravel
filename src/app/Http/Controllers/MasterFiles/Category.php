<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileCategory;
use Illuminate\Support\Facades\Auth;

class Category extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        // Retrieve query parameters
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        // Query to fetch categories with sorting and searching
        $query = MasterFileCategory::query()
            ->orderBy($sortField, $sortOrder);

        // Apply search filter if search value is present
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('category', 'like', '%' . $searchValue . '%')
                    ->orWhere('note', 'like', '%' . $searchValue . '%')
                    ->orWhere('edit_by', 'like', '%' . $searchValue . '%');
            });
        }

        // Paginate the results
        $allCategories = $query->paginate(50)
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
        return view('front-end.pages.MasterFiles.masterFile-category', compact('allCategories', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addCategory(Request $request)
    {
        try {
            // Create a new Category entry
            MasterFileCategory::create([
                'category' => $request->category,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.category', ['#categories'])->with('success', 'Category added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Category: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.category', ['#categories'])->with("error", "Failed to add Category. Please try again.");
        }
    }

    public function deleteCategory($id)
    {
        try {
            // Find the Category entry by ID
            $category = MasterFileCategory::findOrFail($id);

            // Delete the Category entry
            $category->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.category', ['#categories'])->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.category', ['#categories'])->with('error', 'Failed to delete Category. Please try again.');
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            // Find the Category entry by ID
            $category = MasterFileCategory::findOrFail($id);

            // Update the Category entry with the new data
            $category->update([
                'category' => $request->category,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.category', ['#categories'])->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Category: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.category', ['#categories'])->with("error", "Failed to update Category. Please try again.");
        }
    }
}
