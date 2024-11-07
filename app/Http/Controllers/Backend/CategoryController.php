<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        /* Automatically creates a slug based on the name field*/
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        toastr('Category created successfully.', 'success');

        return redirect()->route('admin.category.index');

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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpateRequest $request, Category $category)
    {
            /*Retrieve validated data*/
            $data = $request->validated();

            /* Generate a slug based on the updated name, if needed*/
            $data['slug'] = Str::slug($data['name']);

            /* Update the category with validated data*/
            $category->update($data);

        toastr('Category updated successfully.', 'success');

        return redirect()->route('admin.category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response(['status' => 'success', 'Category deleted successfully']);
    }
}
