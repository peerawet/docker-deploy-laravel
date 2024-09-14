<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileDeliveryLocation;
use Illuminate\Support\Facades\Auth;

class DeliveryLocation extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        $allDeliveryLocations = MasterFileDeliveryLocation::query()
            ->orderBy($sortField, $sortOrder)
            ->when($searchValue, function ($query) use ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('name', 'like', '%' . $searchValue . '%')
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

        return view('front-end.pages.MasterFiles.masterFile-delivery-locations', compact('allDeliveryLocations', 'sortField', 'sortOrder', 'searchValue'), $data);
    }

    public function addDeliveryLocation(Request $request)
    {
        try {
            // Create a new DeliveryLocation entry
            MasterFileDeliveryLocation::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.delivery-location', ['#deliveryLocations'])->with('success', 'Delivery Location added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Delivery Location: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.delivery-location', ['#deliveryLocations'])->with("error", "Failed to add Delivery Location. Please try again." . $e->getMessage());
        }
    }

    public function deleteDeliveryLocation($id)
    {
        try {
            // Find the DeliveryLocation entry by ID
            $deliveryLocation = MasterFileDeliveryLocation::findOrFail($id);

            // Delete the DeliveryLocation entry
            $deliveryLocation->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.delivery-location', ['#deliveryLocations'])->with('success', 'Delivery Location deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.delivery-location', ['#deliveryLocations'])->with('error', 'Failed to delete Delivery Location. Please try again.');
        }
    }

    public function updateDeliveryLocation(Request $request, $id)
    {
        try {
            // Find the DeliveryLocation entry by ID
            $deliveryLocation = MasterFileDeliveryLocation::findOrFail($id);

            // Update the DeliveryLocation entry with the new data
            $deliveryLocation->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.delivery-location', ['#deliveryLocations'])->with('success', 'Delivery Location updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Delivery Location: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.delivery-location', ['#deliveryLocations'])->with("error", "Failed to update Delivery Location. Please try again.");
        }
    }
}
