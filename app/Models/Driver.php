<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $tabel = "driver";
    protected $fillable = [
        'truck_id',
        'name',
        'phone',
        'image',
        'nic',
        'nic_name',
        'nic_gender',
        'nic_res_address',
        'nic_per_address',
        'nic_dob',
        'nic_father_name',
        'nic_issue_date',
        'nic_expiry_date',
        'nic_image',
        'license_no',
        'category',
        'lic_issue_date',
        'lic_expiry_date',
        'blood_group',
        'license_image',
        'status',
        'expiry',
        'black_list',
        //new
        'lic_father_name',
        'lic_address',
        'lic_region',
        'lic_identity_mark',
        'cc_issue_date',
        'cc_police_station',
        'hc_issue_date',
        'hc_hospital_name',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class,'truck_id','id');
    }

}
