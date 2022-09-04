<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExitMaterial extends Model
{

    protected $dates=['deleted_at'];
    protected $table ='salida_material';
    protected $primaryKey = 'id_salida';

    protected $hidden=['created_at','updated_at'];

    public function cat(){
        return $this->hasOne(Material::class, 'id_material', 'id_material');
    }

}
