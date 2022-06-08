<?php

namespace Admins\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            //  'image' => 'size:2024',
        ]);

        try {
            // create category
            $category = Category::create(['name' => $request->name]);

            // if an image was uploaded
            if ($request->hasFile('image')) {
                // upload the image
                $image = $request->file('image');

                $this->addImage($image, $category->id, 'App\Models\Category', 'categories');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = Category::findOrFail($id);

            $category->update(['name' => $request->name]);

            // if an image was uploaded
            if ($request->hasFile('image')) {
                // delete the image
                $this->deleteImage($category->id, 'App\Models\Category');

                // upload the image
                $image = $request->file('image');

                $this->addImage($image, $category->id, 'App\Models\Category', 'categories');
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
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            // delete the image
            $this->deleteImage($category->id, 'App\Models\Category');

            $category->delete();

            return redirect()->route('admin.category.index')
                ->with('success', 'Successfully Deleted');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.index')
                ->with('error', 'Error ' . $e->getMessage());
        }
    }

    // addImage
    public function addImage($image, $imageable_id, $imageable_type, $folderParent)
    {
        try {
            // upload the image
            $name = $image->getClientOriginalName();

            $filePath = $folderParent . '/' . $imageable_id . '/';

            $destinationPath = public_path($filePath);

            $image->move($destinationPath, $name);

            // create new record in image table

            $image = Image::create([
                'file_path' => $filePath . $name,
                'imageable_id' => $imageable_id,
                'imageable_type' => $imageable_type,
            ]);

            return $image->id;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteImage($imageable_id, $imageable_type)
    {
        try {
            $image = Image::where(['imageable_id' => $imageable_id,
                'imageable_type' => $imageable_type])->first();

            if (!is_null($image)) {
                if (\File::exists($image->file_path)) {
                    \File::delete($image->file_path);
                    $image->delete();
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}