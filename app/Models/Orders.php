<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $tabel = "orders";
    protected $fillable = [
        'customer_name',
        'address',
        'street',
        'location',
        'gps',
        'contact_num',
        'truck_type',
        'status',
    ];
    public function truck_type_fun()
    {
        return $this->belongsTo(Truck_type::class,'truck_type');
    }
}
