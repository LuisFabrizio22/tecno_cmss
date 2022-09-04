<div class="sidebar shadow">
	<div class="section-top">
		<div class="logo">
			<img src="{{url('static\images\logo.png')}}" class="img-fluid">
		</div>

		<div class="user">
			<span class="subtitle">Módulo {{getRoleUserArray(null, Auth::user()->role)}}</span>
			<div class="name">
				{{Auth::user()->name}} {{Auth::user()->lastname}}
				<a href="{{url('/logout')}}" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="salir"><i class="fas fa-sign-out-alt"></i></a>
			</div>
			<div class="email">{{Auth::user()->email}}</div>
		</div>

	</div>
	<div class="main"> 
		<ul> 
			@if(kvfj(Auth::user()->permissions, 'dashboard'))
			<li> 
				<a href="{{url('/admin')}}" class="lk-dashboard"><i class="fas fa-home"></i>Dashboard</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'products'))
			<li> 
				<a href="{{url('/admin/products/1')}}" class="lk-products lk-product_inventory lk-product_add lk-product_search lk-product_edit">
					<i class="fas fa-boxes"></i>Artículos</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'orders_list'))
			<li> 
				<a href="{{url('/admin/orders/all/all')}}" class="lk-orders_list"><i class="fas fa-clipboard-list"></i>Ordenes</a>
			</li>
			@endif

			@if(kvfj(Auth::user()->permissions, 'coverage_list'))
			<li> 
				<a href="{{url('/admin/coverage')}}" class="lk-coverage_list lk-coverage_edit"><i class="fas fa-shipping-fast"></i></i>Cobertura de envios</a>
			</li>
			@endif

			@if(kvfj(Auth::user()->permissions, 'categories'))
			<li> 
				<a href="{{url('/admin/categories')}} " class="lk-categories lk-category_add lk-category_edit lk-category_delete">
					
					<i class="fas fa-folder-open"></i>Categorias</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'user_list'))
			<li> 
				<a href="{{url('/admin/users/all')}}" class="lk-user_list lk-user_permissions lk-user_edit"><i class="fas fa-users"></i>Usuarios</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'sliders_list'))
			<li> 
				<a href="{{url('/admin/sliders')}}" class="lk-sliders_list lk-slider_add lk-slider_edit lk-slider_delete"><i class="far fa-images"></i>Sliders</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'material_list'))
			<li> 
				<a href="{{url('/admin/material')}}" class="lk-material_list lk-material_add lk-material_edit lk-material_delete"><i class="fas fa-warehouse"></i>Material</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'entrymaterial_list'))
			<li> 
				<a href="{{url('/admin/entrymaterial')}}" class="lk-entrymaterial_list lk-entrymaterial_add lk-entrymaterial_edit lk-material_delete"><i class="fas fa-tools"></i></i>Ingreso Material</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'production_list'))
			<li> 
				<a href="{{url('/admin/production')}}" class="lk-production_list lk-production_add lk-production_edit lk-production_delete"><i class="fas fa-couch"></i>Produción</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'exitmaterial_list'))
			<li> 
				<a href="{{url('/admin/exitmaterial')}}" class="lk-exitmaterial_list lk-exitmaterial_add lk-exitmaterial_edit lk-exitmaterial_delete"><i class="fas fa-truck-loading"></i>Salida Material</a>
			</li>
			@endif
			
		
			@if(kvfj(Auth::user()->permissions, 'settings'))
			<li> 
				<a href="{{url('/admin/settings')}}" class="lk-settings"><i class="fas fa-cogs"></i>Configuraciones</a>
			</li>
			@endif
			
			

		</ul>


	</div>
</div>