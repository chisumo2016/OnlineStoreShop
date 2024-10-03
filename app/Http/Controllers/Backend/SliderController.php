<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderStoreRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
        //return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderStoreRequest $request)
    {
        /*Prepare validated data*/
        $sliderData = $request->validated();

        /*Handle the file  upload*/

        if ($request->hasFile('banner')) {
            $sliderData['banner'] = $this->uploadImage($request, 'banner', 'uploads/sliders');
        }

        Slider::create( $sliderData);

       toastr('Created Successfully', 'success');

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
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (SliderUpdateRequest $request, Slider $slider)
    {
        /*Prepare validated data*/

        $sliderData = $request->validated();

        if ($request->hasFile('banner')) {

//            /*Delete old image if exists*/
//            if ($slider->banner) {
//                $this->deleteOldImage($slider->banner);
//            }

            /*Upload new image*/
            $sliderData['banner'] = $this->updateImage($request, 'banner', 'uploads/sliders');
        }

        /*Update the slider record with the new data*/
            $slider->update($sliderData);

        /*Flash success message using Toastr*/
        toastr()->success('Slider updated successfully.');

        /*Redirect back to the index page or any other page*/
        return redirect()->route('admin.slider.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Optional: Method to delete old image from the server
     */

//    private function deleteOldImage($imagePath)
//    {
//        $imageFullPath = public_path($imagePath);
//
//        if (file_exists($imageFullPath)) {
//            @unlink($imageFullPath); // Delete the old image from storage
//        }
//    }
}
