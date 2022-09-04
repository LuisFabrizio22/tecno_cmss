<?php
namespace App\Http\Controllers;
use Config, Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Coverage;

class ApiJsController extends Controller{
    public function __construct(){
    $this->middleware('auth')->except(['getProductsSection']);
    }
    function getProductsSection($section,Request $request){
        $items_x_page=Config::get('localhost.product_per_page');
        $items_x_page_random=Config::get('localhost.product_per_page_random');
        switch ($section): 
            case 'home':
                $products=Product::where('status',1)->inRandomOrder()->paginate($items_x_page_random);
                break;
            case 'store':
                $products=Product::where('status',1)->orderBy('id_articulo', 'Desc')->paginate($items_x_page);
                break;
            case 'store_category':
                $products=$this->getProductsCategory($request->get('object_id'), $items_x_page);
                break;
            default:
                $products=Product::where('status',1)->inRandomOrder()->paginate($items_x_page_random);
                break;
        endswitch;
        return $products;
}
public function getProductsCategory($id, $ipp){
    $category= Category::find($id);
    if($category->parent=="0"): 
        $query=Product::where('status', 1)->where('id_categoria', $id)->orderBy('id_articulo', 'Desc')->paginate($ipp);
    else: 
        $query=Product::where('status', 1)->where('id_subcategoria', $id)->orderBy('id_articulo', 'Desc')->paginate($ipp);

    endif;
    return $query;


}
   function postFavoriteAdd($object, Request $request){
        $query =Favorite::where('user_id', Auth::id())->where('object_id',$object)->count();
        if($query >0): 
            $data=['status'=>'error', 'msg'=>'Este ítems ya esta esta en favoritos'];
        else: 
            $favorite= new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->object_id=$object;
            if($favorite->save()): 
                $data=['status'=>'success', 'msg'=>'Se guardo su favorito'];
            endif;
        endif;
     return response()->json($data);
    }

    public function postUserFavorites(Request $request){
        $object =json_decode($request->input('objects'), true);
        $query= Favorite::where('user_id', Auth::id())->whereIn('object_id',explode(",",$request->input('objects')))->pluck('object_id');
        if(count(collect($query)) >0): 
            $data=['status'=>'success', 'count'=>count(collect($query)), 'objects'=>$query];
        else: 
            $data=['status'=>'success', 'count'=>count(collect($query))];
        endif;

       return response()->json($data);

    }
    public function postProductInventoryVariants($id){
        $query=Inventory::find($id);
        return response()->json($query->getVariants);
    }

    public function postCoverageCitiesFromState($state){
        $cities = Coverage::where('ctype', '1')->where('province_id', $state)->get();
        return response()->json($cities);
        

    }
}
