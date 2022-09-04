<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    

    protected $dates=['deleted_at'];
    protected $table ='material';
    protected $primaryKey = 'id_material';

    protected $hidden=['created_at','updated_at'];

}
