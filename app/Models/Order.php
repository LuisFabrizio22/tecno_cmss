<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    protected $table='orders';
    protected $hidden=['created_at','updated_at'];
    
    public function getItems(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->with(['getProduct']);
    }

    public function getUserAddress(){
        return $this->hasOne(UserAddress::class, 'id', 'user_address_id');
    }
    
    public function getSubtotal(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->sum('total');
    }

    public function getUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

      
}
