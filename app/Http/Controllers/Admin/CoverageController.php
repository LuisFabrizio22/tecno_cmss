<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coverage;
use Validator;

class CoverageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
       $this->middleware('user.permissions');
        $this->middleware('IsAdmin');
}
public function getList(){
    $states=Coverage::where('ctype', 0)->get();
    $data=['states'=>$states];
    return view('admin.coverage.list', $data);
}
public function postCoverageStateAdd(Request $request){
    $rules = [
        'name'=> 'required',   
    ];
    $messages =[
        'name.required'=>'Es requerido el nombre de la cobertura.',  
    ];
    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $coverage = new Coverage;
        $coverage->ctype = '0';
        $coverage->province_id = '0';
        $coverage->name = $request->input('name');
        $coverage->price = '0';
        $coverage->days = $request->input('days');
        if($coverage->save()): 
            return back()->with('message', 'Guardado con éxito')->with('typealert', 'success');
        endif;
    endif;
}
public function getCoverageDelete($id){
    $coverage= Coverage::find($id);
    if($coverage->delete()): 
        return back()->with('message', 'Eliminado con éxito')->with('typealert', 'success');
    endif;


}
public function postCoverageStateEdit($id, Request $request){
    $rules = [
        'name'=> 'required',    
    ];
    $messages =[
        'name.required'=>'Es requerido el nombre de la cobertura.',
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $coverage = Coverage::find($id);
        $coverage->status = $request->input('status');
        $coverage->name = $request->input('name');
        $coverage->days = $request->input('days');
        if($coverage->save()): 
            return back()->with('message', 'Actualizado con éxito')->with('typealert', 'success');
        endif;
    endif;
}
public function getCoverageEdit($id){
    $coverage = Coverage::findOrFail($id);
    $data=['coverage'=>$coverage];
  return view('admin.coverage.edit', $data);

}
public function getCoverageCities($id){
    $state=Coverage::findOrFail($id);
    $cities = Coverage::where('province_id', $id)->get();
    $data= ['cities'=>$cities,  'id'=>$id, 'state'=>$state];
    return view('admin.coverage.cities', $data);



}
public function getCoverageCityEdit($id){
    $coverage = Coverage::findOrFail($id);
    $data= ['coverage'=>$coverage];
    return view('admin.coverage.edit_city', $data);



}
public function postCoverageCityAdd(Request $request){
    $rules = [
        'name'=> 'required',   
    ];
    $messages =[
        'name.required'=>'Es requerido el nombre de la cobertura.',  
    ];
    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $coverage = new Coverage;
        $coverage->ctype = '1';
        $coverage->province_id = $request->input('province_id');
        $coverage->name = $request->input('name');
        $coverage->price =  $request->input('price');
        $coverage->days = $request->input('days');
        if($coverage->save()): 
            return back()->with('message', 'Guardado con éxito')->with('typealert', 'success');
        endif;
    endif;
}

public function postCoverageCityEdit ($id, Request $request){
    $rules = [
        'name'=> 'required',    
        'price'=>'required'
    ];
    $messages =[
        'name.required'=>'Es requerido el nombre de la cobertura.',
        'price.required'=>'Es requerido el precio de envío.'
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $coverage = Coverage::findOrFail($id);
        $coverage->status = $request->input('status');
        $coverage->name = $request->input('name');
        $coverage->days = $request->input('days');
        if($coverage->save()): 
            return back()->with('message', 'Actualizado con éxito')->with('typealert', 'success');
        endif;
    endif;

}

}
