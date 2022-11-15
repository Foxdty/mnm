<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "cart";

    public $timestamps = false;
    
    protected $fillable = [
        'id_user',
        'id_product_detail',
        'quantity'
    ];
    // nhiều cart thì thuộc 1 product details dùng belongsTo( class, 'khoa ngoai', 'khoa chinh')
    public function product_detail(){
        return $this->belongsTo('App\Models\ProductDetail', 'id_product_detail');
    }
}
