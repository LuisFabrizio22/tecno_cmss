<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Order;
use Auth, Config;



class ProductController extends Controller
{
    public function getProduct($id, $slug){
        $product= Product::findOrFail($id);
      //  return count($product->getGallery);
      //  $product=Product::where('id_articulo', $id)->where('slug', $slug)->first();
        $data=['product'=>$product];
       return view('product.product_single', $data);
    
}}

