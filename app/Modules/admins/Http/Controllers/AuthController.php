<?php

namespace Admins\Http\Controllers;

use Admins\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd('admin auth login');

        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $admin = Admin::where('name', $fields['name'])->first();

        // Check password
        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return back()->with('error', 'Bad credentials');
        }

        // Login
        //   dd(Auth::guard('admin')->attempt(['name' => request('name'),
        //     'password' => request('password')]));
        $loggedIn = Auth::guard('admin')->attempt(['name' => request('name'),
            'password' => request('password')]);
        if ($loggedIn) {
            //echo ('in auth controller ' . Auth::guard('admin')->check());
            // dd(Auth::guard('admin')->check());

            return redirect()->route('admin.category.index')
                ->with('success', 'Logged In Successfully');

        } else {
            dd('not logged in');
            return back()->with('error', 'Bad credentials');
        }
    }

    public function logout(Request $request)
    {
        //dd('logout');
        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin/login')->with('success', 'Logged Out Successfully');
    }
}
