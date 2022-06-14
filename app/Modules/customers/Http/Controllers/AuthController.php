<?php

namespace Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Customers\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $customer = Customer::where('name', $fields['name'])->first();

        // Check password
        if (!$customer || !Hash::check($fields['password'], $customer->password)) {
            return back()->with('error', 'Bad credentials');
        }

        // Login
        if (Auth::guard('customer')->attempt(['name' => request('name'),
            'password' => request('password')])) {

            return redirect()->route('customer.product.index')
                ->with('success', 'Logged In Successfully');
        } else {
            return back()->with('error', 'Bad credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/customer/login')->with('success', 'Logged Out Successfully');
    }
}
