<?php

namespace Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $data = [
            'title' => 'Customers Products',
            'products' => $products,
            'message' => 'Hello-this is the component message-customer product index',
        ];

        //   Session::put('mytest', 'session is working set in the product index');
        echo '<br>' . Session::get('mytest') . '<br>';

        return view('customers::pages.products.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            $data = [
                'title' => 'Product Details',
                'product' => $product,
            ];

            return view('customers::pages.products.show', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error ' . $e->getMessage());
        }
    }
}
