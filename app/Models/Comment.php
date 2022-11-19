<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $primaryKey = "id_comment";


    protected $fillable = [
        'id_user',
        'id_product',
        'comment',
        'reply_comment',
        'created_at'
    ];

     // nhiều Comment thì thuộc 1 User dùng belongsTo( class, 'khoa ngoai', 'khoa chinh')
     public function user(){
        return $this->belongsTo('App\Models\User', 'id_user', 'id_comment');
    }

    // nhiều Comment thì thuộc 1 product_detail dùng belongsTo( class, 'khoa ngoai', 'khoa chinh')
    public function product_detail(){
        return $this->belongsTo('App\Models\ProductDetail', 'id_product_detail', 'id_comment');
    }

    /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
    public $timestamps = false;
}
