<?php

namespace App\Http\Controllers\MasterFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterFileAgent;
use Illuminate\Support\Facades\Auth;

class Agent extends Controller
{
    public $title_layouts = 'Master Files';

    public function index(Request $request)
    {
        $sortField = $request->query('sort_field', 'id');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchValue = $request->query('search_value', '');

        $allAgents = MasterFileAgent::query()
            ->orderBy($sortField, $sortOrder)
            ->when($searchValue, function ($query) use ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orWhere('name', 'like', '%' . $searchValue . '%')
                        ->orWhere('contact', 'like', '%' . $searchValue . '%')
                        ->orWhere('tel', 'like', '%' . $searchValue . '%')
                        ->orWhere('agent_id', 'like', '%' . $searchValue . '%')
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

        return view('front-end.pages.MasterFiles.masterFile-agents', compact('allAgents', 'sortField', 'sortOrder', 'searchValue'), $data);
    }


    public function addAgent(Request $request)
    {
        try {
            // Create a new Agent entry
            MasterFileAgent::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'agent_id' => $request->agent_id,
                'note' => $request->note,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field
            ]);

            // Redirect back to the index page with the #agent anchor
            return redirect()->route('masterFiles.index.agent', ['#agent'])->with('success', 'Agent added successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to add Agent: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.agent', ['#agent'])->with("error", "Failed to add Agent. Please try again. " . $e->getMessage());
        }
    }

    public function deleteAgent($id)
    {
        try {
            // Find the Agent entry by ID
            $agent = MasterFileAgent::findOrFail($id);

            // Delete the Agent entry
            $agent->delete();

            // Redirect back with success message
            return redirect()->route('masterFiles.index.agent', ['#agent'])->with('success', 'Agent deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return redirect()->route('masterFiles.index.agent', ['#agent'])->with('error', 'Failed to delete Agent. Please try again.');
        }
    }

    public function updateAgent(Request $request, $id)
    {
        try {
            // Find the Agent entry by ID
            $agent = MasterFileAgent::findOrFail($id);

            // Update the Agent entry with the new data
            $agent->update([
                'name' => $request->name,
                'contact' => $request->contact,
                'tel' => $request->tel,
                'agent_id' => $request->agent_id,
                'note' => $request->note,
                'edit_by' => Auth::user()->name, // Assuming the user's name is stored in the 'name' field
            ]);

            // Redirect back with success message
            return redirect()->route('masterFiles.index.agent', ['#agent'])->with('success', 'Agent updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update Agent: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->route('masterFiles.index.agent', ['#agent'])->withInput()->with("error", "Failed to update Agent. Please try again.");
        }
    }
}
