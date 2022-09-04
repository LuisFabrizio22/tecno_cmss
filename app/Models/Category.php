<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model


{
   use SoftDeletes;
   protected $dates=['deleted_at'];
   protected $table ='categoria';
   protected $hidden=['created_at','updated_at'];
   protected $primaryKey = 'id_categoria';
   public function getSubcategories(){
      return $this->hasMany(Category::class, 'parent', 'id_categoria');
   }
   public function getParent(){
      return $this->hasOne(Category::class, 'id_categoria', 'parent');
   }
 
   
}
