<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Truck extends Model
{
    use HasFactory;
    protected $tabel = "truck";
    protected $fillable = [
        'truck_type',
        'hydrant_id',
        'name',
        'company_name',
        'truck_num',
        'chassis_num',
        'engine_num',
        'cabin_color',
        'tanker_color',
        'paper_image',
        'model',
        'status',
    ];
    public function truckCap()
    {
        return $this->belongsTo(Truck_type::class,'truck_type');
    }
    public function hydrant()
    {
        return $this->belongsTo(Hydrants::class,'hydrant_id');
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class,'truck_id','id');
    }
    
}
