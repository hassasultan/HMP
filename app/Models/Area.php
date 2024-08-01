<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = "area";
    protected $fillable = [
        'hydrant_id',
        'name',
        'block',
        'sector',
        'total_km',
        'extra_km',
    ];

    public function hydrant()
    {
        return $this->belongsTo(Hydrants::class);
    }
}
