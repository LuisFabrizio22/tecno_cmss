<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Production;
use App\Models\Product;

use Validator, Str, Config, Image;

class ProductionController extends Controller
{

    public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getHome(){
     //   $cats=Production::where('parent','0')->orderBy('order','Asc')->get();
      //  $data=['cats'=>$cats];
      $productions= Production::orderBy('id_produccion','desc')->get();

      $cats = Product::where('status','1')->pluck('nombre_articulo', 'id_articulo');
      $products= Product::where('status', '1')->orderBy('id_articulo','desc')->get();
      $data = ['cats'=>$cats, 'productions'=>$productions, 'products'=>$products];
        
    return view('admin.production.home', $data);
     

    }
    public function getProductionAdd(){
        $cats=Material::pluck('descripcion','id_material');
        $data=['cats'=>$cats];
        return view('admin.production.home',$data);
    }

    public function postProductionAdd(Request $request){
        $rules = [
         
            'cantidad'=> 'required',
            'date'=>'required',
          
            
        ];
        $messages =[
           
            'cantidad.required'=> 'seleccione una imagen destacada',
            'date.image'=> 'el archivo no es una imagen',
           
        ];
    
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha poducido un error')
            ->with('typealert','danger')->withInput();
        else:
           
            $production = new Production;
            $production->id_articulo =$request->input('articulo');
            $production->cantidad=$request->input('cantidad');
            $production->fecha=$request->input('date');
   
            if($production->save()):
               
                endif;
                    return back()->with('message', 'Guardado con Exito')->with('typealert','success');
        endif;

    }

}
