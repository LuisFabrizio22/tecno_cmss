<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderSendDetails;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function getOrderEmailDetails($orderid){
        $order =Order::find($orderid);
        $data =['order'=>$order];
        Mail::to($order->getUser->email)->send(new OrderSendDetails($data));
        //foreach($this->getAdminsEmails() as $admin):
         //   $data = ['order' => $order, 'name' => $admin->name.' '.$admin->lastname];
         //   Mail::to($admin->email->send(new OrderSendDetailsAdmin($data)));
       // endforeach;
        //return view('emails.order_details', $data);

    }
    public function getAdminEmails(){
        return DB::table('users')->where('role', '1')->get();
    }
    public function getProcessOrder(Order $order){

    }
	
}
