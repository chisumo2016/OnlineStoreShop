<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        /* Assign a new value*/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();

        //dd($request->all());
    }
}
