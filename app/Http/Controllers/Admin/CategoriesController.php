<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Hash, Auth, Str, Config;
use App\Models\Category;

class CategoriesController extends Controller
{
   
    public function __Construct(){
        $this->middleware('auth');
     $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('IsAdmin');
    }

public function getHome(){
   $cats=Category::where('parent','0')->orderBy('order','Asc')->get();
   $data=['cats'=>$cats];
    return view('admin.categories.home', $data);

}
public function postCategoryAdd(Request $request){
    $rules=[
        'name'=>'required',];
    $messages=[
        'name.required'=>'Se requiere un nombre',];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'ERROR:')
        ->with('typealert','danger');
    else:
        $path='/'.date('Y-m-d');//2020-02-14
        $fileExt=trim($request->file('icon')->getClientOriginalExtension());
        $upload_path=Config::get('filesystems.disks.uploads.root');
        $name =Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
        $filename=rand(1,999).'-'.$name.'.'.$fileExt;
       
        //return $file_file;
        $c=new Category;
        $c->cate_nombre=e($request->input('name'));
        $c->slug=Str::slug($request->input('name'));
        $c->file_path=date('Y-m-d');
        $c->icono=$filename;
        $c->id_empleado=Auth::id();
        $c->cate_descripcion=e($request->input('descripcion'));
        $c->parent=$request->input('parent');
        $c->order=$request->input('order');
        
        

        if($c->save()):
            if($request->hasFile('icon')):
                $fl=$request->icon->storeAs($path,$filename,'uploads');
                
            endif;
            return back()->with('message', 'Guardado con éxito')->with('typealert','success');
        endif;

    endif;
}
public function getSubCategories($id_categoria){
    $cat=Category::findOrfail($id_categoria);
    $data=['category'=>$cat];
    return view('admin.categories.subs_categories', $data);


}
public function getCategoryDelete($id){
    $c=Category::find($id);
    if($c->delete()): 
        return back()->with('message', 'Borrado con éxito')->with('typealert', 'success');
    endif;
}
public function getCategoryEdit($id){
   
    $category =Category::find($id);
    $data=['category'=>$category];
    return view('admin.categories.edit',$data);
}


public function postCategoryEdit($id){
   

}
}
