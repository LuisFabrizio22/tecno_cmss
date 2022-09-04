<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category, App\Models\PGallery, App\Models\Inventory, App\Models\Variant;
use App\Models\Product;
use Validator, Str, Config, Image;

class ProductController extends Controller
{
     public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

public function getHome($status){
    switch($status){
        case '0':
            $products= Product::with(['cat', 'getSubCategory'])->where('status', '0')->orderBy('id_articulo','desc')->simplePaginate(7);
            break;
        case '1':
            $products= Product::with(['cat', 'getSubCategory'])->where('status', '1')->orderBy('id_articulo','desc')->simplePaginate(7);
            break;
        case 'all':
            $products= Product::with(['cat', 'getSubCategory'])->orderBy('id_articulo','desc')->simplePaginate(7);
            break;
        case 'trash':
            $products= Product::with(['cat', 'getSubCategory'])->onlyTrashed()->orderBy('id_articulo','desc')->simplePaginate(7);
            break;      
    }
    $data=['products'=>$products];
    return view('admin.products.home', $data);

}
public function getProductAdd(){
    $cats=Category::where('parent','0')->pluck('cate_nombre','id_categoria');
    $data=['cats'=>$cats];
    return view('admin.products.add',$data);
}
public function postProductAdd(Request $request){
    $rules = [
        'name'=> 'required',
        'img'=> 'required',
        'content'=>'required',
      
        'price'=>'required',
        
    ];
    $messages =[
        'name.required'=>'el nombre del producto es requerido',
        'img.required'=> 'seleccione una imagen destacada',
        'img.image'=> 'el archivo no es una imagen',
        'content.required'=>'ingrese una descripcion del producto',
      
        'price.required'=>'ingrese el precio dle producto',
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        $path='/'.date('Y-m-d');//2020-02-14
        $fileExt=trim($request->file('img')->getClientOriginalExtension());
        $upload_path=Config::get('filesystems.disks.uploads.root');
        $name =Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
        $filename=rand(1,999).'-'.$name.'.'.$fileExt;
        $file_file=$upload_path.'/'.$path.'/'.$filename;
        //return $file_file;
        $product = new Product;
        $product->status ='0';
       
        $product->nombre_articulo=e($request->input('name'));
        $product->slug=Str::slug($request->input('name'));
        $product->imagen=$filename;
        $product->fecha_creacion=date('Y-m-d');
        $product->observacion =e($request->input('content'));
        $product->id_categoria=$request->input('category');   
        $product->id_subcategoria=$request->input('subcategory');
        $product->file_path=date('Y-m-d');
        $product->cantidad_disponible=$request->input('cantidad');
        $product->precio=$request->input('price');
        if($product->save()):
            if($request->hasFile('img')):
                $fl=$request->img->storeAs($path,$filename,'uploads');
                $img=Image::make($file_file);
                $img->fit(256,256, function($constraint){
                    $constraint->upsize();
                });
                $img->save($upload_path.'/'.$path.'/t_'.$filename);
            endif;
                return redirect('/admin/product/'.$product->id_articulo.'/edit')->with('message', 'Guardado con Exito')->with('typealert','success');
        endif;
    endif;
}
public function getProductEdit($id_articulo){
    $p =Product::find($id_articulo);
    $cats=Category::where('parent','0')->pluck('cate_nombre','id_categoria');
    $data=['cats'=>$cats, 'p'=>$p];
    return view('admin.products.edit',$data);

}
public function postProductEdit(Request $request,$id_articulo){
    $rules = [
        'name'=> 'required',     
        'content'=>'required',
     
        'price'=>'required',
        
    ];
    $messages =[
        'name.required'=>'el nombre del producto es requerido',
        'img.image'=> 'el archivo no es una imagen',
       
        'content.required'=>'ingrese una descripcion del producto',
        
        'price.required'=>'ingrese el precio dle producto',
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
       
        //return $file_file;


        $product =Product::findOrFail($id_articulo);
       // $ipp=$product->file_path;
       // $ip=$product->imagen;
        $product->status =$request->input('status');
       
        $product->nombre_articulo=e($request->input('name'));
        if($request->hasFile('img')):
            $path='/'.date('Y-m-d');//2020-02-14
            $fileExt=trim($request->file('img')->getClientOriginalExtension());
            $upload_path=Config::get('filesystems.disks.uploads.root');
            $name =Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename=rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file=$upload_path.'/'.$path.'/'.$filename;
            $product->file_path=date('Y-m-d');
            $product->imagen=$filename;
        endif;
        $product->fecha_creacion=date('Y-m-d');
        $product->observacion =e($request->input('content'));
        $product->discount_until_date=$request->input('discount_until_date');
        $product->discount=$request->input('discount');
        $product->in_discount=$request->input('in_discount');
        $product->id_categoria=$request->input('category');
        $product->id_subcategoria=$request->input('subcategory');
       
        $product->precio=$request->input('price');
        if($product->save()):
            if($request->hasFile('img')):
                $fl=$request->img->storeAs($path,$filename,'uploads');
                $img=Image::make($file_file);
                $img->fit(256,256, function($constraint){
                    $constraint->upsize();
                });
                $img->save($upload_path.'/'.$path.'/t_'.$filename);
                //unlink($upload_path.'/'.$ipp.'/'.$ip);
                //unlink($upload_path.'/'.$ipp.'/t_'.$ip);
            endif;
                return back()->with('message', 'Actualizado con Exito')->with('typealert','success');
        endif;
    endif;

}

public function postProductGalleryAdd($id_articulo, Request $request){

    $rules = [
        'file_image'=> 'required',
        
    ];
    $messages =[
        'file_image.required'=>'seleccione una imagen',
        
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else:
        if($request->hasFile('file_image')):
            $path='/'.date('Y-m-d');//2020-02-14
            $fileExt=trim($request->file('file_image')->getClientOriginalExtension());
            $upload_path=Config::get('filesystems.disks.uploads.root');
            $name =Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));
            $filename=rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file=$upload_path.'/'.$path.'/'.$filename;
            $g=new PGallery;
            $g->product_id=$id_articulo;
            $g->file_path=date('Y-m-d');
            $g->file_name =$filename;
        if($g->save()):
            if($request->hasFile('file_image')):
                $fl=$request->file_image->storeAs($path,$filename,'uploads');
                $img=Image::make($file_file);
                $img->fit(256,256, function($constraint){
                    $constraint->upsize();
                });
                $img->save($upload_path.'/'.$path.'/t_'.$filename);
            endif;
                return back()->with('message', 'Imagen subida con éxito')->with('typealert','success');
        endif;
    endif;
    endif;
        
}

function getProductGalleryDelete($id, $gid){
    $g=PGallery::findOrFail($gid);
    $path=$g->file_path;
    $file=$g->file_name;
    $upload_path=Config::get('filesystems.disks.uploads.root');
    if($g->product_id!=$id){
        return back()->with('message', 'La imagen no se puede eliminar')->with('typealert','danger');
    }else{
        if($g->delete()):
        unlink($upload_path.'/'.$path.'/'.$file);
        unlink($upload_path.'/'.$path.'/t_'.$file);
        return back()->with('message', 'imagen borrado con exito')->with('typealert','success');
        endif;
    }
}
public function postProductSearch(Request $request){
    $rules = [
        'search'=> 'required',
        
    ];
    $messages =[
        'search.required'=>'El campo consulta es requerido',
       
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
      ->with('typealert','danger')->withInput();

    else: 
        switch ($request->input('filter')):
            case '0':
                $products= Product::with(['cat'])->where('nombre_articulo','LIKE', '%'.$request->input('search').'%')
                ->where('status',$request->input('status'))->orderBy('id_articulo','desc')->get();
                break;
            
                case '1':
                    $products= Product::with(['cat'])->where('id_articulo',$request->input('search'))
                   ->orderBy('id_articulo','desc')->get();
                    break;
        
        endswitch;

        $data=['products'=>$products];

        return view('admin.products.search', $data);
    
    endif;

        
}
public function getProductDelete($id){
    $p= Product::findOrFail($id);
    if($p->delete()):
        return back()->with('message', 'Producto enviado a la papelera de reciclaje')->with('typealert', 'success');
    endif;
}
public function getProductRestore($id){
    $p= Product::onlyTrashed()->where('id_articulo',$id)->first();
    if($p->restore()):
        return redirect('/admin/product/'.$p->id_articulo.'/edit')->with('message', 'Este producto se restauro con éxito')->with('typealert', 'success');
    endif;
}
public function getProductInventory($id){
    $product=Product::findOrFail($id);
    $data=['product'=>$product];
    return view('admin.products.inventory', $data);


}
public function postProductInventory(Request $request,$id){
    $rules = [
        'name'=> 'required',
        'price'=>'required',
        
    ];
    $messages =[
        'name.required'=>'el nombre del producto es requerido',
        'price.required'=>'ingrese el precio dle producto',
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else: 
        $inventory =new Inventory;
        $inventory->id_articulo=$id;
        $inventory->name=e($request->input('name'));
        $inventory->quantity=e($request->input('inventory'));
        $inventory->price=$request->input('price');
        $inventory->limited=$request->input('limited');
        $inventory->minimun=$request->input('minimun');
        if($inventory->save()):
            return back()->with('message', 'Guardado con éxito')->with('typealert','success');
        endif;

    endif;
}
public function getProductInventoryEdit($id){
    $inventory=Inventory::findOrFail($id);
   
    $data=['inventory'=>$inventory];
    return view('admin.products.inventory_edit', $data);

}
public function postProductInventoryEdit($id, Request $request){
    $rules = [
        'name'=> 'required',
        'price'=>'required',
        
    ];
    $messages =[
        'name.required'=>'el nombre del producto es requerido',
        'price.required'=>'ingrese el precio dle producto',
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else: 
        $inventory = Inventory::find($id);
     
        $inventory->name=e($request->input('name'));
        $inventory->quantity=e($request->input('inventory'));
        $inventory->price=$request->input('price');
        $inventory->limited=$request->input('limited');
        $inventory->minimun=$request->input('minimun');
        if($inventory->save()):
            return back()->with('message', 'Actualizado con éxito')->with('typealert','success');
        endif;

    endif;


}
public function getProductInventoryDelete($id){
    $inventory= Inventory::findOrFail($id);
    if($inventory->delete()):
        return back()->with('message', 'Inventario Eliminado')->with('typealert', 'success');
    endif;

}
public function postProductInventoryVariantAdd($id, Request $request){

    $rules = [
        'name'=> 'required',
       
        
    ];
    $messages =[
        'name.required'=>'el nombre de la variante es requerido',
      
    ];

    $validator= Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'se ha poducido un error')
        ->with('typealert','danger')->withInput();
    else: 
        $inventory = Inventory::findOrFail($id);

        $variant= new Variant;
    
        $variant->articulo_id=$inventory->id_articulo; 
        $variant->inventory_id=$id;
        $variant->name=e($request->input('name'));
      
        if($variant->save()):
            return back()->with('message', 'Guardado con éxito')->with('typealert','success');
        endif;

    endif;

}
public function getProductInventoryVariantDelete($id){
    $variant= Variant::findOrFail($id);
    if($variant->delete()):
        return back()->with('message', 'Variante Eliminado')->with('typealert', 'success');
    endif;
}
}