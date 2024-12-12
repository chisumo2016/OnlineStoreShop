<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.image-gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image.*' => ['required','image','max:2048'], //array  of image
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $data = [
            'product_id' => $request->input('product_id'), // Associate images with a product
        ];

        /*Handle multiple image uploads*/
        if ($request->hasFile('image')) {
            // Upload multiple images and get their paths
                $imagePaths = $this->uploadMultipleImages($request->file('image'), 'uploads/products');

                // Create a record for each image
                foreach ($imagePaths as $imagePath) {
                    ProductImageGallery::create([
                        'product_id' => $request->input('product_id'),
                        'image' => $imagePath,
                    ]);
                }
        }


        toastr('Product Multiple created successfully!', 'success');
        return redirect()->back();
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
    public function destroy(ProductImageGallery $productImageGallery)
    {
        //$imageGallery = ProductImageGallery::findOrFail($id);
        // Delete the associated image file
        $this->deleteImage($productImageGallery->image);

        // Delete the database record
        $productImageGallery->delete();

        return response(['status' => 'success', 'message' => 'Image deleted successfully'], 200);
    }
}
