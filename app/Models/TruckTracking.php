<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckTracking extends Model
{
    use HasFactory;
    protected $tabel = "truck_tracking";
    protected $fillable = [
        'reg_truck_id',
        'billing_id',
        'status',
    ];
    public function reg_truck()
    {
        return $this->belongsTo(RegTrucks::class,'reg_truck_id');
    }
    public function billing()
    {
        return $this->belongsTo(Billings::class,'billing_id');
    }
}
