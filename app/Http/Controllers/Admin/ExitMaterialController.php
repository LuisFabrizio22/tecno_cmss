<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Material;
use App\Http\Models\EntryMaterial;
use App\Http\Models\ExitMaterial;
use Validator, Config, Auth;


class ExitMaterialController extends Controller
{
    public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getHome(){
        
    $cats = Material::pluck('descripcion', 'id_material');
    $materials= ExitMaterial::orderBy('id_salida','desc')->get();
    $cats1=Material::orderBY('id_material', 'Desc')->get();
    $data = ['cats'=>$cats, 'materials'=>$materials, 'cats'=>$cats, 'cats1'=>$cats1];
        return view('admin.material.exit_home', $data);
    }

    
    public function postExitMaterialAdd(Request $request){
        $rules = [
            'cantidad_salida'=> 'required',
        ];
        $messages =[
            'cantidad_salida.required'=>'La cantidad  es requerido',
        ];
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha poducido un error')
            ->with('typealert','danger')->withInput();
        else:
            $exitmaterial = new ExitMaterial;
            $exitmaterial->id_material=$request->input('material');
            $exitmaterial->cantidad_salida=$request->input('cantidad_salida');
            $exitmaterial->fecha_salida=$request->input('date');
            $exitmaterial->id_empleado = Auth::user()->id;
            if($exitmaterial->save()):
               
                return back()->with('message', 'Guardado con éxito')->with('typealert','success');
            endif;
        endif;   
    }
}
