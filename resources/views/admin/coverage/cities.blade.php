@extends('admin.master')
@section('title', 'Cobertura de envios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/') }}"><i class="fas fa-shipping-fast"></i> Covertura de envios</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/'.$state->id.'/cities') }}"><i class="fas fa-shipping-fast"></i>Ciudades de: {{ $state->name }}</a>
    </li>
  
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>Agregar ciudad para envío</h2>
                    </div>
                    <div class="inside">
                            {!! Form::open(['url' => '/admin/coverage/city/add']) !!}
                            {!! Form::hidden('province_id', $id) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <label for="price" class="mtop16">Valor del envío:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('price', 0, ['class' => 'form-control', 'min'=>'0', 'step' =>'any']) !!}
                            </div>

                            <label for="days" class="mtop16">Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('days', 0, ['class' => 'form-control', 'min'=>'0', 'step' =>'any']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                  
                    </div>
                </div>
            </div>
    
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-shipping-fast"></i>Ciudades de: {{ $state->name }}</h2>
                    </div>
                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td><strong>Estatus</strong></td>
                                    <td><strong>Ciudad</strong></td>
                                    <td><strong>Valor del envío</strong></td>
                                    <td><strong>Entrega estimada</strong></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $state )
                                <tr>
                                    <td>{{getCoverageStatus($state->status) }}</td>
                                    <td>{{ $state->name }}</td>
                                    <td>{{ config('localhost.currency') }} {{ $state->price }}</td>
                                    <td>{{ $state->days }} días</td>
                                 
                                    <td>
                                        <div class="opts">
                                            @if (kvfj(Auth::user()->permissions, 'coverage_edit'))
                                                <a href="{{ url('/admin/coverage/city/' . $state->id . '/edit') }}"
                                                    data-toggle="tooltip" data-placement="top"  class="edit" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                          
                                            @if (kvfj(Auth::user()->permissions, 'coverage_delete'))
                                            <a href="{{ url('/admin/coverage/' . $state->id . '/delete') }}"
                                                data-action="delete"
                                                data-path="admin/coverage"
                                                data-object="{{$state->id}}"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Eliminar" class="btn-deleted deleted">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            @endif
                                        </div>
                                    </td>
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
