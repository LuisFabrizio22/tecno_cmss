<?php

Route::prefix('/admin')->group(function(){
	Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

	//module settigs

	Route::get('/settings', 'Admin\SettingsController@getHome')->name('settings');
	Route::post('/settings', 'Admin\SettingsController@postHome')->name('settings');

	
	//module Users

	Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
	Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
	Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit');
	Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
	Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
	Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');
	
	//modulo productos

	Route::get('/products/{status}', 'Admin\ProductController@getHome')->name('products');
	Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name('product_add');
	Route::get('/product/{id_articulo}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit');
	Route::get('/product/{id_articulo}/inventory', 'Admin\ProductController@getProductInventory')->name('product_inventory');
	Route::post('/product/{id_articulo}/inventory', 'Admin\ProductController@postProductInventory')->name('product_inventory');
	Route::get('/product/{id_articulo}/delete', 'Admin\ProductController@getProductDelete')->name('product_delete');
	Route::get('/product/{id_articulo}/restore', 'Admin\ProductController@getProductRestore')->name('product_delete');
	Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name('product_add');
	Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name('product_search');
	Route::post('/product/{id_articulo}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');
	Route::post('/product/{id_articulo}/gallery/add', 'Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
	Route::get('/product/{id_articulo}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');

	//modulos inventario

	Route::get('/product/inventory/{id}/edit', 'Admin\ProductController@getProductInventoryEdit')->name('product_inventory');
	Route::post('/product/inventory/{id}/variant', 'Admin\ProductController@postProductInventoryVariantAdd')->name('product_inventory');
	Route::post('/product/inventory/{id}/edit', 'Admin\ProductController@postProductInventoryEdit')->name('product_inventory');
	Route::get('/product/inventory/{id}/delete', 'Admin\ProductController@getProductInventoryDelete')->name('product_inventory');
	Route::get('/product/variant/{id}/delete', 'Admin\ProductController@getProductInventoryVariantDelete')->name('product_inventory');


	//modulo categorias

	Route::get('/categories','Admin\CategoriesController@getHome')->name('categories');
	Route::post('/categories/add', 'Admin\CategoriesController@postCategoryAdd')->name('category_add');
	Route::get('/categories/{id_categoria}/delete', 'Admin\CategoriesController@getCategoryDelete')->name('category_delete');
	Route::post('/categories/{id_categoria}/edit', 'Admin\CategoriesController@postCategoryEdit')->name('category_edit');
	Route::get('/categories/{id_categoria}/edit', 'Admin\CategoriesController@getCategoryEdit')->name('category_edit');
	Route::get('/categories/{id_categoria}/subs', 'Admin\CategoriesController@getSubCategories')->name('category_add');

	//coverage 
	Route::get('/coverage', 'Admin\CoverageController@getList')->name('coverage_list');
	Route::post('/coverage/state/add', 'Admin\CoverageController@postCoverageStateAdd')->name('coverage_add');
	Route::get('/coverage/{id}/edit', 'Admin\CoverageController@getCoverageEdit')->name('coverage_edit');
	Route::get('/coverage/city/{id}/edit', 'Admin\CoverageController@getCoverageCityEdit')->name('coverage_edit');
	Route::post('/coverage/city/{id}/edit', 'Admin\CoverageController@postCoverageCityEdit')->name('coverage_edit');

	Route::post('/coverage/state/{id}/edit', 'Admin\CoverageController@postCoverageStateEdit')->name('coverage_edit');
	Route::get('/coverage/{id}/cities', 'Admin\CoverageController@getCoverageCities')->name('coverage_list');
	Route::get('/coverage/{id}/delete', 'Admin\CoverageController@getCoverageDelete')->name('coverage_delete');
	Route::post('/coverage/city/add', 'Admin\CoverageController@postCoverageCityAdd')->name('coverage_add');

	//modulo material

	Route::get('/material', 'Admin\MaterialController@getHome')->name('material_list');
	Route::post('/material/add', 'Admin\MaterialController@postMaterialAdd')->name('material_add');

	//Module ordenes
	Route::get('/orders/{status}/{type}', 'Admin\OrderController@getList')->name('orders_list');
	Route::get('/order/{order}/view', 'Admin\OrderController@getOrder')->name('order_view');
	Route::post('/order/{order}/view', 'Admin\OrderController@postOrderStatusUpdate')->name('order_view');




	//modulo ingreso material
	Route::get('/entrymaterial', 'Admin\EntryMaterialController@getHome')->name('entrymaterial_list');

	Route::post('/entrymaterial/add', 'Admin\EntryMaterialController@postEntryMaterialAdd')->name('entrymaterial_add');
	//modulo salida material
	Route::get('/exitmaterial', 'Admin\ExitMaterialController@getHome')->name('exitmaterial_list');
	Route::post('/exitmaterial/add', 'Admin\ExitMaterialController@postExitMaterialAdd')->name('exitmaterial_add');




	//modulo produccion

	Route::get('/production', 'Admin\ProductionController@getHome')->name('production_list');
	Route::get('/production/add', 'Admin\ProductionController@getProductionAdd')->name('production_add');
	Route::post('/production/add', 'Admin\ProductionController@postProductionAdd')->name('production_add');







	//sliders

	Route::get('/sliders', 'Admin\SliderController@getHome')->name('sliders_list');
	Route::post('/slider/add', 'Admin\SliderController@postSliderAdd')->name('slider_add');
	Route::get('/slider/{id}/edit', 'Admin\SliderController@getSliderEdit')->name('slider_edit');
	Route::post('/slider/{id}/edit', 'Admin\SliderController@postSliderEdit')->name('slider_edit');
	Route::get('/slider/{id}/delete', 'Admin\SliderController@getSliderDelete')->name('slider_delete');


	//javascript request

	Route::get('/md/api/load/subcategories/{parent}', 'Admin\ApiController@getSubCategories');
	

});




