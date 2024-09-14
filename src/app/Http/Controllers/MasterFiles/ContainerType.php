<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileContainerType;
use Illuminate\Support\Facades\Auth;

class ContainerType extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');
    
        $allContainerTypes = MasterFileContainerType::query()
            ->orderBy($sortField, $sortOrder)
            ->when($searchValue, function ($query) use ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('size', 'like', '%' . $searchValue . '%')
                        ->orWhere('note', 'like', '%' . $searchValue . '%')
                        ->orWhere('edit_by', 'like', '%' . $searchValue . '%')
                        ->orWhere('edit_date', 'like', '%' . $searchValue . '%');
                });
            })
            ->paginate(50)
            ->appends([
                'sort_field' => $sortField,
                'sort_order' => $sortOrder,
                'search_value' => $searchValue
            ]);
    
        $data = [
            'title_layouts' => $this->title_layouts,
        ];
    
        return view('front-end.pages.MasterFiles.masterFile-container-types', compact('allContainerTypes', 'sortField', 'sortOrder', 'searchValue'), $data);
    }
    
    public function addContainerType(Request $request)
    {
        try {


            // Create a new ContainerType entry
            MasterFileContainerType::create([
                'qty' => $request->qty,
                'size' => $request->size,
                'temp' => $request->temp,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.container-type', ['#container-type'])->with('success', 'Container Type added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Container Type: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.container-type', ['#container-type'])->with("error", "Failed to add Container Type. Please try again." . $e->getMessage());
        }
    }

    public function deleteContainerType($id)
    {
        try {
            // Find the ContainerType entry by ID
            $containerType = MasterFileContainerType::findOrFail($id);

            // Delete the ContainerType entry
            $containerType->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.container-type', ['#container-type'])->with('success', 'Container Type deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.container-type', ['#container-type'])->with('error', 'Failed to delete Container Type. Please try again.');
        }
    }

    public function updateContainerType(Request $request, $id)
    {
        try {
            // Find the ContainerType entry by ID
            $containerType = MasterFileContainerType::findOrFail($id);

            // Update the ContainerType entry with the new data
            $containerType->update([
                'qty' => $request->qty,
                'size' => $request->size,
                'temp' => $request->temp,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.container-type', ['#container-type'])->with('success', 'Container Type updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Container Type: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.container-type', ['#container-type'])->with("error", "Failed to update Container Type. Please try again.");
        }
    }
}
