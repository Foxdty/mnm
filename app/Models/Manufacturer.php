<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $table = "manufacturer";
    protected $primaryKey = "id_manufacturer";

    protected $fillable = [
        'id_manufacturer',
        'manufacturer'
    ];

    public $timestamps = false;
}
