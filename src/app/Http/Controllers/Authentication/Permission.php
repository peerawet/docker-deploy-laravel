<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class Permission extends Controller
{


    public function index()
    {
        $title_layouts = 'จัดการสิทธิ์การเข้าถึง';
        // Fetch roles from the database
        $roles = Role::all(); // Or use any other method to fetch roles as per your requirements
        $data = [
            'title_layouts' => $title_layouts,
        ];

        // Pass roles data to the view
        return view('front-end.pages.users.permission.index', ['roles' => $roles], $data);
    }


    public function create()
    {
        $menus = Menu::all();
        $title_layouts = 'เพิ่มผู้แผนกใหม่';
        $data = [
            'title_layouts' => $title_layouts,
        ];
        return view('front-end.pages.users.permission.form', [

            'menus' => $menus,

        ], $data);
    }

    public function createPost(Request $request)
    {
        $menuIds = $request->input('menus', []);
        try {
            $request->validate([
                'name' => 'required',
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Create the role and set the create_by field
            $role = Role::create([
                'name' => $request->name,
                'create_by' => $user->username // Assuming username is the correct attribute
            ]);

            $role->menus()->sync($menuIds);

            // Check if the role was successfully created
            if (!$role) {
                return redirect()->route('users.permission.create')->with("error", "Create new role error");
            }

            // Redirect with success message
            return redirect()->route('users.permission.index')->with("success", "Create new role successful");
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->route('users.permission.create')->with("error", "Failed to create new role. Please try again.");
        }
    }



    public function edit(Request $request)
    {
        $title_layouts = 'แก้ไขสิทธิ์การเข้าถึง';
        $data = [
            'title_layouts' => $title_layouts,
        ];
        $menus = Menu::all();


        // Retrieve the user's role
        $role_id = $request->roleId;
        $role = Role::find($role_id);

        // Pass the user's data, role, and manus to the view
        return view('front-end.pages.users.permission.formEditPermission', [
            'role' => $role,
            'menus' => $menus,

        ], $data);
    }





    public function editPost(Request $request)
    {
        // Validate the request data as needed
        // $request->validate([
        //     'name' => 'required', // Define your validation rules here if necessary
        // ]);

        // Retrieve the role ID from the request
        $roleId = $request->roleId;

        // Retrieve the selected menu IDs from the request
        $menuIds = $request->input('menus', []);

        try {
            // Find the role by ID
            $role = Role::find($roleId);

            // Check if the role exists
            if (!$role) {
                return redirect()->back()->with("error", "Role not found");
            }

            // Update the updated_at timestamp
            $role->touch();

            // Update the update_by column
            $role->update_by = Auth::user()->username; // Assuming the username is used for updating

            // Sync the role's associated menus with the selected menu IDs
            $role->menus()->sync($menuIds);

            // Save the changes to the role
            $role->save();

            // Redirect back to the index page with a success message
            return redirect()->route('users.permission.index')->with("success", "Role permissions updated successfully");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error("Failed to update role permissions: " . $e->getMessage());

            // Redirect back to the form with a more informative error message
            return redirect()->back()->with("error", "Failed to update role permissions. Please try again or contact support.");
        }
    }




    public function delete($roleId)
    {
        // Find the role by ID
        $role = Role::find($roleId);

        // Check if the role exists
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        // Check if the role is associated with any users
        if ($role->users()->exists()) {
            return redirect()->route('users.permission.index')->with("error", "Cannot delete role as it is associated with users.");
        }

        // Delete the role
        $role->delete();

        // Redirect to the index page with a success message
        return redirect()->route('users.permission.index')->with("success", "Role deleted successfully");
    }
}
