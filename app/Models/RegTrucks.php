<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegTrucks extends Model
{
    use HasFactory;
    protected $tabel = "reg_trucks";
    protected $fillable = [
        'truck_id',
        'status',
    ];
    public function truck()
    {
        return $this->belongsTo(Truck::class,'truck_id');
    }
}
