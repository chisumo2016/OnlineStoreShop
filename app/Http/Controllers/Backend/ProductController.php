<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
       /*Validate the request using ProductRequest*/
        $data = $request->validated();

        //dd($data);

        /*Handle Image Upload*/
        if ($request->hasFile('thumb_image')){

            $imagePath = $this->uploadImage($data['thumb_image'], 'thumb_image', 'uploads/product');
            $data['thumb_image'] = $imagePath;
        }


        /*Add additional fields that are not part of the form*/

        $data['slug'] = Str::slug($data['name']);
        $data['vendor_id'] = Auth::user()->vendor->id; // Assuming the user has a vendor relationship
        $data['is_approved'] = 1; // Default to approved

        /* Use mass assignment to create the product*/
        Product::create($data);

        toastr('Product created successfully!', 'success');

        return redirect()->route('admin.product.index');
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
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product','categories','brands', 'subCategories','childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('thumb_image')) {
            $this->updateImage(
                /*Instance of model*/
                $product,
                /*The uploaded file*/
                $request->file('thumb_image'),
                /*Path to store the image*/
                'uploads/products',
                'thumb_image'
            );
        }

        /*Generate slug from name*/
        if (isset($data['name'])) {
            $data['slug'] = \Str::slug($data['name']);
        }

        /*Remove thumb_image from data to prevent mass assignment conflict*/
        /*since it's handled separately*/
        unset($data['thumb_image']);

        /*since it's handled separately*/
        $product->update($data);

        /*Flash success message and redirect*/
        toastr('Product updated successfully!', 'success');

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get all product sub categories.
     */
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();

        return $subCategories;
        //dd($request->all());
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

        return $childCategories;
    }
}
