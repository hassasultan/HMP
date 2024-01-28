<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Models\User_role;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function roles()
    // {
    //     return $this->hasMany(User_role::class,'model_id');
    // }

    public function hydrant()
    {
        // return $this->belongsTo(Hydrants::class,'id','user_id');
        return $this->belongsTo(Hydrants::class, 'hydrant_id', 'id');
    }
    public function hydrant_user()
    {
        return $this->belongsTo(Hydrants::class, 'hydrant_id', 'id');
    }
    public function cutomer()
    {
        return $this->hasMany(Customer::class, 'user_id', 'id');
    }
}
