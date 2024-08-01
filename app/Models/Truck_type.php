<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck_type extends Model
{
    use HasFactory;
    protected $tabel = "truck_type";
    protected $fillable = [
        'name',
        'description',
        'price',
        'km_price',
    ];
}
