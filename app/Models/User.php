<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use League\CommonMark\Extension\Table\Table;
use PDO;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "user";
    protected $primaryKey = "id_user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'address',
        'phone',
        'avatar',
        'gender',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
    public $timestamps = false;

    // 1 User có nhiều Comment dùng hasMany( class, 'khoa ngoai', 'khoa chinh')
    
    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'id_user', 'id_user');
    }
  
    public function cart()
    {
        return $this->belongsToMany(ProductDetail::class, 'cart', 'id_user', 'id_product_detail')->withPivot('quantity');
    }
}
