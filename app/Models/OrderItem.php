<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
 

    use SoftDeletes;
    protected $dates=['deleted_at'];

   protected $table ='orders_items';


  
   protected $hidden=['created_at','updated_at'];


   public function getItems(){
       return $this->hasMany(OrderItem::class, 'order_id', 'id');
   }
   public function getProduct(){
       return $this->hasOne(Product::class, 'id_articulo', 'product_id');

}
}