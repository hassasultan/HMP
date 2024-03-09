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
        'owned_by',
        'unregister',
        // new Start
        'link',
        'reg_region',
        'book_num',
        'father_name',
        'owner_address',
        'owner_cnic',
        'reg_date',
        'class_of_type',
        'cylinders_count',
        'body_type',
        'horse_power',
        'seating_capacity',
        'num_description',
        'front_excel',
        'rear_excel',
        'any_other',
        'cfra_no',
        'issue_date',
        'expiry_date',
        'commercial_license',
        'road_permit',
        'doc_running_part',
        'cabin_picture',
        // new End
        'engine_num',
        'cabin_color',
        'tanker_color',
        'paper_image',
        'model',
        'status',
        'black_list',
    ];
    public function truckCap()
    {
        return $this->belongsTo(Truck_type::class,'truck_type');
    }
    public function reg_truck()
    {
        return $this->belongsTo(RegTrucks::class,'id','truck_id');
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
