<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChildCategoryRequest;
use App\Http\Requests\Admin\ChildCategoryStoreRequest;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
