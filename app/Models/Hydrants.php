<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hydrants extends Model
{
    use HasFactory;
    protected $tabel = "hydrants";
    protected $fillable = [
        'name',
        'contractor_name',
        'person',
        'contact',
        'owned',
        'alternate',
        'color',
    ];
    // public function truck_type_fun()
    // {
    //     return $this->belongsTo(Truck_type::class,'truck_type');
    // }
    public function vehicles()
    {
        return $this->hasMany(Truck::class,'hydrant_id','id');
    }
}
