<?php

namespace Suppliers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Suppliers\Models\Supplier;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $supplier = Supplier::where('name', $fields['name'])->first();

        // Check password
        if (!$supplier || !Hash::check($fields['password'], $supplier->password)) {
            return back()->with('error', 'Bad credentials');
        }
        // Login
        if (Auth::guard('supplier')->attempt(['name' => request('name'),
            'password' => request('password')])) {
            return redirect()->route('supplier.product.index')
                ->with('success', 'Logged In Successfully');

        } else {
            return back()->with('error', 'Bad credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('supplier')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/supplier/login')->with('success', 'Logged Out Successfully');
    }
}
