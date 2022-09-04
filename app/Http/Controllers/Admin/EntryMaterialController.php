<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\EntryMaterial;
use Validator, Config, Auth;

class EntryMaterialController extends Controller
{
    public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getHome(){

    $cats1 = Material::pluck('descripcion', 'id_material');
    $materials= EntryMaterial::orderBy('id_ingreso','desc')->get();
    $material= Material::orderBy('id_material','desc')->get();
     $cats=Material::orderBY('id_material', 'Desc')->get();

    $data = ['cats'=>$cats, 'materials'=>$materials, 'cats1'=>$cats1, 'material'=>$material];
        return view('admin.material.entry_home', $data);
    }
    public function postEntryMaterialAdd(Request $request){
        $rules = [
            'cantidad_ingreso'=> 'required',
            'precio'=> 'required',
        ];
        $messages =[
            'cantidad_ingreso.required'=>'La cantidad  es requerido',
            'precio.required'=> 'El precio es requerido',      
        ];
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha poducido un error')
            ->with('typealert','danger')->withInput();
        else:
            $entrymaterial = new EntryMaterial;
            $entrymaterial->id_material=$request->input('material');
            $entrymaterial->cantidadingreso=$request->input('cantidad_ingreso');
            $entrymaterial->fecha_adquisicion = $request->input('date');
            $entrymaterial->precio_adquisicion=$request->input('precio');

            $entrymaterial->id_empleado = Auth::user()->id;
            if($entrymaterial->save()):
               
                return back()->with('message', 'Guardado con éxito')->with('typealert','success');
            endif;
        endif;   
    }
}