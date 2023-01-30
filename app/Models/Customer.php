<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'street',
        'location',
        'gps',
        'contact_num',
        'status',
        'black_list',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
