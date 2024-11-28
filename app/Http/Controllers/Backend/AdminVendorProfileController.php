<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile') );
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
        dd($request->all());
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Find the vendor profile associated with the authenticated user
        $vendor = Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return response()->json(['message' => 'Vendor profile not found.'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:vendors,email,' . $vendor->id,
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'fb_link' => 'nullable|url',
            'tw_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
        ]);

        // Check if a new banner image is provided and store it if so
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $path= $this->updateImage($request, 'banner', 'uploads/profile', $vendor->banner);
            $validatedData['banner'] = $path;
        }

        // Update the vendor using mass assignment
        $vendor->update($validatedData);

        toastr()->success('Vendor profile updated successfully.');

        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
