<?php

namespace App\Models;

use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImageUpload extends Model
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function imageUploadPost($image)
    {
        // Validator::make($image, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $path = Storage::disk('public')->put('', new File($image));
       // $image->move(public_path('images'), $path);
        /* Store $imageName name in DATABASE from HERE */
        return  $path;
    }
}
