<?php
namespace App\Http\Traits;
use File;;
use Storage;

trait FileUpload{
    

    protected function upload($name = 'file', $as = 'file', $to = 'uploads', $accept = []){
        $response = ['error' => null, 'filename' => null];
        if(request()->file($name)){
            $file = request()->file($name);
            $extension = $file->getClientOriginalExtension();
            $destination = $to.'/'.$as.'.'.$extension;
            $extension = $file->getClientOriginalExtension();
            if(\in_array($extension, $accept)){
                $filename = $as.'.'.$extension;
                if(Storage::disk('public')->put($destination,  File::get($file))){
                    $response['filename'] = $filename;
                }else{
                    $response['error'] = "An error occured while uploading";
                }
            }else{
                $response['error'] = "File format not accepted";
            }
        }else{
            $response['error'] = "No valid file found";
        }
        return $response;
    }
}