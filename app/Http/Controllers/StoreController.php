<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use App\Models\OrderItem;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Order;
use Auth, Config;

class StoreController extends Controller
{
    public function getStore(){
      
        $categories=Category::where('parent', '0')->orderBy('order', 'Asc')->get();
        $data =['categories'=>$categories];
        return view('store', $data);
    }
     public function getCategory($id, $slug){
      
         $category= Category::findOrFail($id);
        $categories=Category::where('parent',$id)->orderBy('order', 'Asc')->get();
        $data =['categories'=>$categories, 'category'=>$category];
        return view('category', $data);

     }
     public function postSearch(Request $request){
       
         $product = Product::where('status', 1)->where('nombre_articulo', 'LIKE', '%'.$request->input('search_query').'%')->orderBy('id_articulo', 'Asc')->get();
         $data =['query'=>$request->input('search_query'), 'products'=>$product];
        return view('search', $data);

     }
     
    
}