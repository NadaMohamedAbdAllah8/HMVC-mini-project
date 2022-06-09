<?php

namespace Suppliers\Http\Controllers;

use App\Actions\RemoveImageAction;
use App\Actions\StoreImageAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // Product::paginate(config('global.defaultPagination'));

        $data = [
            'title' => 'Categories',
            'products' => $products,
            'message' => 'Hello-this is the component message',
        ];

        return view('suppliers::pages.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create New Product',
            'categories' => Category::all(),
        ];

        return view('suppliers::pages.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreImageAction $storeImageAction)
    {
        $this->validateInfo($request);

        try {

            // create product
            $product = Product::create(['name' => $request->name,
                'category_id' => $request->category_id]);

            // if an image was uploaded
            if ($request->hasFile('images')) {
                $this->addImages($storeImageAction, $request->images, $product->id);
            }

            return redirect()->route('supplier.product.index')
                ->with('success', 'Successfully Added');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error ' . $e->getMessage());
        }
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

            return view('suppliers::pages.products.show', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error ' . $e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = [
                'title' => 'Edit Product Details',
                'product' => Product::findOrFail($id),
                'categories' => Category::all(),
            ];

            return view('suppliers::pages.products.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, StoreImageAction $storeImageAction,
        RemoveImageAction $removeImageAction) {

        $this->validateInfo($request);

        try {
            $product = Product::findOrFail($id);

            $product->update(['name' => $request->name,
                'category_id' => $request->category_id]);

            // if an image was uploaded
            if ($request->hasFile('images')) {
                // delete the image
                $removeImageAction->handle($product->id, 'App\Models\Product');

                // upload, and save the image
                $this->addImages($storeImageAction, $request->images, $product->id);
            }

            return redirect()->route('supplier.product.index')
                ->with('success', 'Successfully Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, RemoveImageAction $removeImageAction)
    {
        try {
            $product = Product::findOrFail($id);

            // delete the image
            $imageRemoved = $removeImageAction->handle($product->id, 'App\Models\Product');

            $product->delete();

            if (!$imageRemoved) {
                return redirect()->route('supplier.product.index')
                    ->with('notification', 'Product deleted, image not removed');
            }

            return redirect()->route('supplier.product.index')
                ->with('success', 'Successfully Deleted');
        } catch (\Exception $e) {
            return redirect()->route('supplier.product.index')
                ->with('error', 'Error ' . $e->getMessage());
        }
    }

    private function validateInfo(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'images[]' => 'image|max:2024',
        ];

        $customMessages = [
            'name.required' => 'Add name',
            'name.string' => 'Name has to be a string',
            'name.max' => 'Name max size is 255',

            'image.image' => 'Add a valid image',
            'image.max' => 'Image size has to be under 2M',

        ];

        $this->validate($request, $rules, $customMessages);
    }

    public function addImages($storeImageAction, $images, $productId)
    {
        foreach ($images as $image) {
            // upload the image
            $storeImageAction->handle($image, $productId,
                'App\Models\Product', 'products');
        }

    }
}