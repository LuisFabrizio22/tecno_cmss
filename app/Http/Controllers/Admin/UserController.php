<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('IsAdmin');
    }

    public function getUsers($status){
        if($status=='all'):
            $users=User::orderBY('id', 'Desc')->simplePaginate(10);
        else: 
        $users=User::where('status', $status)->orderBy('id', 'Desc')->simplePaginate(10);   
        endif;  


        $data=['users'=> $users];
        return view('admin.users.home', $data);

    }
    public function getUserEdit($id){
        $u=User::findOrFail($id);
        $data=['u'=>$u];
        return view('admin.users.user_edit', $data);

    }
    public function getUserBanned($id){
        $u=User::findOrFail($id);
        if($u->status=="100"):
         $u->status = "1";
         $msg="Usuario activo nuevamente";
        else:
            $u->status="100";
            $msg="Usuario suspendido con éxito";
        endif;
        if($u->save()):

                return back()->with('message', $msg)->with('typealert','success');
        endif;

   
    }

    public function getUserPermissions($id){
        $u=User::findOrFail($id);
        $data=['u'=>$u];
        return view('admin.users.user_permissions', $data);

    }
    public function postUserPermissions(Request $request, $id){
       
        $u=User::findOrFail($id);
      
        
        $u->permissions=$request->except(['_token']);
        
     
        if($u->save()):
            return back()->with('message', 'Los permisos fueron actualizados con éxito')->with('typealert','success');
        endif;


    }

    public function postUserEdit(Request $request, $id){
        $u=User::findOrFail($id);
        $u->role=$request->input('user_type');
        if($request->input('user_type')=="1"): 
            if(is_null($u->permissions)): 
                $permissions=[
                    'dashboard'=>true
                   
            
            ];
            $permissions=json_encode($permissions);
            $u->permissions=$permissions;

             endif;
            else: 
                $u->permissions=null;
        endif;

        if($u->save()):
            if($request->input('user_type')=="1"): 

                return redirect('/admin/user/'.$u->id.'/permissions')->with('message', 'El rango del usuario se actualizo con éxito')
                ->with('typealert','success');
            else: 
                return back()->with('message', 'El rango del usuario se actualizo con éxito')
                ->with('typealert','success');
            endif;
         endif;

        }

       
    
}
