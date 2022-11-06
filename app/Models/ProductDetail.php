<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = "product_detail";
    protected $primaryKey = "id_product_detail";
    public $timestamps = false;

    protected $fillable = [
        'id_product',
        'size',
        'color',
        'image',
        'price',
        'remaining',
        'voucher_code',
        'status'
    ];

    protected $hidden = [
        //'remember_token',
    ];


    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id_product', 'id_product');
    }
}
