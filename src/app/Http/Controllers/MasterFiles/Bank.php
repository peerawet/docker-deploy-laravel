<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileBank;
use Illuminate\Support\Facades\Auth;

class Bank extends Controller
{
    public $title_layouts = 'Master Files';

    public function index()
    {
        $allBanks = MasterFileBank::all();

        $data = [
            'title_layouts' => $this->title_layouts,
        ];

        return view('front-end.pages.MasterFiles.masterFile-banks', ['allBanks' => $allBanks], $data);
    }

    public function addBank(Request $request)
    {
        try {
            // Create a new Bank entry
            MasterFileBank::create([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Add other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.bank', ['#banks'])->with('success', 'Bank added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Bank: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.bank', ['#banks'])->with("error", "Failed to add Bank. Please try again." . $e->getMessage());
        }
    }

    public function deleteBank($id)
    {
        try {
            // Find the Bank entry by ID
            $bank = MasterFileBank::findOrFail($id);

            // Delete the Bank entry
            $bank->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.bank', ['#banks'])->with('success', 'Bank deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.bank', ['#banks'])->with('error', 'Failed to delete Bank. Please try again.');
        }
    }

    public function updateBank(Request $request, $id)
    {
        try {
            // Find the Bank entry by ID
            $bank = MasterFileBank::findOrFail($id);

            // Update the Bank entry with the new data
            $bank->update([
                'name' => $request->name,
                'note' => $request->note,
                'edit_by' => Auth::user()->name,
                // Update other fields as needed
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.bank', ['#banks'])->with('success', 'Bank updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Bank: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.bank', ['#banks'])->with("error", "Failed to update Bank. Please try again.");
        }
    }
}
