<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail;
use App\User;
use App\Mail\UserSendRecover;

class ConnectController extends Controller{
   public function __construct(){
   $this->middleware('guest')->except(['getLogout']);   
   }
 public function getLogin(){
    return view('connect.login');
}
 public function getRegister(){
   return view('connect.register');

}
public function postLogin(Request $request){
   $rules=[
      'email'=>'required|email',
      'password'=>'required|min:8'
   ];
   $messages=[
      'email.required'=> 'su nombre es requerido',
      'email.email'=> 'el formato de correo electronico es invalido',
      'password.required'=> 'por favor escriba la contraseña',
      'password.min' =>'la contraseña debe tener al menos 8 caracteres.'
   ];
    $validator1=Validator::make($request->all(), $rules, $messages);
   if($validator1->fails()):
      return back()->withErrors($validator1)->with('message','se ha producido un error:')->with('typealert',
         'danger');
   else:
      if(Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')],true)):
         if(Auth::user()->status=="100"):
            return redirect('/logout');
         else: 
            return redirect('/');
         endif;
      else:
            return back()->withErrors($validator1)->with('message','correo electronico o contraseña incorrecta')->with('typealert',
         'danger');
      endif;
   endif;

}
public function postRegister(Request $request){
   $rules = [
      'name'=> 'required',
      'lastname'=>'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8',
      'cpassword'=> 'required |min:8|same:password'

   ];
   $messages=[
      'name.required'=> 'su nombre es requerido',
      'lastname.required'=> 'su apellido es requerido',
      'email.required'=> 'su nombre es requerido',
      'email.email'=> 'el formato de correo electronico es invalido',
      'email.unique'=> 'ya existe un usuario registrado con este correo electronico',
      'password.required'=> 'por favor escriba la contraseña',
      'password.min' =>'la contraseña debe tener al menos 8 caracteres.',
      'cpassword.required'=>'es necesario confirmar la contraseña.',
      'cpassword.min'=>'la confirmacionla contraseña debe terner al menos 8 caracteres.',
      'cpassword.same'=> 'las contraseñas no coindicen.'

   ];
   $validator1=Validator::make($request->all(), $rules, $messages);
   if($validator1->fails()):
      return back()->withErrors($validator1)->with('message','se ha producido un error:')->with('typealert',
      'danger');
   else:
      $user = new User;
      $user->name = e($request->input('name'));
      $user->lastname = e($request->input('lastname'));
      $user->email = e($request->input('email'));
      $user->password = Hash::make($request->input('password'));

      if($user->save()):
         return redirect('/login')->with('message', 'su usuario se creo corectamente, iniciar sesion')->with('typealert','success');
      endif;
      //poner para revisar el video #41
   endif;
}
 public function getLogout(){
   if (Auth::guest()) {
      Auth::logout();
      return redirect('/');
} else {
   $status = Auth::user()->status;
   Auth::logout();
   if ($status == "100") {
          return redirect('/login')->with('message', 'Se cuenta fue suspendida')->with('typealert', 'danger');
    } else {
         return redirect('/');
   }
} 

}
public function getRecover(){
   return view('connect.recover');
  

}
public function postRecover(Request $request ){
   $rules = [
  
      'email' => 'required|email',
      
   ];
   $messages=[

      'email.required'=> 'su nombre es requerido',
      'email.email'=> 'el formato de correo electronico es invalido',
      

   ];
   $validator1=Validator::make($request->all(), $rules, $messages);

   if($validator1->fails()):
      return back()->withErrors($validator1)->with('message','se ha producido un error:')->with('typealert',
      'danger');
   else:
      $user =User::where('email', $request->input('email'))->count();
      if($user=="1"):
         $user= User::where('email', $request->input('email'))->first();
         $code = rand(100000, 999999);
         $data=['name'=>$user->name,'email'=>$user->email, 'code'=>$code];
        // return view('emails.user_password_recover', $data);
        Mail::to($user['email'])->send(new UserSendRecover($data));
      else:
         return back()->with('message','este correo electronico no existe')->with('typealert',
         'danger');
      endif;
   endif;

}

}