<?php

namespace Admins\Http\Controllers;

use App\Actions\RemoveImageAction;
use App\Actions\StoreImageAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =
        Category::all();
        // Category::paginate(config('global.defaultPagination'));

        $data = [
            'title' => 'Categories',
            'categories' => $categories,
            'message' => 'Hello-this is the component message',
        ];

        return view('admins::pages.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create New Category',
        ];

        return view('admins::pages.categories.create', $data);
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

            // create category
            $category = Category::create(['name' => $request->name]);

            // if an image was uploaded
            if ($request->hasFile('image')) {
                // upload the image
                $image = $request->file('image');

                $storeImageAction->handle($image, $category->id,
                    'App\Models\Category', 'categories');
            }

            return redirect()->route('admin.category.index')
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
            $category = Category::findOrFail($id);

            $data = [
                'title' => 'Category Details',
                'category' => $category,
            ];

            return view('admins::pages.categories.show', $data);
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
                'title' => 'Edit Category Details',
                'category' => Category::findOrFail($id),
            ];

            return view('admins::pages.categories.edit', $data);
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
            $category = Category::findOrFail($id);

            $category->update(['name' => $request->name]);

            // if an image was uploaded
            if ($request->hasFile('image')) {
                // delete the image
                $removeImageAction->handle($category->id, 'App\Models\Category');

                // upload, and save the image
                $storeImageAction->handle($request->file('image'), $category->id,
                    'App\Models\Category', 'categories');
            }

            return redirect()->route('admin.category.index')
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
            $category = Category::findOrFail($id);

            // delete the image
            $imageRemoved = $removeImageAction->handle($category->id, 'App\Models\Category');

            $category->delete();

            if (!$imageRemoved) {
                return redirect()->route('admin.category.index')
                    ->with('notification', 'Category deleted, image not removed');
            }

            return redirect()->route('admin.category.index')
                ->with('success', 'Successfully Deleted');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.index')
                ->with('error', 'Error ' . $e->getMessage());
        }
    }

    private function validateInfo(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'image|max:2024',
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
}
