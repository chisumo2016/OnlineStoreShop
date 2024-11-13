<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChildCategoryRequest;
use App\Http\Requests\Admin\ChildCategoryStoreRequest;
use App\Http\Requests\Admin\ChildCategoryupdateRequest;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.ChildCategoryStoreRequest
     */
    public function store(ChildCategoryStoreRequest $request)
    {
        /* Use validated data from the form request*/
        $data = $request->validated();

        /*  Add a slug to the data array*/
        $data['slug'] = Str::slug($data['name']);

        /*  Create a new ChildCategory record with mass assignment*/
        ChildCategory::create($data);

        toastr('Child Category created successfully.', 'success');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildCategory $childCategory)
    {
        $categories = Category::all();
        //$childCategory = ChildCategory::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $childCategory->category_id)->get();


        return view('admin.child-category.edit', compact('categories','childCategory','subCategories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChildCategoryupdateRequest $request, ChildCategory $childCategory)
    {
        /* Retrieve validated data from the request*/
        $data = $request->validated();

        /* Generate and update the slug*/
        $data['slug'] = Str::slug($data['name']);

        /* Update the ChildCategory with mass assignment*/
        $childCategory->update($data);

        toastr('Child Category Updated successfully.', 'success');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $childCategory)
    {

        $childCategory->delete();

        return response(['status' => 'success', 'message' => 'Child Category Deleted successfully']);
    }

    /**
     * Get sub categories
     */
    public function getSubCategories(Request $request)
    {
        $subCategories  = SubCategory::where('category_id', $request->id)->where('status', 1)->get();

        return $subCategories;
    }
}
