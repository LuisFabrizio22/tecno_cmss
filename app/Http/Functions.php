<?php 
//key value from jason
function kvfj($json, $key){
	if($json==null):
		return null;
	else: 
		$json=$json;
		$json=json_decode($json, true);
		if(array_key_exists($key, $json)): 
			return $json[$key];
		else: 
			return null;
		endif;

	endif;
}
function getModulesArray(){
	$a=[
		'0'=> 'Productos',
		'1'=> 'Blog'
	];
	return $a;
}

function getRoleUserArray($mode, $id){
	$roles=['0'=>'Usuario', '1'=>'Administrador','2'=>'Bodega','3'=>'Produccion'];
	if(!is_null($mode)):
		return $roles;
	else:
		return $roles[$id];
	endif;
}
function getUserStatusArray($mode,$id){
	$status=['0'=>'Registrado', '1'=>'Verificado','100'=>'Baneado'];

	if(!is_null($mode)):
		return $status;
	else:
		return $status[$id];
	endif;
	

}

function user_permissions(){
	$p=[
	 'dashboard'=>[
		  'icon'=>'<i class="fas fa-home"></i>',
		 'title'=> 'Módulo Dashboard',
		 'keys' => [
			 'dashboard'=>'Puede ver el dashboard.',
			 'dashboard_small_stats'=>'Puede ver las estadísticas rápidas.',
			 'dashboard_sell_today'=>'Puede ver lo facturado hoy.',


		 ]

		 ],
		 'products'=>[
			'icon'=>'<i class="fas fa-boxes"></i>',
			'title'=> 'Módulo Producto',
			'keys' => [
				'products'=>'Puede ver el listado de productos.',
				'product_add'=>'Puede agregar nuevos productos.',
				'product_edit'=>'Puede editar productos.',
				'product_search'=>'Puede buscar productos.',
				'product_delete'=>'Puede elimibar productos.',
				'product_gallery_add'=>'Puede agregar imágenes a la galería.',
				'product_gallery_delete'=>'Puede eliminar imágenes de la galería.',
				'product_inventory'=>'Puede administrar el inventario',
			 

		 ]
			],
			'coverage'=>[
				'icon'=>'<i class="fas fa-shipping-fast"></i>',
				'title'=> 'Cobertura de envíos',
				'keys' => [
					'coverage_list'=>'Puede ver el listado de cobertura de envíos.',
					'coverage_add'=>'Puede crear zonas de enenvío.',
					'coverage_edit'=>'Puede eliminar zonas de enenvío.',
					'coverage_delete'=>'Puede editar zonas de enenvío.',
					
	
			 ]
				],
			'categories'=>[
				'icon'=>'<i class="fas fa-folder-open"></i>',
			   'title'=> 'Módulo Categorias',
			   'keys' => [
				   'categories'=>'Puede ver lista de categorías.',
				   'category_add'=>'Puede crear nuevas categorías.',
				   'category_edit'=>'Puede editar categorías.',
				   'category_delete'=>'Puede eliminar categorías.',
	  
	  
			   ]
	  
			   ],
			   'sliders'=>[
				'icon'=>'<i class="far fa-images"></i>',
			   'title'=> 'Módulo de Sliders',
			   'keys' => [
				   'sliders_list'=>'Puede ver lista de Sliders.',
				   'slider_add'=>'Puede agregar Sliders.',
				   'slider_edit'=>'Puede editar Sliders.',
				   'slider_delete'=>'Puede eliminar Sliders.',
				
				  
			   ]
	  
			   ],

			   'users'=>[
				'icon'=>'<i class="fas fa-user-friends"></i>',
			   'title'=> 'Módulo de Usuarios',
			   'keys' => [
				   'user_list'=>'Puede ver lista de usuarios.',
				   'user_edit'=>'Puede editar.',
				   'user_banned'=>'Puede banear usuarios.',
				   'user_permissions'=>'Puede administrar permisos de usuario.',
	  
	  
			   ]
	  
			   ],
			   'settings'=>[
				'icon'=>'<i class="fas fa-cogs"></i>',
			   'title'=> 'Módulo de Configuraciones',
			   'keys' => [
				   'settings'=>'Puede configurar la configuración.',
				  
			   ]
	  
			   ],
			   'orders'=>[
				'icon'=>'<i class="fas fa-clipboard"></i>',
			   'title'=> 'Módulo de Ordenes',
			   'keys' => [
				   'orders_list'=>'Puede ver listado de ordenes.',
				    'order_view'=>'Puede ver el detalle de una orden.',
				     'orders_change_status'=>'Puede cambiar el estado de una orden.',
			   ]
				   
	  
			   ],
			   'material'=>[
				'icon'=>'<i class="fas fa-tools"></i>',
			   'title'=> 'Módulo de Material',
			   'keys' => [
				   'material_list'=>'Puede ver listado de material.',
				   'material_add'=>'Puede agregar material.',
				   'material_edit'=>'Puede editar el listado de material.',
				   'material_delete'=>'Puede eliminar el material.',
			   ]
	  
			   ],
			   'entrymaterial'=>[
				'icon'=>'<i class="fas fa-tools"></i>',
			   'title'=> 'Módulo de Ingreso Material',
			   'keys' => [
				   'entrymaterial_list'=>'Puede ver listado de material comprado.',
				   'entrymaterial_add'=>'Puede agregar material.',
				   'entrymaterial_edit'=>'Puede editar el listado de material comprado.',
				   'entrymaterial_delete'=>'Puede eliminar el material.',
			   ]
	  
			   ],
			   'production'=>[
				'icon'=>'<i class="fas fa-tools"></i>',
			   'title'=> 'Módulo de Producción',
			   'keys' => [
				   'production_list'=>'Puede ver listado de producción.',
				   'production_add'=>'Puede agregar producción.',
				   'production_edit'=>'Puede editar el listado de producción.',
				   'production_delete'=>'Puede eliminar el producción.',
			   ]
	  
			   ],
			   'exitmaterial'=>[
				'icon'=>'<i class="fas fa-tools"></i>',
			   'title'=> 'Modulo Salida Material',
			   'keys' => [
				   'exitmaterial_list'=>'Puede ver listado de Salida Material.',
				   'exitmaterial_add'=>'Puede agregar Salida Material.',
				   'exitmaterial_edit'=>'Puede editar el listado de Salida Material.',
				   'exitmaterial_delete'=>'Puede eliminar el Salida Material.',
			   ]
	  
			   ],

];
return $p;
}

