<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = "voucher";
    protected $primaryKey = "id_voucher";

    protected $fillable = [
        'vocher_code',
        'condition_price',
        'price_sale',
        'begin_date',
        'expiration_date',
        'status'
    ];
    /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
    public $timestamps = false;
    
}
