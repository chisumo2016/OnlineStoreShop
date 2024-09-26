<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        /*Grambing  the user */
        $user = Auth::user();

        /*Handle our image  from request*/
        if ($request->hasFile('image')){
            /*Checking  the file exists in database */
            if (File::exists(public_path($user->image))){
                /*Delete the old image */
                File::delete(public_path($user->image));
            }
            /**Handle the new Image, store*/
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();

            /*Move to storage*/
            $image->move(public_path('uploads'), $imageName);

            /**Save into database*/
            $path  = 'uploads/'.$imageName;

            $user->image = $path;
        }

        /*Assign the  value and save into db **/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile User Updated Successfully');
        return redirect()->back();

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required','confirmed','min:8'],
        ]);

       // Auth::user();
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('User Profile Password Updated Successfully');
        return redirect()->back();

    }
}
