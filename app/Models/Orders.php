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
        'hydrant_id',
        'customer_id',
        'contact_num',
        'truck_type',
        'status',
    ];
    public function truck_type_fun()
    {
        return $this->belongsTo(Truck_type::class,'truck_type');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
