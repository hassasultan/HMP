<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtsOrder extends Model
{
    use HasFactory;
    protected $table = "ots_order";
    protected $fillable =
    [
        "order_id",
        "consumer_name",
        "consumer_number",
        "consumer_address",
        "hydrant",
        "gallon",
        "delivery_charges",
        "tanker_amount",
        "km",
        "source",
        "vehicle_no",
        "driver_name",
        "driver_phone",
        "comment",
        "status",

    ];
}
