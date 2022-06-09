<?php

namespace Admins\Http\Controllers;

use Admins\Models\Admin;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //   dd('admin auth login');

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
        if (Auth::guard('admin')->attempt(['name' => request('name'),
            'password' => request('password')])) {

            Debugbar::info(Auth::guard('admin')->check());

            //echo ('in auth cont ' . Auth::guard('admin')->check());
            // dd(session()->all());

            return redirect()->route('admin.category.index')
                ->with('success', 'Logged In Successfully');

        } else {
            dd('not logged in');
            return back()->with('error', 'Bad credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin/login')->with('success', 'Logged Out Successfully');
    }
}
