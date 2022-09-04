<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Mail\AdminNotifyUserOrderStatusChange;
use Mail;
class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    public function getList($status,$type){
        if($status == "all"):
            if($type == "all"):
            $orders = Order::where('status', '!=', '0')->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(8);
            else:
            $orders = Order::where('status', '!=', '0')->where('o_type', $type)->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(8);
            endif;
        else: 
            if($type == "all"):
                $orders =Order::where('status', $status)->with(['get User']);
            else:
                $orders =Order::where('status', $status)->where('o_type', $type)->with(['getUser'])->orderBy('o_number', 'Desc')->paginate(8);
  
            endif;
        endif;
        $all_orders=Order::select(['id', 'status'])->get();
        $data = ['orders'=> $orders, 'all_orders'=>$all_orders, 'status'=>$status,'type'=>$type];

       return view('admin.orders.list', $data);
    }
    public function getOrder(Order $order){
        $data = ['order' => $order];
        return view('admin.orders.view', $data);

    }
    public function postOrderStatusUpdate(Order $order, Request $request){
        if($request->input('status') == "1" || $order->status == "6" || $order->status == "100") :
            return back();
        else:
            $order->status = $request->input('status');
            if($request->input('status') == "2" && is_null($order->paid_at)):
                $order->paid_at = date('Y-m-d h:i:s');
            endif;
            
            if($request->input('status') == "3" && is_null($order->process_at)):
                $order->process_at = date('Y-m-d h:i:s');
            endif;
           
            if($request->input('status') == "4" && is_null($order->send_at)):
                $order->send_at = date('Y-m-d h:i:s');
            endif;
            if($request->input('status') == "5" && is_null($order->send_at)):
                $order->send_at = date('Y-m-d h:i:s');
            endif;
            if($request->input('status') == "6" && is_null($order->delivery_at)):
                $order->delivery_at = date('Y-m-d h:i:s');
            endif;
            if($request->input('status') == "100" && is_null($order->rejected_at)):
                $order->rejected_at = date('Y-m-d h:i:s');
            endif;
            if($order->save()):
                $user = $order->getUser;
                $data =['name'=> $user->name,'email'=>$user->email, 'status'=>$request->input('status'),'o_number'=>$order->o_number];

                Mail::to($user->email)->send(new AdminNotifyUserOrderStatusChange($data));

                return back()->with('message', 'Guardado con éxito')->with('typealert', 'success');
            endif;
        endif;

    }
}
