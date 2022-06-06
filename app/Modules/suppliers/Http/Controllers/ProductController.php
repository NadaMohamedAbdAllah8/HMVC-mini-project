<?php

namespace Suppliers\Http\Controllers;

use App\Http\Controllers\Controller;

//use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suppliers::products.index');

        dd('Helle from the product controller insde the suppliers\' controllers !');
        // $products = Product::where('category_id', '!=', null)
        //     ->whereHas('category', function ($query) {
        //         $query->where('deleted_at', '=', null);
        //     })->paginate(config('global.defaultPagination'));

        // $data = [
        //     'title' => 'Products',
        //     'products' => $products,
        //     'categories' =>
        //     DB::select(DB::raw('SELECT * FROM categories where deleted_at is null')),
        // ];

        // return view('user.pages.products.index', $data);
    }
}