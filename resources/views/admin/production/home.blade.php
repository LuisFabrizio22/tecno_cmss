@extends('admin.master')
@section('title', 'Agregar Producción')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/material') }}"><i class="fas fa-boxes"></i> Produccción</a> </li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/material/add') }}"><i class="fas fa-plus"></i> Agregar Producción</a>
    </li>
@endsection
@section('content')
<div class="container-fluid flex">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i> Agregar Producción</h2>
                </div>
                <div class="inside">
                    @if (kvfj(Auth::user()->permissions, 'production_add'))
                        {!! Form::open(['url' => '/admin/production/add']) !!}   
                        <label for="descripcion" class="">Articulo:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::select('articulo', $cats, 0, ['class' => 'form-select']) !!}
                        </div>
                        <label for="order" class="mtop16">Cantidad:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
                        </div>
                        <label for="order" class="mtop16">Fecha:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::date('date', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel shadow">
                <div class="header"> 
                    <h2 class="title"><i class="fas fa-folder-open"></i> Producción</h2>
                </div>
                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Nombre articulo</td>
                                <td>Cantidad</td>
                                <td>Fecha:</td>
                                <td></td>
                            
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($productions as $production)
                            <tr>
                                <td></td>
                                <td>{{ $production->cat->nombre_articulo }} </td>
                                <td>{{$production->cantidad}}</td>
                              
                                <td>{{$production->fecha }} </td>
                              
                                <td>
                                    <div class="opts">
                                       
                                            <a href="{{ url('/admin/material/' . $production->id_produccion . '/edit') }}"
                                                data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                
                                      
                                            <a href="{{ url('/admin/material/' . $production->id_produccion . '/delete') }}"
                                                data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                    
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
    </div>
</div>
    @endsection
