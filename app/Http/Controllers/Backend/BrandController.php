<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
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
}
