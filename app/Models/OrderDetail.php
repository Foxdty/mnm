<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_detail";
    
    protected $fillable = [
        'id_order',
        'id_product_detail',
        'price_sale',
        'quantity'
    ];

    // nhiều orderdetail thì thuộc 1 order dùng belongsTo( class, 'khoa ngoai', 'khoa chinh')
    public function order(){
        return $this->belongsTo('App\Models\Order', 'id_order');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product', 'id_product_detail');
    }
}
