<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class EntryMaterial extends Model
{

    protected $dates=['deleted_at'];
    protected $table ='ingreso_material';
    protected $primaryKey = 'id_ingreso';

    protected $hidden=['created_at','updated_at'];

    public function getSub(){
        return $this->hasOne(Material::class, 'id_material', 'id_material');
    }

    public function cat(){
        return $this->hasOne(Material::class, 'id_material', 'id_material');
    }
    public function cat1(){
        return $this->hasOne(User::class, 'id', 'id_empleado');
    }
 
}
