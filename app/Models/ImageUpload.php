<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ImageUpload extends Model
{
   
    public static function imageUploadPost($image)
    {
        
        $path = Storage::disk('public')->put('', new File($image));
       
        return  $path;
    }
}
