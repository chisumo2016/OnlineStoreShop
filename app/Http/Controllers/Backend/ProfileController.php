<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(ProfileUpdateRequest $request)
    {
        /* Get the Current user*/
        $user = Auth::user();


        /*Check for image*/
        if ($request->hasFile('image')){

            /*Delete the previous image*/
            if (File::exists(public_path($user->image))){
               File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            /*Storage Path in image  db*/
            $path = "/uploads/".$imageName;

            $user->image = $path;
        }

        /* Assign a new value*/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();

        //dd($request->all());
    }
      /**Update the password**/
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required','confirmed','min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back();
    }
}
