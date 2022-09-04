@extends('admin.master')
@section('title', 'Salida Bodega')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/entrymaterial') }}"><i class="fas fa-boxes"></i> Material</a> </li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/entrymaterial/add') }}"><i class="fas fa-plus"></i> Salida Material</a>
    </li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i> Salida Material</h2>
                </div>
                <div class="inside">
                    @if (kvfj(Auth::user()->permissions, 'exitmaterial_add'))
                        {!! Form::open(['url' => '/admin/exitmaterial/add']) !!}   

                        <label for="material" class="">Material:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::select('material', $cats,0, ['class' => 'form-select']) !!}
                        </div>

                        <label for="cantidad_ingreso" class="mtop16">Cantidad Salida:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::number('cantidad_salida', null, ['class' => 'form-control']) !!}
                        </div>
                        <label for="date" class="mtop16">Fecha de Salida:</label>
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
        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header"> 
                    <h2 class="title"><i class="fas fa-folder-open"></i> Salida Material</h2>
                </div>
                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td width="64px"></td>
                                <td><strong>Nombre</strong></td>
                                <td><strong>Cantidad</strong></td>
                                
                                

                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        
                         @foreach ($cats1 as $material)
                            <tr>
                                <td></td>
                                <td>{{$material->descripcion}} </td>
                                <td>{{$material->cantidad_disponible}}</td>
                               
                                <td></td>
                          


                                
                                <td>
                                    <div class="opts">
                                       
                                            <a href="{{ url('/admin/material/' . $material->id_material . '/edit') }}"
                                                data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                
                                      
                                            <a href="{{ url('/admin/material/' . $material->id_material . '/delete') }}"
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
