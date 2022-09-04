<div class="sidebar shadow">
	<div class="section-top">
		<div class="logo">
			<img src="{{url('static\images\logo.png')}}" class="img-fluid">
		</div>

		<div class="user">
			<span class="subtitle">Módulo Bodega</span>
			<div class="name">
				{{Auth::user()->name}} {{Auth::user()->lastname}}
				<a href="{{url('/logout')}}" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" title="salir"><i class="fas fa-sign-out-alt"></i></a>
			</div>
			<div class="email">{{Auth::user()->email}}</div>
		</div>

	</div>
	<div class="main"> 
		<ul> 
			<li> 
				<a href="{{url('/bodega')}}"><i class="fas fa-home"></i>Dashboard</a>
			</li>
			<li> 
				<a href="{{url('/bodega/products')}}"><i class="fas fa-truck-pickup"></i>Ingreso Material</a>
			</li>
			<li> 
				<a href="{{url('/bodega/categories')}}"><i class="fas fa-tools"></i>Material</a>
			</li>
			<li> 
				<a href="{{url('/bodega/users')}}"><i class="fas fa-couch"></i></i>Salida Material</a>
			</li>


		</ul>


	</div>
</div>