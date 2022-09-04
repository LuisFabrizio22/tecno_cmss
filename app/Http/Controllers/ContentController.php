<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Order;
use Auth, Config;


class ContentController extends Controller
{
   public function getHome(){
      $order= $this->getUserOrder();
      $items = $order->getItems;
      $categories=Category::where('parent', '0')->orderBy('cate_nombre','Asc')->get();
      $sliders= Slider::where('status',1)->orderBy('sorder', 'Asc')->get();
      $data=['categories'=>$categories, 'sliders'=>$sliders,'items'=>$items];
       return view('home', $data);
   }
   public function getUserOrder(){
      $order = Order::where('status','0')->count();
      if($order == "0"):
          $order = new Order;
          $order->user_id=Auth::user()->id;
          $order->save();
      else: 
          $order= Order::where('status','0')->first();
      endif;
      return $order;

  }
}
