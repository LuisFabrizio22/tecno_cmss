@extends('connect.master')
@section('title', 'Login')


@section('content')

<div class="box" box_login shadow>
	<div class="header">
		<a href="{{url('/')}}">
			<img src="{{url('/static/images/avatar_default.png')}}">

		</a>
	</div>
	<div class="inside">

	{!! Form::open(['url'=>'/login'])!!}
	<label for="email">Correo electrónico</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="far fa-envelope-open"></i></div>
		</div>
		{!! Form::email('email',null,['class'=>'form-control' ])!!}
	</div>

	<label for="email" class="mtop16">Password:</label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fas fa-lock"></i></div>
		</div>
		{!! Form::password('password', ['class'=>'form-control'])!!}
	</div>

	{!! Form::submit('Ingresar', ['class'=> 'btn btn-sucess mtop16'])!!}
	{!! Form::close()!!}
	</div>
@if(Session::has('message'))
		<div class="container">
			<div class="alert alert-{{Session::get('typealert')}}" style="display: none;"> 
				{{Session::get('message')}}
				@if(count($errors)>0)
				<ul>
					@foreach($errors->all() as $error)


					<li>
						{{$error}}

					</li>

					@endforeach
				</ul>
				@endif
				<script>
					$('.alert').slideDown();
					setTimeout(function(){$('.alert').slideDown();}, 10000);

				</script>

			</div>
		</div>
	@endif
	<div class="mtop16">
		<a href="{{url('/register')}}">¿no tienes una cuenta?, Registrate </a>
		<a href="{{url('/recover')}}">Recuperar contraseña </a>
	</div>
</div>

@stop