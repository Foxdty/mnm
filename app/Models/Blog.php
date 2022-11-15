<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blog";
    protected $primaryKey = "id_blog";

    protected $fillable = [
        'id_category',
        'blog_name',
        'image',
        'description'
    ];
    

    /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
    public $timestamps = false;

    
    // nhiều blog thì thuộc 1 category dùng belongsTo( class, 'khoa ngoai', 'khoa chinh')
    public function categories(){
        return $this->belongsTo('App\Models\Category', 'id_category', 'id_blog');
    }
    
}
