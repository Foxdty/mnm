<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $primaryKey = "id_product";
    public $timestamps = false;

    protected $fillable = [
        // 'id_product',
        'id_category',
        'id_manufacturer',
        'material',
        'product_name',
        'description',
        'image',
        'status'
    ];

    protected $hidden = [
        //'remember_token',
    ];


    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'id_category', 'id_category');
    }

    public function product_detail()
    {
        return $this->hasMany('App\Models\ProductDetail', 'id_product', 'id_product');
    }
}