function getUserYears(){
	$ya=date('Y');
	$ym=$ya-18;
	$yo=$ym-62;
	return [$ym,$yo];
}
function getMonths($mode, $key){
	$m=[
		'01'=>'Enero',
		'02'=>'Febrero',
		'03'=>'Marzo',
		'04'=>'Abril',
		'05'=>'Mayo',
		'06'=>'Junio',
		'07'=>'Julio',
		'08'=>'Agosto',
		'09'=>'Septiembre',
		'10'=>'Octubre',
		'11'=>'Noviembre',
		'12'=>'Diciembre'

	];
	if($mode=="list"){
		return $m;
	}else{
		return $m[$key];
	}
}
function getShippingMethod($method = null){
	$status=['0'=>'Gratis', '1'=>'Valor fijo por producto', '2'=>'Valor variable por ubicación','3'=>'Envío gratis / Monto mínimo'];

	if(is_null($method)):
		return $status;
	else:
		return $status[$method];
	endif;
}

function getCoverageType($mode=null){
	$roles=['0'=>'Provincia', '1'=>'Ciudad'];
	if(is_null($mode)):
		return $roles;
	else:
		return $roles[$mode];
	endif;

}
function getCoverageStatus($status =null){
	$list =['0'=>'No activo', '1'=>'Activo'];
	if(is_null($status)): 
		return $list;
	else: 
		return $list[$status];
	endif;
}

function getEnableorNot($status =null){
	$list =['0'=>'No activo', '1'=>'Activo'];
	if(is_null($status)): 
		return $list;
	else: 
		return $list[$status];
	endif;
}
function getPaymentsMethods($status =null){
	$list =['0'=>'Efectivo', '1'=>'Transferencia o depósito', '2'=>'Paypal', '3'=>'Tarjeta de crédito'];
	if(is_null($status)): 
		return $list;
	else: 
		return $list[$status];
	endif;
}
function getOrderStatus($status =null){
	$list =['0'=>'En proceso',
	 '1'=>'Pago pendiente confirmar', 
	 '2'=>'Pago recibido',
	  '3'=>'Procesando orden',
	  '4'=>'Orden enviada',
	  '5'=>'Lista para recoger',
	  '6'=>'Orden entregada',
	  '100'=>'Orden rechazada',
	];
	if(is_null($status)): 
		return $list;
	else: 
		return $list[$status];
	endif;
}
function getOrderType($status =null){
	$list =['0'=>'Entrega a domicilio',
	 '1'=>'TO-GO', 
	];
	if(is_null($status)): 
		return $list;
	else: 
		return $list[$status];
	endif;
}