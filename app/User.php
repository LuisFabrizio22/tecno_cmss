<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
 

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAddress(){
       return $this->hasMany(Models\UserAddress::class, 'user_id', 'id')->with(['getState', 'getCity']);
        }
    public function getAddressDefault(){
        return $this->hasOne(Models\UserAddress::class, 'user_id', 'id')->where('defaul', '1')->with(['getState', 'getCity']);
        }
    public function getOrders(){
        return $this->hasMany('App\Models\Order', 'user_id', 'id')->where('status', '!=', '0');
    }
    public function getOrdersProcess(){
        
    }
}
