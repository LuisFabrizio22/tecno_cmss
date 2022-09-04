<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
 
    protected $dates=['deleted_at'];
    protected $table='user_favorites';
    protected $hidden=['created_at','updated_at'];
    protected $primaryKey = 'id';
  
}
