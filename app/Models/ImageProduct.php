<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    use HasFactory;
    protected $table = "image_product";
    protected $primaryKey = "id_image_product";

    protected $fillable = [
        'id_image_product',
        'id_product',
        'image'
    ];

    public $timestamps = false;
}
