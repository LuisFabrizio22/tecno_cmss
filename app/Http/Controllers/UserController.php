<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Coverage;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Order;

use Validator, Str, Config, Image, Auth, Hash;

class UserController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
    }
    public function getAccountEdit(){
        $birthday= (is_null(Auth::user()->birthday))?  [null, null, null] : explode('-', Auth::user()->birthday);
        $data=['birthday'=>$birthday];
        return view('user.account_edit', $data);

    }

    public function postAccountAvatar(Request $request){
        $rules = [
            'avatar'=> 'required',      
        ];
        $messages =[
            'avatar.required'=>'Seleccione una imagen', 
        ];
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'se ha poducido un error')
            ->with('typealert','danger')->withInput();
        else:
           
        if($request->hasFile('avatar')):
            $path='/'.Auth::id();//2020-02-14
            $fileExt=trim($request->file('avatar')->getClientOriginalExtension());
            $upload_path=Config::get('filesystems.disks.uploads_user.root');
            $name =Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
            $filename=rand(1,999).'_av_'.$name.'.'.$fileExt;
            $file_file=$upload_path.'/'.$path.'/'.$filename;

            $u =User::find(Auth::id());
            $uu=$u->avatar;
            $u->avatar=$filename;   
        if($u->save()):
            if($request->hasFile('avatar')):
                $fl=$request->avatar->storeAs($path,$filename,'uploads_user');
                $img=Image::make($file_file);
                $img->fit(256,256, function($constraint){
                    $constraint->upsize();
                });
                $img->save($upload_path.'/'.$path.'/av_'.$filename);
            endif;
            unlink($upload_path.'/'.$path.'/'.$uu);
            unlink($upload_path.'/'.$path.'/av_'.$uu);
                return back()->with('message', 'Avatar subido con Exito')->with('typealert','success');
        endif;
    endif;
    endif;  
    }
    public function postAccountPassword(Request $request){
        $rules = [
            'apassword'=> 'required | min:8',   
            'password'=> 'required | min:8',   
            'cpassword'=> 'required | min:8' 
            
            
        ];
        $messages =[
            'apassword.required'=>'Escriba su contrase??a actual',
            'apassword.min'=>'La constrase??a actual debe de tener al menos 8 caracteres',
            'password.required'=>'Escriba su nueva contrase??a',
            'password.min'=>'Su nueva contrase??a debe tener al menos 8 caracteres',
            'cpassword.required'=>'Confirme su nueva contrase??a',
            'cpassword.min'=>'La confirmaci??n de la nueva contrase??a debe de tener al menos 8 caracteres',
            'cpassword.same'=>'Las contrase??as no coinciden'
           
        ];
    
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha poducido un error')
            ->with('typealert','danger')->withInput();
        else:
            $u= User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                    return back()->with('message', 'La contrase??a se actualizo con ??xito')
                    ->with('typealert','success');
                endif;
                
            else:
                return back()->with('message', 'Su contrase??a actual es err??nea')
                ->with('typealert','danger');

            endif;


        endif;


    }

    public  function postAccountInfo(Request $request){
        $rules = [
            'name'=> 'required',   
            'lastname'=> 'required',   
            'phone'=> 'required' ,
            'year'=> 'required' ,
            'day'=> 'required' 
            
            
        ];
        $messages =[
            'name.required'=> 'Su nombre es requerido',   
            'lastname.required'=> 'Su apellido es requeridp',   
            'phone.min'=> 'Su nombre de tel??fono es requerido' ,
            'year'=> 'El n??mero de tel??fono deber tener como m??nimo 8 d??gitos' ,
            'day'=> 'Su d??a de nacimiento es requerido' 
        ];
    
        $validator= Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha poducido un error')
            ->with('typealert','danger')->withInput();
        else:
            $date =$request->input('year').'-' .$request->input('month').'-'.$request->input('day');
            $u= User::find(Auth::id());
            $u->name=e($request->input('name'));
            $u->lastname=e($request->input('lastname'));
            $u->phone=e($request->input('phone'));
            $u->birthday=date("Y-m-d", strtotime($date));

            $u->gender=e($request->input('gender'));
            if($u->save()):
                return back()->with('message', 'Se actualizo con ??xito')
                ->with('typealert','success');
            endif;
            


        endif;


    }
    public function getAccountAddress(){
       
        $states = Coverage::where('ctype', '0')->pluck('name', 'id');
        $data = ['states'=>$states];
        return view('user.account_address', $data);
    }

   public function postAccountAddressAdd (Request $request){
    $rules = [
        'name'=> 'required',   
        'province_id'=> 'required',   
        'city'=> 'required' ,
        'add1'=> 'required' ,
        'add2'=> 'required' ,
        'add3'=> 'required' 
        
        
    ];
    $messages =[
        'name.required'=> 'Es requerido un nombre para la direcci??n',   
        'province_id.required'=> 'Seleccione una provincia',   
        'city.required'=> 'Seeccione una ciudad' ,
        'add1.required'=> 'Ingrese el nombre de su barrio o residencia',
        'add2.required'=> 'Ingrese su calle / Avenida / Bloque',
        'add3.required'=> 'Ingrese el numero de su casa / departamento' 
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $address= new UserAddress;
        $address->user_id = Auth::id();
        $address->province_id = $request->input('province_id');
       
        $address->city_id = $request->input('city');
        $address->name = e($request->input('name'));
        $info=['add1'=>e($request->input('add1')),'add2'=>e($request->input('add2')),'add3'=>e($request->input('add3')), 'add4'=>e($request->input('add4'))];
        $address->addr_info=json_encode($info);
        if(count(collect(Auth::user()->getAddress))==0):
            $address->defaul = "1";
        endif;
       
        if($address->save()): 
            return back()->with('message', 'La direcci??n fue guardada con ??xito.')->with('typealert', 'success');
        endif;

    endif;
    
   }
   public function getAccountAddressSetDefault(UserAddress $address){
     if(Auth::id() != $address->user_id): 
        return back()->with('message', 'No puede editar la  direcci??n de entrega')->with('typealert', 'danger');
     else: 
        $default = Auth::user()->getAddressDefault->id;
        $default = UserAddress::find(Auth::user()->getAddressDefault->id);
        $default->defaul = "0";
        $default->save();

        //new default address
        $address->defaul= "1";
        if($address->save()): 
            return back()->with('message', 'La direcci??n se asigno como direcci??n principal de entrega.')->with('typealert', 'success');
        endif;


     endif;
   }

public function getAccountAddressDelete(UserAddress $address){
    if(Auth::id() != $address->user_id): 
        return back()->with('message', 'No tiene permisos para eliminar esta direcci??n.')->with('typealert', 'danger');
     else: 
        if($address->defaul == "0"):
            if($address->delete()): 
                return back()->with('message', 'La direcci??n se elimin?? con ??xito.')->with('typealert', 'success');

            endif;
        else: 
            return back()->with('message', 'No se puede eliminar una direcci??n principal.')->with('typealert', 'danger');

        endif;
     endif;

}


}
