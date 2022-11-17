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
  
    // 1 ProductDetail có nhiều Comment dùng hasMany( class, 'khoa ngoai', 'khoa chinh')
    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'id_product_detail', 'id_product_detail');
    }
    // 1 ProductDetail có nhiều OrderDetail dùng hasMany( class, 'khoa ngoai', 'khoa chinh')
    public function orderdetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'id_product', 'id_product_detail');
    }

    public function cart()
    {
        // return $this->belongsToMany(User::class, 'cart', 'id_prodcut_detail', 'id_user');
    }

    static public function getRule()
    {
        return [
            'size'      =>   'required',
            'color'     =>   'required',
            'image'     =>   'required',
            // 'price'     =>   'required',
            // 'remaining' =>   'required',
        ];
    }
   
}
