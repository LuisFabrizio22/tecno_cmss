@extends('admin.master')
@section('title', 'Usuarios')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-users"></i>Usuarios</a>
    </li>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-users"></i>Usuarios</h2>
            </div>
            <div class="inside">
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle " type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;">
								<i class="fas fa-filter"></i>
                                Filtrar
							</button>
							 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								 <a class="dropdown-item" href="{{url('/admin/users/all')}}"><i class="fas fa-stream"></i>Todos</a>
								 <a class="dropdown-item" href="{{url('/admin/users/0')}}"><i class="fas fa-unlink"></i>noo verificando</a>
								 <a class="dropdown-item" href="{{url('/admin/users/1')}}"><i class="fas fa-user-check"></i>Verificado</a>
								 <a class="dropdown-item" href="{{url('/admin/users/100')}}"><i class="fas fa-heart-broken"></i>Suspendido</a>
								 
							 </div>
                        </div>
                    </div>
                </div>

                <table class="table mtop16">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td> </td>
                            <td>Nombre</td>
                            <td>Apellido</td>
							<td>Email</td>
							<td>Rol</td>
                            <td>Estado</td>
                           

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                         
                                <td>{{ $user->id }}</td>
                                <td width="64"> 
                                @if (is_null($user->avatar))
                                    <img src="{{ url('/static/images/avatar_default.png') }}" class="img-fluid rounded-circle">
                                @else
                                    <img src="{{ url('/uploads_users/' . $user->id . '/' . $user->avatar) }}" class="img-fluid rounded-circle">

                                @endif</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
								<td>{{getRoleUserArray(null, $user->role)}}</td>
								<td>{{getUserStatusArray(null, $user->status)}} </td>
                                <td>

                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'user_edit')) 
                                        <a href="{{ url('/admin/user/' . $user->id . '/edit') }}" data-toggle="tooltip"
                                            data-toggle="tooltip" data-placement="top" title="editar">
                                            <i class="fas fa-edit"></i></a>

                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'user_permissions')) 
                                          
                           
                                        <a href="{{ url('/admin/user/' . $user->id . '/permissions') }}" data-toggle="tooltip"
                                            data-toggle="tooltip" data-placement="top" title="Permisos de usuario">
                                            <i class="fas fa-cogs"></i></a>

                                            @endif
                                    </div>
                                </td>


                            </tr>
                        @endforeach
						<tr>
							<td colspan="5">{!!$users->render()!!}</td>
						</tr>
                    </tbody>

                </table>

            </div>

        </div>
    </div>

@endsection
