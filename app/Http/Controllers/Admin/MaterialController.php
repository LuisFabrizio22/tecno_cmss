<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Validator, Auth;

class MaterialController extends Controller
{
    public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
public function getHome(){
    $cats=Material::orderBY('id_material', 'Desc')->get();
     $data=['cats'=>$cats];
    return view('admin.material.home', $data);
}


public function postMaterialAdd(Request $request){
    $rules = [
        'descripcion'=> 'required',
        'order'=> 'required',
    ];
    $messages =[
        'descripcion.required'=>'La descripción  es requerido',
        'order.required'=> 'La una imagen destacada',      
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $material = new Material;

        $material->descripcion=$request->input('descripcion');
        $material->cantidad_disponible=$request->input('order');
        $material->precio='0';
        $material->id_empleado = Auth::user()->id;
        

        if($material->save()):
           
            return back()->with('message', 'Guardado con éxito')->with('typealert','success');
        endif;

    endif;
 
}

}
