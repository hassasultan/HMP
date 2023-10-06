<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $tabel = "orders";
    protected $fillable = [
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
    public function hydrant()
    {
        return $this->belongsTo(Hydrants::class,'hydrant_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function billing()
    {
        return $this->belongsTo(Billings::class,'id','order_id');
    }
}
