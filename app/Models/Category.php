<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "category";
    protected $primaryKey = "id_category";

    protected $fillable = [
        'id_parent',
        'category_name',
        'type',
        'status'
    ];
    /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
    public $timestamps = false;
    /// 1 category có nhiều product nên ->hasMany
    public function product()
    {
        return $this->hasMany('App\Models\Blog', 'id_category', 'id_category');
    }

    public function categories()
    {
        return $this->hasOne(Category::class);
    }

}
