<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Variant extends Model
{
    use SoftDeletes;
   
    
    protected $dates=['deleted_at'];

    protected $table ='product_inventory_variants';
    protected $hidden =['create_at','updated_at'];
 
 
}
