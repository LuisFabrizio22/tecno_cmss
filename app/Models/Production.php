<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Production extends Model
{

    protected $dates=['deleted_at'];
    protected $table ='produccion';
    protected $hidden=['created_at','updated_at'];

    public function cat(){
        return $this->hasOne(Product::class, 'id_articulo', 'id_articulo');
    }

}
