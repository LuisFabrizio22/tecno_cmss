<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;


    protected $dates=['deleted_at'];

    protected $table='articulo';
    protected $hidden=['created_at','updated_at'];
    protected $primaryKey = 'id_articulo';
  



    public function cat(){
        return $this->hasOne(Category::class, 'id_categoria', 'id_categoria');
    }

    public function getSubCategory(){
        return $this->hasOne(Category::class, 'id_categoria', 'id_subcategoria');
    }
   

    public function getGallery(){
        return $this->hasMany(PGallery::class, 'product_id', 'id_articulo');

    }
    public function getInventory(){
        return $this->hasMany(Inventory::class, 'id_articulo', 'id_articulo');
    }
    public function getPrice(){
        return $this->hasMany(Inventory::class, 'id_articulo', 'id_articulo')->min('price');
    }

}
