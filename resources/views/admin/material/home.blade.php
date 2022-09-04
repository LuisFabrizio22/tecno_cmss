@extends('admin.master')
@section('title', 'Agregar Material')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/material') }}"><i class="fas fa-boxes"></i> Material</a> </li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/material/add') }}"><i class="fas fa-plus"></i> Agregar Material</a>
    </li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i> Agregar Material</h2>
                </div>
                <div class="inside">
                  
                        {!! Form::open(['url' => '/admin/material/add']) !!}   
                        <label for="descripcion" class="">Descripción:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                        </div>
                        <label for="order" class="mtop16">Cantidad disponible:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::number('order', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                
                </div>
            </div>
        </div>
       
    </div>
</div>
    @endsection
