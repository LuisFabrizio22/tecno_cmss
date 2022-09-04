<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $dates=['deleted_at'];
    protected $table ='users';
    protected $primaryKey = 'id';

    protected $hidden=['created_at','updated_at'];

}
