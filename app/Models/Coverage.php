<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Coverage extends Model
{
  
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $table ='coverage';
    protected $hidden=['created_at','updated_at'];
    protected $primaryKey = 'id';


    public function getState(){
        return $this->hasOne(Coverage::class, 'id', 'province_id');
    }

    
}
