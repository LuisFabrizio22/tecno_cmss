<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Validator, Auth, Config, Str;

class SliderController extends Controller
{
           public function __construct(){
           $this->middleware('user.status');
           $this->middleware('user.permissions');
           $this->middleware('auth');
           $this->middleware('IsAdmin');
       }
    public function gethome(){
        $sliders = Slider::orderBy('sorder', 'Asc')->get();
        $data=['sliders'=>$sliders];
        return view('admin.slider.home', $data);
    }
    public function postSliderAdd(Request $request){
        $rules =[
            'name' => 'required',
            'img'=> 'required',
            'content'=> 'required',
            'sorder'=> 'required',
        ];
        $messages=[
            'name.required' => 'El nombre del slider es requerido',
            'img.required'=> 'Seleccione una imagen para el Slider',
            'content.required'=> 'El contenido del slider es requerido',
            'sorder.required'=> 'Es necesario definir una orden de aparición',
        ];
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha poducido un error')->with('typealert','danger');
        else: 
            $path='/'.date('Y-m-d');//2020-02-14
            $fileExt=trim($request->file('img')->getClientOriginalExtension());
            $upload_path=Config::get('filesystems.disks.uploads.root');
            $name =Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename=rand(1,999).'-'.$name.'.'.$fileExt;
            $slider=new Slider;
            $slider->user_id=Auth::id();
            $slider->status=$request->input('visible');
            $slider->name=e($request->input('name'));
            $slider->file_path=date('Y-m-d');
            $slider->file_name=$filename;
            $slider->content=e($request->input('content'));
            $slider->sorder=e($request->input('sorder'));
            if($slider->save()): 
                if($request->hasFile('img')): 
                    $fl=$request->img->storeAs($path, $filename, 'uploads');
                endif;
                return back()->withErrors($validator)->with('message', 'Guardado con éxito')->with('typealert','success');
            endif;
        endif;
    }
    public function getSliderEdit($id){
        $slider= Slider::findOrFail($id);
        $data =['slider'=>$slider];
        return view('admin.slider.edit', $data);
    }
    public function postSliderEdit(Request $request, $id){
        $rules =[
            'name' => 'required',
            
            'content'=> 'required',
            'sorder'=> 'required',
        ];
        $messages=[
            'name.required' => 'El nombre del slider es requerido',
            'content.required'=> 'El contenido del slider es requerido',
            'sorder.required'=> 'Es necesario definir una orden de aparición',
        ];
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha poducido un error')->with('typealert','danger');
        else: 
            $slider= Slider::find($id);
   
         
            $slider->name=e($request->input('name'));
            $slider->status=$request->input('visible');
            $slider->content=e($request->input('content'));
            $slider->sorder=e($request->input('sorder'));
            if($slider->save()): 
                return back()->withErrors($validator)->with('message', 'Guardado con éxito')->with('typealert','success');
            endif;
        endif;
    }

    public function getSliderDelete($id){
        $slider= Slider::findOrFail($id);
        if($slider->delete()): 
            return back()->with('message', 'Producto enviado a la papelera de reciclaje')->with('typealert','success');
        endif;
    }
    }