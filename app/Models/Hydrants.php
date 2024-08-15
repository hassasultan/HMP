<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


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
        'ots_hydrant',
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
    public function orders()
    {
        return $this->hasMany(Orders::class,'hydrant_id','id');
    }

    public function todayorders()
    {
        return $this->hasMany(Orders::class,'hydrant_id','id')->where('created_at', '>=', Carbon::today());
    }
    // Method to get total orders count
    public function getOrdersCountAttribute()
    {
        return $this->orders()->count();
    }

    // Method to get today's orders count
    public function getTodayOrdersCountAttribute()
    {
        return $this->todayorders()->count();
    }
}
