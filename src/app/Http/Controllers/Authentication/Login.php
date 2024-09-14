<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class Login extends Controller
{
    public function index()
    {
        return view('front-end.authentication.login');
    }

    public function loginPost(Request $request)
    {
        $member = Role::get();
 
        $username = $request->username;

        $password = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password])) {


            return redirect()->intended(route('home'));
        }

        return redirect()->route('login')->with('error', 'ชื่อผู้ใช้งาน หรือ รหัสผ่าน ผิด!');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Redirect to the login page after logout
        return redirect()->route('login');
    }
}
