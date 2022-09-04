<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

 
      protected $dates=['deleted_at'];

   protected $table ='products_inventory';
   protected $hidden =['create_at','updated_at'];

   public function getProduct(){
       return $this->hasOne(Product::class, 'id_articulo', 'id_articulo');
   }
   public function getVariants(){
    return $this->hasMany(Variant::class, 'inventory_Id', 'id');
}
}
