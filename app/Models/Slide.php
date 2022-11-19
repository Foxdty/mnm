<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $table = "slide";
    protected $primaryKey = "id_slide";

    protected $fillable = [
        'slide_name',
        'image'
    ];
    /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
    public $timestamps = false;
}
