<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Termwind\render;

class BrandController extends Controller
{
    use  ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return  $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        /* Get validated data from the request*/
        $data = $request->validated();

        /* Automatically creates a slug based on the name field*/
        $data['slug'] = Str::slug($data['name']);

        /*Handle the file  upload*/

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadImage($request, 'logo', 'uploads');
        }

        Brand::create($data);

        toastr('Brand created successfully.', 'success');

        return redirect()->route('admin.brand.index');

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
    public function edit(Brand $brand)
    {
        return  view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        /* Get validated data from the request*/
        $data = $request->validated();

        /* Automatically creates a slug based on the name field*/
        $data['slug'] = Str::slug($data['name']);

        /*Handle the file  upload*/
        if ($request->hasFile('logo')) {

            /*delete the old logo file*/
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $this->updateImage($request, 'logo', 'uploads', $brand->logo);
        }

        $brand->update($data);

        toastr('Brand updated successfully.', 'success');

        return redirect()->route('admin.brand.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
