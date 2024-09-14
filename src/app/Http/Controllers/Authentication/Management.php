<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class Management extends Controller
{

    public function index()
    {
        // Retrieve data from the users table along with role information
        $users = User::select('users.*', 'roles.name as role_name')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->get();

        $title_layouts = 'รายชื่อผู้ใช้งาน';

        // Pass data to the view
        return view('front-end.pages.users.management.index', [
            'title_layouts' => $title_layouts,
            'users' => $users,
        ]);
    }
    public function create()
    {
        // Fetch all roles from the database
        $roles = Role::all();
        $title_layouts = 'เพิ่มผู้ใช้งาน';
        $data = [
            'title_layouts' => $title_layouts,
        ];
        return view('front-end.pages.users.management.formRegister', ['roles' => $roles], $data);
    }



    public function editUserAccount(Request $request)
    {
        $title_layouts = 'แก้ไขผู้ใช้งาน';
        $data = [
            'title_layouts' => $title_layouts,
        ];
        // Fetch the user ID from the request
        $userId = $request->userId;

        // Fetch the user from the database based on the user ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            abort(404, 'User not found');
        }

        // Pass the user data to the view
        return view('front-end.pages.users.management.formEditUserAccount', ['user' => $user], $data);
    }



    public function updateUserAccount(Request $request)
    {

        try {
            // Validate the form data
            $validatedData = $request->validate([
                'name' => 'required',
                'password' => 'required',
                'role_id' => 'required',
            ]);

            // Find the user
            $user = User::find($request->userId);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Update user data
            $user->name = $validatedData['name'];
            $user->password = Hash::make($validatedData['password']);
            $user->role_id = $validatedData['role_id'];

            // Get the username of the user who is performing the update
            $updateByUsername = Auth::user()->username;

            // Update the update_by column
            $user->update_by = $updateByUsername;

            // Save the updates
            $user->save();

            // Update the updated_at timestamp
            $user->touch();

            // Redirect the user back to their account page with a success message
            return redirect()->route('users.management.index')->with('success', 'User account updated successfully');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update user account. Please try again.');
        }
    }



    public function registerPost(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required',
                'role_id' => 'required'
            ]);

            // Get the username of the authenticated user
            $createByUsername = Auth::user()->username;

            // Prepare user data
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'create_by' => $createByUsername // Set the create_by field
            ];

            // Create and save the user
            $user = User::create($data);

            // Check if the user was successfully created
            if (!$user) {
                return redirect()->route('users.management.create')->with("error", "Registration error");
            }

            // Redirect with success message
            return redirect()->route('users.management.index')->with("success", "Registration successful");
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->route('users.management.create')->with("error", "Failed to register user. Please try again.");
        }
    }

    public function deletePost($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user
        $user->delete();

        // Redirect to the index page with a success message
        return redirect()->route('users.management.index')->with("success", "Delete user successful");
    }
}
