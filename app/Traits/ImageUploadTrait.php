<?php
 namespace App\Traits;


 use Illuminate\Http\Request;
 use  File;
 use Illuminate\Http\UploadedFile;

 trait ImageUploadTrait

 {
   public  function  uploadImage(UploadedFile $image, $inputName , $path)
   {

           $extension =  $image->getClientOriginalExtension(); //getClientOriginalName();
           $imageName ='media_'.uniqid().'.'.$extension; // rand().'_'.
           return $image->storePubliclyAs('products', $imageName , [
               'disk' => 'public'
           ]);
           //$image->move(public_path($path), $imageName);

           /*Return file path*/
           return $path.'/'.$imageName;
   }


     public  function  updateImage(Request $request, $inputName , $path , $oldPath=null)
     {
         /*Check for image in request*/
         if ($request->hasFile($inputName)){

             /*Delete the previous image*/
             if (File::exists(public_path($oldPath))){
                 File::delete(public_path($oldPath));
             }
             $image = $request->{$inputName};
             $extension =  $image->getClientOriginalExtension(); //getClientOriginalName();
             $imageName ='media_'.uniqid().'.'.$extension; // rand().'_'.

             $image->move(public_path($path), $imageName);

             /*Return file path*/
             return $path.'/'.$imageName;
         }


     }

     /*Handle Delete File*/
     public function deleteImage( $path)
     {
         /*Delete the previous image*/
         if (File::exists(public_path($path))){
             File::delete(public_path($path));
         }
     }
 }


