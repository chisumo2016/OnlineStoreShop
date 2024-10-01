<?php
 namespace App\Traits;


 use Illuminate\Http\Request;

 trait ImageUploadTrait
 {
   public  function  uploadImage(Request $request, $inputName , $path)
   {
       /*Check for image in request*/
       if ($request->hasFile($inputName)){

           $image = $request->{$inputName};
           $extension =  $image->getClientOriginalExtension(); //getClientOriginalName();
           $imageName ='media_'.uniqid().'.'.$extension; // rand().'_'.

           $image->move(public_path($path), $imageName);

           /*Return file path*/
           return $path.'/'.$imageName;
       }
   }
 }


