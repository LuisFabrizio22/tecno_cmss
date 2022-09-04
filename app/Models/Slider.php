<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    
    protected $dates=['deleted_at'];


  
    protected $hidden=['created_at','updated_at'];
  

    protected $table='sliders';
    protected $primaryKey = 'id';
  
}
