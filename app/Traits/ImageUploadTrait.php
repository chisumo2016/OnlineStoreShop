<?php
 namespace App\Traits;


 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Http\Request;
 use  File;
 use Illuminate\Http\UploadedFile;
 use Illuminate\Support\Facades\Storage;

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

     public function updateImage(Model $model, UploadedFile $file, string $path,  string $field = 'thumb_image', string $disk = 'public'): void
     {
         tap($model->{$field}, function ($previous) use ($disk, $file, $path, $model,$field) { //$model->thumb_image

             $model->forceFill([
                 $field => $file->storePublicly(  //'thumb_image'
                     $path, ['disk' => $disk]
                 ),
             ])->save();

             if ($previous) {
                 Storage::disk($disk)->delete($previous);
             }
         });
     }

     /**
      * Upload Multiple Images
      *
      * @param array $files Array of UploadedFile objects
      * @param string $path Directory path to store the files
      * @param string $disk Storage disk (default: 'public')
      * @return array Array of file paths
      */
     public function uploadMultipleImages(array $files, string $path, string $disk = 'public'): array
     {
         $paths = [];

         foreach ($files as $file) {
             $paths[] = $this->uploadImage($file, $path, $disk);
         }

         return $paths;
     }

     /*Handle Delete File*/
     public function deleteImage(string $path)
     {

         /*Delete the previous image*/
         if (File::exists(public_path($path))){ //storage_path
             File::delete(public_path($path));
         }
     }

//     public function deleteImage(string $path, string $disk = 'public'): bool
//     {
//         $fullPath = storage_path("app/{$disk}/{$path}");
//
//         if (File::exists($fullPath)) {
//             return File::delete($fullPath);
//         }
//
//         return false;
//     }


//     public  function  updateImage(Request $request, $inputName , $path , $oldPath=null)
//     {
//
//
////         /*Check for image in request*/
////         if ($request->hasFile($inputName)){
////
////             /*Delete the previous image*/
////             if (File::exists(public_path($oldPath))){
////                 File::delete(public_path($oldPath));
////             }
////             $image = $request->{$inputName};
////             $extension =  $image->getClientOriginalExtension(); //getClientOriginalName();
////             $imageName ='media_'.uniqid().'.'.$extension; // rand().'_'.
////
////             $image->move(public_path($path), $imageName);
////
////             /*Return file path*/
////             return $path.'/'.$imageName;
//         //}
//
//
//     }


 }


