<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billings extends Model
{
    use HasFactory;
    protected $tabel = "billings";
    protected $fillable = [
        'order_id',
        'truck_id',
        'driver_id',
        'amount',
        'status',
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }
    public function truck()
    {
        return $this->belongsTo(Truck::class,'truck_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
}
